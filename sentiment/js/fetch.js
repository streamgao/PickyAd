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

function ready(){
    messageSend = "";
}

var messageSend = " ";

$( document ).ready(function() {
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
        //console.log( today.today );
        for(var i=0; i< feed.length; i++){
            if( feed[i]['updated_time'].substr(0, 10) == today.today ){
                if( feed[i]['message']!=null ){
                    //console.log(i+","+feed[i]['message']);
                    messageSend +=feed[i]['message'];
                    console.log( messageSend );
                }
            }//if time today
        }
    });//get feed


    callAnalysis( messageSend );

}//publicfeed


function callAnalysis( messageAll ){
    $.get('analyse/respond.php?analyseText='+messageSend),function(data){
        var score = JSON.parse(data);
        console.log("result"+score);
    });
}