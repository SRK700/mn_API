<?php
include './conn.php'; // Ensure this path is correct

header("Content-Type: application/json");

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        addShop();
        break;
    case "PUT":
        editShop();
        break;
    case "DELETE":
        deleteShop();
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
        break;
}

function addShop() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $shopName = $data['shop_name'];
    $shopCode = generateShopCode();

    $stmt = $conn->prepare("INSERT INTO shops (shop_code, shop_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $shopCode, $shopName);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Shop added successfully", "shop_code" => $shopCode]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add shop: " . $stmt->error]);
    }
    $stmt->close();
}

function editShop() {
    global $conn;
    parse_str(file_get_contents("php://input"), $data);
    $shopCode = $data['shop_code'];
    $shopName = $data['shop_name'];

    $stmt = $conn->prepare("UPDATE shops SET shop_name = ? WHERE shop_code = ?");
    $stmt->bind_param("ss", $shopName, $shopCode);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Shop updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update shop: " . $stmt->error]);
    }
    $stmt->close();
}

function deleteShop() {
    global $conn;
    parse_str(file_get_contents("php://input"), $data);
    $shopCode = $data['shop_code'];

    $stmt = $conn->prepare("DELETE FROM shops WHERE shop_code = ?");
    $stmt->bind_param("s", $shopCode);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Shop deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete shop: " . $stmt->error]);
    }
    $stmt->close();
}

function generateShopCode() {
    global $conn;
    $prefix = "SH"; // Example prefix
    $date = date("Ymd"); // Example date format

    $sql = "SELECT MAX(shop_code) AS max_code FROM shops WHERE shop_code LIKE '{$prefix}{$date}%'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && $row['max_code']) {
        $nextNum = (int)substr($row['max_code'], -4) + 1; // Increment the last 4 digits
    } else {
        $nextNum = 1;
    }

    return $prefix . $date . str_pad($nextNum, 4, "0", STR_PAD_LEFT); // Pad with zeros to maintain a fixed length
}
?>
