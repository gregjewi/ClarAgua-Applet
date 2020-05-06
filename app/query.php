<?php
// By: Gregory Ewing and Megan Lindmark
// Date: May 2020

// DESCRIPTION: query [default] 1 day(s) worth of data from the location supplied in the url.

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
