<?

$url = 'https://fcm.googleapis.com/fcm/send';
$YOUR_API_KEY = 'AAAAWMKzVKc:APA91bHX5kbvoh8XAERH7ABdloOCnNT7lsRQ1E2Ema27ebzNx4e0MyNPFVrv_EuRgYLvIgVFuqESvsOCyVzjz9_xxCrYUXyqaMlDTCuwMrjTO7YvHpQFSW1ILkmb3qbb5KBkrvEONrD2'; // Server key
$YOUR_TOKEN_ID = 'd-cGjePlo00:APA91bGSkrh8D0K_J3l4sBKBLdT8g0FlygNEO4U2_miEiULQnVWsS8cpNz3n5wZ1iSw-om0TVWsBf_mhjlQFzvWAp0G244FSUR8zKM69SbKxm2RvJk7-3KTj45vi3_AVzB-gE5h7S4V';
 
$request_body = [
	'to' => $YOUR_TOKEN_ID,
	'notification' => [
		'title' => 'CYBERSLOVO',
		'body' => 'Подписывайся на наш телеграм канал',
		'icon' => 'https://cyberslovo.ru/images/logo_main.png',
		'click_action' => 'https://cyberslovo.ru',
	],
];
$fields = json_encode($request_body);
 
$request_headers = [
	'Content-Type: application/json',
	'Authorization: key=' . $YOUR_API_KEY,
];
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;