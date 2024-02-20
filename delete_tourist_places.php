<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'conn.php';

// Check if 'place_code' key exists in $_POST array
$placeCode = isset($_POST['place_code']) ? $_POST['place_code'] : '';

$response = array();

if ($placeCode !== '') {
    $sql = "DELETE FROM tourist_places WHERE place_code = '$placeCode'";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Missing place_code parameter';
}

$conn->close();

echo json_encode($response);
?>
