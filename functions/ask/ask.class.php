<?php
class Ask{
    public function loadsummary($statement){
        $result = mysql_query("SELECT * FROM ask_question $statement"); //mysql
        while($row = mysql_fetch_row($result)){
           
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            //summary
            $summary = str_replace('<br>', ' ', $row[2]);
            //views
            $views = ($row[6]>=999 ? '999+' : $row[6]);
            //answers
            $answers = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ask_answer WHERE questionid=$row[0]"))[0];
            $answers = ($answers>=99 ? '99+' : $answers);
            
           //to generate javascript for client to run. script is about the data of post in array type
            $output=array(
               'id'         =>$row[0]   ,
               'studentno'  =>$row[1]   ,
               'username'   =>$username ,
               'summary'    =>$summary  ,
               'time'       =>$row[4]   ,
               'views'      =>$views    ,
               'answers'    =>$answers  ,
               'finalanswer'=>$row[7]   ,
               );
            echo "questions.push(".json_encode($output).");";
        }
    }
    
    public function loaddetail($statement){
        $result = mysql_query("SELECT * FROM ask_question $statement"); //mysql
        
        while($row = mysql_fetch_row($result)){
            
            mysql_query("UPDATE ask_question SET views=views+1 WHERE id=$row[0]");//id //add views number when load detail every times
           
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            //image
            $image = (($row[5]>0) ? ("ask_".$row[5]) : 'null');//if exist image then return image filename or else return null
            //answers
            $answers = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ask_answer WHERE questionid=$row[0]"))[0];
            $answered = mysql_fetch_row(mysql_query("SELECT * FROM ask_answer WHERE studentno=".$_SESSION['studentno']))[0];//user is answered this question or not
            
           //to generate javascript for client to run. script is about the data of post in array type
           $output=array(
               'id'         =>$row[0]   ,
               'studentno'  =>$row[1]   ,
               'username'   =>$username ,
               'summary'    =>$row[2]   ,
               'detail'     =>$row[3]   ,
               'time'       =>$row[4]   ,
               'image'      =>$image    ,
               'views'      =>$row[6]   ,
               'answers'    =>$answers  ,
               'answered'   =>$answered ,
               'finalanswer'=>$row[7]   ,
               );
               
            echo "questions.push(".json_encode($output).");";
            /*echo "question.push([{",
                "\"id\" : \"" .         $row[0]     . "\",",
                "\"studentno\" : \"".   $row[1]     . "\",",
                "\"username\" : \"".    $username   . "\",",
                "\"summary\" : \"".     $row[2]     . "\",",
                "\"detail\" : \"".      $row[3]     . "\",",
                "\"time\"',$row[4],$plus1,$plused,$image,$reply,
                "}]);";*/
        }
    }
    
    public function loadanswer($statement){
        $result = mysql_query("SELECT * FROM ask_answer $statement"); //mysql

        while($row = mysql_fetch_row($result)){
            //get username from table "profile"
            $username = mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=$row[1]"))[0];
            
            //image
            $image = (($row[5]>0) ? ("ask_ans".$row[5]) : 'null');//if exist image then return image filename or else return null
            
            $output=array(
                'questionid'    =>$row[0],
                'id'            =>$row[1],
                'studentno'     =>$row[2],
                'username'      =>$username,
                'answer'        =>$row[3],
                'time'          =>$row[4],
                'image'         =>$image,
                );
            echo "answer.push(".json_encode($output).");";
        }
    }
    public function loaddicuss($statement){
        $result = mysql_query("SELECT * FROM ask_answer $statement"); //mysql
    }
}
?>