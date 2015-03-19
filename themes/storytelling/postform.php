		
		<input class="anonymousbutton" type="submit" value="匿名发表" 
		onclick="
		if($(this).val()=='匿名发表'){
            $('.defaultpost').hide();
            $('.anonymouspost').show();
            $(this).val('恢复');
		}
        else{
            $('.defaultpost').show();
            $('.anonymouspost').hide();
            $(this).val('匿名发表');
        }
		" >
		
		
		<form id="Postbox" class="defaultpost" method="post" action="?p=st_post" target="PostAction" enctype="multipart/form-data">
	    <input id="PostID" type="hidden" value="" name="PostID">
			<textarea id="textInput" name="text" placeholder="share somethings to school..." 
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
			<span class="upload_btn" >Upload picture<input type="file" name="image" class="upload_input"></span>
			
			<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Posting($(this))">
		</form>
		
		<form id="Postbox" class="anonymouspost" method="post" action="?p=st_post&mode=anonymous" target="PostAction" enctype="multipart/form-data" style="display:none">
		<img style="height: 50px; border: medium none;margin-top:10px" src="themes/ask/ext/incognito.png">
	    <input id="PostID" type="hidden" value="" name="PostID">
			<textarea id="textInput" name="text" placeholder="Even you are anonymous.... well you know what should behave." 
			onkeydown="if(event.ctrlKey&&event.keyCode==13){
				this.parentNode.buttonSubmit.click();
				return false};
				"></textarea>
			<span class="upload_btn" >Upload picture<input type="file" name="image" class="upload_input"></span>
			
			<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Posting($(this))">
		</form>