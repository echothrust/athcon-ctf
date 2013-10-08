<?php
require_once('functions.php');

$clientIP= $_SERVER['REMOTE_ADDR'];
if(@$_GET['type']=='admin'|| substr($clientIP,0,9)=='10.172.17')
    $userType='admin';
else 
    $userType='hacker';
$macAddr= false;
$arp= `/usr/sbin/arp -n $clientIP`;
/* XXX: REMOVE THE $_GET attr */


if (trim($arp) != '')
{
    $cols= preg_split('/\s+/', trim($arp));
    $macAddr= trim($cols[3]);
}

if($macAddr=='' || $macAddr=='no')
 die('You are not connected to the local interfaces, go away!');

try
{
    $pdo= new PDO('mysql:host=172.16.11.50;dbname=athcon', 'athcon', 'athcon', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, false);

try
{
    $sql= "SELECT id,nickname,category,created FROM users WHERE mac=:mac LIMIT 1";
    $stmt= $pdo->prepare($sql);
    /* bind the parameter */
    $stmt->bindParam(':mac', $macAddr);
    $stmt->bindColumn('nickname', $nickname);
    $stmt->bindColumn('category', $userType);
    $stmt->bindColumn('created', $status);
    $stmt->bindColumn('id', $id);
    $stmt->execute();
    $stmt->fetch();
}
catch (PDOException $exception)
{
    print "\nException: ".$exception->getMessage();
}

if ($userType=='admin')
    $css= 'screen.css';
else
    $css= 'terminal.css';
