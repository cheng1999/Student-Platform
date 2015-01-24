
var showpg=1;
var automov=true;
var span=document.getElementById("btnhover").getElementsByTagName("span");

setInterval(function(){
	if(automov)mov();
	},4000);

function mov(){
		if(showpg>3){
			showpg=0;
		}else if(showpg<0){
			showpg=3;
		}

		document.getElementById("mov").style.marginLeft="-"+showpg*100+"%";
		
		for(var i=0; i<span.length;i++){
			span[i].style.opacity="0.4";
		}
		span[showpg].style.opacity="1";
		showpg++;
}

//btnhover
$( "#btnhover span" )
.mouseover(function() {
	showpg=$("#btnhover span").index(this);
	automov=false;
	mov();
})
.mouseout(function() {
	automov=true;
});


//button prev
$( "#leftmove" )
.mouseover(function() {
	this.style.opacity=0.6;
	automov=false;
})
.mouseout(function() {
	this.style.opacity=0.3;
	automov=true;
})
.click(function() {
	showpg-=2;	
	mov();
});
//button next
$( "#rightmove" )
.mouseover(function() {
	this.style.opacity=0.6;
	automov=false;
})
.mouseout(function() {
	this.style.opacity=0.3;
	automov=true;
})
.click(function() {
	mov();
});



