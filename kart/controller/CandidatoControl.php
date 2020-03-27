<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CandidatoCategoriaGrupoBusiness.php';


include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$pessoaBusiness = new PessoaBusiness ();
$pessoabean = new PessoaBean ();

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$categoriaGrupoBean = new CategoriaGrupoBean ();
$categoriaGrupoBusiness = new CategoriaGrupoBusiness ();
$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
$candidatoCategoriaGrupoBusiness = new CandidatoCategoriaGrupoBusiness ();

//$selcampeonatobean = new CampeonatoBean ();
//$campeonatoBusiness = new CampeonatoBusiness ();
$tipos = array(TipoEventoEnum::ELEICAO);
$cltCampeonatoCollection = $campeonatoBusiness->findByTipos($tipos);

//$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
// campeonato ativo
//$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
//$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : null;
Util::echobr ( 0, 'CandidatoControl $selcampeonato', $selcampeonato );

$bean = new CandidatoBean();
$candidatoBusiness = new CandidatoBusiness();
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );

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
$bean->setpessoa($pessoabean);


$cltCategoriasGruposSelecionadas = array ();

$multi = (isset ( $_POST ['idcategoriagrupo'] )) ? $_POST ['idcategoriagrupo'] : null;
$N = count( $multi );
Util::echobr(0,'$multi',$multi);
Util::echobr ( 0, "CandidatoControl N", $N );

if($N<1){
	Util::echobr ( 0, "CandidatoControl N", $N );
	$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
	$candidatoCategoriaGrupoBean->setCategoriaGrupo(0);
	$candidatoCategoriaGrupoBean->setCandidato ($bean->getid ());
	$cltCategoriasGruposSelecionadas [] = $candidatoCategoriaGrupoBean;
}

for($i = 0; $i < $N; $i ++) {
	$candidatoCategoriaGrupoBean = new CandidatoCategoriaGrupoBean ();
	$candidatoCategoriaGrupoBean->setCategoriaGrupo ( $multi [$i] );
	Util::echobr ( $dbg, "CandidatoControl multi [i]", $multi [$i]);
	$candidatoCategoriaGrupoBean->setCandidato ($bean->getid () );
	$cltCategoriasGruposSelecionadas [] = $candidatoCategoriaGrupoBean;
	
}

$bean->setcandidatoCategoriaGrupo( $cltCategoriasGruposSelecionadas );


$validarCPF = false;
$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($candidatoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		if($selcampeonato==null || $selcampeonato < 1){
			$collection = $candidatoBusiness->findAllSort ( $bean );
		}else{
			$collection = $candidatoBusiness->findByCampeonato($selcampeonato);
		}
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $candidatoBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $candidatoBusiness->findById ( $idobj );
			$pessoabean = $bean->getpessoa();
			
			$cltCategoriasGruposSelecionadas = $candidatoCategoriaGrupoBusiness->findByCandidato($bean);
		}
		$cltCategoriasGruposCollection = $categoriaGrupoBusiness->findByCampeonato ( $selcampeonato );
		
		Util::echobr ( $dbg, 'CandidatoControl $cltCategoriasGruposCollection', $cltCategoriasGruposCollection );
		
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
	
	case Choice::VALIDAR :
		$pessoabean = $pessoaBusiness->findByCPF( $pessoabean->getcpf() );
		Util::echobr ( $dbg, "CandidatoControl VALIDA pessoa id ()", Util::getIdObjeto($pessoabean) );
		if($pessoabean->getcpf()==null||$pessoabean->getcpf()==""){
			$pessoabean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
			$idobj = 0;
		}else{
			$candidatobean = $candidatoBusiness->findByPessoa($pessoabean);
			Util::echobr ( $dbg, "CandidatoControl VALIDA candidatobean->getid ()", $candidatobean->getid () );
			if ($candidatobean->getid () != null && $candidatobean->getid () != 0) {
				$bean = $candidatobean;
				$idobj = $bean->getid ();
			}
		}
		$cltCategoriasGruposCollection = $categoriaGrupoBusiness->findByCampeonato ( $selcampeonato );
		
		Util::echobr ( $dbg, "EleitorControl $cltCategoriasGruposCollection", $cltCategoriasGruposCollection );
			
		$usuarioCollection = $usuarioBusiness->findAll ();
		$validarCPF = false;
		$urlC = EDITAR;
		break;
		
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>