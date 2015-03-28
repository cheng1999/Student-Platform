<?php
define("ADMIN_PATH",__DIR__."/");

if(@$_SESSION['admin_logged']){
    include(ADMIN_PATH.'themes/index.php');
}
else{
    include(ADMIN_PATH.'login.php');
    exit();
}

?>