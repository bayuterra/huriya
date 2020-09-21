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

function login($username,$pass){
	$url="https://www.999dice.com/api/web.aspx";
	$param=[
		"a"           => "Login",
		"Key"         => "14effa7fe5544337a903960b4488b3ac",
		"Username"    => $username,
		"Password"    => $pass,
		"Totp"        => "" 
	];
	$pos = build($param);
	$akun=curl("POST",$url,$pos);
	return $akun;
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

if($_POST['a'] == 'Login'){
  $username = $_POST['Username']
  $pass = $_POST['Password']
  echo login($username,$pass)
}
if($_POST['a'] == 'GetBalance'){
  $sesi = $_POST['s'];
  echo bal($sesi)
}
