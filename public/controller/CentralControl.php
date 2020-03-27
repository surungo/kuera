<?php
ob_start ();
session_start ();

include_once PATHAPP.'/config/serverDefinition.php';
/*if($_SERVER['SERVER_PORT']==4006){
	include_once 'config/serverDefinition.USBW.php';
}else{
	include_once 'config/serverDefinition.php';
}*/

include_once PATHAPPVER.'/public/model/factory/importManager.php';

include_once PATHAPPVER.'/public/controller/LogonControl.php';

?>