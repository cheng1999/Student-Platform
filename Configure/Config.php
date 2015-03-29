<?php
/*
    configure of php.ini you may change it in .htaccess
*/

//Database Config
$DB_SERVER="localhost";   //Database Server
$DB_NAME="village";     //Database Name
$DB_USER="root";        //Database User
$DB_PASS="";            //Database Password

$DB_CHAR="utf8";        //Database Charset

//admin control panel
$admin_hash=md5(md5("!2#4%6&8(0SuPeR PW"));// password must me strong ,if admin hacked, xss or get shell even

//html Layout Config
$Title="公教村";

$Template="themes/";     //the framework will auto load index.php from $Template


//salt for hash
$salt="HAsh741852963";

?>  
