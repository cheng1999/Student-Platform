<?php
echo 'test';
if(!is_uploaded_file($image['tmp_name'] && $image['error'])){//if no uploaded then wait until upload complete
    echo '<script>alert("error where upload")</scrip>';
}
if (!preg_match( '/gif|png|x-png|jpeg/', $image['type'])||!getimagesize($image['tmp_name'])){      //check is image or not
    die("<script>Illegal file upload break</scrip>");
}
    //if (getimagesize($image['tmp_name'])!=false){

    echo $image['tmp_name'];
    if(!@move_uploaded_file($image['tmp_name'], ROOT_DIR . "uploads/st_" . $imageid))
        die("error");
    /*}else{
        die("Illegal file upload break");
    }*/
?>