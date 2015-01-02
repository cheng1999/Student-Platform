<?php
session_start();
if(!$_SESSION['logged']){
    echo "you have not permission to access this page!";
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
<meta http-equiv="Content-Type"content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<title>village</title>
<link rel="stylesheet" href="../ext/css/storytelling.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
	<div id="container">
		<div id="left_con">
			<form id="commentbox" method="post" action="write.php">
            
				<textarea id="textInput" name="text" placeholder="Write a comment..." 
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)">
			</form>
			<div id="commentList">
			</div>
			<center><img src="../ext/image/loading.gif" id="loading"></img></center>
			
			<div id="hideCon">
				<div id=replyList></div>
					
					<div class="cmt">
                    <form id="commentbox" class="cmt" method="post" action="write.php">
	<!-----------------><input id="PostID" type="hidden" value="" name="PostID">
						<textarea id="textInput" name="text" placeholder="Write a comment..." 
						onkeydown="if(event.ctrlKey&&event.keyCode==13){
							this.parentNode.buttonSubmit.click();
							return false};
							"></textarea>
						<br>
						<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)">
					</form>
					</div>
				
			</div>
			
		</div>
		
		<div id="right_con">
			something here...
		</div>
	</div>


<script src="../ext/js/post.js"></script>
</body>
</html>
