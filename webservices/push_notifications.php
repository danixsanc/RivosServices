<?php





$postdata = file_get_contents("php://input"); 

$data = json_decode($postdata);



$Gcm_Id = $data->Gcm_Id;

$Message = $data->Message;

$Type = $data->Type;







// API access key from Google API's Console

define( 'API_ACCESS_KEY', 'AIzaSyCSGDg5Si6gvM8VKApwIiM8K9AUjzD9P_E' );

$registrationIds = array( $Gcm_Id );

// prep the bundle
if ($Type == 'A') {
	$message = 'Nueva Solicitud.';
}
if ($Type == 'B') {
	$message = 'Tu taxista va en camino';
}



$msg = array

(

	'message' 	=> $message,

	'val'		=> $Type,

	'title'		=> 'This is a title. title',

	'subtitle'	=> 'This is a subtitle. subtitle',

	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',

	'vibrate'	=> 300,

	'sound'		=> 1,

	'largeIcon'	=> 'large_icon',

	'smallIcon'	=> 'small_icon'

);

$fields = array

(

	'registration_ids' 	=> $registrationIds,

	'data'			=> $msg

);

 

$headers = array

(

	'Authorization: key=' . API_ACCESS_KEY,

	'Content-Type: application/json'

);

 

$ch = curl_init();

curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );

curl_setopt( $ch,CURLOPT_POST, true );

curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

$result = curl_exec($ch );

curl_close( $ch );

echo $result;

?>

