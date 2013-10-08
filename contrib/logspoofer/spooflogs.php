<?php
$QUERY= "INSERT INTO syslog (host, facility, priority, level, received_ts, program, msg,pid,tag) VALUES ( INET_ATON(:websrv), '0', '0','6', NOW(), 'httpd', :msg,0, 6)";
require_once('init.php');

do 
{
    // RANDOM IP FOR CLIENT
    $RANDIP= long2ip(rand(178585600, 178978815));
    
    // Random Requests File
    $REQid= rand(0, count($REQUESTS) - 1);
    
    // Random Browser Profile
    $BRWid= rand(0, count($BROWSERS) - 1);
    // format Apache Prefix
    $_prefix= sprintf("%s - - %s", $RANDIP, date("[d/m/Y:H:i:s +0300]"));
    // and suffix (which is the browser and such)
    $_suffix= $BROWSERS[$BRWid];
    $_tmpreq= array_keys($REQUESTS);
    
    // the variable holding the random requests
    $_file=$_tmpreq[$REQid];
    $websrv=$REQUESTS[$_file];
    echo "PREFIX: ", $_prefix," SUFFIX: ", $_suffix, "\n","FILE: ", $_file, "\n";
    $_reqs= explode("\n", file_get_contents($_file));
    foreach ($_reqs as $val)
    {
        $msg= sprintf("%s %s %s", $_prefix, trim($val), $_suffix);
        $stmt->bindValue(':websrv', $websrv);
        $stmt->bindValue(':msg', $msg);
        $stmt->execute();
    }
    $slrand=rand(30,380);
    echo "Sleeping for $slrand\n";
    sleep($slrand);
} while (true);

//print_r($_reqs);
//$ENTRY $BROWSER
?>
