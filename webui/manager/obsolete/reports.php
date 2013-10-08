<?php ob_start();session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once('init.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>AthCon CTF</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AthCon CTF Interface"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="../css/abuse.css" media="screen" />
</head>
<body>
<div id="container">
</table>
<h2>Your Reports</h2>
<table width="100%">
<thead style="background: black; color: white">
  <tr>
    <th width="20px">ID</th>
    <th width="160px">Subject</th>
    <th width="60px">Attacker</th>
    <th width="60px">Server</th>
    <th width="100px">Reporter</th>
    <th width="300px">Comment</th>
    <th width="20px"></th>
  </tr>
</thead>
<tbody>
<?php foreach(get_all_reports() as $report):?>
  <tr style="border-bottom: 1px solid black">
    <td><?=sprintf("%.5d",$report['id'])?></td>
    <td><?=$report['subject']?></td>
    <td><?=$report['attacker']?></td>
    <td><?=$report['server']?></td>
    <td><?=$report['reporter']?></td>
    <td><?=$report['comments']?></td>
    <td></td>
  </tr>
<?php endforeach;?>
</tbody>
</table>    
