<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

$sql = "SELECT * FROM railway_data";
$result = $conn->query($sql);

$railwayData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $railwayData[] = $row;
    }
}

$conn->close();

echo json_encode($railwayData);
?>
