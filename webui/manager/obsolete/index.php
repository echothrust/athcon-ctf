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
    <h1>AthCon CTF Judge</h1>
    <a href="reports.php" target="iframe">Reports</a> |
    <a href="../scores.php" target="iframe">Scores</a> | 
    <a href="users.php" target="iframe">Users</a> |
    <a href="arpdat.php" target="iframe">arpdat</a> |
    <a href="arphistory.php" target="iframe">arphistory</a> |
     
<iframe name="iframe" src="reports.php" width="100%" height="400px" style="border:0px solid white;"></iframe>
<?php 
?>

</div>
</body>
</html>
