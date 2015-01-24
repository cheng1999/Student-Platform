<?php
session_start();

$logged=$_SESSION['logged'];
$x='x';

//exit if not logged
function exit_if_no_logged(){
    global $logged;
    if(!$logged){
            echo "you have not permission to access this page!";
            //header("Location: 403.php")
            exit();
    }
}
?>