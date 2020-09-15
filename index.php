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

function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);
}

function trade( $sesi,$hash,$bet,$hi,$lo ) {
	$url  = "https://www.999dice.com/api/web.aspx";
	$param= [
		"a"              => "PlaceBet",
		"s"              => $sesi,
		"PayIn"          => $bet,
		"Low"            => $lo,
		"High"           => $hi,
		"ClientSeed"     => $hash,
		"Currency"       => "doge",
		"ProtocolVersion" => 2  
	];
	$pos = build($param);
	return curl("POST",$url,$pos); 
}

$sesi = $_POST['s'];
$hash = "HURIYA".rand_string(7);
$bet = $_POST['PayIn'];
$hi = $_POST['High'];
$lo = $_POST['Low'];

echo trade($sesi,$hash,$bet,$hi,$lo);


?>
