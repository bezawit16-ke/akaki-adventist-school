<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Collect and Sanitize Text Data
    $name  = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age   = mysqli_real_escape_string($conn, $_POST['age']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']); 
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);

    // 2. Setup Upload Folder
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        @mkdir($target_dir, 0755, true); 
    }

    // 3. File Upload Logic (Photo)
    $photo_name = "";
    if(!empty($_FILES["photo"]["name"])) {
        $photo_name = time() . "_photo_" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $photo_name);
    }

    // 4. File Upload Logic (Birth Cert)
    $birth_name = "";
    if(!empty($_FILES["birth_card"]["name"])) {
        $birth_name = time() . "_birth_" . basename($_FILES["birth_card"]["name"]);
        move_uploaded_file($_FILES["birth_card"]["tmp_name"], $target_dir . $birth_name);
    }

    // 5. File Upload Logic (Digital ID)
    $digital_name = "";
    if(!empty($_FILES["digital_id"]["name"])) {
        $digital_name = time() . "_id_" . basename($_FILES["digital_id"]["name"]);
        move_uploaded_file($_FILES["digital_id"]["tmp_name"], $target_dir . $digital_name);
    }

    // 6. Insert into Database 
    $sql = "INSERT INTO students (fullname, email, age, parent_phone, grade, photo, birth_card, digital_id) 
            VALUES ('$name', '$email', '$age', '$phone', '$grade', '$photo_name', '$birth_name', '$digital_name')";

    if (mysqli_query($conn, $sql)) {
        // SUCCESS: Show Private Card instead of redirecting to view.php
        $new_id = mysqli_insert_id($conn);
        echo "<!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='style.css'>
            <title>Registration Successful</title>
        </head>
        <body class='welcome-page'>
            <div class='glass-card' style='text-align:center; max-width:500px;'>
                <h1 style='color: #1e4d2b; font-size: 3rem;'>✔</h1>
                <h2 style='color: #1e4d2b;'>Registration Successful!</h2>
                <p>Thank you, <strong>$name</strong>. Your data has been securely saved.</p>
                
                <div style='background: rgba(0,0,0,0.05); padding: 20px; border-radius: 10px; margin: 20px 0; border: 1px dashed #1e4d2b;'>
                    <span style='font-size: 0.8rem; color: #666; letter-spacing:1px;'>YOUR STUDENT ID:</span><br>
                    <strong style='font-size: 2rem; color: #1e4d2b;'>AAS-$new_id</strong>
                </div>
                
                <p style='font-size: 0.85rem; color: #555;'>Please write this ID down. Only officials can access the full student dashboard.</p>
                <br>
                <a href='index.php' class='modern-btn' style='text-decoration:none; display:inline-block;'>Back to Home</a>
            </div>
        </body>
        </html>";
        exit();
    } else {
        echo "<h3>Database Error!</h3>";
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>