<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Only POST allowed']);
    exit;
}

// Parse JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
$required = ['temperature_dht', 'humidity', 'temperature_bmp', 'pressure', 'altitude', 'air_quality_raw', 'air_quality_status', 'rain_detected', 'rain_value'];

foreach ($required as $field) {
    if (!isset($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing field: $field"]);
        exit;
    }
}

// Prepare values
$temp_dht     = $data['temperature_dht'];
$humidity     = $data['humidity'];
$temp_bmp     = $data['temperature_bmp'];
$pressure     = $data['pressure'];
$altitude     = $data['altitude'];
$air_raw      = $data['air_quality_raw'];
$air_status   = $data['air_quality_status'];
$rain_detected= $data['rain_detected'];
$rain_value   = $data['rain_value'];

$query = "INSERT INTO sensordata 
(temperature_dht, humidity, temperature_bmp, pressure, altitude, air_quality_raw, air_quality_status, rain_detected, rain_value) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $Connector->prepare($query);
$stmt->bind_param("ddddddssi", $temp_dht, $humidity, $temp_bmp, $pressure, $altitude, $air_raw, $air_status, $rain_detected, $rain_value);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Database insert failed', 'mysqli_error' => $stmt->error]);
}
?>
