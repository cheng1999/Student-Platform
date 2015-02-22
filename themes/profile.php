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
        <script>var profile=[];
        eval("<?php $profile-> studentno = $studentno;$profile-> userInformation(); ?>");
        var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0] //get username?>";
        </script>
    </div>
    <br>
    <div id="storytelling">
    
    <script class="loadpost">
        var post=[],reply=[];   //ready for server give them the data of posts, the data will set by storytelling.js with eval()
        var loadpost_url="?p=profile";
        var totalposts= <?php echo mysql_fetch_row(mysql_query("select COUNT(*) from storytelling where studentno=$studentno"))[0] //get total posts number from database ?>;
        </script>
        
        <?php
            include($Template . 'storytelling/content.php');
        ?>
    </div>
</div>
</body>