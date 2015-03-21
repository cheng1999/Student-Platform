<?php
if(!checklogin()){
    exit();
}

$studentno=$_SESSION['studentno'];
@$PostID = $_POST['PostID'];
@$text   = $_POST['text'];
@$plus1Target  = $_GET['PostID']; //in some condition this will null

//@$image = $_FILES['image'];

//plus1
//intval() to prevent blind sql injection
if(@intval($_GET['mode'])==3){ //if user click "+1" <a> button the value 3 will send with mode,which means like this post
    mysql_query("INSERT IGNORE INTO storytelling_plus1 (primarykey,studentno,postid)VALUES($studentno$plus1Target,$studentno,$plus1Target)");
    
    $poster = mysql_fetch_row(mysql_query("SELECT studentno FROM storytelling WHERE id=$PostID"))[0];
	if($studentno!==$poster){
    		notify($poster,"a person plus 1 to your post !","?p=storytelling&postid=$PostID");
    		exit();
	}
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
    $text = str_replace($change, '<br>', $text);    //change enter <br>
    
    $link_regex='/((http|https)+\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.\/_:@=.+?,##%&~-]*[^.|\'|\# |!|\(|?|,| |>|<|;|\)])/';
    $text=preg_replace($link_regex,'<a href="$1">$1</a>', $text);  //if have link detect in regex, make href
    
    $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
    
/*
 * -----------------------insert into sql---------------------------------------------------
 */
	//post
	if($PostID==0){
	    $anonymous=(@$_GET['mode']=='anonymous'?1:0); //if user choose anonymous to post
	    
	    if(is_uploaded_file(@$_FILES['image']['tmp_name'])){//if have image
	        $imageid=mysql_fetch_row(mysql_query("SELECT MAX(imageid) FROM storytelling"))[0]+1;//the imageid to insert must lager that the max imageid in database to prevent no used id will reuse
	        
	        processimage($_FILES['image'] , "st_".$imageid);//process uploaded image function in ROOT_DIR functions/functions.php
	        if(!@mysql_query("INSERT INTO storytelling (studentno, text , time , imageid, anonymous)VALUES( $studentno, '$text', '$time',$imageid,$anonymous)"))//write into database with image data
			    die( mysql_error ());
	    }
	    else{//not image
	     //write into database
		    if(!@mysql_query("INSERT INTO storytelling (studentno, text , time,anonymous)VALUES( $studentno, '$text', '$time',$anonymous)"))
			    die( mysql_error ());
	    }
	}
	
	//reply		(PostID!=0 && PostID is the id of post to reply)
	else{
		if(!@mysql_query("INSERT INTO storytelling_reply (parentid, studentno, text , time)VALUES( $PostID, $studentno, '$text', '$time')"))
			die( mysql_error ());
		
    	$poster = mysql_fetch_row(mysql_query("SELECT studentno FROM storytelling WHERE id=$PostID"))[0];
		if($studentno!=$poster){
   			notify($poster,"Someone replied your post !","?p=storytelling&postid=$PostID");
		}
	}
}
?>
