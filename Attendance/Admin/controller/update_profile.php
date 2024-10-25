<?php
session_start();
include '../dbconn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$admin_email = $_SESSION['email'];

// Prepare to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';

    // Validate input (you may want to add more validation)
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    // Update query
    $query = "UPDATE admins SET first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $admin_email);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . $stmt->error]);
    }

    $stmt->close();
}
$conn->close();
?>
