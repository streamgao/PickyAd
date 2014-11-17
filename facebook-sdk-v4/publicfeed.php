<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/17/14
 * Time: 2:52 AM
 */

require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSession.php";
require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRequest.php";
require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookResponse.php";
require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphObject.php";
require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphUser.php";

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\GraphObject;
use Facebook\GraphUser;


session_start();

//if($_SERVER['REQUEST_METHOD'] === "POST" ){
//    $method = $_POST['method'];
//}else{
//    $method = $_GET['method'];
//}
//
////$access_token = $_GET['access_token'];
//$access_token = $_REQUEST['code'];
//echo $access_token;
//
echo $_SESSION["color"];

echo "get session!";
echo $_SESSION["color2"];
echo $_SESSION["color3"];

echo $_SESSION["favcolor"];
echo $_SESSION["feed"];



?>