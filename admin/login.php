<?php
if(@$_GET['logout']){
    session_destroy();
    exit();
}

if(@$_POST['hash']){
    if($admin_hash==$_POST['hash']){
        $_SESSION['admin_logged']=1;
    }
    else{
        echo "<script>alert('login failed')</script>";
    }
}

else{
    include ADMIN_PATH.'themes/login.php';
}

?>
