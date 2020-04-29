<?php

// DESCRIPTION: query 1 days worth of data from the location supplied in the url.

// Returns results as JSON in descending order from most recent data point.


require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/dbconnect.php';

# Sensor ID
$sid = $_GET["sid"];

$result = $database->query('SELECT * FROM smart WHERE (sid = \''.$sid.'\') AND time >= now() - 1d ORDER BY time DESC');
$points = $result->getPoints();

echo json_encode($points);
?>