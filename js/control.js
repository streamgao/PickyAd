var currentQuestionId=0;
var jsonObjArray = [];
var clickedOne = -1;     // the last list clicked

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
            //source.attr("src", obj['video_add'] );
            source.src=obj['video_add'];
            document.getElementById("video").load();
        }
    );//get
}


function loadQuestions ( currentQuestionId ){

    $.get("request.php?op=returnAnswerList&question_id="+currentQuestionId, function (data) {  //request data

        var json = JSON.parse(data);
        jsonObjArray = json;
        for (var i = 0; i < 9; i++) {  // load the answers
            var listgot = null;
//            if( currentQuestionId ==1 ){
//                listgot = document.createElement("DIV");
//                listgot.setAttribute("class", "list");
//                listgot.setAttribute("id", i);
//            }else{
                listgot = document.getElementById(i);
           // }
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
    console.log(clickedOne);

    if ( clickedOne !=-1 ) {     //if it is chosen,return back
        alert(clickedOne);
        var temp = thisRight.style.background;
        thisRight.style.background = "#d9dcdf";

        var lastClicked = document.getElementById(clickedOne);
        lastClicked.style.background = temp;
       // clickedOne = -1;  // after clicked, set the last clicked one to -1. ensure no one in the history of clicked

    }else{ //do nothing
    }
}


function clickList(evt){

    var targetOne = evt.target;
    var clickedOne = targetOne.getAttribute("id");

    console.log(targetOne);
    console.log(targetOne.getAttribute("id"));
    console.log(clickedOne);
    document.getElementById("right").style.background = targetOne.style.background;     // to the right answer
    evt.target.style.background = "#ffffff";

    //right show yes.  else show no/
    if ( jsonObjArray[clickedOne]['answer_right']== 1) {
        if (confirm("Right Answer. Click to Next.")) {
            currentQuestionId++;
            loadVideo(currentQuestionId);
            loadQuestions(currentQuestionId);
        }else{}
    }else {
        $("#right").className = "rightAnswerOutline"; //change the style if it is wrong
    }//else

}

