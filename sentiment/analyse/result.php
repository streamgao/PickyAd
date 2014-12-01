<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/23/14
 * Time: 1:25 PM
 */
session_start();

$result = _SESSION["result"];

$type = $result["type"];
$score = $result["score"];
$mixed = $result["mixed"];


if ( $type == "positive" ){
    $type = 1;
}else if( $type == "negative" ){
    $type = 2;
} else {
    $type = 0;
}

if( $mixed==null ){
    $mixed = 0;
}

$resultFix = array( "type"=>$type,"score"=>$score,"mixed"=>$mixed );
echo json_encode( $resultFix);
echo  json_encode($_SESSION["result"]);