<?php
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBEAN . '/PaginaPerfilBean.php';
include_once PATHPUBBUS . '/PaginaPerfilBusiness.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBUS . '/PerfilBusiness.php';
include_once PATHPUBBEAN . '/PaginaBean.php';
include_once PATHPUBBUS . '/PaginaBusiness.php';

include_once PATHPUBFAC . '/Util.php';

$bean = new PaginaPerfilBean ();
$paginaPerfilBean = new PaginaPerfilBean ();
$paginaPerfilBusiness = new PaginaPerfilBusiness ();

$perfilBean = new PerfilBean ();
$perfilBusiness = new PerfilBusiness ();

$paginaBean = new PaginaBean ();
$cltPagina = array ();
$paginaBusiness = new PaginaBusiness ();

$multi = (isset ( $_POST ['idpagina'] )) ? $_POST ['idpagina'] : null;
$N = count ( $multi );

for($i = 0; $i < $N; $i ++) {
	$paginaBean = new PaginaBean ();
	$paginaBean->setId ( $multi [$i] );
	$cltPagina [] = $paginaBean;
}
$paginaPerfilBean->setpagina ( $cltPagina );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$perfilBean->setid ( $idobj );
$paginaPerfilBean->setperfil ( $perfilBean );

$editar = true;
$novo = false;
for($i = 0; $i < count ( $itemCollection ); $i ++) {
	$itemBean = new ItemBean ();
	$itemBean = $itemCollection [$i];
	if ($itemBean->getcodigo () == "PERFIL_EDITAR") {
		$editar = true;
	}
	if ($itemBean->getcodigo () == "PERFIL_NOVO") {
		$novo = true;
	}
	if ($itemBean->getcodigo () == "PERFIL_EXCLUIR") {
		$excluir = true;
	}
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($paginaPerfilBusiness->delete ( $paginaPerfilBean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $perfilBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $paginaPerfilBusiness->salvePaginaPerfil ( $paginaPerfilBean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $paginaPerfilBusiness->findByPerfil ( $perfilBean );
		}
		$bean->setperfil ( $perfilBusiness->findById ( $perfilBean->getid () ) );
		$cltPagina = $paginaBusiness->findAll ();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>