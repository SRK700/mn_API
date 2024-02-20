<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'conn.php';

$sql = "SELECT * FROM tourist_places";
$result = $conn->query($sql);

$touristPlacesData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $touristPlacesData[] = $row;
    }
}

$conn->close();

echo json_encode($touristPlacesData);
?>
