<?php ob_start();session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once('init.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Claim an Achievement</title>  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
  <meta name="description" content="Claim an Achievement"></meta>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="stylesheet" href="css/terminal.css" media="screen" />
</head>
<body>
<div id="container">
<?php if(intval($id)>0 && trim($nickname)!='' &&  $userType=="hacker") { 
   if(!empty($_POST)) 
   {
    $ret=claim_achievement();
    switch($ret)
    {
        case false:
            echo "<p>You probly misstyped the code. Give it another go.</p>";
            break;
        case -1:
            echo '<p style="color: red">You already have this achievement</p>';
            break;
        default:
            echo "<h1>You have succefully claimed the following achievement</h1>";
            echo "<pre>\n";
            echo "Title: ",$ret['name'],"\n";
            echo "Points: ",$ret['points'],"\n";
            echo $ret['description'],"\n";
            echo "</pre>\n";
    }
   }
?> 

<h1>Claim an achievement <?=tohtml($nickname)?></h1>
<form id="form1" action="claim.php" method="post">  
      <fieldset><legend>Achievement Claim</legend>
        <p clas="last">
          <label for="code">Achievement Code <strong style="color: red;">*</strong><small>(Enther the code as it appeared)</small></label>
          <input type="text" name="code" id="code" size="30" value=""/>
        </p>      
      </fieldset>         

      <p class="submit"><button type="submit">Send</button></p>   
            
    </form>
<?php } else {?>
    <h1>You need to register as a hacker first in order to claim an achievement</h1>
<?php } ?>
</div>
</body>
</html>
