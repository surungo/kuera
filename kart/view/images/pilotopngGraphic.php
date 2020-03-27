<?php
ob_start ();
session_start ();

include_once $_SERVER ['DOCUMENT_ROOT'] . '/kart/config/serverDefinition.php';
/*
 * $host = "localhost"; $username = "c420"; $password = '*nc$spWQ'; $db = "c420"; $PicNum = $_GET["idobj"]; mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); @mysql_select_db($db) or die("Impossível conectar ao banco."); $result=mysql_query("SELECT fotoimg FROM c420.kart_piloto WHERE idpiloto=$PicNum") or die("Impossível executar a query "); $row=mysql_fetch_object($result); Header( "Content-type: image/png");
 */

$PicNum = 1;
$PicNum = (isset ( $_GET ["idobj"] ) && $_GET ["idobj"] > 0) ? $_GET ["idobj"] : 1;
// $apelido = isset($_GET["apelido"])?$_GET["apelido"]:"foto";
$urlfoto = URLAPP . '/mvc/kart/view/images/pilotojpg.php?idobj=' . $PicNum;

$size = getimagesize ( $urlfoto );
$typeImage = $size ['mime'];
$headerImage = "Content-type: image/png";

switch ($typeImage) {
	case "image/gif" :
		$img1 = imagecreatefromgif ( $urlfoto );
		$headerImage = "Content-type: image/gif";
		break;
	case "image/jpeg" :
		$img1 = imagecreatefromjpeg ( $urlfoto );
		$headerImage = "Content-type: image/jpeg";
		break;
	case "image/png" :
		$img1 = imagecreatefrompng ( $urlfoto );
		$headerImage = "Content-type: image/png";
		break;
	case "image/bmp" :
		$img1 = imagecreatefrombmp ( $urlfoto );
		$headerImage = "Content-type: image/bmp";
		break;
	
	case "image/x-ms-bmp" :
		$img1 = imagecreatefrombmp ( $urlfoto );
		$headerImage = "Content-type: image/x-ms-bmp";
		break;
}

// Created by NerdsOfTech

// Step 1 - Start with image as layer 1 (canvas).
// $img1 = ImageCreateFromjpeg("./fractal.jpg");
$width = 0;
$height = 0;
$x = imagesx ( $img1 ) - $width;
$y = imagesy ( $img1 ) - $height;

// Step 2 - Create a blank image.
$img2 = imagecreatetruecolor ( $x, $y );
$bg = imagecolorallocate ( $img2, 255, 255, 255 ); // white background
imagefill ( $img2, 0, 0, $bg );

// Step 3 - Create the ellipse OR circle mask.
$e = imagecolorallocate ( $img2, 0, 0, 0 ); // black mask color
                                         
// Step 3 - Create the ellipse OR circle mask.
$borda = imagecolorallocate ( $img2, 250, 250, 250 ); // black mask color
                                                   
// Draw a ellipse mask
                                                   // imagefilledellipse ($img2, ($x/2), ($y/2), $x, $y, $e);
                                                   
// OR
                                                   // Draw a circle mask
$r = $x <= $y ? $x : $y; // use smallest side as radius & center shape
imagefilledellipse ( $img2, ($x / 2), ($y / 2), $r, $r, $borda );
imagefilledellipse ( $img2, ($x / 2), ($y / 2), $r - 3, $r - 3, $e );

// Step 4 - Make shape color transparent
imagecolortransparent ( $img2, $e );

// Step 5 - Merge the mask into canvas with 100 percent opacity
imagecopymerge ( $img1, $img2, 0, 0, 0, 0, $x, $y, 100 );

// Step 6 - Make outside border color around circle transparent
imagecolortransparent ( $img1, $bg );

// Step 7 - Output merged image
header ( $headerImage ); // output header
                      // header('Content-Disposition: attachment; filename="'.$apelido.$PicNum.'.png"');
                      // imagepng($img1); // output merged image
imagepng ( $img1 );

// Step 8 - Cleanup memory
imagedestroy ( $img2 ); // kill mask first
imagedestroy ( $img1 ); // kill canvas last
                     
// http://www.engecar-rs.com.br/kart/mvc/kart/view/images/pilotopngGraphic.php?idobj=144

?>
	
