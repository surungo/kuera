<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoEsquemaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontuacaoEsquemaBusiness.php';

$bean = new PontuacaoEsquemaBean ();
$pontuacaoEsquemaBusiness = new PontuacaoEsquemaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pontuacaoEsquemaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $pontuacaoEsquemaBusiness->findAllSort ( $bean );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		$retorno = $pontuacaoEsquemaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		// opcional server como padrao desta pagina
		$bean->setsort ( (isset ( $_POST ['clsort'] )) ? $_POST ['clsort'] : 'nome desc' );
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		
		if ($idobj > 0) {
			$bean = $pontuacaoEsquemaBusiness->findById ( $idobj );
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