<?php ob_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
require_once('functions.php');
try
{
    $pdo= new PDO('mysql:host=127.0.0.1;dbname=athcon', 'athcon', 'athcon', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, false);

try {
        $sql = "SELECT * FROM hackerteam_scores";

        $rs = $pdo->query($sql);
        $rs->setFetchMode(PDO::FETCH_ASSOC);
        $hackers=$rs->fetchAll();

        $sql = "SELECT * FROM admin_scores";
        $rs = $pdo->query($sql);
        $rs->setFetchMode(PDO::FETCH_ASSOC);
        $admins=$rs->fetchAll();
    } catch (PDOException $exception) {
        print "\nException: " . $exception->getMessage();
    }
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
    <h1>AthCon CTF Scores</h1>
    <table class="scores hackers">
        <thead>
        <tr><th colspan="6">HACKERS</th></tr>
        <tr class="last">
          <th>nick</th>
          <th>total pckts</th>
          <th>valid pckts</th>
          <th>treasure points</th>
          <th>reported</th>
          <th>score</th>
        </tr>
        </thead>
        <tbody>
<?php foreach($hackers as $score): ?>
        <tr style="font-weight: bold">
          <td><?=tohtml($score['nickname'])?></td>
          <td><?=intval($score['total'])?></td>
          <td><?=intval($score['valid'])?></td>
          <td><?=intval($score['treasure'])?></td>
          <td><?=intval($score['reported'])?></td>
          <td><?=intval($score['points'])?></td>
        </tr>        
<?php endforeach;?>
        <tbody>
    </table> <!-- /end hackers table -->
    <table class="scores admins">
        <thead>
        <tr><th colspan="6">ADMINS</th></tr>
        <tr class="last">
          <th>nick</th>
          <th>reports</th>
          <th>valid</th>
          <th>bonus</th>
          <th>score</th>
        </tr>
        </thead>
        <tbody>
<?php foreach($admins as $score): ?>
        <tr style="font-weight: bold">
          <td><?=tohtml($score['nickname'])?></td>
          <td><?=intval($score['total'])?></td>
          <td><?=intval($score['valid'])?></td>
          <td><?=intval($score['treasure'])?></td>
          <td><?=intval(@$score['points'])?></td>
        </tr>        
<?php endforeach;?>
        <tbody>
    </table> <!-- /end admins table -->

</div>
</body>
</html>
