#!/bin/bash

date=`date +%y%m%d`;
time=`date +%H:%M`;

if [ "$time" == "00:00" ]; then
	sudo mv /opt/dxmtlogs/Application/Java/logstemp.csv /opt/dxmtlogs/Application/Java/"logs$date".csv;
	sudo mv /opt/dxmtlogs/Application/WildFly/logs.csv /opt/dxmtlogs/Application/WildFly/"logs$date".csv;
	sudo mv /opt/dxmtlogs/Application/Apache/logs.csv /opt/dxmtlogs/Application/Apache/"logs$date".csv;
	sudo mv /opt/dxmtlogs/Application/RabbitMQ/logs.csv /opt/dxmtlogs/Application/RabbitMQ/"logs$date".csv;
fi

#Application Discovery
	# Java
	if [ "`ps aux | grep -oP "java" | head -n 1`" == "java" ]; then
		sudo sed -i -e 's/JAVA="false"/JAVA="true"/g' /opt/dxmtlogs/config.txt;
	else
		sudo sed -i -e 's/JAVA="true"/JAVA="false"/g' /opt/dxmtlogs/config.txt;
	fi

	# WildFly
	if [ "`ps aux | grep -oP "wildfly" | head -n 1`" == "wildfly" ]; then
		sed -i -e 's/WILDFLY="false"/WILDFLY="true"/g' /opt/dxmtlogs/config.txt;
	else
		sed -i -e 's/WILDFLY="true"/WILDFLY="false"/g' /opt/dxmtlogs/config.txt;
	fi

	# Apache
	if [ "`ps aux | grep -oP "apache" | head -n 1`" == "apache" ]; then
		sed -i -e 's/APACHE="false"/APACHE="true"/g' /opt/dxmtlogs/config.txt;
	else
		sed -i -e 's/APACHE="true"/APACHE="false"/g' /opt/dxmtlogs/config.txt;
	fi

	# RabbitMQ
	if [ "`ps aux | grep -oP "rabbitmq" | head -n 1`" == "rabbitmq" ]; then
		sed -i -e 's/RABBITMQ="false"/RABBITMQ="true"/g' /opt/dxmtlogs/config.txt;
	else
		sed -i -e 's/RABBITMQ="true"/RABBITMQ="false"/g' /opt/dxmtlogs/config.txt;
	fi

# Application Monitoring
# Java SDK
if [ "`cat /opt/dxmtlogs/config.txt | grep JAVA | grep -oP '(?<=").*(?=")'`" == "true" ]; then
	cat /opt/dxmtlogs/Application/Java/logs.csv >> /opt/dxmtlogs/Application/Java/logstemp.csv;
	sudo rm -f /opt/dxmtlogs/Application/Java/logs.csv;
	 `cat /opt/dxmtlogs/config.txt | grep JREJDK_BIN | grep -oP '(?<=").*(?=")'`jstat -gcutil 0 1000 1 | sed '1d' | awk -v OFS="," '$1=$1' >> /opt/dxmtlogs/Application/Java/logs.csv;
fi

ipadd="`cat /opt/dxmtlogs/config.txt | grep JBOSS_ADD | grep -oP '(?<=").*(?=")'`";
port="`cat /opt/dxmtlogs/config.txt | grep JBOSS_PORT | grep -oP '(?<=").*(?=")'`";

# WilfFly
if [ "`cat /opt/dxmtlogs/config.txt | grep WILDFLY | grep -oP '(?<=").*(?=")'`" == "true" ]; then
	sudo curl -s $ipadd:$port > /dev/null && echo Success || echo Fail >> /opt/dxmtlogs/Application/WildFly/logs.csv;
fi

# Apache
if [ "`cat /opt/dxmtlogs/config.txt | grep "APACHE" | grep -oP '(?<=").*(?=")' | head -n 1`" == "true" ]; then
	if [ "`cat /opt/dxmtlogs/config.txt | grep APACHE_TYPE | grep -oP '(?<=").*(?=")'`" == "default" ]; then
		echo `sudo service httpd status | grep running > /dev/null && echo Success || echo Fail` >> /opt/dxmtlogs/Application/Apache/logs.csv;
	elif [ "`cat /opt/dxmtlogs/config.txt | grep APACHE_TYPE | grep -oP '(?<=").*(?=")'`" == "xampp" ]; then
		 echo `sudo /opt/lampp/lampp status | grep -oP 'Apache is running.' > /dev/null && echo Success || echo Fail` >> /opt/dxmtlogs/Application/Apache/logs.csv;
	fi
fi

# RabbitMQ
if [ "`cat /opt/dxmtlogs/config.txt | grep RABBITMQ | grep -oP '(?<=").*(?=")'`" == "true" ]; then
	sudo echo `sudo service rabbitmq-server status | grep running > /dev/null && echo Success || echo Fail` >> /opt/dxmtlogs/Application/RabbitMQ/logs.csv;
fi
