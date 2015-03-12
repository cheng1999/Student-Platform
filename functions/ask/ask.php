<?php
if(!checklogin()){
    exit();
}

$studentno=$_SESSION['studentno'];
@$mode=intval($_GET['mode']);//the indecate ask , answer , agree answer , or just view

//@$image = $_FILES['image'];//image to let asker ask in easy way and liberal answer in easy way
$time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am

if($mode==1){  //ask question
/*
 *ask question data process and insert into database
 * -----------------------check and fix some requirement-----------------------
 */
 
//initail the variable
@$summary   = $_POST['summary'];//the summary of question
@$detail   = $_POST['detail'];//detail to the question
//@$questionid =intval($_GET['questionid']);

//filtering the input
$summary=addslashes(htmlspecialchars($summary));
$detail=addslashes(htmlspecialchars($detail));

    if (trim($summary)==""||str_word_count($summary)>50){
        exit();
    }

/*
 * -----------------------the requirement is passed, edit text and fill date----------------
 */
    else{
        $summary = nl2br($summary);    //change enter to <br>
        
        $link_regex='/((http|https)+\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.\/_:@=.+?,##%&~-]*[^.|\'|\# |!|\(|?|,| |>|<|;|\)])/';
        $detail=preg_replace($link_regex,'<a href="$1">$1</a>', $detail);  //if have link detect in regex, make href
        
        
    /*
     * -----------------------insert into sql---------------------------------------------------
     */
        if(is_uploaded_file(@$_FILES['image']['tmp_name'])){//if have image
            $imageid=mysql_fetch_row(mysql_query("SELECT MAX(imageid) FROM ask_question"))[0]+1;//the imageid to insert must lager that the max imageid in database to prevent no used id will reuse

            processimage($_FILES['image'] , "ask_".$imageid);//process uploaded image function in ROOT_DIR functions/functions.php
            if(!@mysql_query("INSERT INTO ask_question (studentno, summary , detail , time , imageid)VALUES( $studentno, '$summary', '$detail', '$time', $imageid)"));//write into database with image data
                die(mysql_error ());
        }
        else{//not image
            if(!@mysql_query("INSERT INTO ask_question (studentno, summary , detail , time)VALUES( $studentno, '$summary', '$detail', '$time')"))
                die(mysql_error ());
        }
    }
}
    
/*
 *if not ask question
 */
    if ($mode==2){ //answer question

        //initial variable
        $questionid=intval($_POST['questionid']);
        $answer=addslashes(htmlspecialchars($_POST['answer']));
    
        //check user answered the question or not, if did , exit
        if(mysql_fetch_row(mysql_query("SELECT id FROM ask_answer WHERE id=$studentno$questionid"))[0]){exit();}
    
        $answer = nl2br($answer);    //change enter <br>
    
        $link_regex='/((http|https)+\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.\/_:@=.+?,##%&~-]*[^.|\'|\# |!|\(|?|,| |>|<|;|\)])/';
        $answer=preg_replace($link_regex,'<a href="$1">$1</a>', $answer);  //if have link detect in regex, make href

        //answer		(questionID!=0 && questionID is the id of question to answer)
        if(is_uploaded_file(@$_FILES['image']['tmp_name'])){
            $imageid=mysql_fetch_row(mysql_query("SELECT MAX(imageid) FROM ask_answer"))[0]+1;//the imageid to insert must lager that the max imageid in database to prevent no used id will reuse
            processimage($_FILES['image'] , "ask_ans_".$imageid);//process uploaded image function in ROOT_DIR functions/functions.php
            
            if(!@mysql_query("INSERT INTO ask_answer (questionid, id ,studentno, answer , time, imageid)VALUES( $questionid, $studentno$questionid, $studentno, '$answer', '$time',$imageid)"))
                die( '<script>alert("'.mysql_error().'")</script>');
        }
	    
		else{
		    if(!@mysql_query("INSERT INTO ask_answer (questionid, id ,studentno, answer , time)VALUES( $questionid, $studentno$questionid, $studentno, '$answer', '$time')"))
                die( '<script>alert("'.mysql_error().'")</script>');
        }
    }
        
    else if($mode==3){ //accepted answer
        $answerid=intval($_GET['answerid']);
        $questionid=intval($_GET['questionid']);
        
        //validation , is asker accepted the answer or 'hacker' ?
        $asker=mysql_fetch_row(mysql_query("SELECT studentno from ask_question where id=$questionid"))[0];
        
        if($studentno==$asker){//if studentno not asker's
            if(!mysql_query("UPDATE ask_question SET solved=1 where id=$questionid"))
                die(mysql_error());
            if(!mysql_query("UPDATE ask_answer SET accepted=1 where id=$answerid"))
                die(mysql_error());
        }
        exit();
    }
    else if($mode==4){  //discuss
        $discuss=addslashes(htmlspecialchars($_POST['discuss']));
        $questionid=intval($_POST['questionid']);
        
        $discuss=nl2br($discuss);
        
        if(!mysql_query("INSERT INTO ask_discuss (questionid, studentno, text, time)VALUES($questionid,$studentno,'$discuss','$time')"));
                die(mysql_error());
    }
    
    exit();//exit when work is finished or no work(invalid $mode)

    

?>