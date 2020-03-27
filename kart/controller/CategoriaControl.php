<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$bean = new CategoriaBean ();
$categoriaBusiness = new CategoriaBusiness ();
$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$cltCampeonatoCollection = $campeonatoBusiness->findAllAtivo();
// campeonato ativo
$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
//$selcampeonatoBean = $campeonatoBusiness->atual ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $selcampeonato;
$bean->setcampeonato ( $selcampeonato );
$bean->setvalorlote1 ( (isset ( $_POST ['valorlote1'] )) ? $_POST ['valorlote1'] : null );
$bean->setvalorlote2 ( (isset ( $_POST ['valorlote2'] )) ? $_POST ['valorlote2'] : null );
$bean->setvalorlote3 ( (isset ( $_POST ['valorlote3'] )) ? $_POST ['valorlote3'] : null );
$bean->setregulamento ( (isset ( $_POST ['regulamento'] )) ? $_POST ['regulamento'] : null );
$bean->setrequisitos ( (isset ( $_POST ['requisitos'] )) ? $_POST ['requisitos'] : null );
$bean->getpostlog ();

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($categoriaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $categoriaBusiness->findByCampeonato ( $selcampeonato );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $categoriaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $categoriaBusiness->findById ( $idobj );
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