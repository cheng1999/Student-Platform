<?php
    /*
    the file which is require this config is ROOT_DIR."functions/function.php" ||sorry to explain the path with code language XD
        forward to target page which is indicate in $_GET['p'] with 
            include file which have indicate and
            include the target
        maybe this will look like url
    
        ::example::
            domain.com/?p=home      :   go to home page ($Template."index.php")
            domain.com/?p=aboutus   :   go to about us
            
            ****if some variable in $_GET['p'] cannot use maybe it have been used, 
            to find the location of this variable, you may type this in terminal at 
            the web root path:
                grep -R "variable name"
    */

//逗号的排列是为了让我看了舒服的 B|
$indicated_Page=array(
    //request name: target web path
    
    //admin control panel (better change the path of admin control panel)
    'admin'         =>ROOT_DIR."admin/index.php"      ,
    
    //main tabs in nav
    'home'          =>ROOT_DIR.$Template."index.php"        ,
    'profile'       =>ROOT_DIR.$Template."profile.php"      ,
    'storytelling'  =>ROOT_DIR.$Template."storytelling/storytelling.php"  ,
    'ask'           =>ROOT_DIR.$Template."ask/ask.php"      ,//at the beginning we found out something, and we ask: why ?
    'classEventBook'=>ROOT_DIR.$Template.""                 ,//have not start this project yet
    'aboutus'       =>ROOT_DIR.$Template."aboutus.php"      ,
    
    //report
    'report'        =>ROOT_DIR.$Template."report.php"        ,
    
    //login
    'login'         =>ROOT_DIR.$Template."login.php"        ,
    'validlogin'    =>ROOT_DIR."functions/login_validator.php"      ,
    
    //profile
    'editprofile'   =>ROOT_DIR."functions/editprofile.php"          ,
    
    //notif
    'notif'         =>ROOT_DIR."functions/notification.php"         ,
    
    //storytelling
    'st_post'          =>ROOT_DIR."functions/storytelling/post.php"        ,
    'st_loadposts'     =>ROOT_DIR."functions/storytelling/loadposts.php"   ,
    'st_report'        =>ROOT_DIR."functions/storytelling/report.php"      ,
    
    //ask
    'ask_ask'       =>ROOT_DIR."functions/ask/ask.php"      ,
    'ask_load'      =>ROOT_DIR."functions/ask/load.php"     ,
    );
?>