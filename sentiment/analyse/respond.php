<?php
    /*-------------database-------------*/
    $user_name = "stream";
    $password = "gaoxi123";
    $database = "mindfullamp";
    $hostname = "aaglnrhc6ky1th.ch5sjbwjm96s.us-west-2.rds.amazonaws.com";

    $connect_db = mysql_connect($hostname, $user_name, $password);
    $find_db = mysql_select_db($database);


    session_start();
    //sentiment analysis
    require_once 'alchemyapi.php';
    $alchemyapi = new AlchemyAPI();

    $demo_text = $_GET['analyseText'];
    $response = $alchemyapi->sentiment('text', $demo_text, null);
    //$respond;
    if ($response['status'] == 'OK') {

        if (array_key_exists('score', $response['docSentiment'])) {
            $respond = $response['docSentiment'];
        } else {
            $respond = array("type" => "neutral", "score" => "0.5");
            //echo json_encode( $respond );
        }
    } else {
        $respond = array("Error" => $response['statusInfo']);
        //echo json_encode( );
    }

    echo json_encode($respond);
    $_SESSION["result"] = $respond;


    $type = $response['type'];
    $score = $response['score'];
    $mixed = $response['mixed'];

    if ($type == "positive") {
        $type = "1";
    } else if ($type == "negative") {
        $type = "2";
    } else { //netural
        $type = "0";
    }

    if ($mixed == null) {
        $mixed = "0";
    }

    //update database
    if($find_db) {
        $query = "UPDATE emotion  SET type='$type',score='$score'  WHERE id=1 ";
        $result = mysql_query($query);

        if( $result ) {
            echo "update successfully!";
        }
    }


?>