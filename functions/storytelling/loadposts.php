<?php
if(!checklogin()){
    exit();
}

include('storytelling.class.php');
$load = new Storytelling();

//mode1 is post, mode2 is reply(comment), mode3 is +1(like) but it useless here
@$mode   =   intval($_GET['mode']);
@$start  =   intval($_GET['load']);
$loadperTime=20;

@$studentno = intval($_GET['studentno']);
@$postid = intval($_GET['postid']);

//set mode1 statement and mode2 statement for load data from mysql
if(@$studentno){
    $mode1_statement="WHERE studentno=$studentno ORDER BY id DESC LIMIT $start,$loadperTime";
    
    if(@$mode==2){ //special rule while user is trying to load only a studentno's post's reply
    $result = mysql_query("SELECT id FROM storytelling WHERE studentno=$studentno ORDER BY id DESC LIMIT $start,$loadperTime");
    while($row=mysql_fetch_row($result)){
        $mode2_statement="WHERE parentid=$row[0]" ;
        $load->loadreply($mode2_statement);
    }
    exit();
    }
}
else if(@$_GET['postid']){
    $mode1_statement="WHERE id=$postid";
    $mode2_statement="WHERE parentid=$postid";
}
else{
    $mode1_statement="ORDER BY id DESC LIMIT $start,$loadperTime";
    $mode2_statement="WHERE parentid BETWEEN $start AND $start+$loadperTime";
}

if($mode==1){ //post
	$load->loadpost($mode1_statement);
}
else if($mode==2){ //reply
	$load->loadreply($mode2_statement);
}
else{//if invalid $_GET will exit
    exit();
}
?>
