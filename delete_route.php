<?php
header('Content-Type: application/json');
include 'conn.php';

$sequenceNumber = $_POST['sequence_number'];

$sql = "DELETE FROM route_data WHERE sequence_number = $sequenceNumber";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>
