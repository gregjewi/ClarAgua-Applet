<?php
// DESCRIPTION: query n days worth of data from the site id supplied in the url.
// Returns results as JSON in descending order from most recent data point.

require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/dbconnect.php';

# Sensor ID + days sampled
$sid = $_GET["sid"];
$days = $_GET["days"];

# setting default of one day
if ($days=='') $days=1;

$result = $database->query('SELECT * FROM smart WHERE (sid = \''.$sid.'\') AND time >= now() - '.$days.'d ORDER BY time DESC');
$points = $result->getPoints();

echo json_encode($points);
?>
