<?php
if(@$_POST['hash']){
    if($admin_hash==$_POST['hash']){
        $_SESSION['admin_logged']=1;
        header("Location:");//refresh
    }
    else{
        echo "<script>alert('login failed')</script>";
    }
}

else{
    include ADMIN_PATH.'themes/login.php';
}

?>
