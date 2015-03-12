<link rel="stylesheet" href="<?php echo $Template ?>ask/ext/ask.css">
<link rel="stylesheet" href="<?php echo $Template ?>ask/ext/summary.css">

<iframe id="PostAction" name="PostAction" style="display:none" ></iframe>
<div id="PostList">
</div>

			
<div id="hideCon" style="display:none">
    <div class="questions">
        <div class="question-summary" id="" onclick="godetail($(this).attr('id'))">
            <div class="question-review">
                <div class="status-question block"></div>
                <div class="status-answer block"></div>
                <div class="views block"></div>
            </div>
            <div class="summary">
                <div class="h3"></div><br>
                <div class="asker summaryblock"></div><br>
                <div class="time summaryblock"></div>
            </div>
        </div>
    </div><br>
    <div id="" class="question-detail">
        <div class="summary">
            <a class="status light"></a>
            <div class="detail-summary"></div>
        </div>
        <div class="detail">
            <a class="light">Detail:</a>
            <div class="detail-detail"></div>
            <img class="question-img" src="">
        </div>
        <div class="asker">Asker: <a class="user" href=""></a></div>
        <br>
        <br class="clear">
    </div>

    <div class="aboutAnswer">
        <a class="aAanswer" onclick="tab($(this));showanswers()">Answer</a>
        <a class="aAdiscuss" onclick="tab($(this));showdiscusses()">Discuss</a>
    </div>
    <div id="Answer_Discuss">
        <div id="answers"></div>
        <div id="discusses"></div>
    </div>
    <div class="answercontent">
        <div class="answer" value="">
            <div class="answerStatus" onclick=""></div>
            <div class="answer_text"></div>
            <img class="answer_img" scr=""></img>
            <div class="problemsolver">
                <a class="time"></a>
                Answer by: <a class=user href=""></a>
            </div>
        </div>
    </div>
    <div class="discusscontent">
        <div class="discuss" value="">
            <div class="discusser">
                <a class=user href=""></a>
                <a class="time"></a>
            </div>
            <div class="discuss_text text"></div>
        </div>
    </div>
    
    <div id="loadstatus">
        <center id="loading"><img src="<?php echo $Template?>ask/ext/loading.gif" id="loading"></img></center>
        <center id="nomore">No More</center>
    </div>
    
    <div class="answerbox">
        <form id="Postbox" style="height:90vh" class="cmt" method="post" target="PostAction" action="?p=ask_ask&mode=2" enctype="multipart/form-data">
            <input id="questionID" type="hidden" value="" name="questionid">
            <br><br>
				<textarea id="textInput" style="height:60vh" name="answer" placeholder="Hi liberal, we need your answer! :D"
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="attachment" type="file" name="image"><br>
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Answering($(this))">
		</form>
	</div>
	
    <div class="discussbox">
        <form id="Postbox" style="height:45vh" class="cmt" method="post" target="PostAction" action="?p=ask_ask&mode=4" enctype="multipart/form-data">
            <input id="questionID" type="hidden" value="" name="questionid">
            <br><br>
				<textarea id="textInput" style="height:20vh" name="discuss" maxlength="200" placeholder="It doesn't matter if you left some stupid discussions here."
				onkeydown="if(event.ctrlKey&&event.keyCode==13){
					this.parentNode.buttonSubmit.click();
					return false};
					"></textarea>
				<br>
				<input id="buttonSubmit" type="submit" value="Post (ctrl+enter)" onclick="Answering($(this))">
		</form>
	</div>
</div>
<script src="<?php echo $Template ?>ask/ext/ask.js"></script>