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
    
    //main sidebar's tabs
    'home'          =>$Template."index.php"         ,
    'profile'       =>$Template."profile.php"       ,
    'storytelling'  =>$Template."storytelling/storytelling.php"  ,
    'ask'           =>$Template.""                  ,//have not start this project yet  //at the beginning we found out something, and we ask: why ?
    'classEventBook'=>$Template.""                  ,//have not start this project yet
    'aboutus'       =>$Template."aboutus.php"       ,
    
    //login
    'login'         =>$Template."login.php"         ,
    'validlogin'    =>ROOT_DIR."functions/login_validator.php"      ,
    
    //storytelling
    'st_post'          =>ROOT_DIR."functions/storytelling/post.php"        ,
    'st_loadposts'     =>ROOT_DIR."functions/storytelling/loadposts.php"   ,
    'st_report'        =>ROOT_DIR."functions/storytelling/report.php"      ,
    );
?>