<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/PartidaBusiness.php';

$bean = new PartidaBean ();
$partidaBusiness = new PartidaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setplacar1 ( (isset ( $_POST ['placar1'] )) ? $_POST ['placar1'] : null );
$bean->setplacar2 ( (isset ( $_POST ['placar2'] )) ? $_POST ['placar2'] : null );
$bean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$bean->setdtpartida ( (isset ( $_POST ['dtpartida'] )) ? $_POST ['dtpartida'] : null );
$bean->settexto ( (isset ( $_POST ['texto'] )) ? $_POST ['texto'] : null );

$bean->getpostlog ();
if($idperfilatual==1){
    $editar = true;
    $novo = true;
}else{
    $editar = false;
    $novo = false;
}
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($partidaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $partidaBusiness->findAll( $bean );
		$urlC = LISTAR;
		break;

	case Choice::VALIDAR:
	    $collection = $partidaBusiness->atualizarApostas();
	    $urlC = LISTAR;
	    break;
	
	case Choice::SALVAR :
		$retorno = $partidaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $partidaBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>