<?php
session_start();

//exit if not logged
function exit_if_no_logged(){
    if(!$_SESSION['logged']){
            echo "403 please login";
            //header("Location: 403.php")
            exit();
    }
}
?>