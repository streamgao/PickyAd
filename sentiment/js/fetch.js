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
        console.log( "1"+ messageSend );
    });//get feed
    console.log( "2"+ messageSend );

    callAnalysis( messageSend );

}//publicfeed


function callAnalysis( messageAll ){
    console.log( "3"+ messageAll );
    $.getJSON("analyse/respond.php?analyseText="+messageAll, function(json){
        //var score = JSON && JSON.parse(json) || $.parseJSON(json);
        var score = jQuery.parseJSON(json);
        var s = JSON.parse(json);
        console.log("result2");
        console.log(data);
        console.log(score);
    });
    $.getJSON("analyse/respond.php?analyseText="+messageAll, function(data){
        //var score = JSON.parse( data,function(k,v){} );
        console.log("result3");
        console.log(data.data);
        console.log(data.result);
    });
    $.ajax({

        url: "analyse/respond.php?analyseText="+messageAll,
        type: "GET",
        dataType: "jsonp",
        async:false,
        success: function (msg) {
            console.log("result22");
            console.log(msg);
        },
        error: function () {
            console.log("resulterror");
            ErrorFunction();
        }

    });

}