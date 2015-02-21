<?php
$hash="698d51a19d8a121ce581499d7b701668";
$salt="HAsh741852963";
$salted =md5($salt.$hash.$salt);
echo $salted;
?>