#!/bin/bash
while /bin/true
do
    cd /opt/ut
    node utorrent-block-xunlei.js --port 11451 --username user --password pwd --ipfilter "/path/to/ipfilter.dat"
    echo haha
    sleep 10
done