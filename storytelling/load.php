<?php
include("../sql.php");
extract($_GET);


$start=intval($load);
$loadNum=20;

if($mode==1){
	$table='storytelling';
	$condition="ORDER BY id DESC LIMIT $start,$loadNum";			//$condition will use for mysql command
	}
else if($mode==2){
	$table='storytelling2';
	$condition="WHERE id BETWEEN $start AND $start+$loadNum" ;
	}

if(!$result = mysql_query("SELECT * FROM $table $condition"))
    die(mysql_error()); // TODO: better error handling

if($mode==1){
while($row = mysql_fetch_row($result)){
    
    
	echo 	"<div class=\"cmt\" id=\"cmt-$row[0]\"><div id=\"cmtauthor\">";	//id
	echo    '<n>'.mysql_fetch_row(mysql_query("SELECT * FROM profile WHERE studentno=$row[1]"))[1].'<n>';       //username from profile table where sutdentno is match
			
	echo	"<date>$row[3]</date></div>",									//time
			"<a id=\"reply\">reply</a>",									//reply <a>
			"<div id=\"text\">$row[2]</div></div>";							//text			
}
}
else if($mode==2){
while($row = mysql_fetch_row($result)){
	echo 	"<div class=\"reply\" id=\"cmt-$row[0]\"><div id=\"cmtauthor\">";	//id
	echo    '<n>'.mysql_fetch_row(mysql_query("SELECT * FROM profile WHERE studentno=$row[1]"))[1].'<n>';       //username from profile table where sutdentno is match
	echo	"<date>$row[3]</date></div>",										//time
			"<div id=\"text\">$row[2]</div></div>";								//text		
}
}
?>
