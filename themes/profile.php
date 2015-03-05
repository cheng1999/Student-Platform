<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
    
    include(ROOT_DIR . 'functions/profile.class.php');
    $profile=new Profile();     //function from class above
    
    if(@$_GET['studentno']){
        $studentno = $_GET['studentno'];
    }
    else{
        $studentno = $_SESSION['studentno'];
    }
    
    $profile->studentno=$studentno;
?>

<!DOCTYPE HTML>
<html>
<head>
<?php include('head.php') ?>

</head>
<body>
<?php include('nav.php') ?>

<div id="container">
    <div id="user information">
        <script id="initial">
        var profile=[];
        eval("<?php $profile-> userInformation(); ?>");
        var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $studentno))[0] //get username?>";
        </script>
    </div>
    <br>
    <div id="storytelling">
        <a href="?p=storytelling&studentno=<?php echo $studentno;?>">Ta的分享</a>
    </div>
</div>
</body>