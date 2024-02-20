<?php
header('Content-Type: application/json');
include 'conn.php';

$code = $_POST['code'];
$spotName = $_POST['spot_name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$sql = "INSERT INTO tourist_spots (code, spot_name, latitude, longitude) VALUES ($code, '$spotName', $latitude, $longitude)";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>
