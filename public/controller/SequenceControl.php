<?php
include_once PATHPUBBEAN . '/SequenceBean.php';
include_once PATHPUBBUS . '/SequenceBusiness.php';
include_once PATHPUBFAC . '/Util.php';

$bean = new SequenceBean ();
$sequenceBusiness = new SequenceBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->settabela ( (isset ( $_POST ['tabela'] )) ? $_POST ['tabela'] : null );

$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($sequenceBusiness->delete ( $idobj )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $sequenceBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $sequenceBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $sequenceBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>