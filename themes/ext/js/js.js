//text overflow
function chkOverFlowText(){
    $("*.readmore").remove();
    for(var i=0;i<$("*.text").length;i++){
        if($("*.text")[i].scrollHeight >  $('.text').innerHeight()){
            $("*.text")[i].parentNode.innerHTML+="<a class=\"readmore\" onclick=\"readmore($(this))\">...</a>";
        }
    }
}
function readmore(THIS){
    THIS.parent().find(".text").css({"maxHeight":"none","overflow":"auto"});
    THIS.remove();
}