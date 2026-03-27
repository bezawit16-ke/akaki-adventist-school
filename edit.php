<?php 
include 'db.php';

// 1. Get the student's current info to fill the boxes
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
    $student = mysqli_fetch_assoc($result);
    
    if (!$student) {
        die("Student not found.");
    }
}

// 2. Handle the "Update" button click
if(isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    
    // Using parent_phone to match your database column name
    $query = "UPDATE students SET fullname='$name', parent_phone='$phone', grade='$grade' WHERE id=$id";
    
    if(mysqli_query($conn, $query)) {
        header("Location: view.php?status=updated");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Akaki Adventist</title>
    <link rel="stylesheet" href="style.css?v=12">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="welcome-page">
    <div class="glass-card" style="max-width: 500px; margin: 50px auto; padding: 30px;">
        <h2 style="color: #1e4d2b; margin-top: 0;">Edit Student</h2>
        <p style="color: #666;">Updating details for: <strong><?php echo $student['fullname']; ?></strong></p>
        
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600;">Full Name</label>
                <input type="text" name="fullname" value="<?php echo $student['fullname']; ?>" required 
                       style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600;">Parent Phone</label>
                <input type="text" name="phone" value="<?php echo $student['parent_phone']; ?>" required 
                       style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 25px; text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600;">Grade</label>
                <select name="grade" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin-top: 5px;">
                    <option value="<?php echo $student['grade']; ?>"><?php echo $student['grade']; ?> (Current)</option>
                    <option value="KG-1">KG-1</option>
                    <option value="KG-2">KG-2</option>
                    <option value="KG-3">KG-3</option>
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>
            </div>

            <button type="submit" name="update" class="modern-btn" style="width: 100%;">
                SAVE CHANGES
            </button>
            
            <div style="margin-top: 20px;">
                <a href="view.php" style="color: #666; text-decoration: none; font-size: 0.9rem;">← Cancel and Go Back</a>
            </div>
        </form>
    </div>
</body>
</html>