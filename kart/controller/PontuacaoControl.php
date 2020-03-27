<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontuacaoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PosicaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PosicaoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoEsquemaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PontuacaoEsquemaBusiness.php';

$bean = new PontuacaoBean ();
$pontuacaoBusiness = new PontuacaoBusiness ();

$pontuacaoEsquemaBusiness = new PontuacaoEsquemaBusiness ();
$cltPontuacaoEsquemaSelecionar = $pontuacaoEsquemaBusiness->findAll ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$bean->setposicao ( (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : null );
$bean->setpontuacaoesquema ( (isset ( $_POST ['pontuacaoesquema'] )) ? $_POST ['pontuacaoesquema'] : null );
$pontuacaoesquemade = ((isset ( $_POST ['pontuacaoesquemade'] )) ? $_POST ['pontuacaoesquemade'] : null);
$pontuacaoesquemapara = ((isset ( $_POST ['pontuacaoesquemapara'] )) ? $_POST ['pontuacaoesquemapara'] : null);

$bean->getpostlog ();
$editar = true;
$novo = true;

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pontuacaoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	case Choice::SALVA_U :
		if ($choice != Choice::EXCLUIR) {
			$retorno = $pontuacaoBusiness->copiarEsquema ( $pontuacaoesquemade, $pontuacaoesquemapara );
			if ($retorno != null) {
				$idobj = ($retorno->getresposta () != null) ? $retorno->getresposta () : 0;
			}
		}
	case Choice::LISTAR :
		$collection = $pontuacaoBusiness->findAll ();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$retorno = $pontuacaoBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pontuacaoBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$posicaoBusiness = new PosicaoBusiness ();
		$cltPosicaoSelecionar = $posicaoBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>