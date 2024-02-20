<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include 'conn.php';

$response = array();

if (isset($_POST['shop_name'])) {
    $shopName = $_POST['shop_name'];

    // Generate a unique shop_code using UUID
    $shopCode = uniqid('SC');

    $sql = "INSERT INTO shops (shop_code, shop_name) VALUES (?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ss", $shopCode, $shopName);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['shop_code'] = $shopCode; // Return the generated shop_code to the client
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error executing SQL query';
            $response['sql_error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error preparing SQL statement';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Missing required fields';
}

$conn->close();

echo json_encode($response);
?>
