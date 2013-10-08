<?php
try
{
    // Query the local server since we are in another routing domain.
    $pdo= new PDO('mysql:host=localhost;dbname=echofish', 'root', '', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);

try
{
    $sql= "SELECT id,nickname,`passwd` FROM users WHERE category='admin' and created=0 ORDER BY id DESC LIMIT 1";

    $rs= $pdo->query($sql);
    $rs->setFetchMode(PDO :: FETCH_ASSOC);
    $users= $rs->fetch();
}
catch (PDOException $exception)
{
    syslog(LOG_INFO, "Exception: " . $exception->getMessage());
    die("\nException: " . $exception->getMessage());
}
if($users==false)
  exit(0);
syslog(LOG_INFO, sprintf("Registering user [%s] on drupal", $users['nickname']));
post_data($users, 'www.acmesec.fake', 80, '/tadd.php');
$us[':nickname']= $users['nickname'];
$us[':passwd']= $users['passwd'];
// ECHOFISH
do_srvsql('ids.acmesec.fake', 'echofish','athcon','athcon',"INSERT INTO user (username,`password`) VALUES (:nickname,sha1(:passwd))",$us);

// BASE
do_srvsql('ids.acmesec.fake', 'snort','athcon','athcon',"INSERT INTO base_users (usr_login,usr_pwd,role_id,usr_enabled) VALUES (:nickname,md5(:passwd),1,1)",$us);

// Snorby
$us[':nickname']= $users['nickname'] . '@acmesec.fake';
do_srvsql('ids.acmesec.fake', 'snorby', 'athcon', 'athcon', "INSERT INTO users (email,encrypted_password) VALUES (:nickname,md5(:passwd))", $us);

// MAIL ACCOUNT
$CMD=sprintf('/etc/postfix/add_new_admin.sh "%s" "%s"', $users['nickname'],md5($users['passwd']));
do_ssh('mail.acmesec.fake',27622,$CMD);

//die();

try
{
    $sql= "UPDATE users SET created=1 WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(':id', $users['id']);
    $stmt->execute();
    syslog(LOG_INFO, sprintf("Updating user [%s]/[%d] created on all systems", $users['nickname'], $users['id']));
}
catch (PDOException $exception)
{
    syslog(LOG_INFO, "Exception: " . $exception->getMessage());
    die("\nException: " . $exception->getMessage());
}

/**
 * Post the user details on a server
 */
function post_data($post_data, $host, $port, $post)
{

    foreach ($post_data as $key => $value)
    {
        $post_items[]= $key . '=' . $value;
    }

    //create the final string to be posted using implode()
    $post_string= implode('&', $post_items);
    //we also need to add a question mark at the beginning of the string
    $post_string= '?' . $post_string;
    //we are going to need the length of the data string
    $data_length= strlen($post_string);
    //let's open the connection
    $connection= fsockopen($host, $port);
    //sending the data
    fputs($connection, "POST  $post  HTTP/1.1\r\n");
    fputs($connection, "Host:  $host \r\n");
    fputs($connection, "Content-Type: application/x-www-form-urlencoded\r\n");
    fputs($connection, "Content-Length: $data_length\r\n");
    fputs($connection, "Connection: close\r\n\r\n");
    fputs($connection, $post_string);
    //closing the connection
    fclose($connection);
}

function do_srvsql($host, $db, $user= 'root', $pass= '', $query, $params)
{

    try
    {
        $pdo= new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $pass, array (
            PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
    }
    catch (PDOException $exception)
    {
        printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
    }
    $pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);

    try
    {
        $stmt= $pdo->prepare($query);
        foreach ($params as $key => $val)
        {
            printf("Binding %s => %s\n", $key, $val);
            $stmt->bindValue($key, $val);
        }
        if (!$stmt->execute())
            die('error');
        syslog(LOG_INFO, "Added User to".$db."@".$host);
    }
    catch (PDOException $exception)
    {
        syslog(LOG_INFO, "Exception: " . $exception->getMessage());
        die("\nException: " . $exception->getMessage());
    }

}

function do_ssh($host,$port=22,$cmd)
{
    $connection= ssh2_connect($host, $port, array (
        'hostkey' => 'ssh-rsa'
    ));

    if (ssh2_auth_pubkey_file($connection, 'root', '/root/.ssh/id_rsa.pub', '/root/.ssh/id_rsa'))
    {
      syslog(LOG_INFO, "Public Key Authentication Successful on [$host]");
    }
    $stream= ssh2_exec($connection, $cmd);
}