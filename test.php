<?php
$string=".aaaaa去你";

//$regex = '/!|@|#|\$|%|\^|&|\*|\(|\)|_|\+|\||{|}|:|"|<|>|\?|-|=|\\|\[|\]|;|\'|,|\.|\//';

$regex='/[a-z\x{4e00}-\x{9fa5}]+/u';
//$regex="/[^!@#$%^&*()_+|{}:"<>?\-=\\[\];',.\/]+/";

//$string = preg_replace($regex,"\1", $string);
//string=preg_split($regex,$string);
preg_match($regex,$string,$string);
print_r($string);

?>