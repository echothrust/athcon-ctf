<?php ob_start();session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once('init.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Vulnerability Report</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="AcmeSec Vulnerability Report"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/abuse.css" media="screen" />
</head>
<body>
<div id="container">
<?php if(intval($id)>0 && trim($nickname)!='' && $userType=="hacker") { 
   if(!empty($_POST)) add_vuln();
?> 

<h1>Report A Vulnerability / Reporter: <?=tohtml($nickname)?></h1>
<form id="form1" action="?" method="post">  
      <fieldset><legend>Vulnerability Report</legend>
        <p class="first">
          <label for="subject">Subject <strong style="color: red;">*</strong><small>(Enter a short descriptive subject for your report)</small></label>
          <input type="text" name="subject" id="subject" size="30" maxsize="250" value=""/>
        </p>      
        <p>
          <label for="server">Attacked Server <strong style="color: red;">*</strong><small>(IP/hostname of the server that is vulnerable)</small></label>
          <input type="text" name="server" id="server" size="30" value=""/>
        </p>      
        <p>
          <label for="message">Message <small>(Describe the vulnerability in depth. If we dont have enough details we won't be able to verify your claim)</small></label>
          <textarea name="message" id="message" cols="73" rows="10"></textarea>
        </p>                
      </fieldset>         

      <p class="submit"><button type="submit">Send</button></p>   
            
    </form>
<?php } else {?>
    <h1>You need to register as a hacker in order to submit a vulnerability report </h1>
<?php } ?>
</div>
</body>
</html>
