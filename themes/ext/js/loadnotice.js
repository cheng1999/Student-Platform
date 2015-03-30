var loaded=0;//this var is the post number that have loaded

//initial
loadnotice();addloaded();

//loadpost();
$(window).scroll(function() {
    if (($(window).scrollTop()+$(window).height()==$(document).height())&&
        totalnotices>loaded){
	    loadnotice();
        addloaded();
	}
});

function addloaded(){
    if(loaded+20<totalnotices){
        loaded+=20;
    }
    else if(totalnotices-loaded>0){
        loaded+=totalnotices-loaded;
    }else{
        loaded++;
    }
}

//----------------------------------request the posts from server----------------------------------
var loadstatus=document.getElementById("loadstatus");

function loadquestions() {
    if (totalnotices>=loaded){
        loadmore($("#PostList"));
        $.ajax({
            url: load_url+'&load='+loaded,
            //fully url will like this: ?p=ask_loadnotice&load=20
           
		    success: function(response){
                if(response){
				    loadmore($("#PostList"));
                        eval(response);//eval is about add questions' summary to var questions
                        
                        loadnotice();
                        
                        if (totalnotices<=loaded){
                            nomore($("#PostList"));
                        }
                }
            }
        });
    }
}


//-----------------------------------------function()--------------------------------------------------
//some action listener

function loadnotice(){
    //append to postlist(layout)
    for(i=0;i<notice.length;i++){
        $("#PostList").append(
            $("#notice-content").html() //cannot use clone here because it will append one more (don know why -- someone can teach me?)
        );
    }
    
    /*
        <div id="notice">
            <span id="notice-title"></span>
            <span id="notice-time"></span>
            <span id="notice-content"></span>
        </div>
    */
    
    for(i=notice.length-1;i>=0;i--){//from the new question to old question
        $("*#notice")[i].id=notice[i].id;
        $("*#notice-title")[i].innerHTML=notice[i].title;
        $("*#notice-time")[i].innerHTML=notice[i].time;
        $("*#notice-content")[i].innerHTML=notice[i].content;
        
        (notice[i].image ? 
            $("*#notice-img")[i].setAttribute("scr",notice[i]image) :
            $("*#notice-img")[i].remove(
        );
    }
}