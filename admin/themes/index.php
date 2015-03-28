<html>

<head>
    <?php include(__DIR__."/head.php") ?>
</head>

<body>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo $Template ?>storytelling/ext/storytelling.css">
<link rel="stylesheet" href="<?php echo $Template ?>ext/css/css.css">
</head>

<body>
	<div id="container">
		<form style="margin-top:50px" id="Postbox" method="post" action="?p=report" enctype="multipart/form-data">
		<h1 style="margin-bottom:20px">公告：</h1>
		    
		    Title:
			<textarea style="height:5vh" id="textInput" name="title"
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
				
			Content:
			<textarea style="height:40vh" id="textInput" name="Content"
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
			<span class="upload_btn" >Upload picture<input type="file" name="image" class="upload_input"></span>
			<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="chkPostingStatus()">
		</form>
	</div>
</body>
</html>
