<?php
ob_end_clean();
if($_GET['code']==1) { show_source(__FILE__); die();}

$dbg = 0;
if($_GET['dbg'] == 1) {$dbg=1;}
if($dbg) { echo "0<br/>\n";}
require "twitter/twitteroauth.php";
if($dbg) { echo "1<br/>\n";}
require_once 'config/twconfig.php';
if($dbg) { echo "2<br/>\n";}
session_start();
if($dbg) { echo "3<br/>\n";}
$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
if($dbg) { echo "4<br/>\n";}
// Requesting authentication tokens, the parameter is the URL we will be redirected to 

//$request_token = $twitteroauth->getRequestToken('http://onlinewebapplication.com/Facebook2/getTwitterData.php'); 
//$request_token = $twitteroauth->getRequestToken('http://pickyad-env.elasticbeanstalk.com/twitter/getTwitterData.php'); 
$request_token = $twitteroauth->getRequestToken('http://onlinewebapplication.com/gx/getTwitterData.php');
if($dbg) { echo "5<br/>\n";}
if($dbg) {
    echo "<pre>\n";
    var_dump($request_token);
    echo "</pre>\n";
}

// Saving them into the session 
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
if($dbg) {
    echo "<pre>\n";
    var_dump($_SESSION);
    echo "</pre>\n";
}
// If everything goes well.. 
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect 
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    if($dbg) { echo "URL: $url\n"; die();}
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error. 
    die('Something wrong happened.');
}
?> 