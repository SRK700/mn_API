<?php
header('Content-Type: application/json');
include 'conn.php';

$code = $_POST['code'];
$spotName = $_POST['spot_name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$sql = "UPDATE tourist_spots SET spot_name = '$spotName', latitude = $latitude, longitude = $longitude WHERE code = $code";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>
