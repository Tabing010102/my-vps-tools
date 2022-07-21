#!/bin/bash

DEVICE=lo
PORT_LIMIT=20mbit
# PORT_BURST=512k

tc qdisc del dev ${DEVICE} root
# tc qdisc del dev ${DEVICE} ingress

# tc qdisc add dev ${DEVICE} root handle 1: prio
# tc filter add dev ${DEVICE} parent 1: protocol ip basic match 'cmp(u16 at 0 layer transport eq 12342)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} parent 1: protocol ip basic match 'cmp(u16 at 0 layer transport eq 12343)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} parent 1: protocol ip basic match 'cmp(u16 at 0 layer transport eq 12344)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} parent 1: protocol ip basic match 'cmp(u16 at 0 layer transport eq 12345)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} parent 1: protocol ip basic match 'cmp(u16 at 0 layer transport eq 12346)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc qdisc add dev ${DEVICE} ingress
# tc filter add dev ${DEVICE} ingress protocol ip basic match 'cmp(u16 at 2 layer transport eq 12342)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} ingress protocol ip basic match 'cmp(u16 at 2 layer transport eq 12343)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} ingress protocol ip basic match 'cmp(u16 at 2 layer transport eq 12344)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} ingress protocol ip basic match 'cmp(u16 at 2 layer transport eq 12345)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}
# tc filter add dev ${DEVICE} ingress protocol ip basic match 'cmp(u16 at 2 layer transport eq 12346)' action police rate ${PORT_LIMIT} burst ${PORT_BURST}

tc qdisc add dev ${DEVICE} root handle 1: htb

tc class add dev ${DEVICE} parent 1: classid 1:40 htb rate ${PORT_LIMIT}
tc class add dev ${DEVICE} parent 1: classid 1:41 htb rate ${PORT_LIMIT}
tc class add dev ${DEVICE} parent 1: classid 1:42 htb rate ${PORT_LIMIT}
tc class add dev ${DEVICE} parent 1: classid 1:43 htb rate ${PORT_LIMIT}
tc class add dev ${DEVICE} parent 1: classid 1:44 htb rate ${PORT_LIMIT}

tc qdisc add dev ${DEVICE} parent 1:40 handle 40: sfq perturb 10
tc qdisc add dev ${DEVICE} parent 1:41 handle 41: sfq perturb 10
tc qdisc add dev ${DEVICE} parent 1:42 handle 42: sfq perturb 10
tc qdisc add dev ${DEVICE} parent 1:43 handle 43: sfq perturb 10
tc qdisc add dev ${DEVICE} parent 1:44 handle 44: sfq perturb 10

tc filter add dev ${DEVICE} parent 1: protocol ip prio 1 basic match 'cmp(u16 at 0 layer transport eq 12342)' flowid 1:40
tc filter add dev ${DEVICE} parent 1: protocol ip prio 1 basic match 'cmp(u16 at 0 layer transport eq 12343)' flowid 1:41
tc filter add dev ${DEVICE} parent 1: protocol ip prio 1 basic match 'cmp(u16 at 0 layer transport eq 12344)' flowid 1:42
tc filter add dev ${DEVICE} parent 1: protocol ip prio 1 basic match 'cmp(u16 at 0 layer transport eq 12345)' flowid 1:43
tc filter add dev ${DEVICE} parent 1: protocol ip prio 1 basic match 'cmp(u16 at 0 layer transport eq 12346)' flowid 1:44
