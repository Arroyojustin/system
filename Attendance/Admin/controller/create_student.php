<?php
ob_start(); // Start output buffering

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './dbconn.php';

// header('Content-Type: application/json'); // Set response content type to JSON

// Get JSON input from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if POST request and valid JSON data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $data) {
    $names = isset($data['names']) ? $data['names'] : '';
    $position = isset($data['position']) ? $data['position'] : '';
    $email = isset($data['email']) ? $data['email'] : null;

    // Validate input fields
    if (empty($names) || empty($position) || empty($email)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required.'
        ]);
        exit;
    }

    // Prepare SQL statement to insert the student
    $stmt = $conn->prepare("INSERT INTO students (names, position, email) VALUES (?, ?, ?)");
    if ($stmt === false) {
        echo json_encode([
            'success' => false,
            'message' => 'Prepare failed: ' . $conn->error
        ]);
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param("sss", $names, $position, $email);

    if (!$stmt->execute()) {
        // Handle execution failure
        echo json_encode([
            'success' => false,
            'message' => 'Execute failed: ' . $stmt->error
        ]);
        exit;
    }

    // Get the inserted student ID
    $student_id = $stmt->insert_id;

    // Prepare success response
    echo json_encode([
        'success' => true,
        'id' => $student_id
    ]);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Handle invalid requests or missing data
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request or missing data.'
    ]);
}

// Flush output buffer
ob_end_flush();
