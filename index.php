<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PickyAd--STREAM GAO</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/DialogBySHF.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>

<div id="container">
    <div id="title" class="title" >Unknown Name</div>
    <div class="subcontainer">
        <div class="questions">

            <video id="video" controls>
                <source id="source" src="https://s3-us-west-2.amazonaws.com/video-gao/video1.mp4" type="video/mp4">
                Congradulations!! Your browser does not support the video tag.
            </video>

            <div class="answerList">
                <div class="answer">
                    <div class="rightAnswer" id="right"></div>
                </div>
                <div class="line"> </div>
                <div id="list">
                    <div class="list" id="0"></div>
                    <div class="list" id="1"></div>
                    <div class="list" id="2"></div>
                    <div class="list" id="3"></div>
                    <div class="list" id="4"></div>
                    <div class="list" id="5"></div>
                    <div class="list" id="6"></div>
                    <div class="list" id="7"></div>
                    <div class="list" id="8"></div>
                </div>
            </div>
        </div>   <!--question-->
    </div>
    <div class="footer"> @2014 by Stream Gao. ITP</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/DialogBySHF.js"></script>
<script type="text/javascript" src="js/control.js"> </script>
</html>