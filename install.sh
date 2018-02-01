#!/bin/bash

clear;
echo "     DD   X   X   M   M   TTTTT";
echo "     D D   X X    MM MM     T";
echo "     D  D   X     M M M     T";
echo "     D D   X X    M   M     T   .IO";
echo "     DD   X   X   M   M     T";

sudo mkdir /opt/dxmtlogs;
echo "mkdir /opt/dxmtlogslogs";
sudo mkdir /opt/dxmtlogslogs/Application;
echo "mkdir /opt/dxmtlogslogs/Application";
sudo mkdir /opt/dxmtlogslogs/Application/Apache;
echo "mkdir /opt/dxmtlogslogs/Application/Apache";
sudo mkdir /opt/dxmtlogslogs/Application/Java;
echo "mkdir /opt/dxmtlogslogs/Application/Java";
sudo mkdir /opt/dxmtlogslogs/Application/RabbitMQ;
echo "mkdir /opt/dxmtlogslogs/Application/RabbitMQ";
sudo mkdir /opt/dxmtlogslogs/Application/WildFly;
echo "mkdir /opt/dxmtlogslogs/Application/WildFly";
sudo mkdir /opt/dxmtlogslogs/CPU;
echo "mkdir /opt/dxmtlogs/CPU";
sudo mkdir /opt/dxmtlogs/DiskSpace;
echo "mkdir /opt/dxmtlogs/DiskSpace";
sudo mkdir /opt/dxmtlogs/Memory;
echo "mkdir /opt/dxmtlogs/Memory";
sudo mkdir /opt/dxmtlogs/Network;
echo "mkdir /opt/dxmtlogs/Network";
sudo mkdir /opt/dxmtlogs/TopIPs;
echo "mkdir /opt/dxmtlogs/TopIPs";

sudo cp ./application.sh /opt/dxmtlogs/;
echo " cp ./application.sh /opt/dxmtlogs/";
sudo cp ./config.txt /opt/dxmtlogs/;
echo " cp ./config.txt /opt/dxmtlogs/";
sudo cp ./monitoring.sh /opt/dxmtlogs/;
echo " cp ./monitoring.sh /opt/dxmtlogs/";
sudo cp ./topips.sh /opt/dxmtlogs/;
echo " cp ./topips.sh /opt/dxmtlogs/";

sudo chmod 777 -R /opt/dxmtlogs/;
echo "chmod 777 -R /opt/dxmtlogs/";

sudo crontab -l | { cat; echo "*/1 * * * * sudo /opt/dxmtlogs/application.sh"; } | crontab -;
sudo crontab -l | { cat; echo "*/1 * * * * sudo /opt/dxmtlogs/monitoring.sh"; } | crontab -;
sudo crontab -l | { cat; echo "* * */1 * * sudo /opt/dxmtlogs/topips.sh"; } | crontab -;

echo "Done on installing the monitoring system.";
echo "Please copy /dxmt folder to your Apache htdocs or html folder.";