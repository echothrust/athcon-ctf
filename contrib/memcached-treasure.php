<?php
$memcache_obj = memcache_connect("pbx.acmesec.fake", 11211);

/* procedural API */
memcache_replace($memcache_obj, 'easter_egg', 'f5cd8f35110b4735990cc7cd851777199f63ad4d', false, 0);

$var = memcache_get($memcache_obj, 'easter_egg');
var_dump($var);
?>
