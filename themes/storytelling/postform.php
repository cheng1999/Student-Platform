
		<form id="Postbox" method="post" action="?p=st_post" target="PostAction" enctype="multipart/form-data">
	    <input id="PostID" type="hidden" value="" name="PostID">
			<textarea id="textInput" name="text" placeholder="share somethings to school..." 
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
			<br>
			<input id="attachment" type="file" name="image"><br>
			
			<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Posting($(this))">
		</form>