<?php
exit_if_no_logged();
$studentno=$_SESSION['studentno'];

$PostID = $_POST['PostID'];
$text   = $_POST['text'];
$plus1Target  = $_GET['PostID'];

//plus1
if($_GET['mode']==3){ //if user click "+1" <a> button the value 3 will send with mode,which means like this post
    if(!@mysql_query("INSERT IGNORE INTO storytelling_plus1 (primarykey,studentno,postid)VALUES($studentno$plus1Target,$studentno,$plus1Target)" ))
		die(mysql_error ());
    exit();
}

/*
 *posting status or reply data process and insert into database
 * -----------------------check and fix some requirement for comment-----------------------
 */
//filtering the input

$text=addslashes(htmlspecialchars($text));
// PostID is the id of Post to reply
// but if PostID==1 that means this is comment.
$PostID=intval($PostID);
if (trim($text)==""){
}

/*
 * -----------------------the requirement is passed, edit text and fill date----------------
 */
else{
    $change = array("\n", "\r\n", "\r");
    $text = str_replace($change, '<br>', $text);
    $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
    
    
/*
 * -----------------------insert into sql---------------------------------------------------
 */
	//post	($PostID==1)
	if($PostID==0){
		if(!@mysql_query("INSERT INTO storytelling (studentno, text , time)VALUES( '$studentno', '$text', '$time')"))
			die( mysql_error ());
	}
	
	//reply		(PostID!=1 && PostID is the id of post to reply)
	else{
		if(!@mysql_query("INSERT INTO storytelling_reply (id, studentno, text , time)VALUES( $PostID, '$studentno', '$text', '$time')"))
			die( mysql_error ());
	}
}
?>
<script>window.location.href='?p=storytelling'</script>