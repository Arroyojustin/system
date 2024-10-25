<?php
session_start();
include '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    if ($new_password !== $confirm_new_password) {
        echo json_encode(['success' => false, 'message' => 'New passwords do not match.']);
        exit();
    }

    // Fetch the stored password for the logged-in admin
    $query = "SELECT password FROM admins WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    
    // Debugging: Check if we fetched the stored password correctly
    if ($stmt->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'No password found for this email.']);
        exit();
    }

    $stmt->close();

    // Verify the current password
    if (!password_verify($current_password, $stored_password)) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
        exit();
    }

    // Hash the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_query = "UPDATE admins SET password = ? WHERE email = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ss", $hashed_new_password, $admin_email);

    if ($update_stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to change the password.']);
    }

    $update_stmt->close();
    $conn->close();
}
?>
