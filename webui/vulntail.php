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
$res=false;
try {
    $stmt=$pdo->prepare("SELECT t1.*,if(t2.team='',t2.nickname,concat('team ',t2.team)) as nickname FROM vulns_FULL t1 LEFT JOIN users t2 on t2.id=t1.users_id");
    $stmt->execute();
    $stmt->setFetchMode(PDO :: FETCH_ASSOC);
    $results=$stmt->fetchAll();
}
catch (PDOException $exception)
{
    echo "";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Vulnerabilities</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AcmeSec Vulnerabilities"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/abuse.css" media="screen" />
</head>
<body>
<div id="container">
<?php foreach ($results  as $res) {?>
  <h1>Reporter: <?=tohtml($res['nickname'])?></h1>
  <h1>Subject: <?=tohtml($res['subject'])?></h1>
  <h1>STATUS: <?=tohtml($res['status'])?></h1>
  <h1>Server: <?=tohtml($res['server'])?>
  <h1>Timestamp: <?=$res['ts']?></h1>
<pre>
<?=tohtml(wordwrap($res['message'],75,"\n",true))?>
</pre>
<hr noshade="noshade"/>
<?php } ?>
</div>
</body>
</html>
