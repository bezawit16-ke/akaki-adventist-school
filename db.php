<?php
// Clear and clean connection for InfinityFree
$host = "sql111.infinityfree.com";      // Look for 'MySQL Hostname' in vPanel
$user = "if0_40832534";                // Look for 'MySQL Username' in vPanel
$pass = "XrRy7zdwZXgzpz";        // The password you use to log into InfinityFree
$dbname = "if0_40832534_registration"; // The EXACT database name you created

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Global Database Connection Failed: " . mysqli_connect_error());
}

// Ensure special characters work
mysqli_set_charset($conn, "utf8mb4");

// Automatically ensure the table exists (Running this once is enough)
$sql_update = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100),
    parent_phone VARCHAR(20),
    grade VARCHAR(20),
    photo VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql_update);
?>