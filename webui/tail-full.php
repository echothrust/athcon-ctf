<?php ob_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
require_once('functions.php');
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

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="refresh" content="<?=intval(@$_GET['meta'])>0 ? intval(@$_GET['meta']) : 10;?>">
  <title>AthCon CTF Scores</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AthCon CTF Scores"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/abuse.css" media="screen" />
</head>
<body>
<div id="scorecontainer">
    <h1>AthCon CTF History</h1>
<ul>
<?php foreach(tail_achievements() as $line): ?>
<li><b><?=tohtml($line['nickname'])?></b> earned [<i><?=$line['private_title']?></i>] for <?=intval($line['points'])?> points.
<?php endforeach;?>
</ul>
</div>
</body>
</html>
