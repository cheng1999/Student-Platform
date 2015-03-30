<?php
$totalnotices = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM noticeboard"))[0];
$load_url = "?p=loadnotice";
?>

<!DOCTYPE HTML>
<html>
<head>
<?php include(__DIR__."/head.php") ?>
</head>

<body>
<?php include(__DIR__."/nav.php"); ?>

<script id="initial">
    var notice=[];
    var totalnotices = <?php echo $totalnotices ?>;
    var load_url = <?php echo $load_url ?>;
</script>

<div id="container">
    <b><h1>通告</h1></b>
    <div id="PostList">
    </div>
</div>

<div id="hideCon" style="display:none">

    <div id="notice-content">
        <div id="notice">
            <span id="notice-title"></span>
            <span id="notice-time"></span>
            <div id="notice-content"></div>
            <img id="notice-img"></img>
        </div>
    </div>
    
    <div id="loadstatus">
        <center id="loading"><img src="<?php echo $Template?>ask/ext/loading.gif" id="loading"></img></center>
        <center id="nomore">No More</center>
    </div>
    
</div>

</body>
</html>
