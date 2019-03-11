#!/bin/bash

function _install() {
	_date=`date +"%Y/%m/%d|%H:%M"`
	echo "$_date: $1"
	$1;
}

clear;
echo "     DD   X   X   M   M   TTTTT";
echo "     D D   X X    MM MM     T";
echo "     D  D   X     M M M     T";
echo "     D D   X X    M   M     T";
echo "     DD   X   X   M   M     T";

_install "sudo apt-get update && sudo apt-get install bwm-ng mpstat"

_install "sudo mkdir /opt/dxmtlogs";
_install "sudo mkdir /opt/dxmtlogslogs/Application";
_install "sudo mkdir /opt/dxmtlogslogs/Application/Apache";
_install "sudo mkdir /opt/dxmtlogslogs/Application/Java";
_install "sudo mkdir /opt/dxmtlogslogs/Application/RabbitMQ";
_install "sudo mkdir /opt/dxmtlogslogs/Application/WildFly";
_install "sudo mkdir /opt/dxmtlogslogs/CPU";
_install "sudo mkdir /opt/dxmtlogs/DiskSpace";
_install "sudo mkdir /opt/dxmtlogs/Memory";
_install "sudo mkdir /opt/dxmtlogs/Network";
_install "sudo mkdir /opt/dxmtlogs/TopIPs";

_install "sudo cp ./application.sh /opt/dxmtlogs/";
_install "sudo cp ./config.txt /opt/dxmtlogs/";
_install "sudo cp ./monitoring.sh /opt/dxmtlogs/";
_install "sudo cp ./topips.sh /opt/dxmtlogs/";

_install "sudo chmod 777 -R /opt/dxmtlogs/";

echo "Adding to crontab"
sudo crontab -l | { cat; echo "*/1 * * * * sudo /opt/dxmtlogs/application.sh"; } | crontab -;
sudo crontab -l | { cat; echo "*/1 * * * * sudo /opt/dxmtlogs/monitoring.sh"; } | crontab -;
sudo crontab -l | { cat; echo "* * */1 * * sudo /opt/dxmtlogs/topips.sh"; } | crontab -;

echo "Done on installing the monitoring system.";
echo "Please copy DxMT/dxmt folder to your Apache htdocs or html folder.";