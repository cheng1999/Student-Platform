<?php
class Storytelling{
    public function loadpost($statement){
        
        $result = mysql_query("SELECT * FROM storytelling $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
           
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            //image
            $image = (($row[4]>0) ? ("'st_".$row[4]."'") : 'null');//if exist image then return image filename or else return null
            
            //load plus1(like)
            $plus1=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling_plus1 WHERE postid=$row[0]"))[0];
            $plused = (mysql_fetch_row(mysql_query("SELECT * FROM storytelling_plus1 WHERE postid=$row[0] AND studentno=".$_SESSION['studentno']))[0] ? 0 : 1);//if user liked the post, no more like button for him
            $reply = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling_reply WHERE parentid=$row[0]"))[0];
            
           //to generate javascript for client to run. script is about the data of post in array type
           //post.push([id,studentno,username,text,time,plus1,boolean plused,image,replys])
            echo "post.push([$row[0],$row[1],'$username','$row[2]','$row[3]',$plus1,$plused,$image,$reply]);";
        }
    }
    
    public function loadreply($statement){
        $result = mysql_query("SELECT * FROM storytelling_reply $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
            
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            
            //to generate javascript for client to run. script is about the data of post in array type
            //reply.push([parentpostid,studentno,username,text,time])
            echo "reply.push([$row[0],$row[1],'$username','$row[2]','$row[3]']);";
        }
    }
}
?>