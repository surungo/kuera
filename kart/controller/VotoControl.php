<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/VotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/VotoBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorCategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoCategoriaGrupoBusiness.php';

$dbg = 0;

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();

$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
$eleitorCategoriaGrupoBusiness = new EleitorCategoriaGrupoBusiness ();
$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
$candidatoCategoriaGrupoBusiness = new CandidatoCategoriaGrupoBusiness ();

//$selcampeonatobean = new CampeonatoBean ();
//$campeonatoBusiness = new CampeonatoBusiness ();
$tipos = array(TipoEventoEnum::ELEICAO);
$cltCampeonatoCollection = $campeonatoBusiness->findByTipos($tipos);

//$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
// campeonato ativo
//$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
$selcampeonatoBean = $campeonatoBusiness->atualByTipo ($tipos[0]);
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : Util::getIdObjeto($selcampeonatoBean);
Util::echobr ( 0, 'VotoControl $selcampeonato', $selcampeonato );

$bean = new VotoBean ();
$votoBusiness = new VotoBusiness ();
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setEleitorCategoriaGrupo ( (isset ( $_POST ['eleitorcategoriagrupo'] )) ? $_POST ['eleitorcategoriagrupo'] : 0 );
$bean->setCandidatoCategoriaGrupo ( (isset ( $_POST ['candidatocategoriagrupo'] )) ? $_POST ['candidatocategoriagrupo'] : 0 );


$bean->getpostlog ();
if($usuarioLoginBean->getperfil ()==1){
	$editar = true;
	$novo = true;
}else{
	$editar = false;
	$novo = false;
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($votoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		if( $selcampeonato < 1){
			$collection = $votoBusiness->findAllSort ( $bean );
		}else{
			$collection = $votoBusiness->findByCampeonato($selcampeonato );
		}
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $votoBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto($bean);
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $votoBusiness->findById ( $idobj );
			$eleitorCategoriaGrupo = $bean->geteleitorcategoriagrupo();
			$candidatosclt = $candidatoCategoriaGrupoBusiness->findAllNotEleitor($eleitorCategoriaGrupo);
			$idobj = Util::getIdObjeto($bean);
		}
		
		$urlC = EDITAR;
		break;
		
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);?>