<?php
define("ADMIN_PATH",__DIR__."/");

if(!@$_SESSION['admin_logged']){
    include(ADMIN_PATH.'login.php');
    exit();
}
if(@$_GET['logout']){
    session_destroy();
    exit();
}
else{
    include(ADMIN_PATH.'admin.class.php');
    $admin = new Admin();
    
    if(@$_POST['notice_title']){
        $admin->postnotice();
    }

    include(ADMIN_PATH.'themes/index.php');
}

?>