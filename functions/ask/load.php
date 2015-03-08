<?php
if(!checklogin()){
    exit();
}

@$studentno = intval($_GET['studentno']);
@$tag = nosymbol($_GET['tag']);
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
    else if(@$tag){
        $statement = "WHERE summary LIKE \"%#$tag%\" ORDER BY id DESC LIMIT $start,$loadperTime;";
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
    $ask->loadanswer("WHERE questionid=$questionid");
    $ask->loaddicuss("WHERE id=$questionid");
}
else{
    exit();
}
?>