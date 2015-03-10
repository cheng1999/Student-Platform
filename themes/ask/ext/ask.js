var loaded=0;//this var is the post number that have loaded

//initial
window.scrollTo(0, 0);
loadquestions();
loaded+=(loaded+20>totalquestions?totalquestions-loaded:20);
window.scrollTo(0, 0);

//loadpost();
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() == $(document).height()){
	    loadquestions();
	    if(loaded+20<totalquestions){
	        loaded+=20;
	    }
	    else if(totalquestions-loaded>0){
	        loaded+=totalquestions-loaded;
	    }
	}
});


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
                            questions=[];//emty questions[]
                        }
                        else{
                            loaddetail();
                            $("#PostList").find("#loadstatus").remove();
                            loaded++;
                        }
                        if (totalquestions<=loaded&&!detail){
                            nomore($("#PostList"));
                            loaded++;
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
    for(i=0;i!=questions.length;i++){
        $("#PostList").append(
            $(".questions").html()
        );
    }
    for(i=questions.length-1;i>=0;i--){
        $("*.question-summary")[i].id=questions[i].id;
        $("*.status-question")[i].innerHTML=(questions[i].finalanswer ? '<br><b>Solved</b>' : '<br>Unsolve');
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
    $("#PostList").append($("#Answer_Dicuss"));
    $(".aAanswer").click();
}
function loadanswer(){
    $("#Answer_Dicuss #answer").show();
    $("#Answer_Dicuss #dicuss").hide();
    
    //load answerform
    if(questions[0].finalanswer||questions[0].answered){}
    else{
        $("#Answer_Dicuss #answer").append(
            $(".answerbox")
        );
        $("#questionID").attr("value",questionid);//var question id set from <script>'s classname call initial
    }
    
    
}
function loaddicuss(){
    $("#Answer_Dicuss #answer").hide();
    $("#Answer_Dicuss #dicuss").show();
    
    $("#Answer_Dicuss #answer").append(
        $(".dicussbox")
    );
    $("#questionID").attr("value",questionid);//var question id set from <script>'s classname call initial
}

var questionID;

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

function bigimg(THIS){
    THIS.css("maxHeight","none");
}
//text overflow;
function chkOverFlowText(){
    $("*#readmore").remove();
    for(var i=0;i<$("*#text").length;i++){
        if($("*#text")[i].scrollHeight >  $('#text').innerHeight()){
            $("*#text")[i].closest("#Pcontent").innerHTML += "<a id=\"readmore\" onclick=\"readmore($(this))\">read more</a>";
        }
    }
}

