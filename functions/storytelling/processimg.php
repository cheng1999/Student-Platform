<?php
if(!is_uploaded_file($image['tmp_name'] && !$image['error'])){//if no uploaded then wait until upload complete
    echo 'error where upload';
}
if (!preg_match( '/gif|png|x-png|jpeg/', $image['type'])||!getimagesize($image['tmp_name'])){      //check is image or not
    die("Illegal file upload break");
}
    //if (getimagesize($image['tmp_name'])!=false){

    echo $image['tmp_name'];
    if(!@move_uploaded_file($image['tmp_name'], ROOT_DIR . "uploads/" . $imageid))
        die("error");
    /*}else{
        die("Illegal file upload break");
    }*/
    


?>