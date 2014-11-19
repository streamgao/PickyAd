<?php
session_start(); //Session should always be active

$app_id				= '770707736335720';  //localhost
$app_secret 		= '15d79634f7b439545f0d60328dea3998';
$required_scope 	= 'public_profile, publish_actions'; //Permissions required
$redirect_url 		= 'http://pickyad-env.elasticbeanstalk.com/facebook-sdk-v4/publicfeed.php'; //FB redirects to this page with a code

require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/autoload.php"; //include autoload from SDK folder
require_once( 'src/Facebook/FacebookSession.php' );
require_once( 'src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'src/Facebook/FacebookRequest.php' );
require_once( 'src/Facebook/FacebookResponse.php' );
require_once( 'src/Facebook/FacebookSDKException.php' );
require_once( 'src/Facebook/FacebookRequestException.php' );
require_once( 'src/Facebook/FacebookAuthorizationException.php' );
require_once( 'src/Facebook/GraphObject.php' );
require_once( 'src/autoload.php');

//import required class to the current scope
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

FacebookSession::setDefaultApplication($app_id , $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);

if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
    // create new session from saved access_token
    $session = new FacebookSession( $_SESSION['fb_token'] );
    // validate the access_token to make sure it's still valid
    try {
        if ( !$session->validate() ) {
            $session = null;
        }
    } catch ( Exception $e ) {
        // catch any exceptions
        $session = null;
    }
}
if ( !isset( $session ) || $session === null ) {
    // no session exists
    try {
        $session = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
        // handle this better in production code
        print_r( $ex );
    } catch( Exception $ex ) {
        // When validation fails or other local issues
        // handle this better in production code
        print_r( $ex );
    }
}
// see if we have a session
if ( isset( $session ) ) {
    // save the session
    $_SESSION['fb_token'] = $session->getToken();
    // create a session using saved token or the new one we generated at login
    $session = new FacebookSession( $session->getToken() );
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject()->asArray();
    // print profile data
    echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
    // print logout url using session and redirect_uri (logout.php page should destroy the session)
    echo '<a href="' . $helper->getLogoutUrl( $session, 'http://yourwebsite.com/app/logout.php' ) . '">Logout</a>';
} else {
    // show login url
    echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '">Login</a>';
}


/*
try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
	die(" Error : " . $ex->getMessage());
} catch(\Exception $ex) {
	die(" Error : " . $ex->getMessage());
}

//if user wants to log out
if(isset($_GET["log-out"]) && $_GET["log-out"]==1){
	unset($_SESSION["fb_user_details"]);
	//session ver is set, redirect user
	header("location: ". $redirect_url);
}

//Test normal login / logout with session
$_SESSION["color"] = "red";

if ($session){ //if we have the FB session
    $_SESSION["color2"] = "red2";
	//get user data
	//$user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject( GraphUser::className() );
    $request = new FacebookRequest(
        $session,
        'GET',
        '/me/feed'
    );
    $_SESSION["color3"] = "red3";

    $response = $request->execute();
    $feed = $response->getGraphObject();

	//save session var as array
	$_SESSION["feed"] = $feed;
    $_SESSION["favcolor"] = "green";

}else{
	//session var is still there
	if(isset($_SESSION["fb_user_details"]))
	{
		print 'Hi '.$_SESSION["fb_user_details"]["name"].' you are logged in! [ <a href="?log-out=1">log-out</a> ] ';
		print '<pre>';
		print_r($_SESSION["fb_user_details"]);
		print '</pre>';
	}
	else
	{
		//display login url
		$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
		echo '<a href="'.$login_url.'">Login with Facebook</a>';
	}
}


/* Demo review
if ($session){ //if we have the FB session

	######## Fetch user Info ###########
	$user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
    $user_id =  $user_profile->getId();
    $user_name = $user_profile->getName();
	$user_email =  $user_profile->getEmail();
	$location =  $user_profile->getLocation();

    ######## Check User Permission called 'publish_actions' ##########
    $user_permissions = (new FacebookRequest($session, 'GET', '/me/permissions'))->execute()->getGraphObject(GraphUser::className())->asArray();
    $found_permission = false;
    foreach($user_permissions as $key => $val){
        if($val->permission == 'publish_actions'){
            $found_permission = true;
        }
    }

	###### post image if 'publish_actions' permission available ########
    if($found_permission){
		$image = "/home/images/image_name.jpg"; //server path to image
		$post_data = array('source' => '@'.$image, 'message' => 'This is test Message');
		$response = (new FacebookRequest( $session, 'POST', '/me/photos', $post_data ))->execute()->getGraphObject();
    }
}else{

	//display login url
	$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
	echo '<a href="'.$login_url.'">Login with Facebook</a>';
}
*/

?>