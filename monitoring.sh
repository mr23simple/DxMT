#!/bin/bash

date=`date +%y%m%d`;
time=`date +%H:%M`;

if [ "$time" == "00:00" ]; then
	sudo mv /opt/dxmtlogs/DiskSpace/logstemp.csv /opt/dxmtlogs/DiskSpace/"logs$date".csv;
	sudo mv /opt/dxmtlogs/Memory/logs.csv /opt/dxmtlogs/Memory/"logs$date".csv;
	sudo mv /opt/dxmtlogs/Network/logs.csv /opt/dxmtlogs/Network/"logs$date".csv;
	sudo mv /opt/dxmtlogs/CPU/logs.csv /opt/dxmtlogs/CPU/"logs$date".csv;
fi

# Disk Space Monitoring
# Filesystem	1K-Blocks	Used		Available	Use%		Mounted on
cat /opt/dxmtlogs/DiskSpace/logs.csv >> /opt/dxmtlogs/DiskSpace/logstemp.csv;
sudo rm -f /opt/dxmtlogs/DiskSpace/logs.csv;
sudo df -l | sed '1d' | awk -v OFS="," '$1=$1' | grep '^/dev/\b' >> /opt/dxmtlogs/DiskSpace/logs.csv;

# Memory Monitoring
# Total			Used		Free		Shared		Buffers		Cached
sudo echo -n "$time," >>  /opt/dxmtlogs/Memory/logs.csv;
sudo free | sed '1d' | awk -v OFS="," '$1=$1' | tr '\n\r' ',' >>  /opt/dxmtlogs/Memory/logs.csv;
sudo truncate -s -1 /opt/dxmtlogs/Memory/logs.csv;
sudo echo "" >> /opt/dxmtlogs/Memory/logs.csv;

# Network Monitoring
# Interface		Rx			Tx			Total
sudo echo -n "$time," >>  /opt/dxmtlogs/Network/logs.csv;
sudo bwm-ng -o plain -c 1 | grep total | awk -v OFS="," '$1=$1' >> /opt/dxmtlogs/Network/logs.csv;

# CPU Monitoring
# Time			CPU			%usr		%nice		%sys		%iowait		%irq	%soft	%steal	%guest	%gnice	%idle
sudo mpstat | sed '1,3d' | awk -v OFS="," '$1=$1' >> /opt/dxmtlogs/CPU/logs.csv;