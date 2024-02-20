<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include 'conn.php';

if (isset($_POST['place_code']) && isset($_POST['time'])) {
    $placeCode = $_POST['place_code'];
    $time = $_POST['time'];

    // ในส่วนนี้คุณสามารถเพิ่มการตรวจสอบเงื่อนไขเพิ่มเติมสำหรับ place_code และ time หากต้องการ

    // ไม่จำเป็นต้องระบุ sequence_number เพราะมันถูกตั้งค่าเป็น AUTO_INCREMENT
    $stmt = $conn->prepare("INSERT INTO route_data (place_code, time) VALUES (?, ?)");
    if ($stmt === false) {
        $response = ['status' => 'error', 'message' => 'Failed to prepare statement'];
    } else {
        $stmt->bind_param("ss", $placeCode, $time);

        if ($stmt->execute()) {
            // ส่งกลับ route_id ซึ่งคือค่า AUTO_INCREMENT ล่าสุดที่ถูกเพิ่ม
            $response = ['status' => 'success', 'route_id' => $conn->insert_id];
        } else {
            $response = ['status' => 'error', 'message' => $stmt->error];
        }

        $stmt->close();
    }
} else {
    $response = ['status' => 'error', 'message' => 'Incomplete or missing data.'];
}

$conn->close();

echo json_encode($response);
?>
