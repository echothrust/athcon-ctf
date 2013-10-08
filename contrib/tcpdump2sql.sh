#!/bin/ksh
PATH=$PATH:/usr/bin:/usr/sbin:/sbin:/bin:/usr/local/bin
export PATH
tcpdump -teqnl -i em4 '(tcp or udp or icmp) and (((src net 10.165 or src net 10.166 or src net 10.167 or src net 10.168 or src net 10.169 or src net 10.170) and (dst net 172.0.0 or dst net 192.0.0)) or ((src net 172.0.0 or src net 192.0.0) and (src net 10.165 or src net 10.166 or src net 10.167 or src net 10.168 or src net 10.169 or src net 10.170)))' 2>/dev/null | /var/www/htdocs/athcon.ctf/contrib/tcpdump2sql.php

