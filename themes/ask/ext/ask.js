var loaded=0;//this var is the post number that have loaded

//initial
loadquestions();addloaded();


//loadpost();
$(window).scroll(function() {
    if (($(window).scrollTop()+$(window).height()==$(document).height())&&
        totalquestions>loaded){
	    loadquestions();
        addloaded();
	}
});

function addloaded(){
    if(loaded+20<totalquestions){
        loaded+=20;
    }
    else if(totalquestions-loaded>0){
        loaded+=totalquestions-loaded;
    }else{
        loaded++;
    }
}

//----------------------------------request the posts from server----------------------------------
var loadstatus=document.getElementById("loadstatus");

function loadquestions() {
    if (totalquestions>=loaded){//var totalquestions is set at <script>'id "initial"
        loadmore($("#PostList"));
        $.ajax({
            url: load_url+'&load='+loaded,   //var load_url also set at <script>'id "initial"
            //fully url will like this: ?p=ask_load&load=20&mode=1
            type: 'POST',
            data: {
                page:$(this).data('page'),
		    },
		    success: function(response){
                if(response){
				    loadmore($("#PostList"));
                        eval(response);//eval is about add questions' summary to var questions

                        if(!detail){//if not load the detail of question
                            loadsummary();
                            //questions=[];//emty questions[]
                        }
                        else{
                            loaddetail();
                            loadanswers();
                            loaddiscuss();
                            $("#PostList").find("#loadstatus").remove();
                            nomore($("#PostList"));
                        }
                        if (totalquestions<=loaded&&!detail){
                            nomore($("#PostList"));
                        }
                }
            }
        });
    }
    //if database have no more post,so this element will show "no more"
/*    else if (totalquestions<=loaded){
    	loading.style.visibility = "hidden";
    	document.getElementById("loadstatus").innerHTML="no more";
    }
    */
}


//-----------------------------------------function()--------------------------------------------------
//some action listener

function loadsummary(){
    //append to postlist(layout)
    for(i=0;i<questions.length;i++){
        $("#PostList").append(
            $(".questions").html() //cannot use clone here because it will append one more (don know why -- someone can teach me?)
        );
    }
    for(i=questions.length-1;i>=0;i--){//from the new question to old question
        $("*.question-summary")[i].id=questions[i].id;
        $("*.status-question")[i].innerHTML=(questions[i].solved ? '<br><b>Solved</b>' : '<br>Unsolve');
        $("*.status-answer")[i].innerHTML=questions[i].answers + '<br>Answers';
        $("*.views")[i].innerHTML=(questions[i].views ? questions[i].views : '0') + '<br>Views';
        $("*.summary .h3")[i].innerHTML=questions[i].summary;
        //  $("*.summary .tags")[i].innerHTML="";
        $("*.summary .asker")[i].innerHTML=questions[i].username;
        $("*.summary .time")[i].innerHTML=questions[i].time;
    }
}
function loaddetail(){
    $("#PostList").append(
        $(".question-detail")
    );
    //load the detail of question
    $(".status")[0].innerHTML=(questions[0].finalanswer ? '<b>Solved</b>' : 'Unsolve');
    $(".asker .user").attr("href","?p=profile&studentno="+questions[0].studentno);
    $(".asker .user")[0].innerHTML=questions[0].username;
    //$("date")[0].innerHTML=questions[0].time;
    $(".detail-summary")[0].innerHTML=questions[0].summary;
    $(".detail-detail")[0].innerHTML=(questions[0].detail ? questions[0].detail : 'no detail for this question.');
    if(questions[0].image){
        $(".question-img").attr("src","uploads/"+questions[0].image);
    }else{
        $(".question-img").remove();
    }
    
    //initial below
    $("#PostList").append($(".aboutAnswer"));
    $("#PostList").append($("#Answer_Discuss"));
    $(".aAanswer").click();
}
function loadanswers(){
    //load answerform
    if(!questions[0].answered&&studentno!=questions[0].studentno){//if user have not answered or not asker then show answerbox){}
        $("#Answer_Discuss #answers").append($(".answerbox"));
        $(".answerbox #questionID").attr("value",questionid);//var question id set from <script>'s classname call initial
    }

    for(i=0;i<answers.length;i++){
        $("#Answer_Discuss #answers").append($(".answercontent").html());//cannot use clone here because it will append one more (don know why -- someone can teach me?)
    }
    
    
    for(i=answers.length-1;i>=0;i--){
        $(".answer")[i].setAttribute("value",answers[i].id);
        
        //if this answer is accepted by asker or the reader is not the asker, the button accepted will remove
        
        if(answers[i].accepted){    //if answer is accepted by asker
            $(".answer .answerStatus")[i].className = $(".answer .answerStatus")[i].className + " solved";
            $(".answer .answerStatus")[i].innerHTML='Accepted';
        }
        else if(studentno==questions[0].studentno){  //or if the user is asker
            $(".answer .answerStatus")[i].className = $(".answer .answerStatus")[i].className + " accept";   //set the button to accept
            $(".answer .answerStatus")[i].innerHTML='Accept this answer';
            $(".answer .answerStatus")[i].setAttribute("onclick","acceptanswer($(this))");  //create the button's function, click will accepted answer
        }
        else{   //if both are not, remove it (not accepted or user not asker)
            $(".answer .answerStatus")[i].remove();
        }
            
        $(".answer .answer_text")[i].innerHTML=answers[i].answer;
        
        (answers[i].image ?
            $(".answer .answer_img")[i].setAttribute("src","uploads/"+answers[i].image): 
            $(".answer .answer_img")[i].remove());

        $(".problemsolver .user")[i].setAttribute("href","?p=profile&studentno="+answers[i].studentno);
        $(".problemsolver .user")[i].innerHTML=answers[i].username;
        $(".problemsolver .time")[i].innerHTML=answers[i].time;
    }
}

