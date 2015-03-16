<?php
/*loading some functions to ready for service*/

/*
checklogin()    login_before_access()   
*/

function checklogin(){
    if(@$_SESSION['studentno']){
        return true;
    }
    else{
        return false;
    }
}

function login_before_access(){
    $_SESSION['request_uri']="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    header("Location: ?p=login");
}

function processimage($image,$filename){
    if($image['error']){//upload error
        echo '<script>alert("error where upload")</script>';
        echo '<script>alert("error code :'.$image['error'].'")</script>';
    }
    if (!preg_match( '/gif|png|x-png|jpeg/', $image['type'])||!getimagesize($image['tmp_name'])){      //check is image or not
        die('<script>alert("Illegal file upload break")</script>');
    }
    //if (getimagesize($image['tmp_name'])!=false){

    //echo $image['tmp_name'];
    if(!@move_uploaded_file($image['tmp_name'], ROOT_DIR . "uploads/" .$filename))
        die('<script>alert("error")</script>');
}

function nosymbol($string){
    $regex='/[a-z\x{4e00}-\x{9fa5}]+/u';
    preg_match($regex,$string,$string);
    return $string[0];
}

//function about notification
function notify($studentno,$message,$link){
    $time = date("Y/n/j \a\\t g:ia"); //date format:	2014/12/25 at 2:00am
    
    if(!@mysql_query("INSERT INTO notification (studentno,message,link,time) VALUES($studentno,'$message','$link','$time')"))
        die(mysql_error());
}
function loadnotify($studentno){
    $result = mysql_query("SELECT * FROM notification WHERE studentno=".$_SESSION['studentno']);
    while($row = mysql_fetch_row($result)){
        $output = array(
            'id'            =>$row[1],
            'message'       =>$row[2],
            'link'          =>$row[3],
            'time'          =>$row[4],
        );
        echo 'notifications.push('.json_encode($output).');';
    }
}
function removenotify($id){
    if(!@mysql_query("DELETE FROM notification WHERE id=$id"))
        die(mysql_error());
}
?>