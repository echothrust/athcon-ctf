<?php ob_start();session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once('init.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>AthCon CTF (TYPE: <?=$userType?>)</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AthCon CTF Interface"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/<?=$css?>" media="screen" />
</head>
<body>
<div id="container">
    <h1>AthCon CTF Interface</h1>
<?php if(intval($id)==0) {?>
<p>Welcome, to the <b>CTF</b> of <b>AthCon2012</b>. This year we wanted something special for our CTF. We wanted to be able and make it more relative, more fun, easier for by standers to see whats going on. This year we want to promote skill, innovation and knowledge.</p>
<p>While attackers display their skills, and compete against latest software, operating systems and each other, administrators track and report malicious activity in order to protect their networks. On the other side, we wanted to give a better view to Athcon participants of how the attacks look from the inside, along with how the attacks start and how they end up on the attacked networks.</p>
<?php } else { ?>
    <p><strong>Now that you have registered take a look at the rules and notes again. Updated information is only for registered eyes.</strong></p>
<?php } ?>

<?php 
if( (trim(@$_POST['nickname'])==''||trim(ereg_replace("[^A-Za-z0-9]",'',@$_POST['nickname']))=='') && intval($id)==0) {
  require_once('form_details.php');
}
elseif (!empty($_POST) && intval($id)==0){ 
  require_once('register.php');
}else {
  require_once('scoreboard.php');
}
?>
</div>
</body>
</html>
