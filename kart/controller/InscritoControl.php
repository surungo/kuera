<?php
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
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/GrupoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/GrupoBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();
$dbg = 0;
$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
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
$bean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );

$bean->setnome ( Util::post('nome',  null ));
$bean->setevento ( Util::post('evento',  null ));
$bean->setapelido ( Util::post('apelido',  null ));
$bean->setgrupo ( Util::post('grupo',  null ));
$bean->setpeso ( Util::post('peso',  null ));
$bean->setdtnascimento ( (Util::post('dtnascimento',"") != "") ? Util::strtotimestamp ( Util::post('dtnascimento',"") ) : "" );
$bean->settelefone ( Util::post('telefone',  null ));
$bean->setemail ( Util::post('email',  null ));
$bean->settamanhocamisa ( Util::post('tamanhocamisa',  null ));
$bean->setcarro ( Util::post('carro',  null ));
$bean->setnrcarro ( Util::post('nrcarro',  null) );
$bean->setendereco ( Util::post('endereco',  null ));
$bean->setnumero ( Util::post('numero',  null ));
$bean->setcomplemento ( Util::post('complemento',null) );
$bean->setbairro ( Util::post('bairro', null) );
$bean->setcep ( Util::post('cep',  null ));
$bean->setnrcba ( Util::post('nrcba',  null ));
$bean->setcidade ( Util::post('cidade',  null ));
$bean->setuf ( Util::post('uf',  null ));

$bean->setcelular ( (isset ( $_POST ['celular'] )) ? $_POST ['celular'] : null );
$bean->settelefonecomercial ( (isset ( $_POST ['telefonecomercial'] )) ? $_POST ['telefonecomercial'] : null );
$bean->setchefeequipe ( (isset ( $_POST ['chefeequipe'] )) ? $_POST ['chefeequipe'] : null );
$bean->setipcriacao ( (isset ( $_POST ['ipcriacao'] )) ? $_POST ['ipcriacao'] : null );
$bean->setdtenvio ( (isset ( $_POST ['dtenvio'] )) ? $_POST ['dtenvio'] : null );
$bean->setcategoria( (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : null );

$bean->setsituacao ( (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : null );
$bean->setdtpagamento ( (isset ( $_POST ['dtpagamento'] ) && $_POST ['dtpagamento'] != "") ? Util::strtotimestamp ( $_POST ['dtpagamento'] ) : "" );
$bean->setnrinscrito ( (isset ( $_POST ['nrinscrito'] )) ? $_POST ['nrinscrito'] : null );
$bean->setdtvalidaemail ( (isset ( $_POST ['dtvalidaemail'] ) && $_POST ['dtvalidaemail'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidaemail'] ) : "" );
$bean->setdtinscricao ( (isset ( $_POST ['dtinscricao'] ) && $_POST ['dtinscricao'] != "") ? Util::strtotimestamp ( $_POST ['dtinscricao'] ) : "" );
$bean->setpessoa ( (isset ( $_POST ['pessoa'] )) ? $_POST ['pessoa'] : null );

$categoriaBusiness = new CategoriaBusiness ();
$cltCategoriainscrito = null;
$multi =  (isset ( $_POST ['categoriainscrito'] )) ? $_POST ['categoriainscrito'] : null;
$N = count ( $multi );
Util::echobr($dbg,"Categoriainscrito multi N", $N);
Util::echobr($dbg,"Categoriainscrito multi ", $multi);
for($i = 0; $i < $N; $i ++) {
	$categoriaBean = $categoriaBusiness->findById( $multi [$i] );
	$categoriainscritoBean = new CategoriaInscritoBean();
        $categoriainscritoBean->setnome(Util::getNomeObjeto( $categoriaBean ));
	$categoriainscritoBean->setvalor(Util::getIdObjeto( $categoriaBean ));
	$categoriainscritoBean->setcategoria ( $multi [$i] );
	$categoriainscritoBean->setinscrito ( $idobj );
	$cltCategoriainscrito [] = $categoriainscritoBean;
}
$bean->setcategoriainscrito ( $cltCategoriainscrito );
Util::echobr($dbg,"cltCategoriainscrito ", $cltCategoriainscrito);

$bean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$recalcular = ( (isset ( $_POST ['recalcular'] )) ? $_POST ['recalcular'] : null );
Util::echobr($dbg,'recalcular ', $recalcular);
if($recalcular!=null){
	$bean = $inscritoBusiness->ajustaValor($bean);
}
Util::echobr($dbg,'bean>getvalor() ', $bean->getvalor() );

$bean->getpostlog ();
$editar = true;
$novo = true;
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