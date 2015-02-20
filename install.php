<?php
include('Configure/Config.php');

//connect to database
if(!@mysql_connect("$DB_SERVER", "$DB_USER","$DB_PASS"))
    die("error while connect...");
mysql_query("SET NAMES $DB_CHAR");
if(!@mysql_select_db("$DB_NAME"))
        die("cannot use selected database");

$query ="create table profile (studentno int(7) not null,username varchar(45) not null,hash text not null,class varchar(3) not null,self text,birthday varchar(21));".
        "create table storytelling (id int(11) not null auto_increment primary key,studentno int(7) not null,text text not null,time varchar(21) not null, imageid int(11));".
        "create table storytelling_reply (parentid int(11) not null,studentno int(7) not null,text text not null,time varchar(21)not null);".
        "create table storytelling_plus1 (primarykey int(19) not null primary key, studentno int(7) not null,postid int(11) not null);".
        "create table storytelling_report (postid int(11) not null,studentno int(7) not null,text text not null,time varchar(21)not null);";
        
mysql_query($query) or die (mysql_error());
echo "StudentPlatform seems installed success !<br>but make sure you did give the full permission of StudentPlatform to access 'uploads' folder in root diretory";

?>