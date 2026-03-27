<?php 
session_start();

// SECURITY CHECK: If not logged in, redirect to index.php (Privacy protection)
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'db.php'; 

// Fetch all students from the database
$query = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Akaki Adventist</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eef0f2;
        }
        .action-btns { display: flex; gap: 10px; justify-content: center; }
        .act-id { background: #d4af37 !important; color: white !important; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; }
        .act-edit { background: #1e4d2b !important; color: white !important; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; }
        .act-del { background: #e74c3c !important; color: white !important; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; }
        .status-msg { padding: 10px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .student-thumb { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #1e4d2b; }
    </style>
</head>
<body class="welcome-page" style="display: block; overflow-y: auto;">

    <div class="dashboard-container">
        <div class="header-flex">
            <div>
                <h2 style="color: #1e4d2b;">Student Records</h2>
                <p style="font-size: 0.9rem; color: #666;">Official School Management Portal</p>
            </div>
            <a href="register.php" class="modern-btn" style="width: auto; padding: 10px 20px;">+ Add New Student</a>
        </div>

        <?php if(isset($_GET['status'])): ?>
            <div class="status-msg">Action processed successfully!</div>
        <?php endif; ?>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Grade</th>
                        <th>Parent Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php if(!empty($row['photo'])): ?>
                                <img src="uploads/<?php echo $row['photo']; ?>" class="student-thumb">
                            <?php else: ?>
                                <div style="width:45px;height:45px;background:#eee;border-radius:50%;margin:auto;"></div>
                            <?php endif; ?>
                        </td>
                        <td style="font-weight: 600;"><?php echo $row['fullname']; ?></td>
                        <td><span style="background:#f0f7f1; padding:4px 8px; border-radius:5px;"><?php echo $row['grade']; ?></span></td>
                        <td><?php echo $row['parent_phone']; ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="id_card.php?id=<?php echo $row['id']; ?>" target="_blank" class="act-id">ID Card</a>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="act-edit">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="act-del" onclick="return confirm('Delete this record?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; text-align: center; display: flex; justify-content: center; gap: 20px;">
            <a href="index.php" style="color: #666; text-decoration: none;">🏠 Home</a>
            <a href="logout.php" style="color: #e74c3c; text-decoration: none; font-weight: bold;">🚪 Logout Securely</a>
        </div>
    </div>
</body>
</html>