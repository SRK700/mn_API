<?php
header('Content-Type: application/json');
include 'conn.php';

$code = $_POST['code'];

$sql = "DELETE FROM tourist_spots WHERE code = $code";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>
