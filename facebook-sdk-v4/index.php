<?php
session_start(); //Session should always be active

$app_id				= '770707736335720';  //localhost
$app_secret 		= '15d79634f7b439545f0d60328dea3998';
$required_scope 	= 'public_profile, publish_actions'; //Permissions required
$redirect_url 		= 'http://pickyad-env.elasticbeanstalk.com/facebook-sdk-v4/publicfeed.php'; //FB redirects to this page with a code

require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/autoload.php"; //include autoload from SDK folder

//import required class to the current scope
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

FacebookSession::setDefaultApplication($app_id , $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);

try {
    $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
} catch( Exception $ex ) {
    // When validation fails or other local issues
}

// see if we have a session
if ( isset( $session ) ) {
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();

    // print data
    echo  print_r( $graphObject, 1 );
} else {
    // show login url
    echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
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


	###### Save info in database ########
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_db_name);
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	$results = $mysqli->query("SELECT COUNT(*) FROM usertable WHERE id=".$user_id);
	$get_total_rows = $results->fetch_row();

	if(!$get_total_rows[0]){
		$insert_row = $mysqli->query("INSERT INTO usertable (fbid, fullname, email) VALUES(".$user_id.", '".$user_name."', '".$user_email."')");
		if($insert_row){
			print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
		}
	}
}else{

	//display login url
	$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
	echo '<a href="'.$login_url.'">Login with Facebook</a>';
}
*/

?>