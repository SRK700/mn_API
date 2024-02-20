<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
include 'conn.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$productsData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productsData[] = $row;
    }
}

$conn->close();

echo json_encode($productsData);
?>
