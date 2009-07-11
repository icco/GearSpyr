<?php
require_once 'Flickr/API.php';

if(isset($_POST['userid'])) 
	display($_POST['userid']);

function display($userid) {
	// create a new api object
	$api =& new Flickr_API(array(
				'api_key'  => '0970dea5db5023bf4da15b0d7062e1b3',
				'api_secret' => $secret
				));

	// call a method

	$response = $api->callMethod('flickr.people.findByUsername', array(
				'username' => $userid	
				));
	if (!$response){
		// fetch the error
		$code = $api->getErrorCode();
		$message = $api->getErrorMessage();
		print_r("<pre>\n$code : $message\n </pre>");
	}

	$user = new SimpleXMLElement($response->get());
	$userNSID = $user->user['nsid'];

	$response = $api->callMethod('flickr.people.getPublicPhotos', array(
				'user_id' => $userNSID	
				));
	if (!$response){
		// fetch the error
		$code = $api->getErrorCode();
		$message = $api->getErrorMessage();
		print_r("<pre>\n$code : $message\n </pre>");
	}
	$userPhotosXML = new SimpleXMLElement($response->get());

	$userPhotos = array();

	foreach($userPhotosXML->photos->photo as $photo) 
		$userPhotos[] = $photo["id"];



	print "<pre>"; 	print_r($userPhotos); print "</pre>";
}

?>

<html>
<head>
<title>GearSpyr</title>
</head>
<body>
<form method="post">
Username: <input type="text" name="userid" />
<input type="submit" value="Submit" />
</form>
</body>
</html>

