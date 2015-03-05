var loaded=0;//this var is the post number that have loaded
var load_url;//ignore this var
//initial
window.scrollTo(0, 0);
loadquestions();
loaded+=(loaded+20>totalquestions?totalquestions-loaded:20);
window.scrollTo(0, 0);

//loadpost();
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() == $(document).height()){
	    loadquestions();
	    loaded+=(loaded+20>totalquestions?totalquestions-loaded:20);
	}
});


//----------------------------------request the posts from server----------------------------------
var loading=document.getElementById("loading");

function loadquestions() {
    if (totalquestions>loaded){
        document.getElementById("loading").style.visibility = "visible";
    	$.ajax({
	    	url: (load_url ? load_url: '?p=ask_load')+'&load='+loaded+'&mode=1',   //default target is st_loadposts because loadpost_url is null, it can set by extend script
    		//fully url will like this: ?p=st_loadposts&load=20&mode=1
		    type: 'POST',
		    data: {
    			page:$(this).data('page'),
		    },
		    success: function(response){
    			if(response){
				    loading.style.visibility = "hidden";
                        eval(response);//eval is about add post to var post
    					
					    //append post to postlist(layout)
                        for(i=0;i!=questions.length;i++){
                            $("#PostList").append(
                                $(".questions").html()
                            );
					    }
    					
    					for(i=questions.length-1;i>=0;i--){
                            $("*.status-question")[i].innerHTML=(questions[i].finalanswer ? '<br>Solved' : '<br>Unsolve');
                            $("*.status-answer")[i].innerHTML=questions[i].answers + '<br>Answers';
                            $("*.views")[i].innerHTML=(questions[i].views ? questions[i].views : '0') + '<br>Views';
                            $("*.summary .h3")[i].innerHTML=questions[i].summary;
                        //  $("*.summary .tags")[i].innerHTML="";
                            $("*.summary .asker")[i].innerHTML=questions[i].username;
                            $("*.summary .time")[i].innerHTML=questions[i].time;
    					}
    					
					    //questions=[];//emty post[]
				    }
			    chkOverFlowText();
		    }
	    });
    }
    //if database have no more post,so this element will show "no more"
    else if (totalquestions<=loaded){
    	loading.style.visibility = "hidden";
    	document.getElementById("loadstatus").innerHTML="no more";
    }
}


//-----------------------------------------function()--------------------------------------------------
//some action listener
var PostID;

function readmore(THIS){
    THIS.closest("#Pcontent").find("#text").css({"maxHeight":"none","overflow":"auto"});
    THIS.remove();
}
function doreply(THIS){
    THIS.parent().find("#ReplyList").show();
    PostID=THIS.parent().attr("id");
    THIS.parent().append($('.cmt #Postbox'));
    $(".cmt #Postbox #PostID").attr('value',''+PostID);
    chkOverFlowText();
}
function plus1(THIS){
    PostID=THIS.parent().attr("id");
    $.get("?p=st_post&mode=3&PostID="+PostID);//mode 3 call that action is plus1
    var plused = THIS.parent().find('#plused');
    plused.text("+"+(parseInt(plused.text())+1));//clear the #plused
    THIS.remove();
}
function bigimg(THIS){
    THIS.css("maxHeight","none");
}
function report(THIS){
    POSTID=(THIS.parent().parent().attr("id"));
    window.location.href="?p=st_report&PostID="+POSTID;
}



//post
function Posting(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Posting...");
    
    $("#PostAction").load(function(){
        window.location.href = "?p=ask";
    });
}
//reply
function Replying(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Posting...");
    totalposts+=1;
    $("#PostAction").load(function(){
        THIS.closest(".cmt").parent().append(
    	    "<div class=\"reply\"><div id=\"cmtauthor\">"   +
    		"<a id=\"user\" onclick=\"invalid_action()\">" + username + "</a>"                     +   //username
    		"<date>just now</date></div>"        +   //time
    		"<div id=\"Pcontent\"><div id=\"text\">" + $("*#textInput")[1].value + "</div></div></div>"     //text
			);
		
			//restore
        THIS.css("backgroundColor","#42b17e");
        THIS.val("Post (ctrl+enter)");
        $("#hideCon .cmt").append(($("*#Postbox")[1]));
    });
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

