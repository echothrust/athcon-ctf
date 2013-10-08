<?php ob_start();session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once('init.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Abuse Report</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AcmeSec Abuse Report"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/abuse.css" media="screen" />
</head>
<body>
<div id="container">
<?php if(intval($id)>0 && trim($nickname)!='' && $userType=="admin") { 
   if(!empty($_POST)) add_report();
?> 

<h1>Report A Hacker / Reporter: <?=tohtml($nickname)?></h1>
<form id="form1" action="?" method="post">  
      <fieldset><legend>Abuse Report</legend>
        <p class="first">
          <label for="subject">Subject <strong style="color: red;">*</strong><small>(Enter a short descriptive subject for your report)</small></label>
          <input type="text" name="subject" id="subject" size="30" maxsize="250" value="<?=tohtml(@$_POST['subject'])?>"/>
        </p>      
        <p>
          <label for="attacker">Attacker <strong style="color: red;">*</strong><small>(IP of the attacker that abused your systems, the IP of the perpetrator)</small></label>
          <input type="text" name="attacker" id="attacker" size="30" value="<?=tohtml(@$_POST['attacker'])?>"/>
        </p>      
        <p>
          <label for="server">Attacked Server <strong style="color: red;">*</strong><small>(IP/hostname of the server that got attacked)</small></label>
          <input type="text" name="server" id="server" size="30" value="<?=tohtml(@$_POST['server'])?>"/>
        </p>      
        <p>
          <label for="datentime">Date and Time <strong style="color: red;">*</strong><small>(Enter the time as it apears on the logs)</small></label>
          <input type="text" name="datentime" id="datentime" size="30" value="<?=tohtml(@$_POST['datentime'])?>"/>
        </p>      
        <p>
          <label for="abuse">Attack Type <small>(Portscan, spam, brute force? Enter a type of the attack)</small></label>
          <input type="text" name="abuse" id="abuse" size="30" value="<?=tohtml(@$_POST['abuse'])?>"/>
        </p>      
        <p>
          <label for="thru">Source <small>(Please indicate where you saw this attack? eg Echofish, Snorby, etc)</small></label>
          <input type="text" name="thru" id="thru" size="30" value="<?=tohtml(@$_POST['thru'])?>"/>
        </p>      
        <p>
          <label for="message">Message <small>(Describe a bit what makes you think this is an attack)</small></label>
          <textarea name="message" id="message" cols="73" rows="10"><?=tohtml(@$_POST['message'])?></textarea>
        </p>                
        <p>
          <label for="logs">Log Entries <strong style="color: red;">*</strong><small>(Paste the evidence here. Logs that prove the guilt of reported IP)</small></label>
          <textarea name="logs" id="logs" cols="73" rows="10"><?=tohtml(@$_POST['logs'])?></textarea>
        </p>                
      </fieldset>         

      <p class="submit"><button type="submit">Send</button></p>   
            
    </form>
<?php } else {?>
    <h1>You need to register as an admin in order to submit an abuse report</h1>
<?php } ?>
</div>
</body>
</html>
