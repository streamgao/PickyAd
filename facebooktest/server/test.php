<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/16/14
 * Time: 8:48 PM
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

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;



session_start();
if($_SERVER['REQUEST_METHOD'] === "POST" ){
    $method = $_POST['method'];
}else{
    $method = $_GET['method'];
}

//$access_token = $_POST['access_token'];
$access_token = $_REQUEST["access_token"];
$session = new FacebookSession( $access_token );
echo $access_token;
echo $session;
echo "Adf";

// Initialize application by Application ID and Secret
$session->setDefaultApplication('1457172401177965','30e55c87aba6e6e7e8aaed380e37f170');






?>