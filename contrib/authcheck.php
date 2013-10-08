<?php
$connection= ssh2_connect('172.16.11.18', 22, array (
    'hostkey' => 'ssh-rsa'
));

if (ssh2_auth_pubkey_file($connection, 'root', '/var/www/htdocs/id_rsa.pub', '/var/www/htdocs/id_rsa'))
{
    echo "Public Key Authentication Successful\n";
}
else
{
    die('Public Key Authentication Failed');
}
$txt= substr($userType, 0, 3) . "|$macAddr\n";
$stream= ssh2_exec($connection, "echo \"$txt\">/tmp/test123");