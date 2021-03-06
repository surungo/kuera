<?php
//classe duplicada
class ExcluirUtilExcluir {
	public function ExcluirUtilExcluir() {
	}
	public function getPost($nomeparametro) {
		return (isset ( $_POST [$nomeparametro] )) ? mysql_real_escape_string($_POST [$nomeparametro]) : null;
	}
	
	
	public function getIdObjeto($ObjectOrString) {
		if($ObjectOrString!=null)
			return gettype ( $ObjectOrString ) == "object" ? $ObjectOrString->getid () : $ObjectOrString;
		return 0;
	}
	public function getNomeObjeto($ObjectOrString) {
		if($ObjectOrString!=null)
			return gettype ( $ObjectOrString ) == "object" ? $ObjectOrString->getnome () : $ObjectOrString;
		return '';
	}
	public function dateAdd($date, $milliseconds) {
		$saida = $date;
		if ($date != null && $milliseconds != null) {
			$saida = date ( 'Y-m-d H:i:s', strtotime ( $date ) + $milliseconds );
		}
		return $saida;
	}
	public function dateDiff($date1, $date2) {
		return strtotime ( $date1 ) - strtotime ( $date2 );
	}
	public function timestamptostr($formato, $entrada) {
		$saida = $entrada;
		if ($entrada != null && $entrada != '' && $formato != null & $formato != '') {
			$saida = date ( $formato, strtotime ( $entrada ) );
		}
		return $saida;
	}
	public function strtotimestamp($entrada) {
		$saida = $entrada;
		$piecesDataHora = explode ( " ", $entrada );
		$phora = 1;
		$pdata = 0;
		
		if (strpos ( $piecesDataHora [$phora], ':' ) > - 1 && strpos ( $piecesDataHora [$pdata], '/' ) > - 1) {
			$piecesData = explode ( "/", $piecesDataHora [$pdata] );
			$piecesHora = explode ( ":", $piecesDataHora [$phora] );
			$hor = ($piecesHora [0] != null) ? $piecesHora [0] : "0";
			$min = ($piecesHora [1] != null) ? $piecesHora [1] : "0";
			$seg = ($piecesHora [2] != null) ? $piecesHora [2] : "0";
			$dia = ($piecesData [0] != null) ? $piecesData [0] : "0";
			$mes = ($piecesData [1] != null) ? $piecesData [1] : "0";
			$ano = ($piecesData [2] != null) ? $piecesData [2] : "0";
			$timestamp = mktime ( $hor, $min, $seg, $mes, $dia, $ano );
			$saida = date ( 'Y-m-d H:i:s', $timestamp );
		} else {
			$piecesData = explode ( "/", $piecesDataHora [$pdata] );
			
			$dia = ($piecesData [0] != null) ? $piecesData [0] : "0";
			$mes = ($piecesData [1] != null) ? $piecesData [1] : "0";
			$ano = ($piecesData [2] != null) ? $piecesData [2] : "0";
			$timestamp = mktime ( 0, 0, 0, $mes, $dia, $ano );
			$saida = date ( 'Y-m-d H:i:s', $timestamp );
		}
		
		return $saida;
	}
	public function strtodate($entrada) {
		$saida = $entrada;
		return $saida;
	}
	
	public function hoje() {
		setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
		date_default_timezone_set('America/Sao_Paulo');
		
		$date = '2011-05-08';
		return strftime("%d de %B de %Y", strtotime('today'));
	}
	
	public function hojeSemana() {
		setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
		date_default_timezone_set('America/Sao_Paulo');
	
		$date = '2011-05-08';
		return strftime("%A, %d de %B de %Y", strtotime('today'));
	}
	
	public function testeData() {
		echo phpversion () . '<br>';
		
		echo '<table border=1>';
		
		$dateTimeStamp = "2013-01-31 13:13:13";
		Util::echoTR ( $dateTimeStamp, '$dateTimeStamp = "2013-01-31 13:13:13"' );
		
		/*
		 * $timestamptostr = timestamptostr('d/m/Y',$dateTimeStamp); Util::echoTR($timestamptostr, 'timestamptostr(\'d/m/Y\',$dateTimeStamp)');
		 */
		
		$strtotime = strtotime ( $dateTimeStamp );
		Util::echoTR ( $strtotime, 'strtotime($dateTimeStamp)' );
		
		$dateObj = date ( 'd/m/Y H:i', $strtotime );
		Util::echoTR ( $dateObj, '$dateObj = date(\'d/m/Y H:i\', $strtotime)' );
		
		$dateObjC = date ( 'd/m/Y H:i:s', $strtotime );
		Util::echoTR ( $dateObjC, '$dateObjC = date(\'d/m/Y H:i:s\', $strtotime)' );
		
		$dateView = $dateObj;
		Util::echoTR ( $dateView, '$dateView = $dateObj' );
		
		$dateViewC = $dateObjC;
		Util::echoTR ( $dateViewC, '$dateViewC = $dateObjC' );
		
		$dateTimeStampS = Util::strtotimestamp ( $dateView );
		Util::echoTR ( $dateTimeStampS, '$dateTimeStampS = Util::strtotimestamp($dateView)' );
		
		$dateTimeStampSC = Util::strtotimestamp ( $dateViewC );
		Util::echoTR ( $dateTimeStampSC, '$dateTimeStampSC = Util::strtotimestamp($dateViewC)' );
		
		$dateTimeStamp1 = "2013-01-31 13:10:13";
		Util::echoTR ( $dateTimeStamp1, '$dateTimeStamp1 = "2013-01-31 13:10:13"' );
		
		$dateDiff = Util::dateDiff ( $dateTimeStamp1, $dateTimeStamp );
		Util::echoTR ( $dateDiff, '$dateDiff = Util::dateDiff($dateTimeStamp1, $dateTimeStamp)' );
		
		$dateAdd = Util::dateAdd ( $dateTimeStamp, $dateDiff );
		Util::echoTR ( $dateAdd, '$dateAdd = Util::dateAdd($dateTimeStamp, $dateDiff)' );
		
		$dateTimeStampToday = $dateObj = date ( 'd/m/Y H:i' );
		Util::echoTR ( $dateTimeStampToday, '$dateTimeStampToday = $dateObj = date(\'d/m/Y H:i\');' );
		
		echo '</table>';
	}
	
