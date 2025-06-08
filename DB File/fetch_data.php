<?php
require_once '../config.php';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$duration = isset($_GET['duration']) ? $_GET['duration'] : '';

// echo $duration; // Debugging line to check duration value
// echo "<script>console.log('Duration: " .$duration."');</script>";


// Build WHERE clause
$where = '';
if ($duration == "day") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 1 DAY";
} elseif ($duration == "week") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 7 DAY";
} elseif ($duration == "month") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 30 DAY";
} elseif ($duration == "year") {
    $where = "WHERE timestamp >= NOW() - INTERVAL 1 YEAR";
} else {
    $where = ""; // all data
}

// Count total filtered records
$totalQuery = "SELECT COUNT(*) AS total FROM sensordata $where";
$totalResult = mysqli_query($Connector, $totalQuery);
$total = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($total / $limit);

// Fetch data with limit
$query = "SELECT * FROM sensordata $where ORDER BY timestamp DESC LIMIT $start, $limit";
$result = mysqli_query($Connector, $query);

$table = '';
$i = $start;
while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    $table .= "<tr>
        <th>$i</th>
        <td>{$row['temperature_dht']}</td>
        <td>{$row['humidity']}</td>
        <td>{$row['pressure']}</td>
        <td>{$row['altitude']}</td>
        <td>{$row['air_quality_raw']}</td>
        <td>{$row['air_quality_status']}</td>
        <td>{$row['rain_detected']}</td>
        <td>{$row['rain_value']}</td>
        <td>{$row['timestamp']}</td>
    </tr>";
}

if ($i == $start) {
    $table .= "<tr><td colspan='10' style='text-align:center;'>No Data Found</td></tr>";
}

// Build pagination
$pagination = '';
if ($totalPages > 1) {
    for ($p = 1; $p <= $totalPages; $p++) {
        $active = ($p == $page) ? 'active' : '';
        $pagination .= "<li class='page-item $active'><a class='page-link' href='#' data-page='$p'>$p</a></li>";
    }
}

echo json_encode([
    'table' => $table,
    'pagination' => $pagination
]);
?>
