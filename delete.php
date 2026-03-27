<?php
include 'db.php';

if (isset($_GET['id'])) {
    // 1. Secure the ID (prevent SQL injection)
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 2. Get the filenames first so we can delete the actual files from the 'uploads' folder
    $file_query = mysqli_query($conn, "SELECT photo, birth_card, digital_id FROM students WHERE id=$id");
    $files = mysqli_fetch_assoc($file_query);

    if ($files) {
        // Delete the physical files if they exist
        if (!empty($files['photo'])) @unlink("uploads/" . $files['photo']);
        if (!empty($files['birth_card'])) @unlink("uploads/" . $files['birth_card']);
        if (!empty($files['digital_id'])) @unlink("uploads/" . $files['digital_id']);
    }

    // 3. Delete the record from the database
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
}

// 4. Redirect back to the dashboard
header("Location: view.php?status=deleted");
exit();
?>