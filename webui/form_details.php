<h2>Registration for <?=$userType?> station <?=$macAddr?></h2>
<?php 
require_once('rules.'.$userType.'.php');
?>    <form id="form1" action="" method="post">  
    
      <fieldset><legend>Registration Form</legend>
        <p class="first">
          <label for="nickname">nickname <strong style="color: red;">*</strong>(Use a sane nickname a-zA-Z0-9,all other characters will be removed.)</label>
          <input type="text" name="nickname" id="nickname" size="30" />
        </p>
<?php if ($userType=='admin') {?>
        <p>
          <label for="passwd">Password <strong style="color: red;">*</strong>(needed in order to log into the systems)</label>
          <input type="password" name="passwd" id="passwd" size="30" />
        </p>
<?php } ?>
        <p>
          <label for="mac">mac address <strong style="color: red;">*</strong></label>
          <input type="text" readonly="readonly" name="mac" id="mac" value="<?=$macAddr?>" size="30" />
        </p>
<?php if ($userType=='hacker') {?>
        <p>
          <label for="team">team</label>
          <input type="text" name="team" id="team" size="30" />
        </p>
        <p>
          <label for="passwd">team password</label>
          <input type="password" name="passwd" id="passwd" size="30" />
        </p>
<?php } ?>

      </fieldset>
      <fieldset>
        <p>
          <label for="signature">signature</label>
          <textarea name="signature" id="signature" cols="30" rows="10"></textarea>
        </p>                
      </fieldset>         

      <p class="submit"><button type="submit">Send</button></p>   
            
    </form>
<ul>
<li><strong>nickname:</strong> Enter a nick name that the system will identify you. This will be shown on the scoreboard so be polite and reasonable. Offensive or otherwise inapropriate nicknames will be deleted.</li>
<?php if ($userType=='admin') {?><li><strong>password:</strong> Don't enter a sensitive password. This will be stored in plain text and it is used in order to create the required usernames on the security systems that you will monitor.</li> <?php } ?>
<li><strong>mac address:</strong> This will be the mac address that we will monitor to provide you with points. If you plan on "changing" your mac replace the detected one.</li>
<?php if ($userType=='hacker') {?><li><strong>team:</strong> If you enter a team name, then your nickname will not be visible and the team will be shown instead. Points from individual members will be avereaged and displayed as team score.</li><?php } ?>
<li><strong>signature</strong> As a pure geek add a signature that will go along your nickname.</li>
</ul>
