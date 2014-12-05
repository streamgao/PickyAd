<?php
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
session_start();

$twitteroauth = new TwitterOAuth(YC6UqKwK4fcw8edeyPH56uDzh, PpsNoAhXle1Vpq1ppi9Pk9q043j7yNNAUYHfWUwEExTzYbx07r);
// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('http://pickyad-env.elasticbeanstalk.com/Facebook_Twitter_2/getTwitterData.php');

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
