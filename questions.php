<?php

$user_name="stream";
$password="gaoxi123";
$database="pickyad";
$hostname="aaglnrhc6ky1th.ch5sjbwjm96s.us-west-2.rds.amazonaws.com";

$connect_db = mysql_connect($hostname, $user_name , $password);
$find_db = mysql_select_db($database);

//get differernt methods
if($_SERVER['REQUEST_METHOD'] === "POST" ){
    $method = $_POST['method'];
}else{
    $method = $_GET['method'];
}

$name = $_GET['name'];
$comment = $_GET['comment'];

if($find_db) {
    $query = "INSERT INTO suggestion where author='$name' and comments='$comment' ";
    $result = mysql_query($query);

}



?>