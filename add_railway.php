<?php
header('Content-Type: application/json');
include 'conn.php';

// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if (isset($_POST['code']) && isset($_POST['car_number'])) {
    $code = $_POST['code'];
    $carNumber = $_POST['car_number'];

    // ใช้ prepared statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("INSERT INTO railway_data (code, car_number) VALUES (?, ?)");
    $stmt->bind_param("ss", $code, $carNumber);

    if ($stmt->execute()) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['message'] = $stmt->error;
    }

    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Incomplete or missing data.';
}

$conn->close();

echo json_encode($response);
?>
