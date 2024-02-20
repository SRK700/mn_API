<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

// Check if the expected keys are present in the POST data
if (isset($_POST['place_name']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    // Extract values from the POST data
    $placeName = $_POST['place_name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Generate place_code based on some calculation or concatenation
    // For example, take the first 3 letters of place_name and combine with truncated latitude and longitude
    $placeCode = substr($placeName, 0, 3) . intval($latitude) . intval($longitude);

    // Perform the SQL insertion
    // Ensure to add 'place_code' in your database schema for 'tourist_places' table
    $sql = "INSERT INTO tourist_places (place_code, place_name, latitude, longitude) VALUES ('$placeCode', '$placeName', $latitude, $longitude)";

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
