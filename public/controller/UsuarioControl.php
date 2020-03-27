<?php
include_once PATHPUBBEAN . '/ItemBean.php';
include_once PATHPUBBEAN . '/UsuarioBean.php';
include_once PATHPUBBUS . '/UsuarioBusiness.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBUS . '/PerfilBusiness.php';

include_once PATHPUBFAC . '/Util.php';

$bean = new UsuarioBean ();
$usuarioBusiness = new UsuarioBusiness ();

$perfilBean = new PerfilBean ();
$perfilBusiness = new PerfilBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setusuario ( (isset ( $_POST ['usuario'] )) ? $_POST ['usuario'] : null );
$bean->setemail ( (isset ( $_POST ['email'] )) ? $_POST ['email'] : null );
$bean->setsenha ( (isset ( $_POST ['senha'] )) ? $_POST ['senha'] : null );
$bean->setperfil ( (isset ( $_POST ['perfil'] )) ? $_POST ['perfil'] : null );

$senha = false;
$editar = false;
$novo = false;
for($i = 0; $i < count ( $itemCollection ); $i ++) {
	$itemBean = new ItemBean ();
	$itemBean = $itemCollection [$i];
	if ($itemBean->getcodigo () == "USUARIO_ALTERAR_SENHA") {
		$senha = true;
	}
	if ($itemBean->getcodigo () == "USUARIO_EDITAR") {
		$editar = true;
	}
	if ($itemBean->getcodigo () == "USUARIO_NOVO") {
		$novo = true;
	}
	if ($itemBean->getcodigo () == "USUARIO_EXCLUIR") {
		$excluir = true;
	}
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($usuarioBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $usuarioBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $usuarioBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $usuarioBusiness->findById ( $idobj );
		}
		$perfilCollection = $perfilBusiness->findAll ();
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>