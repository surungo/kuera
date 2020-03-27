<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$dbg = 0;

$bean = new CategoriaInscritoBean ();
$categoriaInscritoBusiness = new CategoriaInscritoBusiness ();

$categoriaBusiness = new CategoriaBusiness ();
$categoriaBean = new CategoriaBean ();

$inscritoBusiness = new InscritoBusiness ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
if( Util::getIdObjeto($beanPerfilAtual) == 12 ){
	$tipos = array(TipoEventoEnum::ARRANCADA);
	$selcampeonatoCollection = $campeonatoBusiness->findByTiposAtivos($tipos);
}else{
	$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();
}

// campeonato ativo
//$selcampeonatoBean = $campeonatoBusiness->atual ();
//$selcampeonatoBean = $campeonatoBusiness->findById (14); //vp201

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'CategoriaInscritoControl  $selcampeonato', $selcampeonato );

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['carro'] )) ? $_POST ['carro'] : null );
$bean->setvalor ( (isset ( $_POST ['nrcarro'] )) ? $_POST ['nrcarro'] : null );
$bean->setinscrito ( (isset ( $_POST ['inscrito'] )) ? $_POST ['inscrito'] : null );
Util::echobr ( $dbg, 'CategoriaInscritoControl  bean->getinscrito ', $bean->getinscrito() );

$inscritobean = new InscritoBean ();
$inscritobean->setid ( $bean->getinscrito() );
$inscritobean->setcampeonato ( $selcampeonato );
$inscritobean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );

$inscritobean->setnome ( Util::post('nome',  null ));
$inscritobean->setevento ( Util::post('evento',  null ));
$inscritobean->setapelido ( Util::post('apelido',  null ));
$inscritobean->setgrupo ( Util::post('grupo',  null ));
$inscritobean->setpeso ( Util::post('peso',  null ));
$inscritobean->setdtnascimento ( (Util::post('dtnascimento',"") != "") ? Util::strtotimestamp ( Util::post('dtnascimento',"") ) : "" );
$inscritobean->settelefone ( Util::post('telefone',  null ));
$inscritobean->setemail ( Util::post('email',  null ));
$inscritobean->settamanhocamisa ( Util::post('tamanhocamisa',  null ));
$inscritobean->setcarro ( Util::post('carro',  null ));
$inscritobean->setnrcarro ( Util::post('nrcarro',  null) );
$inscritobean->setendereco ( Util::post('endereco',  null ));
$inscritobean->setnumero ( Util::post('numero',  null ));
$inscritobean->setcomplemento ( Util::post('complemento',null) );
$inscritobean->setbairro ( Util::post('bairro', null) );
$inscritobean->setcep ( Util::post('cep',  null ));
$inscritobean->setnrcba ( Util::post('nrcba',  null ));
$inscritobean->setcidade ( Util::post('cidade',  null ));
$inscritobean->setuf ( Util::post('uf',  null ));

$inscritobean->setcategoria( (isset ( $_POST ['categoria'] )) ? $_POST ['categoria'] : null );

$inscritobean->setcelular ( (isset ( $_POST ['celular'] )) ? $_POST ['celular'] : null );
$inscritobean->settelefonecomercial ( (isset ( $_POST ['telefonecomercial'] )) ? $_POST ['telefonecomercial'] : null );
$inscritobean->setchefeequipe ( (isset ( $_POST ['chefeequipe'] )) ? $_POST ['chefeequipe'] : null );
$inscritobean->setipcriacao ( (isset ( $_POST ['ipcriacao'] )) ? $_POST ['ipcriacao'] : null );
$inscritobean->setdtenvio ( (isset ( $_POST ['dtenvio'] )) ? $_POST ['dtenvio'] : null );

