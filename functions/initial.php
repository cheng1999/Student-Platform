<?php
//initial functions
include(ROOT_DIR."functions/functions.php");


//start session(cookies)
session_start();


//connnect sql
if(!@mysql_connect("$DB_SERVER", "$DB_USER","$DB_PASS"))
        die("error while connect...");
mysql_query("SET NAMES $DB_CHAR");
if(!@mysql_select_db("$DB_NAME"))
        die("cannot use selected database");


//page loader & nav
    /*
        forward to target page which is indicate in $_GET['p'] with 
            include file which have indicate and
            include the target
        maybe this will look like url
    
        ::example::
            domain.com/?p=home      :   go to home page
            domain.com/?p=aboutus   :   go to about us
    */
include(ROOT_DIR."Configure/PageVar.php");
if(@$indicated_Page[$_GET['p']]){
    //the file containing the target which is $_GET['p'] indicate for
    
    include($indicated_Page[$_GET['p']]);//include target page
}
else{//loading homepage if $_GET require nothing
    include(ROOT_DIR.$Template."index.php"); 
}



?>