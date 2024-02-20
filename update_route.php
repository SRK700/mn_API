<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

$sequenceNumber = $_POST['sequence_number'] ?? '';
$placeCode = $_POST['place_code'] ?? '';
$time = $_POST['time'] ?? '';

$sql = "UPDATE route_data SET place_code = ?, time = ? WHERE sequence_number = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $placeCode, $time, $sequenceNumber);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
