<?php
session_start();
if(!$_SESSION['logged']){
    echo "you have not permission to access this page!";
    exit();
}

include("sql.php");
$studentno=intval($_GET['studentno']);

if(!$result = mysql_query("SELECT * FROM profile WHERE studentno=$studentno")){//select the username from database
    failed();// if error then reply login failed
}

if(mysql_num_rows($result)==0){echo '1';} //check the result is emty or not, if emty then failed();
while($row = mysql_fetch_row($result)){
    echo    "Student no:$row[0]<br>",
            "Username:$row[1]<br>",
            "Class:$row[3]<br>",
            "Birthday:$row[5]<br>",
            "Self descripe:$row[4]<br>";
}

function failed(){
    echo '<script>alert(0)</script>';
}
?>