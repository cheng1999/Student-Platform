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
}
?>