$inscritobean->setsituacao ( (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : null );
$inscritobean->setdtpagamento ( (isset ( $_POST ['dtpagamento'] ) && $_POST ['dtpagamento'] != "") ? Util::strtotimestamp ( $_POST ['dtpagamento'] ) : "" );
$inscritobean->setnrinscrito ( (isset ( $_POST ['nrinscrito'] )) ? $_POST ['nrinscrito'] : null );
$inscritobean->setdtvalidaemail ( (isset ( $_POST ['dtvalidaemail'] ) && $_POST ['dtvalidaemail'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidaemail'] ) : "" );
$inscritobean->setdtinscricao ( (isset ( $_POST ['dtinscricao'] ) && $_POST ['dtinscricao'] != "") ? Util::strtotimestamp ( $_POST ['dtinscricao'] ) : "" );
$inscritobean->setpessoa ( (isset ( $_POST ['pessoa'] )) ? $_POST ['pessoa'] : null );

$multi = isset ( $_POST ['categoriainscrito'] ) ? $_POST ['categoriainscrito'] : null;
$N = count ( $multi );
Util::echobr($dbg,"Categoriainscrito multi N", $N);
Util::echobr($dbg,"Categoriainscrito multi ", $multi);
$cltCategoriainscrito=null;
for($i = 0; $i < $N; $i ++) {
	$categoriainscritoBean = new CategoriaInscritoBean();
	$categoriainscritoBean->setcategoria ( $multi [$i] );
	$categoriainscritoBean->setinscrito ( $idobj );
	$cltCategoriainscrito [] = $categoriainscritoBean;
}
$inscritobean->setcategoriainscrito ( $cltCategoriainscrito );
Util::echobr($dbg,"cltCategoriainscrito ", $cltCategoriainscrito);

$inscritobean->setvalor ( (isset ( $_POST ['valor'] )) ? $_POST ['valor'] : null );
$recalcular = ( (isset ( $_POST ['recalcular'] )) ? $_POST ['recalcular'] : null );
Util::echobr($dbg,'recalcular ', $recalcular);
if($recalcular!=null){
	$inscritobean = $inscritoBusiness->ajustaValor($inscritobean);
}

$bean->setinscrito($inscritobean);
if(count($cltCategoriainscrito)>0)
	$bean->setcategoria($cltCategoriainscrito[0]->getcategoria());

Util::echobr($dbg,'$cltCategoriainscrito[0] ', $cltCategoriainscrito[0]);

$bean->getpostlog ();
$editar = true;
$novo = true;

switch ($choice) {
	case Choice::DESATIVAR :

		$retorno = $categoriaInscritoBusiness->desativar ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();
		echo "<script>$(document).ready(function() { $('#formDefault').submit(); });</script>";


	case Choice::LISTAR :

		if( 12 == Util::getIdObjeto($usuarioLoginBean->getperfil()) ){
			$collection = $categoriaInscritoBusiness->findAtivosByCampeonato ( $selcampeonato );
		}else{
			$collection = $categoriaInscritoBusiness->findByCampeonato ( $selcampeonato );
		}
		$urlC = LISTAR;
		break;

	case Choice::SALVAR :
		$retorno = $categoriaInscritoBusiness->update ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = Util::getIdObjeto ( $bean );
		$mensagem = $retorno->getmensagem ();

	case Choice::ABRIR :
		if ($idobj > 0) {
			Util::echobr($dbg,'idobj ', $idobj);
			$bean = $categoriaInscritoBusiness->findById ( $idobj );
		}
		Util::echobr($dbg,'bean->getinscrito() ', Util::getIdObjeto($bean->getinscrito()) );
		Util::echobr($dbg,'bean->getcategoria() ', Util::getIdObjeto($bean->getcategoria()) );
		$inscritobean = $bean->getinscrito();
		$categoriabean = $bean->getcategoria();
		$usuarioCollection = $usuarioBusiness->findAll ();
		$selCategoriaCollection = $categoriaBusiness->findByCampeonato($selcampeonato);
		$urlC = EDITAR;
		break;

	case Choice::RELATORIO :

		//$urlC = REPORT;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);


?>
