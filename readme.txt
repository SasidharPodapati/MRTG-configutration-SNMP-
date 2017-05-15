***Assignment 1***

The main aim of this assignment is to cinfigure MRTG tool and also to develop a tool which works similar to MRTG.
Results are displayed on web dashboard.

***Software requirements and Basic Installations***

Operating System: Ubuntu 14.04 LTS.
Apache server, MySQL and PHP.

***Modules installed from CPAN***
Data::Dumper
DBD::Mysql
DBI
Cwd
RRD::Simple
Net::SNMP
             
***Install packages from terminal*** (sudo apt-get install ____)
snmp && snmpd
rrdtool	 
librrds-perl		
php5-rrd

***Steps to run the Assignment 1***

*Once the database and DEVICES table are setup , modify the db.conf file in the root directory to obtain bitrate.
*Go to the terminal and go to the working directory i.e. /var/www/html.
*Run the given command in terminal "perl mrtgconf.pl" to run the perl script "mrtgcong.pl".
*Go to the URL: http://localhost/mrtg/ to view MRTG tool.
*To run the network monitoring tool, run the perl script "backend.pl" in the terminal with the command "perl backend.pl".
*Now, open a web browser and type the following URL: http://localhost/et2536-sapo15/assignment1/
*It will open index.php and show the RRD graphs (Daily,Monthly,Weekly and Yearly) of the interfaces of the devices.  
 
***Note***
Make sure to create "DEVICES" table in the MySQL database prior to running the backend script in the terminal. 
