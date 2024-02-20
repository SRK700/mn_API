<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

$sql = "SELECT * FROM route_data";
$result = $conn->query($sql);

$routeData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $routeData[] = $row;
    }
}

$conn->close();

echo json_encode($routeData);
?>
