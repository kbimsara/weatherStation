<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "weatherstatuin";

// Connect to database
$Connector = new mysqli($serverName, $userName, $password, $databaseName);

// Check connection
if ($Connector->connect_error) {
    die("Connection failed: " . $Connector->connect_error);
}
?>
