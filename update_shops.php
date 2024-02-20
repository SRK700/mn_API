<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'conn.php';

// Check if the required fields are set in $_POST
if (isset($_POST['shop_code']) && isset($_POST['shop_name'])) {
    $shopCode = $_POST['shop_code'];
    $shopName = $_POST['shop_name'];

    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE shops SET shop_name = ? WHERE shop_code = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $shopName, $shopCode);

    if ($stmt->execute()) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $stmt->error;
    }

    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Missing required fields';
}

$conn->close();

echo json_encode($response);
?>
