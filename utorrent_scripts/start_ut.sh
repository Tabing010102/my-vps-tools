#!/bin/bash
while /bin/true
do
    cd /opt/utorrent/utorrent-server-alpha-v3_3
    su utuser
    LD_LIBRARY_PATH=. ./utserver
    echo haha
    sleep 10
done