<?php
session_start();

// SECURITY CHECK: Only logged-in officials can generate ID cards
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
    $student = mysqli_fetch_assoc($result);

    if (!$student) { 
        die("<body style='background:#f0f2f5; font-family:sans-serif; text-align:center; padding-top:50px;'>
            <h2>Student not found.</h2>
            <a href='view.php'>Return to Dashboard</a>
            </body>"); 
    }
} else { 
    die("No ID specified."); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ID Card - <?php echo $student['fullname']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; display: flex; flex-direction: column; align-items: center; padding: 40px; }
        
        .card-container { display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; }

        /* General Card Properties */
        .id-card {
            width: 350px;
            height: 220px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #ccc;
            position: relative;
            overflow: hidden;
        }

        /* FRONT SIDE STYLING */
        .side-bar { width: 15px; background: #1e4d2b; height: 100%; position: absolute; left: 0; }
        .front-content { padding: 15px 15px 15px 30px; display: flex; }
        .photo-box img { width: 90px; height: 110px; object-fit: cover; border-radius: 5px; border: 2px solid #1e4d2b; }
        .info-box { padding-left: 15px; flex-grow: 1; }
        .school-header { font-size: 14px; font-weight: 700; color: #1e4d2b; border-bottom: 1px solid #d4af37; margin-bottom: 8px; }
        .detail-label { font-size: 9px; color: #777; text-transform: uppercase; margin-top: 5px; }
        .detail-value { font-size: 12px; font-weight: 600; color: #222; }

        /* BACK SIDE STYLING */
        .back-content { padding: 15px; text-align: left; }
        .rules-title { font-size: 11px; font-weight: 700; color: #1e4d2b; text-align: center; margin-bottom: 5px; text-decoration: underline; }
        .rules-list { font-size: 9px; color: #333; line-height: 1.3; padding-left: 15px; margin: 0; }
        .signature-area { margin-top: 15px; display: flex; justify-content: space-between; align-items: flex-end; }
        .sig-box { text-align: center; width: 100px; }
        .sig-line { border-top: 1px solid #333; font-size: 8px; margin-top: 5px; }
        .emergency { font-size: 9px; font-weight: 700; color: #c0392b; margin-top: 10px; text-align: center; }

        .no-print { margin-top: 30px; }
        
        @media print {
            body { background: white; padding: 0; }
            .no-print { display: none; }
            .id-card { box-shadow: none; page-break-inside: avoid; border: 1px solid #000; }
        }
    </style>
</head>
<body>

    <div class="card-container">
        <div class="id-card">
            <div class="side-bar"></div>
            <div class="front-content">
                <div class="photo-box">
                    <img src="uploads/<?php echo $student['photo']; ?>" onerror="this.src='https://via.placeholder.com/90x110?text=No+Photo'">
                </div>
                <div class="info-box">
                    <div class="school-header">AKAKI ADVENTIST SCHOOL</div>
                    <div class="detail-label">Student Name</div>
                    <div class="detail-value"><?php echo $student['fullname']; ?></div>
                    
                    <div class="detail-label">Student ID / Grade</div>
                    <div class="detail-value">AAS-<?php echo $student['id']; ?> / <?php echo $student['grade']; ?></div>
                    
                    <div class="detail-label">Parent Phone</div>
                    <div class="detail-value"><?php echo $student['parent_phone']; ?></div>
                </div>
            </div>
            <div style="background:#1e4d2b; color:white; font-size:9px; position:absolute; bottom:0; width:100%; text-align:center; padding:3px;">
                Empowering Minds, Nurturing Hearts for Eternity
            </div>
        </div>

        <div class="id-card">
            <div class="back-content">
                <div class="rules-title">RULES AND REGULATIONS</div>
                <ul class="rules-list">
                    <li>This card is the property of Akaki Adventist School.</li>
                    <li>The student must wear this card at all times while on campus.</li>
                    <li>This card is non-transferable and must be presented upon request.</li>
                    <li>If found, please return to the school administration office.</li>
                    <li>Loss of this card must be reported immediately. Replacement fees apply.</li>
                </ul>
                
                <div class="emergency">IN CASE OF EMERGENCY: +251 114 340 006</div>

                <div class="signature-area">
                    <div class="sig-box">
                        <div style="height:20px;"></div> <div class="sig-line">School Registrar</div>
                    </div>
                    <div class="sig-box">
                        <div style="height:20px;"></div>
                        <div class="sig-line">School Principal</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()" style="padding: 12px 25px; background: #1e4d2b; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">🖨️ Print Both Sides</button>
        <a href="view.php" style="margin-left: 15px; color: #666; text-decoration: none;">Return to Dashboard</a>
    </div>

</body>
</html>