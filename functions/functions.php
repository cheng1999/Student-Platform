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

?>