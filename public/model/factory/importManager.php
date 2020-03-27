<?php
define ( 'PAGDEFAULT', 4 );
define ( 'ENCRIPT_LINK', false );

//include_once PATHAPP . '/mvc/public/model/factory/LogKuera.php';
//LogKuera::log ( "start imports" );

// ---------------- Packs
define ( 'CTRL', 'controller' );
define ( 'BEAN', 'model/bean' );
define ( 'BUS', 'model/business' );
define ( 'DAO', 'model/dao' );
define ( 'FAC', 'model/factory' );
define ( 'PHP', 'view/php' );
define ( 'HTM', 'view/htm' );
define ( 'IMG', 'view/images' );
define ( 'CSS', 'view/css' );
define ( 'JS', 'view/js' );
define ( 'PHPINCLUDE', 'view/php/include' );
// ---------------- PUBLIC PATH
define ( 'MGR', 'public' );
define ( 'PATHPUBCTRL', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.CTRL );
define ( 'PATHPUBBEAN', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.BEAN );
define ( 'PATHPUBBUS', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.BUS );
define ( 'PATHPUBDAO', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.DAO );
define ( 'PATHPUBFAC', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.FAC );
define ( 'PATHPUBPHP', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.PHP );
define ( 'PATHPUBHTM', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.HTM );
define ( 'PATHPUBIMG', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.IMG );
define ( 'PATHPUBPHPINCLUDE', PATHAPP . '/'.PATHVERSION.'/'.MGR.'/'.PHPINCLUDE );

define ( 'URLPUBCSS', URLAPP . '/'.PATHVERSION.'/'.MGR.'/'.CSS );
define ( 'URLPUBIMG', URLAPP . '/'.PATHVERSION.'/'.MGR.'/'.IMG );
define ( 'URLPUBJS', URLAPP . '/'.PATHVERSION.'/'.MGR.'/'.JS );
define ( 'URLPUBPHP', URLAPP . '/'.PATHVERSION.'/'.MGR.'/'.PHP );

// ---------------- SYSTEM kart
define ( 'SYSKART', 'kart' );
define ( 'PATHKARTCTRL', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.CTRL );
define ( 'PATHKARTBEAN', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.BEAN );
define ( 'PATHKARTBUS', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.BUS );
define ( 'PATHKARTDAO', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.DAO );
define ( 'PATHKARTFAC', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.FAC );
define ( 'PATHKARTPHP', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.PHP );
define ( 'PATHKARTHTM', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.HTM );
define ( 'PATHKARTIMG', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.IMG );
define ( 'PATHKARTPHPINCLUDE', PATHAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.PHPINCLUDE );

define ( 'URLKARTCSS', URLAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.CSS );
define ( 'URLKARTIMG', URLAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.IMG );
define ( 'URLKARTJS', URLAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.JS );
define ( 'URLKARTPHP', URLAPP . '/'.PATHVERSION.'/'.SYSKART.'/'.PHP );


function importManager($sistema, $classe) {
	$arrayTipos = array (
			0 => array (
					"tipos" => "DAO.php",
					"paths" => "/model/dao" 
			),
			1 => array (
					"tipos" => "Business.php",
					"paths" => "/model/business" 
			),
			2 => array (
					"tipos" => "Bean.php",
					"paths" => "/model/bean" 
			),
			3 => array (
					"tipos" => "Control.php",
					"paths" => "/controller" 
			),
			4 => array (
					"tipos" => "List.php",
					"paths" => "/view/php" 
			),
			5 => array (
					"tipos" => "Edit.php",
					"paths" => "/view/php" 
			),
			6 => array (
					"tipos" => ".htm",
					"paths" => "/view/htm" 
			),
			7 => array (
					"tipos" => ".html",
					"paths" => "/view/htm" 
			) 
	)
	;
	
	$path = "";
	foreach ( $arrayTipos as &$value ) {
		if (strpos ( $classe, $value ["tipos"] ) > - 1) {
			$path = $value ["paths"];
		}
	}
	
	$pack = PATHAPP . ''.PATHVERSION.'/' . $sistema . $path . "/" . $classe;
	
	require_once ($pack);
}

// ------------Mensagens---------------
$sucesso = "<span class='azul'><b>Sucesso!</b></span>";
$falhou = "<font color='red'><b>Falhou!</b></font>";
define ( 'SUCESSO', $sucesso );
define ( 'FALHOU', $falhou );

// ------------Tipo de pagina---------------
define ( 'LISTAR', 'List' );
define ( 'EDITAR', 'Edit' );
define ( 'REPORT', 'Report' );


include_once PATHPUBFAC.'/ParametroEmun.php';
include_once PATHPUBFAC.'/Choice.php';
include_once PATHPUBFAC.'/Target.php';
include_once PATHPUBFAC.'/Cripto.php';
include_once PATHPUBFAC.'/ButtonClass.php';
include_once PATHPUBFAC.'/Util.php';
// include_once PATHPUBFAC.'/ChromePhp/ChromePhp.php';
// ChromePhp::log('testetest;');
?>