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

<link rel="stylesheet" href="<?php echo $Template ?>ext/css/profile.css">
<script id="initial">
    var profile=<?php $profile-> userInformation(); ?>;
</script>

</head>
<body>
<?php include(__DIR__.'/nav.php') ?>

<div id="container">
    <div id="user_information">
        <img src="" class="profilepic">
        <div class="vcard">
            <span class="name"></span>
            <span class="class" style=""></span>
        </div>
        <span class="birthday"></span>
        <div class="selfdescribe"></div>
        
        <script class="fill_information">
            $("#user_information .profilepic").attr("src","uploads/profile_pic_"+profile.studentno);
            $(".vcard .name").html(profile.username);
            $(".vcard .class").html("("+profile.class+")");
            $("#user_information .birthday").html((profile.birthday ? profile.birthday : "(haven't set yet)"));
            $("#user_information .selfdescribe").html((profile.selfdescribe ? profile.selfdescribe : "(none)"));
            
        </script>
        
    </div>
    
    <div id="storytelling">
        <a href="?p=storytelling&studentno=<?php echo $studentno;?>">Ta的分享</a>
    </div>
    <div id="ask">
        <a href="?p=ask&studentno=<?php echo $studentno;?>">Ta的问题</a>
    </div>
</div>
</body>