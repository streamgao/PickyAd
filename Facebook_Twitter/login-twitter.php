<?php
require_once 'twitter/twitteroauth.php';
require_once 'config/twconfig.php';

session_start();

$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
// Requesting authentication tokens, the parameter is the URL we will be redirected to
//var_dump($twitteroauth);
$request_token = $twitteroauth->getRequestToken('http://pickyad-env.elasticbeanstalk.com/Facebook_Twitter/getTwitterData.php');

//var_dump($twitteroauth);die();
//var_dump($request_token); die();
// Saving them into the session

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// If everything goes well..
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    //echo $url; die();
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
?>
