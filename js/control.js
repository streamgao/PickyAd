var currentQuestionId=0;

//$(document).ready(function(){
window.addEventListener("load", function(){
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

        for (var i = 0; i < 9; i++) {  // load the answers
            var listgot = null;
            if( currentQuestionId ==1 ){
                listgot = document.createElement("DIV");
                listgot.setAttribute("class", "list");
                listgot.setAttribute("id", i);
            }else{
                listgot = document.getElementById(i);
            }
            listgot.style.background = "#ffffff url(" + json[i]['answer_logo'] + ") center center no-repeat";
            listgot.style.backgroundSize = "100%, 100%";
            console.log( listgot);
            console.log( json[i] );
            var ans = document.getElementById("list");
            ans.appendChild(listgot);
            var selectedOne = json[i];

            listgot.addEventListener("click",function(evt) {

                    var js = JSON.parse(data);
                    document.getElementById("right").style.background = "url("+selectedOne['answer_logo']+") center center no-repeat";     // to the right answer
                    console.log(  document.getElementById("right") );
                    evt.target.style.background = "#ffffff";
                    //right show yes.  else show no/
                    if ( selectedOne['answer_right']== 1) {
                        if (confirm("Right Answer. Click to Next.")) {
                            currentQuestionId++;
                            loadVideo(currentQuestionId);
                            loadQuestions(currentQuestionId);
                        }else{}
                    }else {
                        $("#right").className = "rightAnswerOutline"; //change the style if it is wrong
                    }//else

            }); //click listgot

        }//for

        var rightanswer= document.getElementById("right");
        console.log("rightanswer");
        console.log(rightanswer);
        rightanswer.addEventListener("click", function(){
            clickAnswer( rightanswer ) } ,false );
//    var rightanswer=$("#right")[0];
//    console.log("rightanswer");
//    console.log(rightanswer);
//    rightanswer.click(
//        clickAnswer( rightanswer )
//    );

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


/*$(document).ready( function() {
 var control = new Controller(1,0,false);
 control.currentQuestionId = 1;
 control.isFinish = false;
 console.log(control);

 $.get("request.php?op=returnVideo&question_id=1", function (data) {

 var obj = JSON.parse(data);
 console.log(obj);
 var title = document.getElementById("title");
 title.innerHTML = obj['video_title'];    //set title
 console.log(title.innerHTML);
 console.log(title);

 var video = document.getElementById("video");
 console.log(video);
 var source = document.getElementById("source");
 console.log(source);
 source.attr("src", obj['video_add'] );
 document.getElementById("video").load();
 }
 );//get


 $.get("request.php?op=returnAnswerList&question_id=1", function (data) {
 var json = JSON.parse(data);
 console.log(json);

 for (var i = 0; i < 9; i++) {
 var listgot = document.createElement("DIV");
 listgot.setAttribute("class", "list");
 listgot.setAttribute("id", i);
 console.log(json[i]);
 listgot.style.background = "#ffffff url(" + json[i]['answer_logo'] + ") center center no-repeat";
 listgot.style.backgroundSize = "100%, 100%";
 //listgot.addEventListener("click", control.clickAnswer( listgot,json[i] );
 //listgot.innerHTML = json[i]['answer_title'];

 var ans = document.getElementById("list");
 var answerList= $("#list");
 ans.appendChild(listgot);
 }
 }
 );//get

 $(".rightAnswer").addEventListener("click", function()}{});

 }  );   //document.ready
 */