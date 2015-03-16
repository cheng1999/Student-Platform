<?php
if(!checklogin()){
    exit();
}

//if user readed the notifications;
if(@intval($_GET['read'])){
    $readedid=intval($_GET['read']);
    $notiftarget=mysql_fetch_row(mysql_query("SELECT studentno FROM notification WHERE id=$readedid"))[0];
    if(@$_SESSION['studentno'] == $notiftarget){
        removenotify($readedid);
    }
    else{
        exit();
    }
}

?>