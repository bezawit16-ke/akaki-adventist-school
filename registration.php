<?php 
include 'db.php'; 
// Check if connection exists, if not, show error
if (!$conn) {
    die("Database connection missing. Please check db.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration | Akaki Adventist</title>
    <link rel="stylesheet" href="style.css?v=5">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="manifest" href="manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#1e4d2b">
     <style>/* Add this to style.css for better button interaction */
.modern-btn {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
}

.modern-btn:hover {
    transform: scale(1.05) translateY(-3px);
    box-shadow: 0 15px 30px rgba(30, 77, 43, 0.4);
}

.modern-btn:active {
    transform: scale(0.98);
}
        </style>
</head>
<body class="welcome-page"> 

    <div id="loader-overlay" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:999; flex-direction:column; justify-content:center; align-items:center;">
        <div class="spinner"></div>
        <h3 style="color:white; margin-top:15px; font-family: 'Poppins';">Saving to Database...</h3>
    </div>

    <div class="glass-card" style="max-width: 700px; margin: 20px auto;">
        <div class="form-header">
            <div class="logo-container">
          <img src="logo.png?v=1" class="form-logo">
            </div>
            <h2 class="form-title">Student Registration</h2>
            <p class="form-subtitle">Join the Akaki Adventist School Community</p>
            <div class="header-divider"></div>
        </div>

        <form action="save.php" method="POST" enctype="multipart/form-data" id="registrationForm">
            
            <div class="input-row" style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div class="input-group" style="flex: 1;">
                    <label>Full Name</label>
                    <input type="text" name="fullname" placeholder="Student Full Name" required>
                </div>
                <div class="input-group" style="flex: 1;">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="example@mail.com" required>
                </div>
            </div>

            <div class="input-row" style="display: flex; gap: 15px; align-items: flex-end; margin-bottom: 25px;">
                <div class="input-group" style="flex: 1;">
                    <label>Student Age</label>
                    <input type="number" name="age" placeholder="Age" min="3" max="20" required>
                </div>
                <div class="input-group" style="flex: 1;">
                    <label>Parent Phone</label>
                    <input type="text" name="phone" placeholder="09..." required>
                </div>
                <div class="input-group" style="flex: 1;">
                    <label>Select Grade</label>
                    <select name="grade" required>
                        <option value="" disabled selected hidden>-- Choose --</option>
                        <optgroup label="Kindergarten">
                            <option value="KG-1">KG-1</option>
                            <option value="KG-2">KG-2</option>
                            <option value="KG-3">KG-3</option>
                        </optgroup>
                        <optgroup label="Primary School">
                            <option value="Grade 1">Grade 1</option>
                            <option value="Grade 2">Grade 2</option>
                            <option value="Grade 3">Grade 3</option>
                            <option value="Grade 4">Grade 4</option>
                            <option value="Grade 5">Grade 5</option>
                            <option value="Grade 6">Grade 6</option>
                            <option value="Grade 7">Grade 7</option>
                            <option value="Grade 8">Grade 8</option>
                        </optgroup>
                        <optgroup label="High School">
                            <option value="Grade 9">Grade 9</option>
                            <option value="Grade 10">Grade 10</option>
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="upload-section">
                <p class="section-title">Required Documents</p>
                <div class="upload-grid">
                    
                    <div class="upload-box" id="box-photo">
                        <input type="file" name="photo" id="photo" accept="image/*" required onchange="updateStatus('photo', '📸')">
                        <label for="photo">
                            <div class="icon">📸</div>
                            <span>Student Photo</span>
                            <p>JPG/PNG</p>
                        </label>
                    </div>

                    <div class="upload-box" id="box-birth">
                        <input type="file" name="birth_card" id="birth" accept=".pdf,image/*" required onchange="updateStatus('birth', '📜')">
                        <label for="birth">
                            <div class="icon">📜</div>
                            <span>Birth Cert.</span>
                            <p>PDF/IMG</p>
                        </label>
                    </div>

                    <div class="upload-box" id="box-digital">
                        <input type="file" name="digital_id" id="digital" accept=".pdf,image/*" required onchange="updateStatus('digital', '🪪')">
                        <label for="digital">
                            <div class="icon">🪪</div>
                            <span>Digital ID</span>
                            <p>PDF/IMG</p>
                        </label>
                    </div>

                </div>
            </div>

            <button type="submit" class="modern-btn" style="margin-top: 30px; width: 100%; cursor: pointer;">
                COMPLETE REGISTRATION
            </button>

        </form>

        <div style="margin-top: 25px; text-align: center;">
            <a href="index.php" style="color: #1e4d2b; text-decoration: none; font-size: 0.9rem; font-weight: 600;">← Back to Welcome Page</a>
        </div>
    </div>

    <script>
        // Loader logic
        document.getElementById('registrationForm').onsubmit = function() {
            document.getElementById('loader-overlay').style.display = 'flex';
        };
      
        // Update box appearance when file is selected
        function updateStatus(inputId, originalEmoji) {
            const input = document.getElementById(inputId);
            const box = input.parentElement;
            const icon = box.querySelector('.icon');
            const span = box.querySelector('span');
            const p = box.querySelector('p');

            if (input.files.length > 0) {
                box.classList.add('selected');
                icon.innerHTML = "✅";
                span.innerHTML = "Ready!";
                p.innerHTML = "File Attached";
                box.style.borderColor = "#2ecc71";
                box.style.background = "rgba(46, 204, 113, 0.1)";
            } else {
                box.classList.remove('selected');
                icon.innerHTML = originalEmoji;
                if(inputId === 'photo') span.innerHTML = 'Student Photo';
                else if(inputId === 'birth') span.innerHTML = 'Birth Cert.';
                else span.innerHTML = 'Digital ID';
                p.innerHTML = (inputId === 'photo') ? 'JPG/PNG' : 'PDF/IMG';
                box.style.borderColor = "";
                box.style.background = "";
            }
        }

        // Register Service Worker for PWA
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js');
        }
    </script>
</body>
</html>