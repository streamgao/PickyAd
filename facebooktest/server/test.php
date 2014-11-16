<?php
/**
 * Created by IntelliJ IDEA.
 * User: stream
 * Date: 11/16/14
 * Time: 4:23 PM
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

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

// Initialize application by Application ID and Secret
FacebookSession::setDefaultApplication('1457172401177965','30e55c87aba6e6e7e8aaed380e37f170');


try {
    $access_token = $_POST['access_token'];
    $session = new FacebookSession( $access_token );
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