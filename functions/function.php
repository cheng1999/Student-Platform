<?php

/*loading some functions to ready for service*/

//connecting to database
include(ROOT_DIR."functions/sql.php");

//cookie session's validator and some similar functions
include(ROOT_DIR."functions/session.php"); 


//loading homepage if $_GET require nothing
if (count($_GET)==0){
    include(ROOT_DIR.$Template."index.php"); 
    exit();
}

/*function loader*/

    /*
        forward to target page which is indicate in $_GET['p'] with 
            include file which have indicate and
            include the target
        maybe this will look like url
    
        ::example::
            domain.com/?p=home      :   go to home page
            domain.com/?p=aboutus   :   go to about us
    */
if($_GET['p']!=null){

    //the file containing the target which is $_GET['p'] indicate for
    include(ROOT_DIR."Configure/PageVar.php");
    
    //target page
    include $indicatedPage[$_GET['p']];
}
else{
    print_r($_GET);
    //exit();
}



?>