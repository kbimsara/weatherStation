<?php
require_once '../config.php';

//User data
if (isset($_POST['duration'])) {
    $duration = $_POST['duration'];

    if ($duration == "day") {
        $sql = "SELECT * FROM sensordata WHERE timestamp >= NOW() - INTERVAL 1 DAY;";
    } elseif ($duration == "week") {
        $sql = "SELECT * FROM sensordata WHERE timestamp >= NOW() - INTERVAL 7 DAY;";
    } elseif ($duration == "month") {
        $sql = "SELECT * FROM sensordata WHERE timestamp >= NOW() - INTERVAL 30 DAY;";
    } elseif ($duration == "year") {
        $sql = "SELECT * FROM sensordata WHERE timestamp >= NOW() - INTERVAL 1 YEAR;";
    } else {
        $sql = "SELECT * FROM sensordata;";
    }

    // $sql = "SELECT * FROM sensordata WHERE timestamp >= NOW() - INTERVAL 1 DAY;";


    $result = mysqli_query($Connector, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $i++;
        $temperature_dht  = $row['temperature_dht'];
        $humidity  = $row['humidity'];
        $pressure  = $row['pressure'];
        $altitude  = $row['altitude'];
        $air_quality_raw  = $row['air_quality_raw'];
        $air_quality_status  = $row['air_quality_status'];
        $rain_detected  = $row['rain_detected'];
        $rain_value  = $row['rain_value'];
        $timestamp  = $row['timestamp'];
?>
        <tr>
            <th scope="row"><?php echo "$i"; ?></th>
            <td><?php echo "$temperature_dht"; ?></td>
            <td><?php echo "$humidity"; ?></td>
            <td><?php echo "$pressure"; ?></td>
            <td><?php echo "$altitude"; ?></td>
            <td><?php echo "$air_quality_raw"; ?></td>
            <td><?php echo "$air_quality_status"; ?></td>
            <td><?php echo "$rain_detected"; ?></td>
            <td><?php echo "$rain_value"; ?></td>
            <td><?php echo "$timestamp"; ?></td>
        </tr>
    <?php
    }
    if ($i < 1) {
    ?>
        <tr style="text-align: center;">
            <td colspan="10">No Data Here !!</td>
        </tr>
    <?php
    }
}