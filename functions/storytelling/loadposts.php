<?php
if(!checklogin()){
    exit();
}

include(__DIR__.'/storytelling.class.php');
$load = new Storytelling();


//load only the post from a studentno, this require special operation when load replys of the post, so it run alone here.
if(@$_GET['studentno']){//only load posts of student
    @$studentno = intval($_GET['studentno']);
    
    $start = intval($_GET['load']);
    $loadperTime=20;
    $post_statement="WHERE studentno=$studentno ORDER BY id DESC LIMIT $start,$loadperTime";
    
    $load->loadpost($post_statement);
    
    $result = mysql_query("SELECT id FROM storytelling WHERE studentno=$studentno ORDER BY id DESC LIMIT $start,$loadperTime");
    while($row=mysql_fetch_row($result)){
        $reply_statement="WHERE parentid=$row[0]" ;
        $load->loadreply($reply_statement);
    }
    exit();
}

//load arealy of the post
else if(@$_GET['postid']){//if only want to read only a post which is indecated with postid
    $postid = intval($_GET['postid']);

    $post_statement="WHERE id=$postid";
    $reply_statement="WHERE parentid=$postid";
}
else{//default , load 20 posts per time,but load maybe with the value 0, so cannot use if statement
    $start = intval($_GET['load']);
    $loadperTime=20;
    
    $post_statement="ORDER BY id DESC LIMIT $start,$loadperTime";
    $reply_statement="WHERE parentid BETWEEN $start AND $start+$loadperTime";
}


$load->loadpost($post_statement);
$load->loadreply($reply_statement);

?>
