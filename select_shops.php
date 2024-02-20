<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

$sql = "SELECT * FROM shops";
$result = $conn->query($sql);

$shopsData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shopsData[] = $row;
    }
}

$conn->close();

echo json_encode($shopsData);
?>
