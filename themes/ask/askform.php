<input class="toask" onclick="$('#Postbox').show()" value="ask">
			<form id="Postbox" method="post" action="?p=ask_ask&mode=1" target="PostAction" enctype="multipart/form-data" style="display:none">
		    <input id="questionID" type="hidden" value="" name="PostID">
		        <span id="charlength">50 more words left until limited char</span>
				<textarea id="textInput" name="summary" height="50px" placeholder="Summary of your question...."  maxlength="50" style="height:50px;margin-bottom:20px;"
				onkeyup="$('#charlength').text((50-this.textLength)+' more words left until limited char');
					"></textarea>
					
				<textarea id="textInput" name="detail" placeholder="More details to your question...."
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="attachment" type="file" name="image"><br>
				
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Posting($(this))">
			</form>