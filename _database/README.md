# How We Use InfluxDB

We use  InfluxDB for this application.
InfluxDB was designed specifically for time series data, just like our application.
Plus it's open source and has a large community of developers building tools which enable apps to connect to the database across many platforms.
Get started with influxDB [by reading their docs](https://docs.influxdata.com/influxdb/v1.8/).

## Database Schema
InfluxDB uses databases, measurements, field keys, and tag keys.
How we employ these schema are found below in the code block retrieved from the InfluxDB Command Line Interface.
See the [InfluxDB documentation](https://docs.influxdata.com/influxdb/v1.8/concepts/schema_and_data_layout/) about their schema and best practices.

```
ubuntu@ip:~/scripts$ influx
Connected to http://localhost:8086 version 1.7.10
InfluxDB shell version: 1.7.10
> SHOW DATABASES
name: databases
name
----
_internal
chlorinators
> USE chlorinators
Using database chlorinators
> SHOW SERIES
key
---
smart,sid=SCN0001
> SHOW MEASUREMENTS
name: measurements
name
----
smart
> SHOW FIELD KEYS
name: smart
fieldKey    fieldType
--------    ---------
flow        float
orp         float
orp_target  float
orp_warning float
p           string
ph          float
tablet      float
tank        float
valve       float
> SHOW TAG KEYS
name: smart
tagKey
------
sid
```
