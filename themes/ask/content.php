<link rel="stylesheet" href="<?php echo $Template ?>ask/ext/ask.css">
<link rel="stylesheet" href="<?php echo $Template ?>ask/ext/summary.css">

<iframe id="PostAction" name="PostAction" style="display:none" src="?p=st_post" ></iframe>
<div id="PostList">
</div>
<center id="loadstatus" style="color:#4D4D4D;font-weight:bold;"><img src="<?php echo $Template?>ask/ext/loading.gif" id="loading"></img></center>
			
<div id="hideCon" style="display:none">
    <div class="questions">
        <div class="question-summary" id="" onclick="loaddetail($(this).attr('id'))">
            <div class="question-review">
                <div class="status-question block"></div>
                <div class="status-answer block"></div>
                <div class="views block"></div>
            </div>
            <div class="summary">
                <a class="h3"></a><br>
                <div class="asker summaryblock"></div><br>
                <div class="time summaryblock"></div>
            </div>
        </div>
    </div>
    
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