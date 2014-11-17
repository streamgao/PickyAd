<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/16/14
 * Time: 4:09 PM
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


if($_SERVER['REQUEST_METHOD'] === "POST" ){
    $method = $_POST['method'];
}else{
    $method = $_GET['method'];
}

//$access_token = $_POST['access_token'];
$session = new FacebookSession( 'CAAK89GDZAlWgBACLA1ZAWGZA5Wi4rSq9WEZAxF1CqEEwKnwZA3w3CulPA6AQgFhg03vMERnjAFv84pp21HddtmCRlRW5ICVV9Qb5rfZCwVZC2raN6vd8ezItf8VRPaga2SjRtqvwOTwThtlbQb08cE9W5iiAcs97TR3FuO0A2tmadxxeuTW4EItKakZC9DogTG6JNmAQcWC5yAocjuQsGwBMFj3QdkWu04EZD' );
//echo $access_token;
echo $session;
echo "Adf";

// Initialize application by Application ID and Secret
$session->setDefaultApplication('1457172401177965','30e55c87aba6e6e7e8aaed380e37f170');
session_start();


if($session) {
    try {
        $user_profile = (new FacebookRequest(
            $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());
        $response[$res_count] = array(
            "user_profile" => $user_profile,
        );
        echo json_encode($response);
    } catch(FacebookRequestException $e) {
        echo "Exception occured, code: " . $e->getCode();
        echo " with message: " . $e->getMessage();
    }
}




?>