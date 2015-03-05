<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
    
    //detemine the vars' values for client require
    if(@$_GET['studentno']){
        $load_url = "?p=st_loadposts&studentno=".intval($_GET['studentno']);
        $totalposts = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling WHERE studentno=".intval($_GET['studentno'])))[0];
        
    }
    else if(@$_GET['postid']){
        $load_url = "?p=st_loadposts&postid=".intval($_GET['postid']);
        $totalposts = 1;
    }
    else{
        $load_url = "?p=st_loadposts";
        $totalposts = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling"))[0];
    }
    $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0];//get username
?>


<!DOCTYPE HTML>
<html>
<head>
<?php include($Template . 'head.php') ?>

<script class="initial">
var post=[],reply=[];
var load_url = <?php echo "\"".$load_url."\"" ?>;
var totalposts = <?php echo $totalposts ?>;
var username = "<?php echo $username ?>";
</script>
</head>
<body>
<?php include($Template . 'nav.php');?>
<div id="container">

<?php

//if not search a person post or just load an indecate post, will not load useless post form
if(@$_GET['studentno']||@$_GET['postid']){}
else{
    include("postform.php");
}

include($Template . 'storytelling/content.php');
?>

</div>
</body>
</html>
