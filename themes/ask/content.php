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
        <a class="aAanswer" onclick="tab($(this));loadanswer()">Answer</a>
        <a class="aAdicuss" onclick="tab($(this));loaddicuss()">Dicuss</a>
    </div>
    <div id="Answer_Dicuss">
        <div id="answer"></div>
        <div id="dicuss"></div>
    </div>
    <div class="answer">
        <div class="answer_text"></div>
        <div class="answer_img"></div>
        <div class="problemsolver">Answer by: <a class=user href=""></a></div>
    </div>
    <div class="dicuss">
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
</div>
<script src="<?php echo $Template ?>ask/ext/ask.js"></script>