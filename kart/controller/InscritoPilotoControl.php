<?php
$className = "InscritoPilotoControl";
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoEquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoEquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EquipeBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/GrupoBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$dbg = 0;

$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();

$pilotoBean = new PilotoBean();
$pilotoBusiness = new PilotoBusiness();	

$cltCampeonatoCollection = $campeonatoBusiness->findAllAtivo();
//Util::echobr ( $dbg, 'InscritoControl  $cltCampeonatoCollection', $cltCampeonatoCollection );

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) &&  ($_POST ['campeonato'] > 0) )  ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'InscritoControl  $selcampeonato', $selcampeonato );
Util::echobr ( $dbg, 'InscritoControl  selcampeonatoBean->gettipoevento()', $selcampeonatoBean->gettipoevento() );

$pessoaBean = new PessoaBean ();
$pessoaBusiness = new PessoaBusiness ();

$grupoBusiness = new GrupoBusiness ();
$grupoBean = new GrupoBean ();
$grupoBean->setsort ( "grupo.sigla" );
$grupoBean->setcampeonato($selcampeonatoBean );
Util::echobr ( $dbg, 'InscritoControl  $grupoBean', $grupoBean );
$grupos = $grupoBusiness->findByEventoSortAtivo($grupoBean);

$bean = new InscritoBean ();
$inscritoBusiness = new InscritoBusiness ();
$totalNPago = 0;
$totalPago = 0;

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( $selcampeonato );

$bean->getpostlog ();
$editar = true;
$novo = true;

