<?php
exit_if_no_logged();

extract($_GET);

//mode1 is post, mode2 is reply(comment), mode3 is +1(like)
$mode   =   intval($_GET['mode']);
$start  =   intval($_GET['load']);
$loadperTime=20;


if($mode==1){ //post
	$table='storytelling';
	$condition="ORDER BY id DESC LIMIT $start,$loadperTime";			//$condition will use for mysql command
}
else if($mode==2){ //reply
	$table='storytelling_reply';
	$condition="WHERE parentid BETWEEN $start AND $start+$loadperTime" ;
}
else{//if invalid $_GET will exit
    exit();
}


/*
    load requre data from database
*/
if(!$result = mysql_query("SELECT * FROM $table $condition"))
    die(mysql_error()); // TODO: better error handling


/*
    processing data from database
*/
if($mode==1){       //loading posts
while($row = mysql_fetch_row($result)){

    //load plus1
    $plus1=0;
    unset($plus1studentno);
    $plus1studentno=array();
    $plus1data = mysql_query("SELECT * FROM storytelling_plus1 WHERE postid=$row[0]"); //$row[0] is postid and this is loading all plus1 for the postid from database
    while($plus1row=mysql_fetch_row($plus1data)){//count each plus1
        $plus1++;
        array_push($plus1studentno,$plus1row[1]);
    }

	echo 	"<div class=\"cmt\" id=\"cmt-$row[0]\"><div id=\"cmtauthor\">";	//id
	echo    '<n>'.mysql_fetch_row(mysql_query("SELECT * FROM profile WHERE studentno=$row[1]"))[1].'<n>';       //username from profile table where sutdentno is match
	echo    "<a id=\"plused\">+$plus1</a>";
	echo	"<date>$row[3]</date></div>",									//time
			"<a id=\"reply\">reply</a>";									//reply <a>
			
    if(!in_array($_SESSION['studentno'],$plus1studentno)){//check user plused 1 to this post or not
        echo    "<a id=\"plus1\"></a>";									        //plus1 <a>
    }
    
	echo "<div id=\"text\">$row[2]</div></div>";							//text			
}
}
else if($mode==2){  //loading comments (this data will allot to their belongs posts with javascript)
while($row = mysql_fetch_row($result)){
	echo 	"<div class=\"reply\" id=\"cmt-$row[0]\"><div id=\"cmtauthor\">";	//id
	echo    '<n>'.mysql_fetch_row(mysql_query("SELECT * FROM profile WHERE studentno=$row[1]"))[1].'<n>';       //username from profile table where sutdentno is match
	echo	"<date>$row[3]</date></div>",										//time
			"<div id=\"text\">$row[2]</div></div>";								//text		
}
}
?>
