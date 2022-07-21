#!/bin/bash

# 总上传带宽
GLOBAL_LIMIT=8500kbit
# 保障带宽
ENSURE_BAND_10=6000kbit
# 保证规则
ENSURE_BAND_PROTO1=tcp
ENSURE_BAND_PROTO2=udp
ENSURE_BAND_PORT=51513
ENSURE_BAND_PORT2=51514

# 清空tc原有规则
tc qdisc del dev eth0 root
# 默认走1:99规则
tc qdisc add dev eth0 root handle 1: htb default 99
# 总规则
tc class add dev eth0 parent 1: classid 1:1 htb rate ${GLOBAL_LIMIT}
# 高优先级规则，保障设定的带宽
tc class add dev eth0 parent 1:1 classid 1:10 htb rate ${ENSURE_BAND_10} ceil ${GLOBAL_LIMIT} prio 0
# 默认规则，留200Kb给ssh等
tc class add dev eth0 parent 1:1 classid 1:99 htb rate 200kbit ceil ${GLOBAL_LIMIT} prio 1
# 使有标记的数据包走高优先级规则
tc filter add dev eth0 parent 1:0 prio 0 protocol ip handle 10 fw flowid 1:10

# 清空OUTPUT的mangle表
iptables -F OUTPUT -t mangle
# 给要保证带宽的协议端口标记
iptables -A OUTPUT -t mangle -p ${ENSURE_BAND_PROTO1} --sport ${ENSURE_BAND_PORT} -j MARK --set-mark 10
iptables -A OUTPUT -t mangle -p ${ENSURE_BAND_PROTO2} --sport ${ENSURE_BAND_PORT} -j MARK --set-mark 10
iptables -A OUTPUT -t mangle -p ${ENSURE_BAND_PROTO1} --sport ${ENSURE_BAND_PORT2} -j MARK --set-mark 10
iptables -A OUTPUT -t mangle -p ${ENSURE_BAND_PROTO2} --sport ${ENSURE_BAND_PORT2} -j MARK --set-mark 10

