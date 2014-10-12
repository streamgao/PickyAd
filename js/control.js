var currentQuestionId=0;
var jsonObjArray = null;

function jsonObj(id,title, logo, right){
    this.answer_id= id;
    this.answer_title = title;
    this.answer_logo =logo;
    this.answer_right =right;
}

$(document).ready(function(){
//window.addEventListener("load", function(){
    currentQuestionId=1;
    jsonObjArray =[];
    console.log(jsonObjArray+"kk");
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
    console.log(jsonObjArray+"jsonarray");
    $.get("request.php?op=returnAnswerList&question_id="+currentQuestionId, function (data) {  //request data
        var json = JSON.parse(data);

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


            listgot.addEventListener("click",clickcall ); //click listgot

        }//for

        var rightanswer= document.getElementById("right");
        console.log("rightanswer");
        console.log(rightanswer);
        rightanswer.addEventListener("click", function(){
            clickAnswer( rightanswer ) } ,false );

    });//get
}


//Controller.prototype.clickAnswer = function ( ) {    it failed
function clickAnswer( answer ){
    alert("answer");
    var thisRight = answer;
    if (thisRight.style.background != "#d9dcdf" && thisRight.style.background != " ") {     //if it is chosen,return back
        var temp = thisRight.style.background;
        thisRight.style.background = "#d9dcdf";

    }else{ //do nothing
    }
}


function clickcall(evt){
    console.log(currentQuestionId+"hdjf");
    console.log(jsonObjArray+"hdjf"+j1);

    console.log(evt.target);
    var s = evt.target;
    var img = s.style.background;
    console.log(img);
    document.getElementById("right").style.background = img;     // to the right answer

    //right show yes.  else show no/
    if ( evt.target['answer_right']== 1) {
        if (confirm("Right Answer. Click to Next.")) {
            currentQuestionId++;
            loadVideo(currentQuestionId);
            loadQuestions(currentQuestionId);
        }else{}
    }else {
        $("#right").className = "rightAnswerOutline"; //change the style if it is wrong
    }//else
    evt.target.style.background = "#ffffff";

}

