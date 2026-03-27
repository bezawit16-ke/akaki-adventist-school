<?php
$servername = "localhost:3307"; // Using the port that worked for you
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

// Create the database
$conn->query("CREATE DATABASE IF NOT EXISTS akaki_school");
$conn->select_db("akaki_school");

// Create the table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    email VARCHAR(100),
    grade VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Database & Table Created Successfully! You are ready.";
} else {
    echo "Error: " . $conn->error;
}
?>