<?php 

$time = date("H:i:s");
$fileName = date("d.m.Y") . '.json';
$filePath = __DIR__ . '/log/' . $fileName;
$params = '';
$seperator= (file_exists($filePath)) ? ',' : '{';
$file = fopen($filePath, "a+");

if (file_exists($filePath))
	ftruncate($file, filesize($filePath) - 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	foreach ($_POST as $key => $value) {
		$params = $params . $key . '=' . $value . '&&';
	}
} 
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	foreach ($_GET as $key => $value) {
		$params = $params . $key . '=' . $value . '&&';
	}
}

$response = [
		'url' 		=> $_SERVER['REQUEST_URI'], 
		'method' 	=> $_SERVER['REQUEST_METHOD'], 
		'code' 		=> http_response_code(), 
		'userAgent' => $_SERVER['HTTP_USER_AGENT'],
		'remoteIp' 	=> $_SERVER['REMOTE_ADDR'],
		'params' 	=> $params
];

fwrite($file, $seperator . '"' . $time . '":' . json_encode($response) . '}');
fclose($file);