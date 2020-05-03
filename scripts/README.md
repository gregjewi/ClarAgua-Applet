# Scripts

Within the ``scripts`` directory you'll find the files that are run from Ubuntu.
(The part of the AWS instance that is not used for serving the website.)

For now this is a single python file, ``data2idb.py`` that takes new data from the IWQIS server, 
formats it, and then pushes it to the InfluxDB database running on our AWS Instance.

Scheduled running of the script is handled through crontab:

``13 * * * * python3 /home/ubuntu/scripts/python/data2idb.py``

``data2idb.py`` runs on the 13th minute, every hour, everyday, etc.



# Database Schema

```
ubuntu@ip-172-31-35-198:~/scripts$ influx
Connected to http://localhost:8086 version 1.7.10
InfluxDB shell version: 1.7.10
> SHOW DATABASES
name: databases
name
----
_internal
chlorinators
> USE CHLORINATORS
ERR: Database CHLORINATORS doesn't exist. Run SHOW DATABASES for a list of existing databases.
DB does not exist!
> USE chlorinators
Using database chlorinators
> SHOW SERIES
key
---
smart,sid="SCN0001"
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
