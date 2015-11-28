#!/bin/bash
# Workout instance id
	mac=$(</sys/class/net/eth0/address)
#echo "$mac"
	macadd="${mac//:/}"
#echo $macadd
   OS=`uname -r | cut -d- -f3`
#echo $OS
   hw=`cat /proc/cpuinfo | grep Hardware | cut -d: -f 2 | cut -d" " -f 2`
#echo $hw
   hwserial=`cat /proc/cpuinfo | grep Serial | cut -d: -f 2 | cut -d" " -f 2`
#echo $hwserial
   instanceid=$macadd$OS$hw$hwserial
   echo $instanceid
