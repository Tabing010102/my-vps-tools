#!/bin/bash

DEVICE=$1
SPEED=$2

tc qdisc del dev ${DEVICE} root tbf rate ${SPEED} burst 1mbit latency 0.001ms