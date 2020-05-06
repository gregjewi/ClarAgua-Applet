<?php

// Influxdb connection code.
// write 'include dbconnect.php' in other php files to avoid writing this over and over.

require __DIR__ . '/vendor/autoload.php';

$host = "HOSTNAME";
$port = 8086;
$dbname = "DATABASENAME";
$database = InfluxDB\Client::fromDSN(sprintf('influxdb://daemon:chlorine_rules@%s:%s/%s', $host, $port, $dbname),5); // 5 second timeout

?>
