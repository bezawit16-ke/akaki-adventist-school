<?php
session_start();
if (isset($_POST['login'])) {
    $password = $_POST['password'];
    // You can change 'admin123' to any password you like
    if ($password == 'admin123') {
        $_SESSION['admin'] = true;
        header("Location: view.php");
        exit();
    } else {
        $error = "Incorrect Password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcome-page">
    <div class="glass-card">
        <h2>School Admin Login</h2>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter Admin Password" required style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">
            <button type="submit" name="login" class="modern-btn">Login</button>
            <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>