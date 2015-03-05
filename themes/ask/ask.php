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
var questions=[];
var totalquestions=<?php echo mysql_fetch_row(mysql_query("select COUNT(*) from ask_question"))[0]; //get total posts number from database ?>;
var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0]; //get username?>";
</script>

</head>

<body>
<?php include($Template . 'nav.php') ?>
	<div id="container">

			<form id="Postbox" method="post" action="?p=ask_ask&mode=1" target="PostAction" enctype="multipart/form-data">
		    <input id="questionID" type="hidden" value="" name="PostID">
		        <span style="background:#eee;color:#999">可使用标签:{ #课外 | #物理 #化学 #生物 | #数学 #高数 #地理 #历史 #电子 | #华文 #国文 #英文 | #经济 #商业 #簿记 | #电脑 #美术}</span>
		        <br><br>
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
