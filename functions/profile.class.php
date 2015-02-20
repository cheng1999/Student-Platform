<?php
class Profile {
    var $studentno;
    
    public function userInformation(){
        $result = mysql_query("SELECT * FROM profile WHERE studentno=" . $this->studentno);
        while($row = mysql_fetch_row($result)){
            echo    "Student no:$row[0]<br>",
                    "Username:$row[1]<br>",
                    "Class:$row[3]<br>",
                    "Birthday:$row[5]<br>",
                    "Self descripe:$row[4]<br>";
        }
    }
    
    public function loadST_post(){
        $result = mysql_query("SELECT * FROM storytelling WHERE studentno=" . $this->studentno);
        while($row = mysql_fetch_row($result)){
        echo 	"<div class=\"cmt\" id=\"cmt-$row[0]\"><div id=\"cmtauthor\">",	//id
	        '<n>'.mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0].'</n>',       //username
	        "<a id=\"report\">report</a>",                                         //report
	        "<date>$row[3]</date></div>",									//time
	        "<div id=\"text\">$row[2]</div>";							    //text
	        
        if($row[4]>0){
	        echo "<img id=\"postimg\" src=\"uploads/st_$row[4]\"></img><br class=\"clear\">";   //load image if exist
    }}
    }

}
?>