function loaddiscuss(){
    $("#Answer_Discuss #discusses").append($(".discussbox"));
    $(".discussbox #questionID").attr("value",questionid);//var question id set from <script>'s classname call initial
}

//accept answer
function acceptanswer(THIS){
    $.get("?p=ask_ask&mode=3&answerid="+THIS.parent().attr("value")+"&questionid="+questionid);    //?p=ask_ask&mode=3&answerid=20130451&questionid=1
    THIS.removeClass("accept").addClass("solved");
    THIS.html("Accepted");
}

function showanswers(){
    $("#Answer_Discuss #answers").show();
    $("#Answer_Discuss #discusses").hide();
}
function showdiscusses(){
    $("#Answer_Discuss #answers").hide();
    $("#Answer_Discuss #discusses").show();
}


//view detail of question;
function godetail(id){
    window.location.href="?p=ask&questionid="+id;
}
//the tab
function tab(THIS){
    $(".aboutAnswer a").css({"color":"#777","border":"3px solid #e0e0e0"});
    THIS.css({"border-bottom":"3px solid #fff","color":"#555"});
}

//loading & no more
function loadmore(THIS){
    THIS.find("#loadstatus").remove();
    THIS.append($("#loadstatus").clone());
    THIS.find("#loadstatus #loading").show();
}
function nomore(THIS){
    THIS.find("#loadstatus").remove();
    THIS.append($("#loadstatus").clone());
    THIS.find("#loadstatus #loading").hide();
    THIS.find("#loadstatus #nomore").show();
}

//post
function Posting(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Posting...");
    
    $("#PostAction").load(function(){
        window.location.href = "?p=ask";
    });
}
function Answering(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Submmiting...");
    
    $("#PostAction").load(function(){
        window.location.href = window.location.href;
    });
}

//give the image original size
function bigimg(THIS){
    THIS.css("maxHeight","none");
}

//text overflow
function chkOverFlowText(){
    $("*#readmore").remove();
    for(var i=0;i<$("*#text").length;i++){
        if($("*#text")[i].scrollHeight >  $('#text').innerHeight()){
            $("*#text")[i].closest("#Pcontent").innerHTML += "<a id=\"readmore\" onclick=\"readmore($(this))\">read more</a>";
        }
    }
}

