<?php
require_once('../functions.php');

$clientIP= $_SERVER['REMOTE_ADDR'];
if(substr($clientIP,0,6)!='172.16')
    die('Not an admin');

try
{
    $pdo= new PDO('mysql:host=localhost;dbname=athcon', 'root', '', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);

