<?php
include_once PATHPUBFAC . '/Util.php';
include_once 'AbstractControl.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';

$dbg =1;
$bean = new ParametroBean ();
$parametroBusiness = new ParametroBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$bean->setcodigo ( (isset ( $_POST ['codigo'] )) ? $_POST ['codigo'] : null );

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($parametroBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $parametroBusiness->findAllSort ( $bean );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
	    Util::echobr ( $dbg, 'parametroControl $ bean',  $bean );
		$retorno = $parametroBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $parametroBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);?>