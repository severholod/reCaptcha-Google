<?
	if ( !empty($_POST['name']) ){
		if( empty($_POST['g-recaptcha-response'])){
			http_response_code(400);	
			exit('Заполните капчу');
		}	
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$key = '6Lcg36UUAAAAAE4AhpHqkElR5CEwPQSbBre8nFKX';
		$query = $url . "?secret=" . $key . "&response=" . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
		$data = json_decode(file_get_contents($query), true);
		if ($data['success']){
			require_once 'form-process.php';
		}
		else {
			exit("Капча введена неверно");
			http_response_code(400);
		}
	}
	else {
	 http_response_code(400);
	 exit('Введите имя!');
	}
?>