<?php

$studentno=intval($_POST['studentno']);// filtering the $_POST
$hash=trim(addslashes(htmlspecialchars($_POST['hash'])));

$result = mysql_query("SELECT * FROM profile WHERE studentno=$studentno");//select the username from database

while($row = mysql_fetch_row($result)){
    if($row[2]==$hash){//login success
        $_SESSION['logged']=true;//this val is makesure the the user is logged
        $_SESSION['studentno']=$studentno;
        
        if($_SESSION['request_uri']){   //if someone request uri but have not logged,the have to  logging first,the uri will store in session and after logged here will refer to there
            header("Location: " . $_SESSION['request_uri']);
        }
        else{
            header("Location: index.php");
        }
    }
    else{               //login failed
        echo '<script>alert("Login failed")</script>';
        header("Location: ?p=login");
        exit();
    }
}


?>