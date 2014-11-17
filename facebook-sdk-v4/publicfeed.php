<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/17/14
 * Time: 2:52 AM
 */

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/FacebookJavaScriptLoginHelper.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\FacebookJavaScriptLoginHelper;


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


echo "get session!";
echo $_SESSION["fb_user_details"];



?>