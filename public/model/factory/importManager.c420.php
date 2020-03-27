<?php
define ( 'PAGDEFAULT', 4 );
define ( 'ENCRIPT_LINK', false );

define ( 'PRJROOT', 'kart' );
define ( 'DBPREFIXPUB', 'public_' );
// http://ns.metha.srv.br/phpmyadmin
define ( 'HOST', 'localhost' );
define ( 'DATABASE', 'c420' );
define ( 'DBUSERNAME', 'c420' );
define ( 'DBPASSWORD', '*nc$spWQ' );

$pathAPP = $pathAPP==""?substr ( dirname ( __FILE__ ), strlen ( $_SERVER ['DOCUMENT_ROOT'] ) + 1 ):$pathAPP;
define ( 'PATHROOT', $pathAPP );
define ( 'PATHAPP', $_SERVER ['DOCUMENT_ROOT'] . '/' . PRJROOT );
define ( 'PATHPUBROOT', 'mvc/' );
define ( 'URLROOT', 'http://' . $_SERVER ['HTTP_HOST'] );
define ( 'URLAPP', 'http://' . $_SERVER ['HTTP_HOST'] . '/' . PRJROOT );

// define('DATASOURCEMANAGER','MySQL_InnoDB.php');
// define('DATASOURCEMANAGER',PATHAPP.'/mvc/public/model/database/MySQL_MyISAM.php');
define ( 'DATASOURCEMANAGER', PATHAPP . '/mvc/public/model/database/DataSourceManager.php' );

include_once PATHAPP . '/mvc/public/model/factory/LogKuera.php';

LogKuera::log ( "start imports" );

// ---------------- PUBLIC
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
define ( 'PATHSYSCTRL', PATHAPP . '/mvc/system/controller' );
define ( 'PATHSYSBEAN', PATHAPP . '/mvc/system/model/bean' );
define ( 'PATHSYSBUS', PATHAPP . '/mvc/system/model/business' );
define ( 'PATHSYSDAO', PATHAPP . '/mvc/system/model/dao' );
define ( 'PATHSYSFAC', PATHAPP . '/mvc/system/model/factory' );
define ( 'PATHSYSPHP', PATHAPP . '/mvc/system/view/php' );
define ( 'PATHSYSHTM', PATHAPP . '/mvc/system/view/htm' );

define ( 'URLSYSCSS', URLAPP . '/mvc/system/view/css' );
define ( 'URLSYSIMG', URLAPP . '/mvc/system/view/images' );
define ( 'URLSYSJS', URLAPP . '/mvc/system/view/js' );
define ( 'URLSYSPHP', URLAPP . '/mvc/system/view/php' );
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