	public function removeDuplicados($string,$duplicado) {
		$string = str_replace("<","[3C]",$string);
		$string = str_replace(">","[3E]",$string);
		$string = str_replace($duplicado,"><",$string);
		$string = str_replace("<>","",$string);
		$string = str_replace("><"," ",$string);
		$string = str_replace("[3C]","<",$string);
		$string = str_replace("[3E]",">",$string);
		return $string;
	}
	
	public function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	public function getTimestamp()
	{
		$micro_date = microtime();
		$date_array = explode(" ",$micro_date);
		$date = date("Y-m-d H:i:s",$date_array[1]);
		$ms = $date_array[0]*1000000;
		return $date."." .$ms ;
	}
	
	public function acento_para_html($umarray) {
		$comacento = array (
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�',
				'�' 
		);
		$acentohtml = array (
				'&Aacute;',
				'&aacute;',
				'&Acirc;',
				'&acirc;',
				'&Agrave;',
				'&agrave;',
				'&Atilde;',
				'&atilde;',
				'&Eacute;',
				'&eacute;',
				'&Ecirc;',
				'&ecirc;',
				'&Egrave;',
				'&egrave;',
				'&Oacute;',
				'&oacute;',
				'&Ocirc;',
				'&ocirc;',
				'&Ograve;',
				'&ograve;',
				'&Otilde;',
				'&otilde;',
				'&Iacute;',
				'&iacute;',
				'&Icirc;',
				'&icirc;',
				'&Igrave;',
				'&igrave;',
				'&Uacute;',
				'&uacute;',
				'&Ucirc;',
				'&ucirc;',
				'&Ugrave;',
				'&ugrave;',
				'&Ccedil;',
				'&ccedil;' 
		);
		$umarray = str_replace ( $comacento, $acentohtml, $umarray );
		return $umarray;
	}
	public function echohtml($val) {
		// echo htmlspecialchars($val, ENT_COMPAT,'ISO-8859-1', true);
		if (Util::codificacao ( $val ) == 'UTF-8') {
			// $val = iconv("CP1252", "UTF-8", $val);
			$val = iconv ( "UTF-8", "CP1252", $val );
		}
		echo $val;
		// echo Util::acento_para_html($val);
		// echo Util::codificacao($val);
	}
	public function codificacao($string) {
		return mb_detect_encoding ( $string . 'x', 'UTF-8, ISO-8859-1' );
	}
	public function echoTR($desc, $val) {
		echo "<tr><td>" . $desc . "</td><td>" . $val . "</td></tr>";
	}
	 
	
	
	public function alert($ativo, $desc, $val) {
		if ($ativo == 1) {
			echo "<script>alert('" . $desc . " - ";
			print_r ( $val );
			echo "');</script>";
		}
	}
	public function linkRelStylesheet($url) {
		if (file_exists ( $url )) {
			$pathPontoPonto = "";
			$splitPath = explode ( "/", $url );
			for($i = 0; $i < count ( $splitPath ) - 2; $i ++) {
				$pathPontoPonto .= $splitPath [$i] . "/";
			}
			echo '<!--link rel="stylesheet" href="' . $url . '" /-->';
			$data = file_get_contents ( $url );
			$convert = explode ( "\n", $data ); // create array separate by new line
			echo "<style>";
			for($i = 0; $i < count ( $convert ); $i ++) {
				echo str_ireplace ( "../", $pathPontoPonto, $convert [$i] ); // write value by index
			}
			echo "</style>";
		} else {
			
			echo "<script>alert('Arquivo " . $url . " n�o existe.')</script>";
		}
	}
	public function randomString($length = 6) {
		$str = "";
		$characters = array_merge ( range ( 'A', 'Z' ), range ( 'a', 'z' ), range ( '0', '9' ) );
		$max = count ( $characters ) - 1;
		for($i = 0; $i < $length; $i ++) {
			$rand = mt_rand ( 0, $max );
			$str .= $characters [$rand];
		}
		return $str;
	}
	public function soNumero($str) {
		return preg_replace("/[^0-9]/", "", $str);
	}
	
	public function post($str,$se_nulo){
		//return (isset ( $_POST [$str] )) ? htmlspecialchars_decode($_POST [$str]) : $se_nulo;
		//return (isset ( $_POST [$str] )) ? addslashes ($_POST [$str]) : $se_nulo;
		return (isset ( $_POST [$str] )) ?  stripslashes($_POST [$str]) : $se_nulo;
	}
}
?>