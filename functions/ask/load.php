<?php
if(!checklogin()){
    exit();
}

@$questionid = intval($_GET['question']);
@$start = intval($_GET['load']);
@$mode = intval($_GET['mode']); //mode 1 is load summary, mode 2 is load detail of question

include('ask.class.php');
$ask=new Ask();     //function from class above

if($mode==1){//load summary
    $loadperTime=20;
    $ask->loadsummary("ORDER BY id DESC LIMIT $start,$loadperTime");
}
else if($mode==2){//load question in detail
    $ask->loaddetail("WHERE id=$questionid");
    $ask->loadanswer("WHERE id=$questionid");
}
else{
    exit();
}
?>