<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

$productCode = $_POST['product_code'];
$productName = $_POST['product_name'];
$unitOfMeasure = $_POST['unit_of_measure'];
$sellingPrice = $_POST['selling_price'];

$sql = "UPDATE products SET product_name = '$productName', unit_of_measure = '$unitOfMeasure', selling_price = $sellingPrice WHERE product_code = $productCode";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>
