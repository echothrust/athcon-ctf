<?
try {
        $sql = "SELECT * FROM hacker_scores";

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
    if($userType=='admin') $scores=$admins;
    else $scores=$hackers;
?>

<h2>Scoreboard (MAC:<?=$macAddr?>)</h2>
<?php if(intval($status)!=1 && $userType=='admin') {?>
<p><strong style="color: red; font-size: 1.5em">Account Creation: PENDING</strong><br/></p>
<?php } else {?>
<p><strong style="color: green; font-size: 1.5em">Account Creation: COMPLETED</strong><br/></p>
<?php } ?>
<table width="100%">
<thead>

<?php if($userType=='admin') {?>
    <tr><th>nick</th><th>reports</th><th>valid reports</th><th>bonus</th><th>score</th></tr>
<?php } else { ?>
    <tr><th>nick</th><th>pckts</th><th>valid pckts</th><th>achievements</th><th>score</th></tr>
<?php } ?>
</thead>
<tbody>
<?php 
    foreach($scores as $score) {
        if($score['id']==$id) $style='style="background-color: darkgray"'; 
        else $style="";
?>
  <tr valign="top" <?=$style?>>
    <td><?=tohtml($score['nickname'])?><?php if (trim($score['team'])!='')echo "/",tohtml($score['team']);?></td>
    <td><?=intval($score['total'])?></td>
    <td><?=intval($score['valid'])?></td>
    <td><?=intval($score['treasure'])?></td>
    <td><?=intval($score['points'])?></td>
  </tr>
<?php }?>
</tbody>
</table>
<h2>Achievements</h2>
<ul>
<?php foreach(get_achievements() as $arch) { ?>
    <li><?=$arch['ts']?> - <?=$arch['name']?> (<?=intval($arch['points'])?> Points)</li>
<?php }?>
</ul>


<h2>Your Reports</h2>
<table width="100%">
<thead style="background: black; color: white">
  <tr>
    <th width="20px">ID</th>
    <th width="160px">Subject</th>
    <th width="60px">Attacker</th>
    <th width="60px">Server</th>
<?php if($userType=='hacker') {?>
    <th>Reporter</th>
<?php } ?>
    <th width="20px"></th>
    <th>Comment</th>
  </tr>
</thead>
<tbody>
<?php foreach(get_reports($macAddr,$userType) as $report):?>
  <tr style="border-bottom: 1px solid black">
    <td><?=sprintf("%.5d",$report['id'])?></td>
    <td><?=tohtml($report['subject'])?></td>
    <td><?=tohtml($report['attacker'])?></td>
    <td><?=tohtml($report['server'])?></td>
<?php if($userType=='hacker') {?>
    <td><?=tohtml($report['reporter'])?></td>
<?php } ?>
    <td><?=tohtml($report['comments'])?></td>
    <td></td>
  </tr>
<?php endforeach;?>
</tbody>
</table>

<h2>Vulnerability Reports</h2>
<table width="100%">
<thead style="background: black; color: white">
  <tr>
    <th width="20px">ID</th>
    <th width="160px">Subject</th>
    <th width="60px">Reporter</th>
    <th width="60px">Server</th>
    <th width="60px">Status</th>
  </tr>
</thead>
<tbody>
<?php foreach(get_vulns() as $vuln):?>
  <tr style="border-bottom: 1px solid black">
    <td><?=sprintf("%.5d",$vuln['id'])?></td>
    <td><a target="_blank" href="/viewvuln.php?id=<?=intval($vuln['id'])?>"><?=tohtml($vuln['subject'])?></a></td>
    <td><?=tohtml($vuln['reporter'])?></td>
    <td><?=tohtml($vuln['server'])?></td>
    <td><?=tohtml($vuln['status'])?></td>
  </tr>
<?php endforeach;?>
</tbody>
</table>



<h2>Hints</h2>
<ul>
<?php foreach(get_hints('note',$userType) as $rule){?>
<li><u><?=$rule['title']?></u><br/>
<code><?=$rule['message']?></code></li>    
<?php }?>
</ul>


<h2>Rules</h2>
<ul>
<?php foreach(get_hints('rule',$userType) as $rule){?>
<li><u><?=$rule['title']?></u><br/>
<code><?=$rule['message']?></code></li>    
<?php }?>
</ul>