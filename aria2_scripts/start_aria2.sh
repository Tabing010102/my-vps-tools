aria2c --enable-rpc --rpc-listen-all=false --rpc-secret=114514 --file-allocation=falloc --continue=true --check-integrity=true --max-connection-per-server=16 --split=16 --min-split-size=20M --dir=/path/to/dl --save-session=/path/to/session.gz --input-file=/path/to/session.gz