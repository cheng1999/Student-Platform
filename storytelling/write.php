<?php
session_start();
if(!$_SESSION['logged']){
    echo "you have not permission to access this page!";
    exit();
}

include("../sql.php");
extract($_POST);



/*
 * -----------------------check and fix some requirement for comment-----------------------
 */
//filtering the input
$studentno=$_SESSION['studentno'];
$text=addslashes(htmlspecialchars($text));

// PostID is the id of Post to reply (abbreviation of 'Comment id' 
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
		if(!@mysql_query("INSERT INTO storytelling2 (id, studentno, text , time)VALUES( $PostID, '$studentno', '$text', '$time')"))
			die( mysql_error ());
	}
}
?>
<script>window.location.href='./'</script>