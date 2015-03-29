<?php

class Admin{

    public function postnotice(){
        $notice_title = $_POST['notice_title'];
        $notice_content = $_POST['notice_content'];
        $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
        
        if(is_uploaded_file(@$_FILES['image']['tmp_name'])){
	        $imageid=mysql_fetch_row(mysql_query("SELECT MAX(imageid) FROM noticeboard"))[0]+1;//the imageid to insert must lager that the max imageid in database to prevent no used id will reuse
	        processimage($_FILES['image'] , "notice_".$imageid);
			mysql_query("INSERT INTO noticeboard (title,text,time,imageid)VALUES('$notice_title','$notice_content','$time',$imageid)");
	    }
	    else{
	        mysql_query("INSERT INTO noticeboard (title,text,time)VALUES('$notice_title','$notice_content','$time')");
	    }
    }    
}
?>