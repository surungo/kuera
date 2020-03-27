<?php
include_once PATHPUBBEAN . '/SistemaBean.php';
include_once PATHPUBBUS . '/SistemaBusiness.php';
include_once PATHPUBFAC . '/Util.php';

$bean = new SistemaBean ();
$sistemaBusiness = new SistemaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setcodigo ( (isset ( $_POST ['codigo'] )) ? $_POST ['codigo'] : null );

$editar = true;
$novo = true;
for($i = 0; $i < count ( $itemCollection ); $i ++) {
	$itemBean = new ItemBean ();
	$itemBean = $itemCollection [$i];
	if ($itemBean->getcodigo () == "SISTEMA_EDITAR") {
		$editar = true;
	}
	if ($itemBean->getcodigo () == "SISTEMA_NOVO") {
		$novo = true;
	}
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($sistemaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $sistemaBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $sistemaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $sistemaBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>