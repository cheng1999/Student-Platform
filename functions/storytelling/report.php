<?php
if(!checklogin()){
    exit();
}

if($_POST){ //if user did input
    $studentno=$_SESSION['studentno'];
    $PostID = (@$_GET['PostID'] ? $_GET['PostID'] : $_POST['PostID']);   // if get is null then get post
    $text   = $_POST['text'];
    
    //filter
    $text=addslashes(htmlspecialchars($text));
    // PostID is the id of Post to reply
    // but if PostID==1 that means this is comment.
    $PostID=intval($PostID);
    
    $change = array("\n", "\r\n", "\r");
    $text = str_replace($change, '<br>', $text);
    $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
    
    
    //write into sql
    if(!@mysql_query("INSERT INTO storytelling_report (postid, studentno, text , time)VALUES( $PostID, $studentno, '$text', '$time')"))
        die( mysql_error ());
    echo "<script>alert(\"report success! Thanks for your report.\");";
    echo "window.location.href=\"?p=storytelling\"</script>";
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo $Template ?>ext/css/storytelling.css">
</head>

<body>
	<div id="container">
			<form id="Postbox" method="post" action="?p=st_report" enctype="multipart/form-data">
		    <input id="PostID" type="hidden" value="<?php echo $_GET['PostID'] ?>" name="PostID">
				<textarea id="textInput" name="text" placeholder="reason to report this post..." 
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="chkPostingStatus()">
			</form>
	</div>
</body>
</html>