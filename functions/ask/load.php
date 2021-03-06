<?php
if(!checklogin()){
    exit();
}

@$studentno = intval($_GET['studentno']);
@$search = nosymbol($_GET['search']);
@$questionid = intval($_GET['questionid']);
@$start = intval($_GET['load']);
@$mode = intval($_GET['mode']); //mode 1 is load summary, mode 2 is load detail of question

include(__DIR__.'/ask.class.php');
$ask=new Ask();     //function from class above

if($mode==1){//load summary
    $loadperTime=20;
    
    if(@$studentno){
        $statement = "WHERE studentno=$studentno ORDER BY id DESC LIMIT $start,$loadperTime";
    }
    else if(@$search){
        $statement = "WHERE summary LIKE \"%$search%\" ORDER BY id DESC LIMIT $start,$loadperTime;";
    }
    else if(@$questionid){}//if is questionid then do nothing let it run at mode 2
    else{
        $statement = "ORDER BY id DESC LIMIT $start,$loadperTime";
    }
    //load
    $ask->loadsummary($statement);
}
else if($mode==2){//load question in detail
    $ask->loaddetail("WHERE id=$questionid");
    $ask->loadanswer("WHERE questionid=$questionid AND accepted=1 ORDER BY time DESC");//load the answer than accepted first
    $ask->loadanswer("WHERE questionid=$questionid AND accepted IS NULL ORDER BY time DESC");//then load the non accepted answer
    $ask->loaddiscuss("WHERE questionid=$questionid ORDER BY time DESC");
}
else{
    exit();
}
?>