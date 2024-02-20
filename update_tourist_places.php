<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'conn.php';

// Check if the expected keys are present in the POST data
if (isset($_POST['place_code']) && isset($_POST['place_name']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    // Extract values from the POST data
    $placeCode = $_POST['place_code'];
    $placeName = $_POST['place_name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Sanitize input to prevent SQL injection
    $placeCode = mysqli_real_escape_string($conn, $placeCode);
    $placeName = mysqli_real_escape_string($conn, $placeName);
    $latitude = mysqli_real_escape_string($conn, $latitude);
    $longitude = mysqli_real_escape_string($conn, $longitude);

    // Perform the SQL update
    $sql = "UPDATE tourist_places SET place_name = '$placeName', latitude = $latitude, longitude = $longitude WHERE place_code = $placeCode";

    $response = array(); // Initialize response array

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $conn->error;
    }
} else {
    // If expected keys are not present, return an error response
    $response['status'] = 'error';
    $response['message'] = 'Missing required data in the request';
}

$conn->close();

echo json_encode($response);
?>
