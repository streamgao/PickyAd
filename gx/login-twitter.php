<?php
if($_GET['code'] == 1) { show_source(__FILE__);}
require_once 'twitter/twitteroauth.php';
require_once 'config/twconfig.php';

session_start();

$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
// Requesting authentication tokens, the parameter is the URL we will be redirected to

//$request_token = $twitteroauth->getRequestToken('http://onlinewebapplication.com/Facebook2/getTwitterData.php');
$request_token = $twitteroauth->getRequestToken('http://pickyad-env.elasticbeanstalk.com/gx/getTwitterData2.php');
//$request_token = $twitteroauth->getRequestToken('http://liuctic.com/gx/getTwitterData.php');

// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// If everything goes well..
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
?>
