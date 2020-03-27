<?php
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBEAN . '/ItemPerfilBean.php';
include_once PATHPUBBUS . '/ItemPerfilBusiness.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBUS . '/PerfilBusiness.php';
include_once PATHPUBBUS . '/ItemBusiness.php';

include_once (PATHPUBFAC . '/Util.php');

$bean = new ItemPerfilBean ();
$itemPerfilBusiness = new ItemPerfilBusiness ();
$cltItemPerfil = array ();

$perfilBean = new PerfilBean ();
$perfilBusiness = new PerfilBusiness ();

$itemBean = new ItemBean ();
$selItemClt = array ();
$itemClt = array ();
$itemBusiness = new ItemBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;

$perfilBean->setid ( $idobj );
$perfilBean = $perfilBusiness->findById($perfilBean);

$multi = (isset ( $_POST ['idItem'] )) ? $_POST ['idItem'] : null;
$N = count ( $multi );

for($i = 0; $i < $N; $i ++) {
	$itemPerfilBean = new ItemPerfilBean();
	$itemBean = new ItemBean ();
	$itemBean->setId ( $multi [$i] );
	$itemPerfilBean->setperfil ( $perfilBean );
	$itemPerfilBean->setitem ( $itemBean );
	$cltItemPerfil [] = $itemPerfilBean;
	
}
$perfilBean->setitemperfil($cltItemPerfil);

$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($itemPerfilBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $perfilBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$result = $itemPerfilBusiness->salvePerfil( $perfilBean );
		$perfilBean = $result->getresposta();
		$mensagem = $result->getmensagem();
			
	case Choice::ABRIR :
		if ($idobj > 0) {
			$perfilBean = $perfilBusiness->findById ( $perfilBean );
		}
		$selItemClt = $itemBusiness->findAll ();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>