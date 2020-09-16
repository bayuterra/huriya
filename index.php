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

function trade( $sesi,$hash,$bet,$hi,$lo) {
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
	$js =  curl("POST",$url,$pos); 
	return $js;
}
function login($key,$username,$pass){
	$url="https://www.999dice.com/api/web.aspx";
	$param=[
		"a"           => "Login",
		"Key"         => $key,
		"Username"    => $username,
		"Password"    => $pass,
		"Totp"        => ""
	];
	$pos = build($param);
	$akun= curl("POST",$url,$pos);
	return $akun;
} 
function register($username,$password){
	$url  = "https://www.999dice.com/api/web.aspx";
	$param =[
		"a"         => "CreateUser",
		"s"         => $sesi,
		"Username"  => $username,
		"Password"  => $password ];
	$pos = build($param);
	$js  = curl("POST",$url,$pos);
	return $js;
}
function Cakun($key){
	$url  = "https://www.999dice.com/api/web.aspx";
	$param =[
		"a"           => "CreateAccount",
		"Key"         => $key
	];
	$pos = build($param);
	$js  = curl("POST",$url,$pos);
	return $js;
}
function bal($sesi){
	$url="https://www.999dice.com/api/web.aspx";
	$param=[
		"a"          => "GetBalance",
		"s"          => $sesi,
		"Currency"   => "doge"
	];
	$pos = build($param);
	$js  = curl("POST",$url,$pos);
	return $js;
}
function withdraw($sesi,$walet,$amo){
	$url  = "https://www.999dice.com/api/web.aspx";
	$param= [
		"a"                => "Withdraw",
		"s"                => $sesi,
		"Address"          => $walet,
		"Amount"           => $amo,// satoshi
		"Currency"         => "doge"   
	];
	$pos   = build($param);
	$payout= curl("POST",$url,$pos);
	return $payout;
}
function depo($sesi){
	$url = "https://www.999dice.com/api/web.aspx";
	$param = [
		"a"        => "GetDepositAddress",
		"s"        => $sesi,
		"Currency" => "doge"
	];
	$pos = build($param);
	$js  = curl("POST",$url,$pos);
	return $js;

}

if(isset($_POST['a'])) {
	$key = $_POST['Key'];
	$sesi = $_POST['s'];
	$username = $_POST['Username'];
	$pass = $_POST['Password'];
	$walet = $_POST['Address'];
	$amo = $_POST['Amount'];
	$hash = "HURIYA".rand_string(7);
	$bet = $_POST['PayIn'];
	$hi = $_POST['High'];
	$lo = $_POST['Low'];
	if($_POST['a'] == "Withdraw"){
		echo withdraw($sesi,$walet,$amo);
	}
	else if($_POST['a'] == "GetDepositAddress"){
		echo depo($sesi);
	}
	else if($_POST['a'] == "GetBalance"){
		echo bal($sesi);
	}
	else if($_POST['a'] == "PlaceBet"){
		echo trade( $sesi,$hash,$bet,$hi,$lo);
	}
	else if($_POST['a'] == "CreateAccount"){
		echo Cakun($key);
	}
	else if($_POST['a'] == "CreateUser"){
		echo register($username,$pass);
	}
	else if($_POST['a'] == "Login"){
		echo login($key,$username,$pass);
	}else{
		$na = array('Detected' => 'KONTOL');
		echo json_encode($na);
	}
}else{
		$na = array('Detected' => 'KONTOL');
		echo json_encode($na);
	}

?>
