<?php
if(!@mysql_connect("localhost", "root"))
        die("error while connect...");

//資料庫連線採UTF8
mysql_query("SET NAMES utf8");
if(!@mysql_select_db("village"))
        die("cannot use selected database");
?>  
