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
<?php include(__DIR__.'/head.php') ?>

<script id="initial">
    var profile=<?php $profile-> userInformation(); ?>;
    var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $studentno))[0] //get username?>";
</script>

</head>
<body>
<?php include(__DIR__.'/nav.php') ?>

<div id="container">
    <div id="user_information">
        <img id="profilepicture" src=""></img>
        <span class="name"></span>
        <span class="class"></span>
        <span class="birthday"></span>
        <div class="selfdescribe"></div>
    </div>
    <br>
    
    <div id="storytelling">
        <a href="?p=storytelling&studentno=<?php echo $studentno;?>">Ta的分享</a>
    </div>
    <div id="ask">
        <a href="?p=ask&studentno=<?php echo $studentno;?>">Ta的问题</a>
    </div>
</div>
</body>