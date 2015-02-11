var loaded=0;//this var is the post number that have loaded

window.scrollTo(0, 0);
loadpost();

//loadpost();
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() == $(document).height()){
	    loadpost();
	}
});

function loadpost(){
    load(1);//loading posts first
    setTimeout(function(){//loading reply of posts after 1 second 
        load(2);
        loaded+=20;
    }, 1000);
}
var mode;
var reply;
var loading=document.getElementById("loading");
function load(mode) {//----------------------------------loading post----------------------------------
	
    if (totalposts>loaded){
    document.getElementById("loading").style.visibility = "visible";
	$.ajax({
		url: '?p=st_loadposts&load='+loaded+'&mode='+mode,
		type: 'POST',
		data: {
			page:$(this).data('page'),
		},
		success: function(response){
			if(response){
				loading.style.visibility = "hidden";
				if(mode==1){//mode 1 for post
					$("#PostList").append(response);
					enableAButton();
				}
				if(mode==2){//mode 2 for reply
					$("#replyList").append(response);
					reply=document.getElementById("replyList").getElementsByClassName("reply");
					Post=document.getElementById("PostList").getElementsByTagName("div");
					for(var i=0;reply.length!=0;i++){
					    if(Post[reply[0].id]){//if parent post is exist
						    Post[reply[0].id].appendChild(reply[0]);
					    }else{reply[0].remove();}
					}
				}
			}
		}
	});
    }
//if element which id is cmt-1 is detect, means that database have no more post,so this element will show "no more"
    else if (totalposts<loaded){
    	loading.style.visibility = "hidden";
    	document.getElementById("loadstatus").innerHTML="no more";
    }
}


//reply plus1 image click listener
var PostID;
function enableAButton(){
$(".cmt #reply").click(function(){
  PostID=$(this).parent().attr("id").substring(4);
  $(this).parent().append($('.cmt #Postbox'));
  $(".cmt #Postbox #PostID").attr('value',''+PostID);
});

$(".cmt #plus1").click(function(){
  PostID=$(this).parent().attr("id").substring(4);
  $.get("?p=st_post&mode=3&PostID="+PostID);
  var plused = $(this).parent().find('#plused');
  plused.text("+"+(parseInt(plused.text())+1));//clear the #plused
  this.style.visibility='hidden';
});

$(".cmt #postimg").click(function(){
  this.style.maxHeight="none";
});

$(".cmt #report").click(function(){
    PostID=$(this).parent().parent().attr("id").substring(4);
    window.location.href="?p=st_report&PostID="+PostID;
});
}

function chkPostingStatus(){
    var buttonSubmit=document.getElementById("buttonSubmit")
    buttonSubmit.style.backgroundColor="#d9534f";
    buttonSubmit.style.content="Posting...";
    
    $("#PostAction").load(function(){
        window.location.href = "?p=storytelling";
    });
}

