<?php
    /**
     * Created by IntelliJ IDEA.
     * User: stream
     * Date: 11/23/14
     * Time: 1:25 PM
     */

    $user_name = "stream";
    $password = "gaoxi123";
    $database = "mindfullamp";
    $hostname = "aaglnrhc6ky1th.ch5sjbwjm96s.us-west-2.rds.amazonaws.com";

    $connect_db = mysql_connect($hostname, $user_name, $password);
    $find_db = mysql_select_db($database);


    session_start();
    $result = $_SESSION["result"];
    /*
    $type = $result['type'];
    $score = $result['score'];
    $mixed = $result['mixed'];

    if ( $type == "positive" ){
        $type = "1";
    }else if( $type == "negative" ){
        $type = "2";
    }else {  //netural
        $type = "0";
    }

    if( $mixed==null ){
        $mixed = "0";
    }
    */

    if ($find_db) {
        $query = "SELECT type,score,mixed FROM emotion WHERE id=1 ";
        $result = mysql_query($query);

        while ($field = mysql_fetch_row($result)) {
            $type = $field[0];
            $score = $field[1];
            $mixed = $field[2];
        }
        $resultFix = array("type" => $type, "score" => $score, "mixed" => $mixed);

    } else {
        $resultFix = array("error" => "databse connection fail");
    }
    echo json_encode($resultFix);


?>