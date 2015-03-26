<?php
class Storytelling{
    public function loadpost($statement){
        
        $result = mysql_query("SELECT * FROM storytelling $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
           
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            //image
            $image = (($row[4]>0) ? ("st_".$row[4]) : null);//if exist image then return image filename or else return null
            
            //load plus1(like)
            $plus1 = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling_plus1 WHERE postid=$row[0]"))[0];
            $plused = (mysql_fetch_row(mysql_query("SELECT * FROM storytelling_plus1 WHERE postid=$row[0] AND studentno=".$_SESSION['studentno']))[0] ? 0 : 1);//if user liked the post, no more like button for him
            $replys = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM storytelling_reply WHERE parentid=$row[0]"))[0];
            
            $anonymous = $row[5];
           //to generate javascript for client to run. script is about the data of post in array type
            $output=array(
                'id'        =>($anonymous?0:$row[0]),
                'studentno' =>($anonymous?0:$row[1]),
                'username'  =>($anonymous?'anonymous':$username),
                'text'      =>$row[2],
                'image'     =>$image,
                'time'      =>$row[3],
                'plus1'     =>$plus1,
                'plused'    =>$plused,
                'replys'    =>$replys,
            );
           
           echo "posts.push(".json_encode($output).");";

        }
    }
    
    public function loadreply($statement){
        $result = mysql_query("SELECT * FROM storytelling_reply $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
            
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            
            //to generate javascript for client to run. script is about the data of post in array type
            $output=array(
                'parentpostid'  =>$row[0],
                'studentno'     =>$row[1],
                'username'      =>$username,
                'text'          =>$row[2],
                'time'          =>$row[3],
            );
            echo "replys.push(".json_encode($output).");";
            /*//reply.push([parentpostid,studentno,username,text,time])
            echo "reply.push([$row[0],$row[1],'$username','$row[2]','$row[3]']);";
            */
        }
    }
}
?>