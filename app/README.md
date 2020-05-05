# Query and Database Connection

 This directory contains:
 1. The query php file used to serve data from the database,
 2. The supporting packages that allow us to do 1. without reinventing the wheel.
 
 The query file is all of ~15 lines of code.
 We have 5 or so supporting packages that enable such verbose code on our side of things.
 
 The influxDB php connection package and its dependcies are managed by the php package manager [Composer](https://getcomposer.org/).
 However, as long as the ``vendor/`` folder is still here, you don't have to worry about that.
 :+1:
