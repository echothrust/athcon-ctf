<?php
$pid=getmypid();
define('HACBRIDGE', 'bridge0');
define('HACIF', 'em4');
define('HACVETH', 'vether0');

define('ADMBRIDGE', 'bridge1');
define('ADMVETH', 'vether1');
define('ADMIF', 'em5');

$CMD= "/sbin/ifconfig %s flushrule %s rulefile";
$GETRULES= "ifconfig %s rules %s";
$SRC= "pass on %s src %s tag %s\n";
$DST= "pass on %s dst %s tag %s\n";
$BLOCK="block on %s TAG UNAUTH\n";
$RULES= "";
function _do_add($bridge,$eth,$verther,$mac)
{
    global $CMD,$GETRULES,$SRC,$DST,$RULES,$BLOCK;
    // open syslog, include the process ID 
    // Create a random /tmp file"
    $fname= tempnam("/tmp", "ruleset");
    // Format rules for bridge src/dst
    $RULES= sprintf($SRC, $eth,trim($mac));
    $RULES .= sprintf($DST, $eth,trim($mac));

    // Put the two rules on our TMP file
    file_put_contents($fname, $RULES);

    // Get the rules from the bridge, sort them and unique them, 
    // appending them into our TMP file
    system(sprintf($GETRULES . ">>$fname",$bridge,$eth));
    // Flush output buffers
    flush();
    // Load our rules and unlink the tmp file
    system(sprintf($CMD . " $fname",$bridge,$eth));
    unlink($fname);
}
function admin_add($mac= NULL)
{
        _do_add(ADMBRIDGE,ADMIF,ADMVETH,$mac);
}

function hacker_add($mac= NULL)
{
        _do_add(HACBRIDGE,HACIF,HACVETH,$mac);
}
// Open the PIPE and read MAC's
if (!file_exists('/tmp/arpexchange'))
    die("Error: Socket does not exist.\n");
$handle= fopen('/tmp/arpexchange', 'r+');
file_put_contents("/var/run/arpsrv.pid",$pid);
while (true)
{
    if ($handle)
    {
        while (($buffer= fgets($handle)) !== false)
        {
            if (trim($buffer) != "")
            {
                $registration= explode('|', trim($buffer));
                openlog("arpsrv", LOG_PID|LOG_NDELAY, LOG_AUTH);
                $mac=$registration[1];
                if ($registration[0] == 'adm')
                {
                    
                    syslog(LOG_INFO, "Registering admin MAC [$mac]");
                    admin_add($registration[1]);
                }
                else
                {
                    syslog(LOG_INFO, "Registering hacker MAC [$mac]");
                    hacker_add($registration[1]);
                }
                closelog();
            }
        }
        if (!feof($handle))
        {
            echo "Error: unexpected fgets() fail\n";
            fclose($handle);
        }

    }
}