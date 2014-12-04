<?php
    session_start();

	require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();

	$demo_text = $_GET['analyseText'];
	$response = $alchemyapi->sentiment('text',$demo_text, null);
    //$respond;

	if ($response['status'] == 'OK') {

		if (array_key_exists('score', $response['docSentiment'])) {
            $respond = $response['docSentiment'];
		}else{
            $respond = array("type"=>"neutral","score"=>0.5);
            //echo json_encode( $respond );
        }
	}else {
        $respond = array("Error"=> $response['statusInfo']);
		//echo json_encode( );
	}

    echo json_encode( $respond );
    $_SESSION["result"] = $respond;


?>