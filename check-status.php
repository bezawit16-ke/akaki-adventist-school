<?php
include 'db.php';
$student = null;

if (isset($_POST['search'])) {
    $search_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    // Remove 'AAS-' prefix if they typed it
    $id_only = str_replace("AAS-", "", $search_id);
    
    $result = mysqli_query($conn, "SELECT * FROM students WHERE id = '$id_only'");
    $student = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check Registration Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcome-page">
    <div class="glass-card">
        <h3>View My Registration</h3>
        <form method="POST">
            <input type="text" name="student_id" placeholder="Enter Student ID (e.g. AAS-101)" required style="width:100%; padding:10px; margin-bottom:10px;">
            <button type="submit" name="search" class="modern-btn">Find My Data</button>
        </form>

        <?php if ($student): ?>
            <div style="text-align:left; margin-top:20px; background:rgba(255,255,255,0.2); padding:15px; border-radius:10px;">
                <p><strong>Name:</strong> <?php echo $student['fullname']; ?></p>
                <p><strong>Grade:</strong> <?php echo $student['grade']; ?></p>
                <p><strong>Status:</strong> <span style="color:yellow;">Pending Review</span></p>
                <hr>
                <p style="font-size:0.8rem;">To edit this data, please contact the Registrar Office.</p>
            </div>
        <?php elseif (isset($_POST['search'])): ?>
            <p style="color:red; margin-top:10px;">No record found with that ID.</p>
        <?php endif; ?>
        
        <br><a href="index.php" style="color:white; font-size:0.8rem;">← Back</a>
    </div>
</body>
</html>