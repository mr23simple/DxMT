#!/bin/bash

arr=$(cat /opt/dxmtlogs/TopIPs/logs.csv);

for x in $arr; do
	sudo iptables -D INPUT -s "$x" -j DROP;
done

date=`date +%y%m%d%H%M`;
sudo mv /opt/dxmtlogs/TopIPs/logs.csv /opt/dxmtlogs/TopIPs/"logs$date".csv;
wget http://malc0de.com/bl/IP_Blacklist.txt -O /opt/dxmtlogs/TopIPs/logstemp.csv;
sudo echo `cat /opt/dxmtlogs/TopIPs/logstemp.csv | sed '1d' | sed '1d' | sed '1d' | sed '1d'` >> /opt/dxmtlogs/TopIPs/logs.csv;

arr=$(cat /opt/dxmtlogs/TopIPs/logs.csv);

for x in $arr; do
	sudo iptables -A INPUT -s "$x" -j DROP;
done

iptables-save;