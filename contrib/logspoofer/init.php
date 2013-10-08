<?php
try
{
    $pdo= new PDO('mysql:host=10.172.16.1;dbname=echofish', 'athcon', 'athcon', array (
        PDO :: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
}
catch (PDOException $exception)
{
    printf("Failed to connect to the  database, please notify the judges. Error: %s", $exception->getMessage());
}
$pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO :: ATTR_AUTOCOMMIT, true);
$stmt= $pdo->prepare($QUERY);

$REQUESTS= array (
    'requests/www.acmesec.fake_feng.log' => '172.0.0.4',
    'requests/www.acmesec.fake_webmail.log' => '172.0.0.4',
    'requests/www.acmesec.fake_.log' => '172.0.0.4',
    'requests/pbx.acmesec.fake_.log' => '172.0.0.3',
    'requests/lamp.acmesec.fake_.log' => '192.0.0.2',
    'requests/lamp.acmesec.fake_joomla.log' => '192.0.0.2',
    'requests/lamp.acmesec.fake_phpBB.log' => '192.0.0.2',
    'requests/lamp.acmesec.fake_pixie.log' => '192.0.0.2',
    'requests/lamp.acmesec.fake_phpcollab.log' => '192.0.0.2',
);

$BROWSERS= array('"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.162 Safari/535.19"',
'"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0"',
'"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)"',
'"Mozilla/5.0 (iPhone; CPU iPhone OS 5_0_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A405 Safari/7534.48.3"',
'"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en; rv:1.9.0.19) Gecko/2011032020 Camino/2.0.7 (like Firefox/3.0.19)"',
'"Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en; rv:1.8.1.14) Gecko/20080409 Camino/1.6 (like Firefox/2.0.0.14)"',
'"Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en; rv:1.8.1.6) Gecko/20070809 Camino/1.5.1"',
'"Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-US; rv:1.8.0.1) Gecko/20060118 Camino/1.0b2+"',
'"Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.5b) Gecko/20030917 Camino/0.7+"',
'"Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en-US; rv:1.0.1) Gecko/20021104 Chimera/0.6"',
'"Dillo/2.2"',
'"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.152 Safari/535.19"',
'"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11"',
'"Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.66 Safari/535.11"',
'"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.0 Safari/535.11"',
'"Mozilla/4.0 (compatible; Dillo 2.2)"',
'"Dillo/0.8.6"',
'"ELinks/0.12~pre2.dfsg0-1ubuntu1-lite (textmode; Debian; Linux 2.6.32-4-jolicloud i686; 143x37-2)"',
'"ELinks/0.12pre5.GIT (textmode; CYGWIN_NT-6.1 1.7.1(0.218/5/3) i686; 80x24-2)"',
'"Explanation: ELinks-lite 0.12pre5 under CYWIN on Windows 7 (honest). String from Jake Wasdin - thanks."',
'"ELinks/0.11.3-5ubuntu2-lite (textmode; Debian; Linux 2.6.24-19-generic i686; 126x37-2)"',
'"ELinks/0.11.4-2 (textmode; Debian; GNU/kFreeBSD 6.3-1-486 i686; 141x21-2)"',
'"Dillo/2.0"',
'"ELinks (0.4.3; NetBSD 3.0.2_PATCH sparc64; 141x19)"',
'"Mozilla/5.0 (X11; U; Linux i686; en-us) AppleWebKit/531.2+ (KHTML, like Gecko) Safari/531.2+ Epiphany/2.29.5"',
'"Mozilla/5.0 (X11; U; Linux i686; en; rv:1.9.0.11) Gecko/20080528 Epiphany/2.22 Firefox/3.0"',
'"Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/420+ (KHTML, like Gecko)"',
'"Mozilla/5.0 (X11; U; Linux x86_64; c) AppleWebKit/525.1+ (KHTML, like Gecko, Safari/525.1+) epiphany"',
'"Mozilla/5.0 (X11; U; OpenBSD i386; en-US; rv:1.8.1.19) Gecko/20090701 Galeon/2.0.7"',
'"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.13) Gecko/20080208 Galeon/2.0.4 (2008.1) Firefox/2.0.0.13"',
'"Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.8.1.4) Gecko/20061201 Galeon/2.0.2 (Ubuntu package 2.0.2-4ubuntu1)"',
'"Mozilla/5.0 (X11; U; FreeBSD i386; en-US; rv:1.7.12) Gecko/20051105 Galeon/1.3.21"',
'"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.7.3) Gecko/20040913 Galeon/1.3.18"',
'"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.7.3) Gecko/20041007 Galeon/1.3.17 (Debian package 1.3.17-2)"',
'"Mozilla/5.0 (X11; U; FreeBSD i386; en-US; rv:1.6) Gecko/20040406 Galeon/1.3.15"',
'"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.6) Gecko/20040115 Galeon/1.3.12"',
'"Mozilla/5.0 (X11; U; Linux i686) Gecko/20030422 Galeon/1.3.4"',
'"Mozilla/5.0 Galeon/1.2.0 (X11; Linux i686; U;) Gecko/20020326"'
);