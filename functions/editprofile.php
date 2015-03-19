<?php
if(!checklogin()){
    exit();
}

//profile picture
if(is_uploaded_file(@$_FILES['image']['tmp_name'])){
    processimage($_FILES['image'] , "profile_pic_".$_SESSION['studentno']);
}

//set username
@$username=trim(addslashes(htmlspecialchars($_POST['username'])));
if(@$username){
    mysql_query("UPDATE profile SET username='$username' WHERE studentno=".$_SESSION['studentno']);
}

//selft describe
@$selfdescribe=trim(addslashes(htmlspecialchars($_POST['selfdescribe'])));
if(@$selfdescribe){
    mysql_query("UPDATE profile SET self='$selfdescribe' WHERE studentno=".$_SESSION['studentno']);
}

//set password
if(@$_POST['current_pw']){
    $client_hash=md5($salt.$_POST['current_pw'].$salt);
    $hash=mysql_fetch_row(mysql_query("SELECT hash FROM profile where studentno=".$_SESSION['studentno']))[0];
    if($client_hash==$hash){
        $sethash=md5($salt.$_POST['first_pw'].$salt);
        mysql_query("UPDATE profile SET hash='$sethash' WHERE studentno=".$_SESSION['studentno']);
    }
    else{
        echo "<script>alert('Wrong password')</scrpit>";
    }
}

header("Location: ?p=profile");

?>