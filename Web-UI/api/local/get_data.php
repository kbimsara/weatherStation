<?php
require_once './config.php'; // make sure the path is correct
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Only GET method allowed']);
    exit;
}

try {
    if (isset($_GET['rain'])) {
        // Get latest entry
        $stmt = $pdo->query("SELECT timestamp, rain_detected FROM sensordata WHERE timestamp >= NOW() - INTERVAL 1 DAY");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     elseif (isset($_GET['id'])) {
        // Get specific entry by ID
        $stmt = $pdo->prepare("SELECT * FROM sensordata WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $data = $stmt->fetch();
    }

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
}
