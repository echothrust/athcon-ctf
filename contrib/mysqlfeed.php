<?php
$pid=getmypid();
$localonly=false;
$verbose=false;
$options=getopt("p:lv");
$pipe='/data/mysql.syslog-ng.pipe';
foreach($options as $key => $val)
{
    switch($key)
    {
        case 'p':
            if(is_array($val)) 
                die("Error only one pipe is allowed\n");
            if(!file_exists($val))
                die("Error pipe $val does not exist\n");
            $pipe=$val;
            break;
        case 'l':
            $localonly=true;
            break;
        case 'v':
            $verbose=true;
            break;
    }
}

define('PIPE',$pipe);
// Open the PIPE and read MAC's
$handle= fopen(PIPE, 'r+');
file_put_contents("/var/run/arpsrv.$pid.pid",$pid);
try
{
    $local= new PDO('mysql:host=localhost;dbname=echofish', 'root', '', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    ));
    if(!$localonly)
    $remote= new PDO('mysql:host=10.172.16.1;dbname=echofish', 'athcon', 'athcon', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$local->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$local->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);
if(!$localonly)
{
    $remote->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
    $remote->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);
}
while (true)
{
    if ($handle)
    {
        while (($buffer= fgets($handle)) !== false)
        {
            if (trim($buffer) != "")
            {
                if(!$localonly)
                    $remote_retval=$remote->query($buffer);
                $local_retval=$local->query($buffer);
                if($verbose)
                    var_dump(array('remote'=>$remote_retval,'local'=>$local_retval));
            }
        }
        if (!feof($handle))
        {
            echo "Error: unexpected fgets() fail\n";
            fclose($handle);
        }

    }
    else $handle= fopen(PIPE, 'r+');
}
unlink("/var/run/arpsrv.$pid.pid");