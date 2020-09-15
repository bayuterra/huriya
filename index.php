<?php

function curl ($method,$url,$data) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER  => true,
		CURLOPT_URL             => $url,
		CURLOPT_TIMEOUT         => 300,
		CURLOPT_CUSTOMREQUEST   => $method,
		CURLOPT_POSTFIELDS      => $data,
		CURLOPT_VERBOSE         => 0
	));
	$result = curl_exec($curl);
	$code   = curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl); 
return $result; 
}
 
function build($array){
	return http_build_query($array);
}

function register($key){
$param= [
	"a"    => "CreateAccount",
	"Key"  => $key ];
$pos  = build($param);	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://cors-anywhere.herokuapp.com/https://www.999doge.com/api/web.aspx");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$pos);  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'X-Requested-With: XMLHttpRequest',
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);
return $server_output;
}

$key = "14effa7fe5544337a903960b4488b3ac";
$cur = "doge";
$gos = "";

echo register($key);
?>
