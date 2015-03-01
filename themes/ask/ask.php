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
<?php include($Template . 'head.php') ?>

<script class="loadpost">
var post=[],reply=[];
var totalposts=<?php echo mysql_fetch_row(mysql_query("select COUNT(*) from storytelling"))[0] //get total posts number from database ?>;
var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0] //get username?>";
</script>

</head>

<body>
<?php include($Template . 'header.php') ?>
	<div id="container">

			<form id="Postbox" method="post" action="?p=ask_ask" target="PostAction" enctype="multipart/form-data">
		    <input id="PostID" type="hidden" value="" name="PostID">
		        <span id="charlength">50 more words left until limited char</span>
				<textarea id="textInput" name="summary" height="50px" placeholder="Summary of your question...."  maxlength="50" style="height:50px;margin-bottom:20px;"
				onkeyup="$('#charlength').text((50-this.textLength)+' more words left until limited char');
					"></textarea>
					
				<textarea id="textInput" name="detail" placeholder="More details to your question...."
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="attachment" type="file" name="image"><br>
				
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Posting($(this))">
			</form>
			
			<?php include($Template . 'ask/content.php') ?>
</body>
</html>
