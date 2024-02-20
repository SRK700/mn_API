<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
include 'conn.php';

$output = []; // Initialize output array
$httpResponseCode = 200; // Default HTTP response code

// Try-Catch block for error handling
try {
    $result = mysqli_query($conn, "SELECT * FROM tourist_places");

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else {
        throw new Exception("Query execution failed: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    $httpResponseCode = 500; // Internal Server Error
    $output = ['error' => $e->getMessage()];
}

http_response_code($httpResponseCode);
echo json_encode($output);

mysqli_close($conn);
?>
