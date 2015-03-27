<?php
if($_POST){
    include(ROOT_DIR."functions/report.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo $Template ?>storytelling/ext/storytelling.css">
</head>

<body>
	<div id="container">
	    <h1>打造干净环境，人人有责</h1>
    使用关键词来举报不良内容，关键词间请以空白键分开。所举报的关键词将交由管理员处理
    <br>
    <small style="color:#888">如果是****类的词也不好意思将就下.....</small>
		<form style="margin-top:50px" id="Postbox" method="post" action="?p=report" enctype="multipart/form-data">
			<textarea style="height:40vh" id="textInput" name="keywords" placeholder="reason to report this post..." 
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
			<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="chkPostingStatus()">
		</form>
	</div>
</body>
</html>