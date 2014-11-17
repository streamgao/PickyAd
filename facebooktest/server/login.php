<?php
/**
 * Created by IntelliJ IDEA.
 * User: wenzhongchi
 * Date: 11/13/14
 * Time: 9:27 PM
 */

session_start();

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

// Initialize application by Application ID and Secret
FacebookSession::setDefaultApplication('770707736335720', '15d79634f7b439545f0d60328dea3998');

// Login Healper with reditect URI
$helper = new FacebookRedirectLoginHelper( 'http://pickyad-env.elasticbeanstalk.com' );

try {
    $session = $helper->getSessionFromRedirect();
}
catch( FacebookRequestException $ex ) {
    // Exception
}
catch( Exception $ex ) {
    // When validation fails or other local issues
}

// Checking Session
if( isset($session) )
{
    // Request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // Responce
    $data = $response->getGraphObject();

    // Print data
    echo  print_r( $data, 1 );
}
else
{
    // Login URL if session not found
    echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
}
?>