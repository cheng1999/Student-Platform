<?php

$studentno=intval($_POST['studentno']);// filtering the $_POST
$hash=trim(addslashes(htmlspecialchars($_POST['hash'])));

$result = mysql_query("SELECT hash FROM profile WHERE studentno=$studentno");//select the username from database
$result = mysql_fetch_row($result);

$salted = md5($salt.$hash.$salt);   //salt the password to make weak password strong in hash.

    if($result[0]==$salted){//login success
        $_SESSION['studentno']=$studentno;
        
        if($_SESSION['request_uri']){ //if someone request uri but have not logged,the have to logging first,the uri will store in session and after logged here will refer to there
            header("Location: " . $_SESSION['request_uri']);
            unset($_SESSION['request_uri']);
        }
        else{
            header("Location: ?p=home");
        }
    }
    else{               //login failed
        echo '<script>alert("Login failed")</script>';
        header("Location: ?p=login");
        exit();
    }
?>