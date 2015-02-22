<?php
class Profile {
    var $studentno;
    
    public function userInformation(){
        $result = mysql_query("SELECT * FROM profile WHERE studentno=" . $this->studentno);
        while($row = mysql_fetch_row($result)){
            //post.push([studentno,username,class,slef,birthday])
            echo "profile.push([$row[0],'$row[1]','$row[3]','$row[4]',$row[5]]);";
        }
    }
    
    public function loadST(){
        include('storytelling.class.php');
        $load = new Storytelling();
        
        //mode1 is post, mode2 is reply(comment), mode3 is +1(like) but it useless here
        $mode   =   intval($_GET['mode']);
        $start  =   intval($_GET['load']);
        $loadperTime=20;
        
        if($mode==1){ //post
	        $statement="WHERE studentno=" . $this->studentno . " ORDER BY id DESC LIMIT $start,$loadperTime";			//$condition will use for mysql command
	        $load->loadpost($statement);
        }
        else if($mode==2){ //reply
	        $statement="WHERE parentid BETWEEN $start AND $start+$loadperTime" ;
	        $load->loadreply($statement);
        }
        else{//if invalid $_GET will exit
            exit();
        }
    }
}
?>