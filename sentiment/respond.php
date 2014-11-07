<?php

	//$text = 
	require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
	

	$demo_text = $_GET['analyseText'];
	$demo_url = 'http://www.npr.org/2013/11/26/247336038/dont-stuff-the-turkey-and-other-tips-from-americas-test-kitchen';

	$response = $alchemyapi->sentiment('text',$demo_text, null);

	if ($response['status'] == 'OK') {

		if (array_key_exists('score', $response['docSentiment'])) {
			echo json_encode($response['docSentiment']);
		}else{
            echo 'da';
            //echo json_encode('type'=>'neutral','score'=>'0.5');
        }

	} else {
		echo json_encode('Error in the targeted sentiment analysis call: ', $response['statusInfo']);
	}





?>