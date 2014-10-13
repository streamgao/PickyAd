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


