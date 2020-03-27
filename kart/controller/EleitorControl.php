<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaGrupoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EleitorCategoriaGrupoBusiness.php';


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
$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
$eleitorCategoriaGrupoBusiness = new EleitorCategoriaGrupoBusiness ();

//$selcampeonatobean = new CampeonatoBean ();
//$campeonatoBusiness = new CampeonatoBusiness ();
$tipos = array(TipoEventoEnum::ELEICAO);
$cltCampeonatoCollection = $campeonatoBusiness->findByTipos($tipos);

//$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
// campeonato ativo
//$selcampeonato = $parametroBusiness->findByCodigo('CAMPEONATO_PRINCIPAL');//10;
//$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonato = (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : null;
Util::echobr ( 0, 'EleitorControl $selcampeonato', $selcampeonato );

$bean = new EleitorBean ();
$eleitorBusiness = new EleitorBusiness ();
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
Util::echobr ( 0, "EleitorControl N", $N );

if($N<1){
	Util::echobr ( 0, "EleitorControl N", $N );
	$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
	$eleitorCategoriaGrupoBean->setCategoriaGrupo (0);
	$eleitorCategoriaGrupoBean->setEleitor ($bean->getid ());
	$cltCategoriasGruposSelecionadas [] = $eleitorCategoriaGrupoBean;
}

for($i = 0; $i < $N; $i ++) {
	$eleitorCategoriaGrupoBean = new EleitorCategoriaGrupoBean ();
	$eleitorCategoriaGrupoBean->setCategoriaGrupo ( $multi [$i] );
	Util::echobr ( $dbg, "EleitorControl multi [i]", $multi [$i]);
	$eleitorCategoriaGrupoBean->setEleitor ($bean->getid () );
	$cltCategoriasGruposSelecionadas [] = $eleitorCategoriaGrupoBean;

}

$bean->seteleitorCategoriaGrupo( $cltCategoriasGruposSelecionadas );


$validarCPF = false;
$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($eleitorBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		if($selcampeonato==null || $selcampeonato < 1){
			$collection = $eleitorBusiness->findAllSort ( $bean );
		}else{
			$collection = $eleitorBusiness->findByCampeonato($selcampeonato);
		}
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		if($pessoabean->getnome() != ""){
			$retorno = $eleitorBusiness->salve ( $bean );
			$bean = $retorno->getresposta ();
			$idobj = $bean->getid ();
			$mensagem = $retorno->getmensagem ();
		}else{
			$mensagem = "Preencha nome.";
		}
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $eleitorBusiness->findById ( $idobj );
			$pessoabean = $bean->getpessoa();

			$cltCategoriasGruposSelecionadas = $eleitorCategoriaGrupoBusiness->findByEleitor($bean);
		}
		$cltCategoriasGruposCollection = $categoriaGrupoBusiness->findByCampeonato ( $selcampeonato );
		
		Util::echobr ( $dbg, 'EleitorControl $cltCategoriasGruposCollection', $cltCategoriasGruposCollection );
			
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
		
	case Choice::VALIDAR :
		$pessoabean = $pessoaBusiness->findByCPF( $pessoabean->getcpf() );
		Util::echobr ( $dbg, 'EleitorControl VALIDA pesoa id ()', Util::getIdObjeto($pessoabea) );
		if($pessoabean->getcpf()==null||$pessoabean->getcpf()==""){
			$pessoabean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
			$idobj = 0;
		}else{
			$eleitorbean = $eleitorBusiness->findByPessoa($pessoabean);
			Util::echobr ( $dbg, "EleitorControl VALIDA eleitorbean->getid ()", $eleitorbean->getid () );
			if ($eleitorbean->getid () != null && $eleitorbean->getid () != 0) {
				$bean = $eleitorbean;
				$idobj = $bean->getid ();
			}
		}
		$cltCategoriasGruposCollection = $categoriaGrupoBusiness->findByCampeonato ( $selcampeonato );
		
		Util::echobr ( $dbg, "EleitorControl $cltCategoriasGruposCollection", $cltCategoriasGruposCollection );
			
		$usuarioCollection = $usuarioBusiness->findAll ();
		$validarCPF = true;
		$urlC = EDITAR;
		break;
		
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>