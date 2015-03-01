<link rel="stylesheet" href="<?php echo $Template ?>ask/ext/ask.css">

<iframe id="PostAction" name="PostAction" style="display:none" src="?p=st_post" ></iframe>
<div id="PostList">
</div>
<center id="loadstatus" style="color:#4D4D4D;font-weight:bold;"><img src="<?php echo $Template?>ask/ext/loading.gif" id="loading"></img></center>
			
<div id="hideCon">
    <div class="cmt">
        <form id="Postbox" class="cmt" method="post" target="PostAction" action="?p=ask_ask">
            <input id="PostID" type="hidden" value="" name="PostID">
	        <textarea id="textInput" name="text" placeholder="Write a comment..." 
    	        onkeydown="if(event.ctrlKey&&event.keyCode==13){
		        this.parentNode.buttonSubmit.click();
		        return false};
	       	"></textarea>
		    <br>
		    <input id="buttonSubmit" type="submit" value="Answer (ctrl+enter)" onclick="Answering($(this))">
    	</form>
	</div>
</div>
<script src="<?php echo $Template ?>ask/ext/ask.js"></script>