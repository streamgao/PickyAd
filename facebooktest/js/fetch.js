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
        console.log( today.today );

        for(var i=0; i< feed.length; i++){
            if( feed[i]['updated_time'].substr(0, 10) == today.today ){
                if( feed[i]['message']!=null ){
                    console.log(i+","+feed[i]['message']);
                }
            }
        }
    });





}//publicfeed