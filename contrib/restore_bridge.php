<?php

//# Restore mac addresses from the database (eliminates the need for rulefile)
$ADMINS[]= "pass on em5 src 00:0c:29:c5:70:a3 tag www";
$ADMINS[]= "pass on em5 dst 00:0c:29:c5:70:a3 tag www";
$admin_last= "block on em5 tag UNAUTH";

$HACKERS[]= "pass on em4 src 00:0c:29:c5:70:ad tag www";
$HACKERS[]= "pass on em4 dst 00:0c:29:c5:70:ad tag www";
$hacker_last="block on em4 tag UNAUTH";

try
{
    $local= new PDO('mysql:host=172.16.11.50;dbname=athcon', 'athcon', 'athcon', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$local->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$local->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);

try
{
    $sql= "SELECT * FROM users";

    $rs= $local->query($sql);
    $rs->setFetchMode(PDO :: FETCH_ASSOC);
    $users= $rs->fetchAll();
}
catch (PDOException $exception)
{
    print "\nException: " . $exception->getMessage();
}
foreach($users as $user)
{
    switch($user['category'])
    {
        case 'admin':
            $ADMINS[]=sprintf("pass on em5 src %s tag ADMIN",$user['mac']);
            $ADMINS[]=sprintf("pass on em5 dst %s tag ADMIN",$user['mac']);
            break;
        case 'hacker':
        default:
            $HACKERS[]=sprintf("pass on em4 src %s tag HACKER",$user['mac']);
            $HACKERS[]=sprintf("pass on em4 dst %s tag HACKER",$user['mac']);
            break;
    }
}
$ADMINS[]=$admin_last;
$HACKERS[]=$hacker_last;
$bridge0=implode("\n",$HACKERS);
$bridge1=implode("\n",$ADMINS);
file_put_contents("/data/bridge0/em4.rules",$bridge0);
file_put_contents("/data/bridge1/em5.rules",$bridge1);
printf("bridge0 rules\n");
echo $bridge0."\n";
printf("bridge1 rules\n");
echo $bridge1."\n";
