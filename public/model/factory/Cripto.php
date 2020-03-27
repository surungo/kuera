<?php
include_once 'aes.class.php';
class Cripto {
	public function Cripto() {
	}
	public static function geraKey() {
		$key = AES::keygen ( AES::KEYGEN_128_BITS, "E4HD9h4DhS23DYfhHemkS3Nf" ); // 32 chars
		
		$_SESSION ['key_cripto'] = $key;
		$_SESSION ['aes_cripto'] = serialize ( new AES ( $key ) );
	}
	public static function encrypt($value) {
		if (isset ( $_SESSION ['aes_cripto'] )) {
			$aes = unserialize ( $_SESSION ['aes_cripto'] );
			$key = $_SESSION ['key_cripto'];
			return Cripto::encrypt2 ( $aes->encrypt ( $value ), $key );
		} else {
			return $value;
		}
	}
	public static function decrypt($value) {
		if (isset ( $_SESSION ['aes_cripto'] )) {
			$aes = unserialize ( $_SESSION ['aes_cripto'] );
			$key = $_SESSION ['key_cripto'];
			return $aes->decrypt ( Cripto::decrypt2 ( $value, $key ) );
		} else {
			return $value;
		}
	}
	public static function encrypt2($string, $key) {
		$result = Cripto::encrypt3 ( $string, $key );
		return base64_encode ( $result );
	}
	public static function encrypt3($string, $key) {
		$result = '';
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) + ord ( $keychar ) );
			$result .= $char;
		}
		return $result;
	}
	public static function decrypt2($string, $key) {
		$result = '';
		$string = base64_decode ( $string );
		return Cripto::decrypt3 ( $string, $key );
	}
	public static function decrypt3($string, $key) {
		$result = '';
		
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) - ord ( $keychar ) );
			$result .= $char;
		}
		return $result;
	}
	public static function randomString($length = 6) {
		$str = "";
		$characters = array_merge ( range ( 'A', 'Z' ), range ( 'a', 'z' ), range ( '0', '9' ) );
		$max = count ( $characters ) - 1;
		for($i = 0; $i < $length; $i ++) {
			$rand = mt_rand ( 0, $max );
			$str .= $characters [$rand];
		}
		return $str;
	}
	public static function randomNumber($length = 6) {
		$str = "";
		$characters = array_merge ( range ( '0', '9' ) );
		$max = count ( $characters ) - 1;
		for($i = 0; $i < $length; $i ++) {
			$rand = mt_rand ( 0, $max );
			$str .= $characters [$rand];
		}
		return $str;
	}
	public static function mineCharInt($string) {
		$chaves = array (
				"r" => 0,
				"t" => 1,
				"n" => 2,
				"m" => 3,
				"c" => 4,
				"l" => 5,
				"s" => 6,
				"f" => 7,
				"g" => 8,
				"b" => 9 
		);
		$return = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$return .= $chaves [$char];
		}
		return $return;
	}
	public static function mineIntChar($string) {
		$chaves = array (
				'r',
				't',
				'n',
				'm',
				'c',
				'l',
				's',
				'f',
				'g',
				'b' 
		);
		$return = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$return .= $chaves [$char];
		}
		return $return;
	}
	public static function peCharInt($string) {
		$chaves = array (
				"p" => 0,
				"e" => 1,
				"r" => 2,
				"n" => 3,
				"a" => 4,
				"m" => 5,
				"b" => 6,
				"u" => 7,
				"c" => 8,
				"o" => 9 
		);
		$return = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$return .= $chaves [$char];
		}
		return $return;
	}
	public static function peIntChar($string) {
		$chaves = array (
				'p',
				'e',
				'r',
				'n',
				'a',
				'm',
				'b',
				'u',
				'c',
				'o' 
		);
		$return = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$return .= $chaves [$char];
		}
		return $return;
	}
	public static function getNewKeySession() {
		usleep ( 1 );
		$micro_date = microtime ();
		$date_array = explode ( " ", $micro_date );
		date_default_timezone_set('America/Sao_Paulo');
		$date = date ( "YmdHis", $date_array [1] );
		$time = ($date_array [0] * pow ( 10, 6 ));
		
		// echo $date.$time."\n";
		$date = Cripto::mineIntChar ( $date );
		$time = Cripto::peIntChar ( $time );
		$string = $date . $time;
		
		// echo $string."\n";
		$randNuns = Cripto::randomNumber ( 12 );
		
		$return = $string;
		for($i = 0; $i < strlen ( $randNuns ); $i ++) {
			$char = substr ( $randNuns, $i, 1 );
			$addpos = rand ( 0, strlen ( $return ) - 1 );
			if ($addpos == 0) {
				$return = $char . $return;
			} else if ($addpos == strlen ( $return ) - 1) {
				$return = $return . $char;
			} else {
				$return = substr ( $return, 0, $addpos ) . $char . substr ( $return, $addpos );
			}
		}
		
		return $return;
	}
	public static function getDatetimeKeySession($keysession) {
		$keysession = preg_replace ( array (
				'/\d/',
				'/\s/' 
		), '', $keysession, - 1, $count );
		
		$str = "";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$str .= $char . Cripto::randomString ( 1 );
		}
		$sizedate = 14;
		$sizeall = strlen ( $keysession );
		$sizetime = $sizeall - $sizedate;
		return Cripto::mineCharInt ( substr ( $keysession, 0, $sizedate ) ) . Cripto::peCharInt ( substr ( $keysession, $sizedate, $sizetime ) );
	}
	public static function microtime_float() {
		usleep ( 10000 );
		list ( $usec, $sec ) = explode ( " ", microtime () );
		return (( float ) $usec + ( float ) $sec);
	}
}

?>