Util::echobr ( $dbg, 'InscritoPilotoControl  $choice', $choice);
switch ($choice) {
	case Choice::PASSO_1 :
		$dbg = 0;
		if ($idobj > 0) {
			$bean = $inscritoBusiness->findById ( $idobj );
		}
		$idpessoa = (isset ( $_POST ['itemFK'] )) ? $_POST ['itemFK'] : null ;
		$bean->setpessoa($idpessoa);
		Util::echobr($dbg,'InscritoPilotoControl update incrito idpessoa ', $idpessoa );
		$retorno = $inscritoBusiness->salve( $bean );
		$choice = Choice::LISTAR;
		break;

	case Choice::PASSO_2 :
		$dbg = 0;
		if ($idobj > 0) {
			$bean = $inscritoBusiness->findById ( $idobj );
			
		}
		$idpessoa = Util::getIdObjeto($bean->getpessoa());
		if($idpessoa != 0){
			$idpiloto = (isset ( $_POST ['itemFK'] )) ? $_POST ['itemFK'] : 0;
			Util::echobr($dbg,'InscritoPilotoControl update piloto idpiloto ', $idpiloto );
			if($idpiloto >0){
				$pilotoBean = new PilotoBean();
				$pilotoBusiness = new PilotoBusiness();
				$pilotoBean->setid($idpiloto);
				$pilotoBean = $pilotoBusiness->findById($pilotoBean );
				Util::echobr($dbg,'InscritoPilotoControl update piloto pilotoBean ', $pilotoBean );
				if(Util::getIdObjeto($pilotoBean)>0){
					$pilotoBean ->setpessoa($idpessoa);
					Util::echobr($dbg,'InscritoPilotoControl update piloto idpessoa ', $idpessoa );
					$retorno = $pilotoBusiness->salve( $pilotoBean );
				}
			}
		}
		$choice = Choice::LISTAR;
		break;
		
	case Choice::PASSO_3 :
		$dbg = 0;
		if ($idobj > 0) {
			$bean = $inscritoBusiness->findById ( $idobj );
		}
		$idpessoa = (isset ( $_POST ['itemFK'] )) ? $_POST ['itemFK'] : null ;
		$pilotoBean = new PilotoBean();
		$pilotoBusiness = new PilotoBusiness();
		$pilotoBean->setpessoa($idpessoa);
 		$pilotoBean->setnome($bean->getnome());
		$pilotoBean->setcpf($bean->getcpf());
		$pilotoBean->setapelido($bean->getapelido());
		$pilotoBean->settelefone($bean->gettelefone());
		$pilotoBean->setemail($bean->getemail());
		$pilotoBean->setpeso($bean->getpeso());
		$pilotoBean->setdtnascimento($bean->getdtnascimento());
		Util::echobr($dbg,'InscritoPilotoControl insert piloto inscrito ', $pilotoBean );
		$retorno = $pilotoBusiness->salve( $pilotoBean );
		$choice = Choice::LISTAR;
		break;
	
	case Choice::PASSO_4 :
		$dbg = 0;
		if ($idobj > 0) {
			$bean = $inscritoBusiness->findById ( $idobj );
		}
		$idpiloto = (isset ( $_POST ['itemFK'] )) ? $_POST ['itemFK'] : null ;
		Util::echobr($dbg,'InscritoPilotoControl insert campeonato idpiloto ', $idpiloto );
		$pilotoBean = new PilotoBean();
		$pilotoBean->setid($idpiloto);
		$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness();
		$pilotoCampeonatoBean = new PilotoCampeonatoBean();
		$pilotoCampeonatoBean->setpiloto($pilotoBean);
		$pilotoCampeonatoBean->setcampeonato($selcampeonatoBean);
		Util::echobr($dbg,'InscritoPilotoControl insert campeonato pilotoCampeonatoBean', $pilotoCampeonatoBean);
		$pilotoCampeonatoBean = $pilotoCampeonatoBusiness->salve($pilotoCampeonatoBean);

		$choice = Choice::LISTAR;
		break;

	case Choice::PASSO_5 :
		$dbg =0;
		Util::echobr ( $dbg, 'InscritoPilotoControl PASSO_5 $choice', $choice);
		$collection = $inscritoBusiness->findAllSort ( $bean );
		for($i = 0; $i < count ( $collection ); $i ++) {
			$inscritoBeanLista = new InscritoBean ();
			$inscritoBeanLista = $collection [$i];
			$idpessoa = Util::getIdObjeto($inscritoBeanLista ->getpessoa());
			Util::echobr($dbg,'InscritoPilotoControl inscrito pessoa ', $idpessoa );			
			if($idpessoa == 0){
				$pessoaBean = $pessoaBusiness->findByCPF($inscritoBeanLista->getcpf());
				Util::echobr($dbg,'InscritoPilotoControl inscrito sem id pessoa ', Util::getIdObjeto($pessoaBean) );			
				if( Util::getIdObjeto($pessoaBean)!=0){
					$inscritoBeanLista->setpessoa($pessoaBean);
					$inscritoBeanLista = $inscritoBusiness->salve($inscritoBeanLista);
				}
			
			}			
		}

		$choice = Choice::LISTAR;
		break;

	case Choice::PASSO_6 :
		$dbg = 0;
		Util::echobr ( $dbg, 'InscritoPilotoControl PASSO_6 $choice', $choice);
		$collection = $inscritoBusiness->findAllSort ( $bean );
		for($i = 0; $i < count ( $collection ); $i ++) {
			$inscritoBeanLista = new InscritoBean ();
			$inscritoBeanLista = $collection [$i];
			$idpessoa = Util::getIdObjeto($inscritoBeanLista->getpessoa());
			$pilotoBean = $pilotoBusiness->findByPessoa($idpessoa);
			$idpessoa = Util::getIdObjeto($pilotoBean);
			$dbg = 0;
			Util::echobr($dbg,'InscritoPilotoControl inscrito piloto ', $idpessoa );
			$dbg = 0;
			if($idpessoa == 0){
				$pessoaBean = $pessoaBusiness->findByCPF($inscritoBeanLista->getcpf());
				$pilotoBean = $pilotoBusiness->findByCPF($inscritoBeanLista->getcpf());
				Util::echobr($dbg,'InscritoPilotoControl piloto sem id pessoa ', Util::getIdObjeto($pessoaBean) );			
				Util::echobr($dbg,'InscritoPilotoControl idpiloto ', Util::getIdObjeto($pilotoBean) );			
				if( Util::getIdObjeto($pessoaBean)!=0 && Util::getIdObjeto($pilotoBean)){
					$pilotoBean->setpessoa($pessoaBean);
					$pilotoBean = $pilotoBusiness->salve($pilotoBean );
				}else{
					$mensagem = "Alguns registros não foram encontrados";
				}
			}			
		}
		$choice = Choice::LISTAR;
		break;
	
	
}

switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($inscritoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
	    //$totalCategorias  = $categoriaBusiness->
	    $totalPilotosGrupos = $grupoBusiness->totalPilotosGruposByCampeonato ( $selcampeonato );
		$collection = $inscritoBusiness->findAllSort ( $bean );
		$totalDtPago = $inscritoBusiness->totalComDtPagamento ( $selcampeonato );
		$totalNDtPago = $inscritoBusiness->totalSemDtPagamento ( $selcampeonato );
		$totalPago = $inscritoBusiness->totalPago ( $selcampeonato );
		$totalNPago = $inscritoBusiness->totalNPago ( $selcampeonato );
		$urlC = LISTAR;
		break;
	case Choice::SALVAR :
		$retorno = $inscritoBusiness->salve( $bean );
		$bean = $retorno->getresposta ();
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $inscritoBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		$cltCampeonatoCollection = $campeonatoBusiness->findAll ();
		$cltPessoaCollection = $pessoaBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);





?>