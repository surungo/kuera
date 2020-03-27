<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoEquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoEquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$dbg = 0;

$bean = new EquipeBean ();
$equipeBusiness = new EquipeBusiness ();

$categoriaBusiness = new CategoriaBusiness ();
$categoriaBean = new CategoriaBean ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'EquipeControl  $selcampeonato', $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $selcampeonato );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setcodigoacesso ( (isset ( $_POST ['codigoacesso'] )) ? $_POST ['codigoacesso'] : null );
$bean->setcampoaux ( (isset ( $_POST ['campoaux'] )) ? $_POST ['campoaux'] : null );
$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$bean->setsituacao ( (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : null );
$bean->setdtpagamento ( (isset ( $_POST ['dtpagamento'] )) ? $_POST ['dtpagamento'] : null );
$bean->setnrinscrito ( (isset ( $_POST ['nrinscrito'] )) ? $_POST ['nrinscrito'] : null );
$bean->setcategoria ( (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : null );
$bean->setinscritolider ( (isset ( $_POST ['inscritolider'] )) ? $_POST ['inscritolider'] : null );

$ativos = (isset ( $_POST ['ativos'] )) ? $_POST ['ativos'] : "A" ;
$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	case Choice::DESATIVAR :
		$retorno = $equipeBusiness->desativar ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();
		echo "<script>$(document).ready(function() { $('#formDefault').submit(); });</script>";
		$choice = Choice::LISTAR;
		break;
	case Choice::VALIDAR :
		$retorno = $equipeBusiness->ativar ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();
		echo "<script>$(document).ready(function() { $('#formDefault').submit(); });</script>";
		$choice = Choice::LISTAR;
		break;

}



switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($equipeBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $equipeBusiness->findByCampeonato ( $selcampeonato );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $equipeBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $equipeBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		$selCategoriaCollection = $categoriaBusiness->findByCampeonato($selcampeonato);
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>