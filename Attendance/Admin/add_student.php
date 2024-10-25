<?php
// Start session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to login page if not admin
    header('Location: index.php');
    exit();
}

// Include your database connection here
include 'dbconn.php';

// Your form for adding students goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Student</h2>
        <form action="add_student_process.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>
</html>
