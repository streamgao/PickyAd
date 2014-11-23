function statusChangeCallback(response) {
    //console.log(response);
    console.log(response['authResponse']['accessToken']);
    if (response.status === 'connected') {
        var AccessToken=response['authResponse']['accessToken'];
        var uid = response.authResponse.userID;
        var accessToken = response.authResponse.accessToken;

        publicFeed( accessToken );
        $.getScript("js/fetch.js", function(){
            console.log("Script loaded and executed.");
            publicFeed( accessToken );
        });

    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +  'into Facebook.';
    }
}//statusChangeCallback

//When someone finishes with the Login Button.
//See the onlogin handler attached to it in the sample code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        console.log("getLoginStatus" + response);
        statusChangeCallback(response);
    });
}//checkLoginState

window.fbAsyncInit = function() {
    FB.init({
        appId      : '770707736335720',
        cookie     : true,  // enable cookies to allow the server to access
        // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.1
    }); //init

    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);   });
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function postJSON(url, data, callback){
    var request = new XMLHttpRequest();
    request.open("POST", url);
    request.onreadystatechange = function(){
        if( request.readystate === 4 && callback){
            callback(request);
        }
    }
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(data));
}

/*
 var body = 'Reading JS SDK documentation';
 FB.api('/me/feed', 'post', { message: body }, function(response) {
 if (!response || response.error) {
 alert('Error occured');
 } else {
 alert('Post ID: ' + response.id);
 }
 });*/





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
                    messageSend + =feed[i]['message'];
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