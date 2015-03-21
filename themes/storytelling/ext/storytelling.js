var loaded=0;//this var is the post number that have loaded

//initial
load();addloaded();

$(window).scroll(function() {
    if (($(window).scrollTop()+$(window).height()==$(document).height())&&
        totalposts>loaded){
	    load();
	    addloaded();
	}
});

function addloaded(){
    if(loaded+20<totalposts){
        loaded+=20;
    }
    else if(totalposts-loaded>0){
        loaded+=totalposts-loaded;
    }else{
        loaded++;
    }
}


//----------------------------------request the posts from server----------------------------------
var loading=document.getElementById("loading");

function load() {
    if (totalposts>loaded){
    document.getElementById("loading").style.visibility = "visible";
	$.ajax({
		url: load_url+'&load='+loaded,   //var load_url also set at <script>'id "initial"
		//fully url will like this: ?p=st_loadposts&load=20&mode=1
		
		success: function(response){
			if(response){
				loading.style.visibility = "hidden";
				eval(response);//eval is about add post to var post
					
                loadposts();
				posts=[];//emty post[]
                    
                loadreplys();
                replys=[]; //emty reply
			}
			chkOverFlowText();
		}
	});
    }
//if database have no more post,so this element will show "no more"
    else if (totalposts<=loaded){
    	loading.style.visibility = "hidden";
    	document.getElementById("loadstatus").innerHTML="no more";
    }
}


//-----------------------------------------function()--------------------------------------------------
function loadposts(){
    for(i=0;i<posts.length;i++){
	    $("#PostList").append($(".postcontent").html());
	}
	
	for(i=posts.length-1;i>=0;i--){
		$("*.post")[i].setAttribute("value",posts[i].id);
		$("*.post")[i].setAttribute("id",posts[i].id);
		$("*.post #plused")[i].innerHTML="+"+posts[i].plus1;
		
		$("*.post #user")[i].innerHTML=posts[i].username;
		$("*.post #user")[i].setAttribute("href","?p=profile&studentno="+posts[i].studentno);
        
		$("*.post #text")[i].innerHTML=posts[i].text;
		
		$("date")[i].innerHTML=posts[i].time;
		
		(posts[i].image ? $("*.post #postimg")[i].setAttribute("src","uploads/"+posts[i].image) : $("*.post #postimg")[i].remove());
    
		if(!posts[i].plused){
            $("*.post #plus1")[i].remove();
        }
        if(posts[i].replys){
            $("*.post #reply")[i].innerHTML="reply ( "+posts[i].replys+" )";
        }
        
	}
}

function loadreplys(){
    for(i=0;i<replys.length;i++){
        if($(".post#"+replys[i].parentpostid)){
            target=$(".post#"+replys[i].parentpostid);
            
            target.find("#ReplyList").append($(".replycontent").html());
            target.find("#ReplyList #user:last").html(replys[i].username);
            target.find("#ReplyList #user:last").attr("href","?p=profile&studentno="+replys[i].studentno);
            target.find("#ReplyList #text:last").html(replys[i].text);
            target.find("#ReplyList #date:last").html(replys[i].time);
        }
	}
}

//some action listener
var PostID;

function readmore(THIS){
    THIS.closest("#Pcontent").find("#text").css({"maxHeight":"none","overflow":"auto"});
    THIS.remove();
}
function doreply(THIS){
    THIS.parent().find("#ReplyList").show();
    PostID=THIS.parent().attr("value");
    THIS.parent().append($('.cmt #Postbox'));
    $(".cmt #Postbox #PostID").attr('value',''+PostID);
    chkOverFlowText();
}
function plus1(THIS){
    PostID=THIS.parent().attr("value");
    $.get("?p=st_post&mode=3&PostID="+PostID);//mode 3 call that action is plus1
    var plused = THIS.parent().find('#plused');
    plused.text("+"+(parseInt(plused.text())+1));//clear the #plused
    THIS.remove();
}
function bigimg(THIS){
    THIS.css("maxHeight","none");
}
function report(THIS){
    POSTID=(THIS.parent().parent().attr("value"));
    window.location.href="?p=st_report&PostID="+POSTID;
}



//post
function Posting(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Posting...");
    
    $("#PostAction").load(function(){
        window.location.href = "?p=storytelling";
    });
}
//reply
function Replying(THIS){
    THIS.css("backgroundColor","#d9534f");
    THIS.val("Posting...");
    totalposts+=1;
    h=THIS;
    $("#PostAction").load(function(){
        replys.push({
            "parentpostid":THIS.closest(".post").attr("id"),
            "studentno":studentno,
            "username":username,
            "text":$("*#textInput")[1].value,
            "time":"just now",
        });
        
        loadreplys();
        replys=[];
		
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
            $("*#text")[i].parentNode.innerHTML += "<a id=\"readmore\" onclick=\"readmore($(this))\">...</a>";
        }
    }
}

