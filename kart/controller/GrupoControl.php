<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/GrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$bean = new GrupoBean ();
$grupoBusiness = new GrupoBusiness ();
$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaGrupoBean = new CategoriaGrupoBean ();
$categoriaGrupoBusiness = new CategoriaGrupoBusiness ();
$categoriaBean = new CategoriaBean ();
$categoriaBusiness = new CategoriaBusiness ();

$cltCampeonatoCollection = $campeonatoBusiness->findAllAtivo();
// campeonato ativo
$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');
//$selcampeonatoBean = $campeonatoBusiness->atual ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : $selcampeonato;
$bean->setcampeonato ( $selcampeonato );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );


$cltCategoriasSelecionadas = array ();

$multi = (isset ( $_POST ['idcategoria'] )) ? $_POST ['idcategoria'] : null;
$N = count ( $multi );
Util::echobr ( 0, "GrupoControl N", $N );

for($i = 0; $i < $N; $i ++) {
	$categoriaGrupoBeanBean = new CategoriaGrupoBean ();
	$categoriaGrupoBeanBean->setCategoria ( $multi [$i] );
	$categoriaGrupoBeanBean->setGrupo ($bean->getid () );
	$cltCategoriasSelecionadas [] = $categoriaGrupoBeanBean;
}
$bean->setCategoriaGrupo ( $cltCategoriasSelecionadas );

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($grupoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $grupoBusiness->findByCampeonato ( $selcampeonato );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		Util::echobr ( 0, "GrupoControl SALVAR id", $bean->getid() );
		$retorno = $grupoBusiness->salve ( $bean );
		$idobj = Util::getIdObjeto ( $retorno->getresposta () );
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $grupoBusiness->findById ( $idobj );
			$selcampeonato = Util::getIdObjeto ( $bean->getcampeonato () );
			$cltCategoriasSelecionadas = $categoriaGrupoBusiness->findByGrupo($bean);
		}
		$cltCategoriasCollection = $categoriaBusiness->findByCampeonato ( $selcampeonato );
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>