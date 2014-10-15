/**
 * Created by stream on 10/10/14.
 */

var currentQuestionId=0;
var jsonObjArray = [];
var clickedOne = -1;     // the last list clicked
var credit = 0;

function jsonObj(id,title, logo, right){
    this.answer_id= id;
    this.answer_title = title;
    this.answer_logo =logo;
    this.answer_right =right;
}

$(document).ready(function(){
//window.addEventListener("load", function(){
    currentQuestionId=1;
    loadVideo(currentQuestionId );
    loadQuestions( currentQuestionId );
});


function loadVideo ( currentQuestionId ) {

    $.get("request.php?op=returnVideo&question_id="+currentQuestionId, function (data) {   //  or use this.currentQuestionId
            var obj = JSON.parse(data);
            var title = document.getElementById("title");
            title.innerHTML = obj['video_title'];    //set title
            var video = document.getElementById("video");
            var source = document.getElementById("source");
            source.src=obj['video_add'];
            document.getElementById("video").load();
            document.getElementById("video").play();
        }
    );//get
}

function loadQuestions ( currentQuestionId ){
    clickedOne = -1;
    document.getElementById("right").style.background = "#d9dcdf";
    $.get("request.php?op=returnAnswerList&question_id="+currentQuestionId, function (data) {  //request data

        var json = JSON.parse(data);
        jsonObjArray = json;
        for (var i = 0; i < 9; i++) {  // load the answers
            var listgot = null;
            listgot = document.getElementById(i);
            listgot.style.background = "#ffffff url(" + json[i]['answer_logo'] + ") center center no-repeat";
            listgot.style.backgroundSize = "100%, 100%";
            var ans = document.getElementById("list");
            ans.appendChild(listgot);
            var selectedOne = json[i];

            listgot.addEventListener("click",clickList ); //click listgot
        }//for
        var rightanswer= document.getElementById("right");
        rightanswer.addEventListener("click", clickAnswer);
    });//get
}



//Controller.prototype.clickAnswer = function ( ) {    it failed
function clickAnswer( evt ){
    var thisRight =  evt.target;
    if ( clickedOne !=-1 ) {     //if it is chosen,return back
        thisRight.style.border= "none";
        var temp = thisRight.style.background;
        thisRight.style.background = "#d9dcdf";
        var lastClicked = document.getElementById(clickedOne);
        lastClicked.style.background = temp;
        clickedOne = -1;  // after clicked, set the last clicked one to -1. ensure no one in the history of clicked
    }else{ //do nothing
    }
}


function clickList(evt){
    if( clickedOne==-1 ){  // if there is no previous selection
        var targetOne = evt.target;
        clickedOne = targetOne.getAttribute("id");
        document.getElementById("right").style.background = targetOne.style.background;     // to the right answer
        evt.target.style.background = "#ffffff";

        //right show yes.  else show no/
        if ( jsonObjArray[clickedOne]['answer_right']== 1) {   // go to the next question
            $.Dialog.Alert({ Width: 400, Height: 300, Title: "Right Answer!",
                Content: jsonObjArray[clickedOne]['answer_title'],
                ConfirmFun:goNext  });
            credit += 5;
        }else {
            document.getElementById("right").style.border= "3px solid red"; //change the style if it is wrong
        }//else
    }else{ }     // otherwise do nothing

}

function goNext(){
    currentQuestionId++;
    loadVideo(currentQuestionId);
    loadQuestions(currentQuestionId);

    document.getElementById("questions").style.top= 150+"%";
    $("#questions").animate({
        top: "0px"
    }, 'slow'   );

}
