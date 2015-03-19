<?php
class Profile {
    var $studentno;
    
    public function userInformation(){
        $result = mysql_query("SELECT * FROM profile WHERE studentno=" . $this->studentno);
        while($row = mysql_fetch_row($result)){
            
            $output = array(
                'studentno'     =>$row[0],
                'username'      =>$row[1],
                'class'         =>$row[3],
                'selfdescribe'  =>$row[4],  //self describe
                'birthday'      =>$row[5],
            );
            echo json_encode($output);
        }
    }
}
?>