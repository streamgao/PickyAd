/**
 * Created by stream on 11/22/14.
 */

function now(){
    this.now=new Date();
//  this.year= this.now.getFullYear();
// this.date= this.now.getDate();
    this.month= this.now.getMonth()+1;
    this.today = this.now.getFullYear() + "-" + this.month + "-" + this.now.getDate();
}


var messageSend = " ";
$( document ).ready(function() {   //in order to load fetch.js before facebook.js
    messageSend = "";
});


function publicFeed( accessToken ) {
    console.log('Welcome!  Fetching your information.... ');
    /*FB.api('/me/home','get',
     function(response) {
     console.log('p Successful login for: ' + response);
     var jsonD =  {data:JSON.stringify(response)};
     console.log("jsonD:", response);
     });*/

    $.get('https://graph.facebook.com/me/feed?access_token='+accessToken, function (feeds) {  //request data
        console.log(feeds.data);
        var feed = feeds.data;
        var today = new now();

        for(var i=0; i< feed.length; i++){
            if( feed[i]['updated_time'].substr(0, 10) == today.today ){
                if( feed[i]['message']!=null ){
                    //console.log(i+","+feed[i]['message']);
                    messageSend += feed[i]['message'];
                    console.log( messageSend );
                }
            }//if time today
        }
        console.log( "1"+ messageSend );
        callAnalysis( messageSend );
    });//get feed

    console.log( "2"+ messageSend );
}//publicfeed


function callAnalysis( messageAll ){
    console.log( "3"+ messageAll );
    $.get("analyse/respond.php?analyseText="+messageAll, function(json){
        //var score = JSON && JSON.parse(json) || $.parseJSON(json);
        var score = JSON.parse(json);
        console.log("result2");
        console.log(json);
        console.log("[]"+score['type']);
        console.log("."+score.type);

    });
    $.getJSON("analyse/respond.php?analyseText="+messageAll, function(data){
        console.log("result3");
        console.log(data);
    });

}