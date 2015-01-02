var loaded=0;//this var is noting the post number that have loaded
var loading=document.getElementById("loading");

load(1);
setTimeout(function(){
    load(2);
	loaded+=20;
}, 1000);

$(window).scroll(function() {   
	if ($(window).scrollTop() + $(window).height() == $(document).height()
		&&
		(document.getElementById("cmt-1")==null)) {
			
		load(1);
		setTimeout(function(){
			load(2);
			loaded+=20;
		}, 1000);
		
	}
});

var mode;
var reply;
function load(mode) {//----------------------------------loading post----------------------------------
	document.getElementById("loading").style.visibility = "visible";
    
	$.ajax({
		url: 'load.php?load='+loaded+'&mode='+mode,
		type: 'POST',
		data: {
			page:$(this).data('page'),
		},
		success: function(response){
			if(response){
				loading.style.visibility = "hidden";
				if(mode==1){//mode 1 for post
					$("#commentList").append(response);
					enableReply();
				}
				if(mode==2){//mode 2 for reply
					$("#replyList").append(response);
					reply=document.getElementById("replyList").getElementsByClassName("reply");
					comment=document.getElementById("commentList");
					for(var i=0;reply.length!=0;i++){
						comment.getElementsByTagName("div")[reply[0].id].appendChild(reply[0]);
					}
				}
			}
		}
	});


//if element which id is cmt-1 is detect, means that database have no more post,so this element will show "no more"
    if (document.getElementById("cmt-1")!=null){
    	loading.style.visibility = "hidden";
    	document.getElementById("cmt-1").innerHTML="<center style=\"color:#4D4D4D;font-weight:bold;\">no more</center>";
    }
}


var PostID;
function enableReply(){
$(".cmt #reply").click(function(){
  PostID=$(this).parent().attr("id").substring(4);
  $(this).parent().append($('.cmt #commentbox'));
  $(".cmt #commentbox #PostID").attr('value',''+PostID);
});
}


















