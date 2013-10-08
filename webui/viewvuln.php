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
$id=intval(@$_GET['id']);
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, false);
$res=false;
try {
    $stmt=$pdo->prepare("SELECT * FROM vuln WHERE status!='PENDING' and id=:id");
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $stmt->setFetchMode(PDO :: FETCH_ASSOC);
    $res=$stmt->fetch();
}
catch (PDOException $exception)
{
    echo "";
}
if ($res===false)
{
    die('The vulnerability does not exist or is still pending administrative approval!');
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Vulnerability [ID:<?=$id?>]</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AcmeSec Vulnerabilities"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/abuse.css" media="screen" />
</head>
<body>
<div id="container">
<h1>Subject: <?=tohtml($res['subject'])?></h1>
<h1>Server: <?=tohtml($res['server'])?>
<h1>Timestamp: <?=$res['ts']?></h1>
<pre>
<?=tohtml($res['message'])?>
</pre>
</div>
</body>
</html>
