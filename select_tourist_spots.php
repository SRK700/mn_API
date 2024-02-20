<?php
header('Content-Type: application/json');
include 'conn.php';

$code = $_GET['code'];

$sql = "SELECT * FROM tourist_spots WHERE code = $code";
$result = $conn->query($sql);

$touristSpotData = array();
if ($result->num_rows > 0) {
    $touristSpotData = $result->fetch_assoc();
}

$conn->close();

echo json_encode($touristSpotData);
?>

