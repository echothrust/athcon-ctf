#!/usr/local/bin/php
<?php

//# tcpdump -teqnl -i em4 pattern|php tcpdump2sql.php
function my_ip2long($ip)
{
    return sprintf("%u", ip2long($ip));
}

try
{
    $pdo= new PDO('mysql:host=localhost;dbname=athcon', 'root', '', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);
$QUERY= "INSERT DELAYED INTO tcpdump (srchw,dsthw, `size`, proto, srcip, dstip, dstport) VALUES (:srchw, :dsthw, :size, :proto, INET_ATON(:srcip), INET_ATON(:dstip), :dstport)";
$stmt= $pdo->prepare($QUERY);

function _do_packet_log($srchw, $dsthw, $size, $proto, $srcip, $dstip, $dstport)
{
    global $pdo, $stmt;
    try
    {

        /* create a prepared statement */

        /* bind the Valueeter */
        $stmt->bindValue(':srchw', $srchw);
        $stmt->bindValue(':dsthw', $dsthw);
        $stmt->bindValue(':size', intval($size));
        $stmt->bindValue(':proto', $proto);
        $stmt->bindValue(':srcip', $srcip);
        $stmt->bindValue(':dstip', $dstip);
        $stmt->bindValue(':dstport', intval($dstport));
        /* execute the SQL */
        $stmt->execute();
        //printf("%s(%s) -> %s %s:%d (%d)\n",$srcip,$srchw,$proto,$dstip,$dstport,$size);
    }
    catch (PDOException $exception)
    {
        global $line;
        printf("%s\n", $line);
        printf("%s(%s) -> %s %s:%d (%d)\n", $srcip, $srchw, $proto, $dstip, $dstport, $size);
    }
}
while (true)
    while (($line= fgets(STDIN)) != false)
    {

        $lparts= explode(' ', trim($line));
        $srchw= $lparts[0];
        $direction=$lparts[1];
        $dsthw= str_replace(',', '', $lparts[2]);
        
        $size= intval($lparts[5]);
        
        $srcipmix= trim($lparts[6]);
        $dstipmix= substr($lparts[8], 0, -1);
        $proto= trim($lparts[9]);
        preg_match("/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/", $srcipmix, $matches);
        $srcip= trim(@ $matches[0]);
        unset ($matches);
        preg_match("/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/", $dstipmix, $matches);
        $dstip= trim(@ $matches[0]);
        $dstport= substr($dstipmix, strlen($dstip) + 1);
        unset ($matches);
        _do_packet_log($srchw, $dsthw, $size, $proto, $srcip, $dstip, $dstport);
    }