<?php
define ( 'PAGDEFAULT', 4 );
define ( 'ENCRIPT_LINK', false );

include_once PATHAPP . '/mvc/public/model/factory/LogKuera.php';
LogKuera::log ( "start imports" );

// ---------------- PUBLIC PATH
define ( 'PATHPUBCTRL', PATHAPP . '/mvc/public/controller' );
define ( 'PATHPUBBEAN', PATHAPP . '/mvc/public/model/bean' );
define ( 'PATHPUBBUS', PATHAPP . '/mvc/public/model/business' );
define ( 'PATHPUBDAO', PATHAPP . '/mvc/public/model/dao' );
define ( 'PATHPUBFAC', PATHAPP . '/mvc/public/model/factory' );
define ( 'PATHPUBPHP', PATHAPP . '/mvc/public/view/php' );
define ( 'PATHPUBHTM', PATHAPP . '/mvc/public/view/htm' );
define ( 'PATHPUBIMG', PATHAPP . '/mvc/public/view/images' );
define ( 'PATHPUBPHPINCLUDE', PATHAPP . '/mvc/public/view/php/include' );

define ( 'URLPUBCSS', URLAPP . '/mvc/public/view/css' );
define ( 'URLPUBIMG', URLAPP . '/mvc/public/view/images' );
define ( 'URLPUBJS', URLAPP . '/mvc/public/view/js' );
define ( 'URLPUBPHP', URLAPP . '/mvc/public/view/php' );

// ---------------- SYSTEM
define ( 'PATHSYSCTRL', '/controller' );
define ( 'PATHSYSBEAN', '/model/bean' );
define ( 'PATHSYSBUS', '/model/business' );
define ( 'PATHSYSDAO', '/model/dao' );
define ( 'PATHSYSFAC', '/model/factory' );
define ( 'PATHSYSPHP', '/view/php' );
define ( 'PATHSYSHTM', '/view/htm' );

define ( 'URLSYSCSS', '/view/css' );
define ( 'URLSYSIMG', '/view/images' );
define ( 'URLSYSJS', '/view/js' );
define ( 'URLSYSPHP', '/view/php' );
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
	
	$pack = PATHAPP . 'mvc/' . $sistema . $path . "/" . $classe;
	
	require_once ($pack);
}

// ------------Mensagens---------------
$sucesso = "<font color='green'><b>Sucesso!</b></font>";
$falhou = "<font color='red'><b>Falhou!</b></font>";
define ( 'SUCESSO', $sucesso );
define ( 'FALHOU', $falhou );

// ------------Tipo de pagina---------------
define ( 'LISTAR', 'List' );
define ( 'EDITAR', 'Edit' );

include_once PATHAPP . '/mvc/public/model/factory/Choice.php';
include_once PATHAPP . '/mvc/public/model/factory/Target.php';
include_once PATHAPP . '/mvc/public/model/factory/Cripto.php';
include_once PATHAPP . '/mvc/public/model/factory/ButtonClass.php';
include_once PATHAPP . '/mvc/public/model/factory/Util.php';
// include_once PATHAPP.'/mvc/public/model/factory/ChromePhp/ChromePhp.php';
// ChromePhp::log('testetest;');
?>
<!-- importManager Success -->