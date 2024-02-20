<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include 'conn.php';

// Check if the required field is set in $_POST
if (isset($_POST['shop_code'])) {
    $shopCode = $_POST['shop_code'];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM shops WHERE shop_code = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $shopCode);

    if ($stmt->execute()) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $stmt->error;
    }

    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Missing required field';
}

$conn->close();

echo json_encode($response);
?>
