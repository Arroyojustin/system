<?php
require './Admin/dbconn.php'; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$response = [];

if ($_POST['action'] === 'fetch') {
    $query = "SELECT * FROM students";
    $result = $conn->query($query);
    
    if (!$result) {
        // Log the error and send JSON
        $response['error'] = $conn->error;
        echo json_encode($response);
        exit;
    }

    $output = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
    }

    // Send valid JSON response
    echo json_encode($output);
} else {
    // If there's an issue with the request, return an error
    $response['error'] = 'Invalid request';
    echo json_encode($response);
}

$debug_output = ob_get_clean(); // Get buffered output if any
if (!empty($debug_output)) {
    // Log any unexpected output (HTML or warnings)
    error_log("Unexpected output in students_query.php: " . $debug_output);
}
?>
