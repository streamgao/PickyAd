/**
 * Created by stream on 11/22/14.
 */

function now(){
    this.now=new Date();
//  this.year= this.now.getFullYear(); this.month= this.now.getMonth()+1; this.date= this.now.getDate();
    this.today = this.now.getFullYear() + "-" + this.now.getMonth()+1 + "-" + this.now.getDate();
}

function publicFeed( accessToken ) {
    console.log('Welcome!  Fetching your information.... ');
    /*FB.api('/me/home','get',
     function(response) {
     console.log('p Successful login for: ' + response);
     var jsonD =  {data:JSON.stringify(response)};
     console.log("jsonD:", response);
     });*/
    $.get('https://graph.facebook.com/me/feed?access_token='+accessToken, function (feeds) {  //request data
        //console.log("http/feeds2"+data);
        console.log(feeds);
        console.log(feeds.data);
        console.log(feeds.data.length);
        var feed = feeds.data;

        var today = new now();
        console.log( today.today );

        for(var i=0; i< feed.length; i++){

            if( feed[i]['message']!=null ){
                console.log(i+","+feed[i]['message']);
                console.log( feed[i]['updated_time'].substr(0, 9) );

            }
        }
    });





}//publicfeed