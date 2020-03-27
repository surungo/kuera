<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/kart/config/serverDefinition.php';

$port = DBPORT;
$host = DBHOST;
$database = DBNAME;
$dbusername = DBUSERNAME;
$dbpassword = DBPASSWORD;

$PicNum = $_GET ["idobj"];
mysql_connect ( $host, $dbusername, $dbpassword ) or die ( "Impossível conectar ao banco." );
@mysql_select_db ( $database ) or die ( "Impossível conectar ao banco." );
$result = mysql_query ( "SELECT fotoimg FROM " . $database . ".kart_piloto WHERE idpiloto=$PicNum" ) or die ( "Impossível executar a query " );
$row = mysql_fetch_object ( $result );
if ($row->fotoimg == null) {
	$img1 = file ( URLROOT . '/mvc/kart/view/images/piloto.png' );
	$imF = implode ( "", $img1 );
} else {
	
	$imF = $row->fotoimg;
}
Header ( "Content-type: image/png" );
echo $imF;

?>
	
