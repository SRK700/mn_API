<?php
header('Access-Control-Allow-Origin: *');
include("./conn.php");

$shopCode = isset($_REQUEST['shopCode']) ? $_REQUEST['shopCode'] : '';
$productName = isset($_REQUEST['proName']) ? $_REQUEST['proName'] : '';
$unitOfMeasure = isset($_REQUEST['unti']) ? $_REQUEST['unti'] : '';
$sellingPrice = isset($_REQUEST['price']) ? $_REQUEST['price'] : '';

// Insert into 'shops' table if 'shop_code' doesn't exist
$insertShopQuery = "INSERT INTO shops (shop_code) VALUES (?) ON DUPLICATE KEY UPDATE shop_code = shop_code";
$stmtInsertShop = mysqli_prepare($conn, $insertShopQuery);
mysqli_stmt_bind_param($stmtInsertShop, 's', $shopCode);
mysqli_stmt_execute($stmtInsertShop);

// Fetch the maximum product_code for the given shop_code
$maxProductCodeQuery = "SELECT MAX(product_code) AS maxProductCode FROM products WHERE shop_code = ?";
$stmtMaxProductCode = mysqli_prepare($conn, $maxProductCodeQuery);
mysqli_stmt_bind_param($stmtMaxProductCode, 's', $shopCode);
mysqli_stmt_execute($stmtMaxProductCode);
$resultMaxProductCode = mysqli_stmt_get_result($stmtMaxProductCode);

if ($resultMaxProductCode) {
    $row = mysqli_fetch_assoc($resultMaxProductCode);
    $maxProductCode = $row['maxProductCode'];
    $productCode = $maxProductCode + 1;
} else {
    // Error handling if fetching maximum product_code fails
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error fetching maximum product_code']);
    exit(); // Exit the script
}

// Insert data into the products table using parameterized query
$insertProductQuery = "INSERT INTO products (shop_code, product_code, product_name, unit_of_measure, selling_price) VALUES (?, ?, ?, ?, ?)";
$stmtInsertProduct = mysqli_prepare($conn, $insertProductQuery);
mysqli_stmt_bind_param($stmtInsertProduct, 'sssss', $shopCode, $productCode, $productName, $unitOfMeasure, $sellingPrice);
mysqli_stmt_execute($stmtInsertProduct);

// Check for success
if (mysqli_stmt_affected_rows($stmtInsertProduct) > 0) {
    // Successful insertion
    http_response_code(200);
    echo json_encode(['status' => 'success', 'message' => 'Product added successfully']);
} else {
    // Error in insertion
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error adding product']);
}

// Close the statements and connection
mysqli_stmt_close($stmtInsertShop);
mysqli_stmt_close($stmtInsertProduct);
mysqli_close($conn);
?>
