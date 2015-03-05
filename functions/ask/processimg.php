<?php
if($image['error']){//upload error
    echo '<script>alert("error where upload")</script>';
    echo '<script>alert("error code :'.$image['error'].'")</script>';
}
if (!preg_match( '/gif|png|x-png|jpeg/', $image['type'])||!getimagesize($image['tmp_name'])){      //check is image or not
    die('<script>alert("Illegal file upload break")</script>');
}
    //if (getimagesize($image['tmp_name'])!=false){

    echo $image['tmp_name'];
    if(!@move_uploaded_file($image['tmp_name'], ROOT_DIR . "uploads/ask_" . $imageid))
        die('<script>alert("error")</script>');
        
?>