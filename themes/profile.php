<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
    include(ROOT_DIR . 'functions/profile.class.php');
    $profile=new Profile();     //function from class above
    
    if(@$_GET['studentno']){
        $profile->studentno=$_GET['studentno'];
    }
    else{
        $profile->studentno=$_SESSION['studentno'];
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<?php include('head.php') ?>

</head>
<body>
<?php include('header.php') ?>

<div id="container">
    <div id="user information">
        <?php $profile->userInformation() ?>
    </div>
    <br>
    <div id="st_posted">
        <?php $profile->loadST_post() ?>
    </div>
</div>
</body>