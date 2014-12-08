<?php
require_once 'twitter/twitteroauth.php';
require_once 'config/twconfig.php';

echo "why cannot go to https://twitter.com/oauth/authorize?oauth_token=";
echo ('why cannot go to');
echo ("whysa;ldkj");

$twitteroauth = new TwitterOAuth('YC6UqKwK4fcw8edeyPH56uDzh', 'PpsNoAhXle1Vpq1ppi9Pk9q043j7yNNAUYHfWUwEExTzYbx07r');
objdump($twitteroauth);
// Requesting authentication tokens, the parameter is the URL we will be redirected to
//$request_token = $twitteroauth->getRequestToken('http://onlinewebapplication.com/Facebook2/getTwitterData.php');
$request_token = $twitteroauth->getRequestToken('http://pickyad-env.elasticbeanstalk.com/Facebook_Twitter/getTwitterData.php');

echo($request_token);
// Saving them into the session

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
