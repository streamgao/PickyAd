window.onload = function(){
	console.log("onLoad");
	buildQueues();
	bindEvents();

};




var theImages = [];
var theVideos = [];

function buildQueues(){
	console.log("fn:buildQueues");
	theImages.push("<div><img src=\"http://www.livbit.com/article/wp-content/uploads/2011/06/keyboardfrequencysculpture_1.jpg\"/></div>");
	theImages.push("<div><img src=\"http://i1.ytimg.com/vi/P7sdlLyOBAs/0.jpg\"/></div>");
	theImages.push("<div><img src=\"http://inhabitat.com/nyc/wp-content/blogs.dir/2/files/2014/05/NYU-ITP-Spring-Show-PrintO-Bot-537x355.jpg\"/></div>");
	theImages.push("<div><img src=\"http://www.weblogsinc.com/common/images/7820584382759138.JPG?0.17898675477542425\" /></div>");
	theImages.push("<div><img src=\"http://www.dvice.com/sites/dvice/files/styles/blog_post_media/public/images/racoon_robot_sm.jpg?itok=VE80RvfS\"/></div>");

	theVideos.push("<div><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/P7sdlLyOBAs\" frameborder=\"0\" allowfullscreen></iframe></div>");
	theVideos.push("<div><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/Z2Lo8ArN3g8\" frameborder=\"0\" allowfullscreen></iframe></div>");
	theVideos.push("<div><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/vF0W8HVR7NQ\" frameborder=\"0\" allowfullscreen></iframe></div>");
	theVideos.push("<div><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/cniLwhS4KT0\" frameborder=\"0\" allowfullscreen></iframe></div>");
	theVideos.push("<div><iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/2YZTlJFtpww\" frameborder=\"0\" allowfullscreen></iframe></div>");

}





var theImage;
var theVideo;

var theRightDiv;

function bindEvents(){
	console.log("fn:bindEvents");
	
	theRightDiv = document.getElementById("rightDiv");

	theImage = document.getElementById("theImg");
	theVideo = document.getElementById("theVid");

	theImage.addEventListener("click",onAddImage);
	theVideo.addEventListener("click",onAddVideo);
}


function onAddImage(){
	console.log("clicked add Image");
	
	if( theImages.length > 0){
		var node = document.createElement('div');
		var divIdName = "imageNewDiv";
		node.setAttribute('id', divIdName);
		node.innerHTML = theImages.shift();
		theRightDiv.appendChild(node);
	}else{
		var node = document.getElementById("theImg");
		node.innerHTML = "<h4 id=\"theImg\"><span> No More Images to show </span></h4>";
		
	}
}

function onAddVideo(){
	console.log("clicked add Video");

	if( theVideos.length > 0){
		var node = document.createElement('div');
		var divIdName = "imageNewDiv";
		node.setAttribute('id', divIdName);
		node.innerHTML = theVideos.shift();
		theRightDiv.appendChild(node);
	}else{
		var node = document.getElementById("theVid");
		node.innerHTML = "<h4 id=\"theVid\"><span> No More Videos to show </span></h4>";
		
	}
}






























