<link rel="stylesheet" href="<?php echo $Template ?>storytelling/ext/storytelling.css">

<iframe id="PostAction" name="PostAction" style="display:none" ></iframe>
<div id="PostList">
</div>
<center id="loadstatus" style="color:#4D4D4D;font-weight:bold;"><img src="<?php echo $Template?>storytelling/ext/loading.gif" id="loading"></img></center>
			
<div id="hideCon">
    <div class="cmt">
        <form id="Postbox" class="cmt reply" method="post" target="PostAction" action="?p=st_post">
            <input id="PostID" type="hidden" value="" name="PostID">
	        <textarea id="textInput" name="text" placeholder="Write a comment..." 
    	        onkeydown="if(event.ctrlKey&&event.keyCode==13){
		        this.parentNode.buttonSubmit.click();
		        return false};
	       	"></textarea>
		    <br>
		    <input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Replying($(this))">
    	</form>
	</div>
	
	<div class="postcontent">
        <div class="cmt post" value="" id="">
    	    <div id="cmtauthor">
                <a id="plused"></a>
                <a id="user" href=""></a>
                <a id="report" onclick="report($(this))">report</a>
                <date></date>
            </div>
		    <div id="Pcontent"><div id="text"></div></div>
            <img id="postimg" onclick="bigimg($(this))" src=""></img><br>
            <a id="plus1" onclick="plus1($(this))"></a>
		    <a id="reply" onclick="doreply($(this))">reply</a>
		    <div id="ReplyList"></div>
		    <br class="clear">
	    </div>
    </div>
    
    <div class="replycontent">
        <div class="reply"><div id="cmtauthor">
            <a id="user" href=""></a>
            <date></date></div>
            <div id="Pcontent"><div id="text"></div></div>
        </div>
    </div>
</div>
<script src="<?php echo $Template ?>storytelling/ext/storytelling.js"></script>