<?php
if(!checklogin()){
    exit();
}

$studentno=$_SESSION['studentno'];
@$mode=intval($_GET['mode']);//the indecate ask , answer , agree answer , or just view
@$questionID =intval($_GET['questionID']);

//initail the variable
@$summary   = $_POST['summary'];//the summary of question
@$detail   = $_POST['detail'];//detail to the question
@$image = $_FILES['image'];//image to let asker ask in easy way


if($mode==1){  //ask question

/*
 *ask question data process and insert into database
 * -----------------------check and fix some requirement-----------------------
 */

//filtering the input
$summary=addslashes(htmlspecialchars($summary));
$detail=addslashes(htmlspecialchars($detail));

    if (trim($summary)==""||str_word_count($summary)>50){
        echo '<script>alert('.str_word_count($summary).')</script>';
        exit();
    }

/*
 * -----------------------the requirement is passed, edit text and fill date----------------
 */
    else{
        
        $change = array("\n", "\r\n", "\r");
        $summary = str_replace($change, '<br>', $summary);    //change enter <br>
        
        $link_regex='/((http|https)+\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.\/_:@=.+?,##%&~-]*[^.|\'|\# |!|\(|?|,| |>|<|;|\)])/';
        $detail=preg_replace($link_regex,'<a href="$1">$1</a>', $detail);  //if have link detect in regex, make href
        
        $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
        
    /*
     * -----------------------insert into sql---------------------------------------------------
     */
        if(is_uploaded_file($image['tmp_name'])){//if have image
            $imageid=mysql_fetch_row(mysql_query("SELECT MAX(imageid) FROM ask_question"))[0]+1;//the imageid to insert must lager that the max imageid in database to prevent no used id will reuse

            include('processimg.php');//process uploaded image
            if(!@mysql_query("INSERT INTO ask_question (studentno, summary , detail , time , imageid)VALUES( $studentno, '$summary', '$detail', '$time', $imageid)"));//write into database with image data
                die("<script>alert('".mysql_error()."')</script>");
        }
        else{//not image
            if(!@mysql_query("INSERT INTO ask_question (studentno, summary , detail , time)VALUES( $studentno, '$summary', '$detail', '$time')"))
                die("<script>alert('".mysql_error()."')</script>");
        }
    }
}
    
/*
 *if not ask question
 */
    if ($mode==2){ //answer question
	//answer		(questionID!=0 && questionID is the id of question to answer)
		if(!@mysql_query("INSERT INTO ask_answer (questionid, id ,studentno, answer , time)VALUES( $questionID, $studentno, '$text', '$time')"))
            die( mysql_error ());
        }
        
    else if($mode==3){ //if user click agree answer
        mysql_query("INSERT IGNORE INTO storytelling_plus1 (primarykey,studentno,postid)VALUES($studentno$plus1Target,$studentno,$plus1Target)");
        exit();
    }
    else{
        exit();
    }
    

?>