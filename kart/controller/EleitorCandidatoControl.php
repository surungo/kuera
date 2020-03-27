<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorCategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoCategoriaGrupoBusiness.php';


include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$dbg = 1;

$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$pessoabean = new PessoaBean ();
$pessoaBusiness = new PessoaBusiness ();
$bean = $pessoabean;

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaGrupoBean = new CategoriaGrupoBean ();
$categoriaGrupoBusiness = new CategoriaGrupoBusiness ();
$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
$eleitorCategoriaGrupoBusiness = new EleitorCategoriaGrupoBusiness  ();
$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
$candidatoCategoriaGrupoBusiness = new CandidatoCategoriaGrupoBusiness ();

$eleitorbean = new EleitorBean ();
$eleitorBusiness = new EleitorBusiness ();

$candidatobean = new CandidatoBean ();
$candidatoBusiness = new CandidatoBusiness ();

//$selcampeonatobean = new CampeonatoBean ();
//$campeonatoBusiness = new CampeonatoBusiness ();
$tipos = array(TipoEventoEnum::ELEICAO);
$cltCampeonatoCollection = $campeonatoBusiness->findByTipos($tipos);

//$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
// campeonato ativo
//$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
//$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : null;
Util::echobr ( $dbg, 'EleitorCandidatoControl $selcampeonato', $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$pessoabean->setid ( $idobj );

$pessoabean->setid ( (isset ( $_POST ['idpessoa'] )) ? $_POST ['idpessoa'] : 0 );
$pessoabean->setapelido ( (isset ( $_POST ['apelido'] )) ? $_POST ['apelido'] : null );
$pessoabean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$pessoabean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$pessoabean->setdtnascimento ( (isset ( $_POST ['dtnascimento'] ) && $_POST ['dtnascimento'] != "") ? Util::strtotimestamp ( $_POST ['dtnascimento'] ) : "" );
$pessoabean->setemail ( (isset ( $_POST ['email'] )) ? $_POST ['email'] : null );
$pessoabean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
$pessoabean->settelefone ( (isset ( $_POST ['telefone'] )) ? $_POST ['telefone'] : null );
$pessoabean->settamanhocamisa ( (isset ( $_POST ['tamanhocamisa'] )) ? $_POST ['tamanhocamisa'] : null );
$pessoabean->setdtvalidaemail ( (isset ( $_POST ['dtvalidaemail'] ) && $_POST ['dtvalidaemail'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidaemail'] ) : "" );
$pessoabean->setsenha ( (isset ( $_POST ['senha'] )) ? $_POST ['senha'] : null );
$eleitorbean->setpessoa($pessoabean);
$candidatobean->setpessoa($pessoabean);

$cltEleitorCategoriasGruposSelecionadas = array ();
$cltCategoriasGruposSelecionadas = null;

$multiEleitor = (isset ( $_POST ['idcategoriagrupo_eleitor'] )) ? $_POST ['idcategoriagrupo_eleitor'] : null ;
$NEleitor = count( $multiEleitor );
Util::echobr ( $dbg, ' EleitorCandidatoControl $multiEleitor',$multiEleitor);
Util::echobr ( $dbg, ' EleitorCandidatoControl $NEleitor', $NEleitor );

if($NEleitor<1){
	
	$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
	$eleitorCategoriaGrupoBean->setCategoriaGrupo (0);
	$eleitorCategoriaGrupoBean->setEleitor ($eleitorbean->getid ());
	$cltCategoriasGruposSelecionadas [] = $eleitorCategoriaGrupoBean;
}

for($i = 0; $i < $NEleitor; $i ++) {
	$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
	$eleitorCategoriaGrupoBean->setCategoriaGrupo ( $multiEleitor [$i] );
	Util::echobr ( $dbg, 'EleitorCandidatoControl $multiEleitor [i]', $multiEleitor [$i]);
	$eleitorCategoriaGrupoBean->setEleitor ($eleitorbean->getid () );
	$cltCategoriasGruposSelecionadas [] = $eleitorCategoriaGrupoBean;
}

$eleitorbean->seteleitorCategoriaGrupo( $cltEleitorCategoriasGruposSelecionadas );

$cltCandidatoCategoriasGruposSelecionadas = array ();

$multiCandidato = (isset ( $_POST ['idcategoriagrupo_candidato'] )) ? $_POST ['idcategoriagrupo_candidato'] : null;
$NCandidato = count( $multiCandidato );
Util::echobr ( $dbg, ' EleitorCandidatoControl $multiCandidato',$multiCandidato);
Util::echobr ( $dbg, ' EleitorCandidatoControl $NCandidato', $NCandidato );

if($NCandidato<1){

	$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
	$candidatoCategoriaGrupoBean->setCategoriaGrupo (0);
	$candidatoCategoriaGrupoBean->setCandidato ($candidatobean->getid ());
	$cltCategoriasGruposSelecionadas [] = $candidatoCategoriaGrupoBean;
}

for($i = 0; $i < $NCandidato; $i ++) {
	$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
	$candidatoCategoriaGrupoBean->setCategoriaGrupo ( $multiCandidato [$i] );
	Util::echobr ( $dbg, 'EleitorCandidatoControl $multiCandidato [i]', $multiCandidato [$i]);
	$candidatoCategoriaGrupoBean->setCandidato ($candidatobean->getid () );
	$cltCategoriasGruposSelecionadas [] = $candidatoCategoriaGrupoBean;
}

$candidatobean->setcandidatoCategoriaGrupo( $cltCandidatoCategoriasGruposSelecionadas );

$validarCPF = false;
$eleitorbean->getpostlog ();
$candidatobean->getpostlog ();
$pessoabean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	case Choice::LISTAR :
		
		// em desenvolvcvimento
		$cltCategoriasGruposSelecionadas = $categoriaGrupoBusiness->findEleitorCandidatoCampeonato ( $selcampeonato );
		break;
	
	case Choice::SALVAR :
		Util::echobr ( $dbg, 'EleitorCandidatoControl antes $eleitorbean', $eleitorbean);
		$retorno = $eleitorBusiness->salve ( $eleitorbean );
		$eleitorbean = $retorno->getresposta ();
		Util::echobr ( $dbg, 'EleitorCandidatoControl depois $eleitorbean', $eleitorbean);
		$mensagem .= '<br>'.$retorno->getmensagem ();
		
		Util::echobr ( $dbg, 'EleitorCandidatoControl antes $candidatobean', $candidatobean);
		$retorno = $candidatoBusiness->salve ( $candidatobean );
		$candidatobean = $retorno->getresposta ();
		Util::echobr ( $dbg, 'EleitorCandidatoControl depois $candidatobeann', $candidatobean);
		$mensagem .= '<br>'.$retorno->getmensagem ();
		
	case Choice::ABRIR :
		if ($idobj > 0) {
			$pessoabean = $pessoaBusiness->findById ( $idobj );
			
			$cltEleitorCategoriasGruposSelecionadas = $eleitorCategoriaGrupoBusiness->findByEleitor($eleitorbean);
			$cltCandidatoCategoriasGruposSelecionadas = $candidatoCategoriaGrupoBusiness->findByCandidato($candidatobean);
		}
		
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		
		
	case Choice::VALIDAR :
		$pessoabean = $pessoaBusiness->findByCPF( $pessoabean->getcpf() );
		Util::echobr ( $dbg, 'EleitorControl VALIDA pesoa id ()', Util::getIdObjeto($pessoabea) );
		if($pessoabean->getcpf()==null||$pessoabean->getcpf()==""){
			$pessoabean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
			$idobj = 0;
		}else{
			$eleitorbean = $eleitorBusiness->findByPessoa($pessoabean->getid());
			Util::echobr ( $dbg, 'EleitorControl VALIDA eleitorbean->getid ()', $eleitorbean->getid () );
			
			$candidatobean = $candidatoBusiness->findByIdPessoa($pessoabean->getid());
			Util::echobr ( $dbg, 'EleitorControl VALIDA $candidatobean->getid ()', $candidatobean->getid () );
			if ($pessoabean->getid () != null && $pessoabean->getid () != 0) {
				$bean = $pessoabean;
				$idobj = $pessoabean->getid ();
			}
		}
		
		Util::echobr ( $dbg, 'EleitorControl $cltCategoriasGruposCollection', $cltCategoriasGruposCollection );
				
		$validarCPF = true;
		$urlC = EDITAR;
		break;
		
}
$usuarioCollection = $usuarioBusiness->findAll ();
$cltCategoriasGruposCollection = $categoriaGrupoBusiness->findByCampeonato ( $selcampeonato );

$urlC = EDITAR;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>