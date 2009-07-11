<?php
require_once 'Flickr/API.php';

# create a new api object


function display($userid) {
	$api =& new Flickr_API(array(
				'api_key'  => '0970dea5db5023bf4da15b0d7062e1b3',
				'api_secret' => $secret
				));

	// call a method

	$response = $api->callMethod('flickr.test.echo', array(	'foo' => 'bar'	));

	// check the response

	if ($response){
		// response is an XML_Tree root object
		var_dump($response);
	}else{
		// fetch the error
		$code = $api->getErrorCode();
		$message = $api->getErrorMessage();
		print_r("<pre>\n$code : $message\n </pre>");
	}
}

?>

<html>
<head>
<title>GearSpyr</title>
</head>
<body>
</body>
</html>

