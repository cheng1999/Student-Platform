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
<a class="btn" onclick="$('.profile_form').show();$(this).remove()" style="float:right"> Edit profile</a>
    <div id="user_information">
        <img src="" class="profilepic"></img>
        <div class="vcard">
            <span class="name"></span>
            <span class="class" style=""></span>
        </div>
        <span class="birthday"></span>
        <div class="selfdescribe"></div>
    </div>
    
<script src="<?php echo $Template ?>ext/js/md5.js"></script>
<form enctype="multipart/form-data" action="?p=editprofile" method="post" onsubmit="return changehash(this)" class="profile_form" style="display:none">
    <div class="form-part">
        <label class="input_label">Profile picture</label>
        <img class="form-profile-img" scr="">
        <span class="upload_btn" >Upload picture<input type="file" name="image" class="upload_input"></span>
    </div>
    <div class="form-part">
        <label class="input_label">Username</label>
        <input maxlength="50" placeholder="username" name="username">
    </div>
    <div class="form-part">
        <label class="input_label">Self describe</label>
        <textarea placeholder="short text to describe your self" name="selfdescribe" id="textInput"></textarea>
    </div>
    <div class="form-part">
        <label class="input_label">Password</label>
        <a class="btn" style="float:left" onclick="$('.setpassword').show();$(this).remove()">Set password</a>
        <div style="display:none" class="setpassword">
            <input type="password" name="current_pw" placeholder="Current password">
            <input type="password" name="first_pw" placeholder="New password">
            <input type="password" name="second_pw" placeholder="Reenter your new password">
	    </div>
    </div>

    <input type="submit" onclick="Posting($(this))" value="Update profile" class="btn" style="width:500px;margin-top:20px">
</form>

    <div id="storytelling">
        <a href="?p=storytelling&studentno=<?php echo $studentno;?>">Ta的分享</a>
    </div>
    <div id="ask">
        <a href="?p=ask&studentno=<?php echo $studentno;?>">Ta的问题</a>
    </div>
</div>

<script class="profile script">
        //load profile imformation
            $("#user_information .profilepic").attr("src","uploads/profile_pic_"+profile.studentno);
            $(".vcard .name").html(profile.username);
            $(".vcard .class").html("("+profile.class+")");
            $("#user_information .birthday").html((profile.birthday ? profile.birthday : "(haven't set yet)"));
            $("#user_information .selfdescribe").html((profile.selfdescribe ? profile.selfdescribe : "(none)"));
            
        //edit profile
            if(studentno!=profile.studentno){
                $(".editprofile_btn").remove();
            }
            else{
                $(".profile_form .form-profile-img").attr("src","uploads/profile_pic_"+profile.studentno);
            
                form=document.forms[0];
                form.username.value = profile.username;
                form.selfdescribe.value = profile.selfdescribe;
            }
            
</script>
</body>