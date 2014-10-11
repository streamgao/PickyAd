
<?php

$user_name="root";
$password="streamgao";
$database="streamgao";
$hostname="aaq6nuqdimvo68.ch5sjbwjm96s.us-west-2.rds.amazonaws.com";

$connect_db = mysql_connect($hostname, $user_name , $password);
$find_db = mysql_select_db($database);

$response = array();
$res_count = 0;

if($find_db) {
    $query = "SELECT answer.* FROM answer WHERE video_id=1";
    $result = mysql_query($query);

    while ($field = mysql_fetch_row($result)) {

        $answer_id = $field[0];
        $answer_title = $field[2];
        $answer_right = $field[3];
        $answer_logo = $field[4];

        $response[$res_count] = array(
            "answer_id" => $answer_id,
            "answer_title" => $answer_title,
            "answer_right" => $answer_right,
            "answer_logo" => $answer_logo
        );
        $res_count++;
    }

    echo json_encode($response);

}

?>