#!/usr/bin/awk -f
# The following script is designed to be run from OpenBSD
# and parses output directly from
# ssh root@172.16.11.18 "tcpdump -ttnql -i hackif"|awk -f tcpdump.awk |gource -f --multi-sampling --no-vsync  --log-format custom  -
# tcpdump -ttnq
{
       networks['172.0.0']="DMZ";
       networks['192.0.0']="LAB";
        timestamp=$1
        sip=$2;
        # Remove double-dot (:) from end of line
        dip=substr($4, 1,length($4)-1);
        direction=$3;
        type="";
        # match the entire destination ip
        match(dip, /[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/)
        # and grab the last part after the . (this is the port)
        dport=substr(dip,RLENGTH+2);
        gsub(".[0-9]*$","",timestamp);
        gsub(".[0-9]*$","",dip);
        network=dip;
        gsub(".[0-9]*$","",network);
        gsub(".[0-9]*$","",sip);
        
        printf("%s|%s|A|%s/%s/%s.tcp|#FF00ff\n",timestamp,sip,networks[network],dip,dport);
}
