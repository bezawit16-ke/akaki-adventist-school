<?php
$servername = "127.0.0.1:3307"; 
$username = "root";
$password = "";
$dbname = "akaki_school";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $grade = $_POST['grade'];

    // Using basic query for beginner level
    $sql = "INSERT INTO students (fullname, email, grade) VALUES ('$name', '$email', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "<body style='font-family:sans-serif; text-align:center; padding-top:50px;'>
                <div style='background:#d4edda; color:#155724; padding:20px; display:inline-block; border-radius:10px;'>
                    <h1>Registration Successful!</h1>
                    <p>Student <b>$name</b> is now registered.</p>
                    <a href='index.php' style='color:#155724; font-weight:bold;'>Add another student</a>
                </div>
              </body>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>