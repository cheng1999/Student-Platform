<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
?>

<!--
----
reference:
	freebuf.com,
	sarawakmethodist.org
----
programmer:Lee Guo Cheng
	facebook:fb.com/detective1999
----
-->

<!DOCTYPE HTML>
<html>
<head>
<?php include('head.php') ?>
<link rel="stylesheet" href="<?php echo $Template ?>ext/css/storytelling.css">

<script class="loadpost">
var post=[],reply=[];
var totalposts=<?php echo mysql_fetch_row(mysql_query("select COUNT(*) from storytelling"))[0] //get total posts number from database ?>;
</script>

</head>

<body>
<?php include('header.php') ?>
	<div id="container">

			<form id="Postbox" method="post" action="?p=st_post" target="PostAction" enctype="multipart/form-data">
		    <input id="PostID" type="hidden" value="" name="PostID">
				<textarea id="textInput" name="text" placeholder="share somethings to school..." 
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="attachment" type="file" name="image"><br>
				
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="chkPostingStatus()">
			</form>
			<iframe id="PostAction" name="PostAction" style="display:none" src="?p=st_post" ></iframe>
			<div id="PostList">
			</div>
			<center id="loadstatus" style="color:#4D4D4D;font-weight:bold;"><img src="<?php echo $Template?>ext/image/loading.gif" id="loading"></img></center>
			
			<div id="hideCon">
				<div id=replyList></div>
					
					<div class="cmt">
                    <form id="Postbox" class="cmt" method="post" target="PostAction" action="?p=st_post">
	<!-----------------><input id="PostID" type="hidden" value="" name="PostID">
						<textarea id="textInput" name="text" placeholder="Write a comment..." 
						onkeydown="if(event.ctrlKey&&event.keyCode==13){
							this.parentNode.buttonSubmit.click();
							return false};
							"></textarea>
						<br>
						<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="chkPostingStatus()">
					</form>
				</div>
			</div>
	</div>


<script src="<?php echo $Template ?>ext/js/storytelling.js"></script>
</body>
</html>
