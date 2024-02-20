<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'conn.php';

$code = isset($_POST['code']) ? $_POST['code'] : null;
$carNumber = isset($_POST['car_number']) ? $_POST['car_number'] : null;

if ($code === null || $carNumber === null) {
    $response['status'] = 'error';
    $response['message'] = 'Missing required parameters';
    echo json_encode($response);
    exit();
}

$sql = "UPDATE railway_data SET car_number = '$carNumber' WHERE code = $code";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);

?>
