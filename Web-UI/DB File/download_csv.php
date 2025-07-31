<?php
require_once '../config.php';

$duration = isset($_GET['duration']) ? $_GET['duration'] : '';

$where = '';
if ($duration == "day") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 1 DAY";
} elseif ($duration == "week") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 7 DAY";
} elseif ($duration == "month") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 30 DAY";
} elseif ($duration == "year") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 1 YEAR";
} else{
    $where = ""; // all data
}

$query = "SELECT * FROM sensordata $where ORDER BY timestamp DESC";
$result = mysqli_query($Connector, $query);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sensor_data.csv"');

$output = fopen('php://output', 'w');

// CSV Header
fputcsv($output, ['Temperature', 'Humidity', 'Pressure', 'Altitude', 'Air Quality Raw', 'Air Quality Status', 'Rain Detected', 'Rain Value', 'Timestamp']);

// CSV Rows
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['temperature_dht'],
        $row['humidity'],
        $row['pressure'],
        $row['altitude'],
        $row['air_quality_raw'],
        $row['air_quality_status'],
        $row['rain_detected'],
        $row['rain_value'],
        $row['timestamp']
    ]);
}

fclose($output);
exit;
?>
