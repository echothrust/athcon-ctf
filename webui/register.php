<?php
try
{
$badnicks=array('admin','administrator','acmesec','sysadmin');
    /* create a prepared statement */
    
    $_POST['nickname']=trim(ereg_replace("[^A-Za-z0-9]",'',@$_POST['nickname']));
    if(posix_getpwnam (trim(@$_POST['nickname']))!==false || array_search(trim($_POST['nickname']),$badnicks)!==false)
      die('Choose another nickname dude');

    if($userType=='hacker')
    {
      $QUERYSE= "SELECT DISTINCT team,passwd FROM users WHERE team=:team and category='hacker' and team!='' GROUP BY team";
      $stmtse= $pdo->prepare($QUERYSE);
      $stmtse->bindParam(':team', @ $_POST['team']);
      $stmtse->setFetchMode(PDO :: FETCH_ASSOC);
      $stmtse->execute();
      $rs= $stmtse->fetch();
      if ($rs == false && $userType == 'hacker')
      {
        // team does not exist
      }
      elseif ($rs['passwd'] == @ $_POST['passwd'])
      {
        // team exists and password is valid
      }
      else
          die('Wrong team password. Go back and try again');
    }

    $QUERYIN= "INSERT INTO users (nickname,passwd,team,mac,category,signature) VALUES (:nickname,:passwd,:team,:mac,:category,:signature)";
    $stmtin= $pdo->prepare($QUERYIN);


    /* bind the parameter */
    $stmtin->bindValue(':nickname', trim(@$_POST['nickname']));
    $stmtin->bindValue(':team', trim(@$_POST['team']));
    $stmtin->bindValue(':passwd', trim(@ $_POST['passwd']));
    $stmtin->bindValue(':category', trim($userType));
    $stmtin->bindValue(':mac', trim($macAddr));
    $stmtin->bindValue(':signature', trim($_POST['signature']));

    $pdo->beginTransaction();
    /* execute the SQL */
    if ($stmtin->execute())
    {

        $_SESSION['nickname']= @ $_POST['nickname'];
        $_SESSION['team']= @ $_POST['team'];
        $_SESSION['category']= $userType;
        $_SESSION['mac']= $macAddr;
        $_SESSION['signature']= @ $_POST['signature'];
        $connection= ssh2_connect('172.16.11.18', 22, array (
            'hostkey' => 'ssh-rsa'
        ));

        if (ssh2_auth_pubkey_file($connection, 'root', '/var/www/htdocs/id_rsa.pub', '/var/www/htdocs/id_rsa'))
        {
            $pdo->commit();
            //echo "Public Key Authentication Successful\n";
        }
        else
        {
            $pdo->rollback();
            die('Bridge Failed, notify the admins. Rolled back registration!!!');
        }
        $stream= ssh2_exec($connection, "/etc/rc.athcon.registration");

        /*if (file_exists("/tmp/arpexchange"))
        {
            $pipe= fopen('/tmp/arpexchange', 'w');
            fwrite($pipe, substr($userType, 0, 3) . "|$macAddr\n");
            fclose($pipe);
            flush();
        } */
        echo 'Successfuly Registered. Go to the <a href="?">scoreboard</a>';
        header("Location: index.php");
    }
    else
    {
        print_r($pdo->errorInfo());
    }
}
catch (PDOException $exception)
{
    if($stmtin->errorCode()==23000) echo "Choose another nickname".$exception->getMessage();
    else print "\nException: " . $exception->getMessage();
    $pdo->rollBack();
}