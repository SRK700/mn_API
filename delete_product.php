<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include 'conn.php';

// Check if 'product_code' exists in $_POST array
if (isset($_POST['product_code'])) {
    $productCode = $_POST['product_code'];

    $sql = "DELETE FROM products WHERE product_code = $productCode";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $conn->error;
    }
} else {
    // 'product_code' key not found in $_POST
    $response['status'] = 'error';
    $response['message'] = 'Product code not provided in the request.';
}

$conn->close();

echo json_encode($response);
?>
