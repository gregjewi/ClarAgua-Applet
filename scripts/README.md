# Scripts

Within the ``scripts`` directory you'll find the files that are run from Ubuntu.
(The part of the AWS instance that is not used for serving the website.)

For now this is a single python file, ``data2idb.py`` that takes new data from the IWQIS server, 
formats it, and then pushes it to the InfluxDB database running on our AWS Instance.

Scheduled running of the script is handled through crontab:

``13 * * * * python3 /home/ubuntu/scripts/python/data2idb.py``

``data2idb.py`` runs on the 13th minute, every hour, everyday, etc.
