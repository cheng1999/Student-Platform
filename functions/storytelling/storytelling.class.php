<?php
class Storytelling{
    public function loadpost($statement){
        
        $result = mysql_query("SELECT * FROM storytelling $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
           
            //load plus1(like)
            $plus1=0;unset($plus1studentno);$plus1studentno=array();
            $plus1data = mysql_query("SELECT * FROM storytelling_plus1 WHERE postid=$row[0]"); //$row[0] is postid and this is loading all plus1 for the postid from database
            while($plus1row=mysql_fetch_row($plus1data)){//count each plus1
                $plus1++;
                array_push($plus1studentno,$plus1row[1]);
            }
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            //image
            $image = (($row[4]>0) ? ("'st_".$row[4]."'") : 'null');//if exist image then return image filename or else return null
            $plused = (in_array($_SESSION['studentno'],$plus1studentno) ? 0 : 1);//if user liked the post, no more like button for him
           
           //to generate javascript for client to run. script is about the data of post in array type
           //post.push([id,studentno,username,text,time,plus1,boolean plused,image])
            echo "post.push([$row[0],$row[1],'$username','$row[2]','$row[3]',$plus1,$plused,$image]);";
        }
        echo ""; //end of the script
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