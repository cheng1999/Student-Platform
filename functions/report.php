<?php
if(!checklogin()){
    exit();
}

 //if user did input
    $keywords   = $_POST['keywords'];
    $keywords = addslashes(htmlspecialchars($keywords));
    
    $keywords = explode(' ', $keywords);
    
    $time=	date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
    for ($i=0;$i<count($keywords);$i++){
        if(!@mysql_query("INSERT INTO report_keyword (keyword,time,block)values('$keywords[$i]','$time',0)"))
            die(mysql_error());
    }
    echo '<script>alert("Thank you!")</script>';

?>