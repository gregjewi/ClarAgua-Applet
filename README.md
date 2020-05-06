# ClarAgua
Smart Chlorinator Beta App

Project Description Presentation:
<iframe src="https://slides.com/gregoryewing/team-nica-web/embed" width="576" height="420" scrolling="no" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


# What You'll Find Here
Welcome to the Github repository of  ClarAgua, a web applet for real time visualization of smart chlorinators in the EOS system. 
This repository serves two purposes:
1. Is the final product of CEE:5993 at the University of Iowa, and
2. Provides continuity for the next people who may come into this project.

The two purposes share a common goal:
**Make it easy for anyone coming behind us to pickup where we left off.**

On every level of this repository you will find a README doc much like this that goes into detail about what is contained in the files. 

With that in mind...

## The Basics
Our project uses a number of languages (python, php, html, javascript, css,) 
uses a smattering of different open-source tools (influxdb, grafana,) and
some products run by big companies (Google Maps, Amazon Web Services.)
Each of these has its own learning curve.
We encourage you to fill in the gaps of knowledge that you think you may need elsewhere.
If you have any questions, bother Greg.

This entire project is deployed from a single, free tier AWS Ubuntu instance.
This is bad practice in the long-term, but in the short term this is just fine.
If you ever scale to something operational, then you'll need to rethink.

### Connecting to the Instance
If you're using a Windows machine you will want:
1. [PuTTY](https://www.putty.org/): an SSH and telnet client. It allows you to control the instance through the command line.
2. [WinSCP](https://winscp.net/eng/index.php): a file manager. I find it the best way to transfer files to and from my machine. Plus, you can edit files directly on the instance using WinSCP and the text editor of your choice.
3. A .ppk key: This is your password to access the instance. If you think you should have it, bother Megan (the keeper of the AWS.)

### The Layout
Congrats, you successfully logged in to the instance using the Ubuntu user.
You probably want to do one of two things:
1. Edit/add some part of the project that goes directly into the web app
2. Manage stuff not directly associated with the web app like data ingest, database management, etc.

#### Website Files
Files associated with anything public facing (ie. something the server could give directly to a client browser,) is located in:

``/var/www/html/``

The overwhelming majority of things that would be messed with are here.
Here, the Apache server (that is on the aws instance,) can interpret php files and serve the html, etc. to the user's phone/browser.
Everything else -- files, etc. -- that sits on the instance cannot be accessed via a user's browser.

**All files and directories in this repository NOT prepended with ``'_'`` are found in ``/var/www/html/`` on the aws instance.**

#### Data Ingest, Database
**All of the files and directories that HAVE a ``'_'`` prepended in this repo are in this category.**
Did something change in how the data is shared with us?
Perhaps the format was changed, or there's an easier way to ingest the data from source?
You want the ``/_scripts`` directory.
**See ``readme`` in scripts directory for more info.**

Want to manage the database itself? Type ``influx`` + enter key in the command line to enter into the 
[InfluxDB Command Line Interface](https://v2.docs.influxdata.com/v2.0/reference/cli/influx/) where 
[Influx Query Language (InfluxQL)](https://docs.influxdata.com/influxdb/v1.8/query_language/) is used to do things in the database like 
[Explore your schema using InfluxQL](https://docs.influxdata.com/influxdb/v1.8/query_language/explore-schema/).
Note: you can enter into the influx CLI from any location in the aws instance.

**Tip: Check out the database schema readme under the ``_database`` directory**

## Conclusion
So that's that.
Thanks for reading this.
If you are just getting started, you probably have a lot more questions.
That's **OK**.
Go over to [Issues](https://github.com/gregjewi/ClarAgua-Applet/issues) and leave a question, complaint, or a comment about something not working.
We will try to get back ASAP.

Best,
Greg & Megan
#### PS: Grafana Dashboard
For managers and researchers looking to interact with the full dataset, we are using a [Grafana](https://grafana.com/). Contact Megan dash Lindmark at uiowa dot edu for link and access. 
