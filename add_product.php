<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php'; // Ensure this file securely handles database connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'POST method required']);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);

// Adjusted required fields without product_code
$requiredFields = ['shop_code', 'product_name', 'unit_of_measure', 'selling_price'];
foreach ($requiredFields as $field) {
    if (empty($inputData[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => "Missing field: $field"]);
        exit;
    }
}

// Generate product_code based on shop_code and a unique identifier
$productCode = $inputData['shop_code'] . '-' . uniqid();

// Prepared statement to avoid SQL injection, with product_code included
$stmt = $conn->prepare('INSERT INTO products (shop_code, product_code, product_name, unit_of_measure, selling_price) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('sssss', $inputData['shop_code'], $productCode, $inputData['product_name'], $inputData['unit_of_measure'], $inputData['selling_price']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'product_code' => $productCode]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to add product']);
}

$stmt->close();
$conn->close();
?>
