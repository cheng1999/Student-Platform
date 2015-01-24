<?php
include("sql.php");
session_start();

$studentno=intval($_POST['studentno']);// filtering the $_POST
$hash=trim(addslashes(htmlspecialchars($_POST['hash'])));

if(!$result = mysql_query("SELECT * FROM profile WHERE studentno=$studentno")){//select the username from database
    failed();// if error then reply login failed
}

if(mysql_num_rows($result)==0){failed();} //check the result is emty or not, if emty then failed();
while($row = mysql_fetch_row($result)){
    if($row[2]==$hash){//login success
        $_SESSION['logged']=true;//this val is makesure the the user is logged
        $_SESSION['studentno']=$studentno;
        echo '<script>window.location.href="index.php"</script>';
    }
    else{               //login failed
        echo '<script>alert(0)</script>';
        echo '<script>window.location.href="?p=login"</script>';
        exit();
    }
}


?>