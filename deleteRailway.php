<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'conn.php';

// Check if 'code' is set in the POST request
if (isset($_POST['code'])) {
    $code = $_POST['code'];

    // Perform the deletion
    $sql = "DELETE FROM railway_data WHERE code = $code";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $conn->error;
    }
} else {
    // 'code' is not set in the POST request
    $response['status'] = 'error';
    $response['message'] = 'No code provided for deletion';
}

$conn->close();

echo json_encode($response);
?>
