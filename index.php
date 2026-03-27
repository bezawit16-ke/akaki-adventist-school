
<?php 
// This helps the server handle the file correctly
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome | Akaki Adventist School</title>
     <link rel="stylesheet" href="style.css?v=99">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="manifest" href="manifest.json">
<meta name="theme-color" content="#2c3e50">
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
        <div class="glass-card fade-in">
        <div class="logo-container">
   <img src="logo.png?v=1" class="form-logo">
</div>
            <h1 class="school-title">Akaki Adventist School</h1>
            <p class="tagline">"Empowering Minds, Nurturing Hearts for Eternity"</p>

            <div class="divider"></div>

            <a href="registration.php" class="modern-btn">
                <span>GET STARTED</span>
                <div class="btn-hover-effect"></div>
            </a>
           <div style="margin-top: 25px;">
        <a href="login.php" style="
            font-size: 0.8rem; 
            color: rgba(255, 255, 255, 0.5); 
            text-decoration: none; 
            text-transform: uppercase; 
            letter-spacing: 2px;
            transition: 0.3s;
        " onmouseover="this.style.color='#d4af37'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
            Admin Login
        </a>
    </div>
        </div>
    </body>

</html>