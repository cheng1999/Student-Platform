<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
    
    //detemine the vars' values for client require
    if(@$_GET['studentno']){
        $load_url = "?p=ask_load&mode=1&studentno=".intval($_GET['studentno']);
        $totalquestions = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ask_question WHERE studentno=".intval($_GET['studentno'])))[0];
        $detail = 0;
    }
    else if(@$_GET['questionid']){
        $load_url = "?p=ask_load&mode=2&questionid=".intval($_GET['questionid']);
        $totalquestions = 1;
        $detail = 1;
    }
    else if(@$_GET['tag']){
        $load_url = "?p=ask_load&mode=1&tag=".addslashes($_GET['tag']);
        $totalquestions = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ask_question WHERE summary LIKE \"%#".addslashes($_GET['tag'])."%\""))[0];
        $detail = 0;
    }
    else{
        $load_url = "?p=ask_load&mode=1";
        $totalquestions = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ask_question"))[0];
        $detail = 0;
    }
    
    $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0];//get username
?>

<!DOCTYPE HTML>
<html>
<head>
<?php include(ROOT_DIR.$Template . 'head.php') ?>

<script class="initial">
var questions=[],answers=[],discusses=[];
var questionid = "<?php echo @$_GET['questionid'] ?>"
var load_url = "<?php echo $load_url ?>";
var totalquestions = <?php echo $totalquestions ?>;
var detail = <?php echo $detail ?> //the boolean to tell javascript load summary or detail
var username = "<?php echo $username ?>";
</script>

</head>

<body>
<?php include(ROOT_DIR.$Template . 'nav.php') ?>
<div id="container">
		
<?php

//if not search a person post or just load an indecate post, will not load useless post form
if(@$_GET['studentno']||@$_GET['questionid']){}
else{
    include(__DIR__.'/askform.php');
}

include(__DIR__.'/content.php');
?>

</body>
</html>
