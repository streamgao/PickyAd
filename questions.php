<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WEEK5 DEMO BY STREAM</title>
    <link rel="stylesheet" href="xiaolong.css" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="xiaolong.js"> </script>
    <style>
        html, body {
            height: 100%;
            width: 100%;
            font-family: verdanda;
        }
        audio, canvas, video { display: inline-block; *display: inline; *zoom: 1; }

        .container{
            height: 100%;
            width: 60%;
            top: 5%;
            float: left;
            position: relative;
            left: 20%;
        }

        .mp3{
            width: 150px;
            height: 150px;
            float: left;
            position: relative;
            background: #4ec3ff;
            margin: 10px;
        }



        #menu {
            font-size: 12px;
            width: 120px;
            overflow: hidden;
            line-height: 2px;
        }

        #menu, #menu ul {
            float: left;
            list-style-type: none;
            background: #bee9ff;
            margin: 0;
            padding: 0;
            border-radius: 5px;
        }

        #menu li {
            float: left;
            width: 120px;
            border-radius: 5px;
        }

        #menu li a {
            display: block;
            padding: 10px 15px;
            color: #FFF;
            text-decoration: none;
            /*border-right: 1px solid #FFF;*/
        }
        #menu li a:hover {
            background: #1BA6B2;
        }

        #menu li ul li {
            float: none;
        }

        #menu li ul li a {
            border-top: 1px solid #FFF;
        }

        #menu li ul {
            display: none;
            position: absolute;
        }

        #menu li:hover ul {
            display: block;
        }
    </style>

</head>

<body>
<div class="container">

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
        <ul id="menu">
            <li><a href="#">Analog</a>
                <ul>
                    <li><a href="#">Menu 1-1</a></li>
                    <li><a href="#">Menu 1-1</a></li>
                    <li><a href="#">Menu 1-1</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>
    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>
    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

    <div class ="mp3">
    </div>

</div>

</div>




<body>
</html>