<?php
    if(!checklogin()){
        login_before_access();
        exit();
    }
?>

<!DOCTYPE HTML>
<html>
<head>

<?php include($Template . 'head.php') ?>
<link rel="stylesheet" href="<?php echo $Template ?>storytelling/ext/storytelling.css">

<script class="loadpost">
var post=[],reply=[];   //ready for server give them the data of posts, the data will set by storytelling.js with eval()
var totalposts= <?php echo mysql_fetch_row(mysql_query("select COUNT(*) from storytelling"))[0] //get total posts number from database ?>;
</script>

</head>

<body>

<?php include($Template . 'header.php') ?>

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
			
            <?php include($Template . 'storytelling/content.php') ?>
            
	</div>
</body>
</html>
