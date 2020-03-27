<?php
$dbg=0;
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';

$bean = new CategoriaInscritoBean();
$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
$idobj = "0";
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : '0';
$idobj = ($idobj == '0' && isset ( $_GET ['idobj'] )) ? $_GET ['idobj'] : $idobj;

Util::echobr ($dbg , 'ContratoVPConteudo $$idobj', $idobj);
Util::echobr ($dbg , 'ContratoVPConteudo $_POST ["idobj"]',(isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : '0');
Util::echobr ($dbg , 'ContratoVPConteudo $_GET ["idobj"]',(isset ( $_GET ['idobj'] )) ? $_GET ['idobj'] : '0' );

$choice = isset($choice)?$choice:"0";
Util::echobr ($dbg , 'ContratoVPPDF $choice', $choice);
Util::echobr ($dbg , 'ContratoVPPDF $_POST ["choice"]', (isset ( $_POST ['choice'] )) ? $_POST ['choice'] : '0' );
Util::echobr ($dbg , 'ContratoVPPDF $_GET ["choice"]', (isset ( $_GET ['choice'] )) ? $_GET ['choice'] : '0' );

$collectionCategoriaInscrito = Array ();
switch ($choice) {

	case Choice::RELATORIO :
		$bean->setid ( $idobj );
		$bean = $categoriaInscritoBusiness->findById ( $bean );
		$collectionCategoriaInscrito[] = $bean;
		break;
		
	case Choice::RELATORIOPAGOS :
		$collectionCategoriaInscrito = $categoriaInscritoBusiness->findAtivosByCampeonatoPagos ( $idobj );
		break;
	
	case Choice::RELATORIOTODOS :
		$collectionCategoriaInscrito = $categoriaInscritoBusiness->findAtivosByCampeonato ( $idobj );
		break;
	
}

for($i = 0; $i < count ( $collectionCategoriaInscrito ); $i ++) {
	$bean = $collectionCategoriaInscrito[$i];
	
	Util::echobr ($dbg , 'ContratoVPConteudo $bean', $bean);
	$inscritobean = new InscritoBean();
	$inscritobean = $bean->getinscrito();
	$nome = Util::getNomeObjeto($bean->getinscrito());
	$campeonato = Util::getNomeObjeto($inscritobean->getcampeonato());
	$categoriaBean = $bean->getcategoria();
	$categoria = Util::getNomeObjeto($categoriaBean);
	$carro = $bean->getnome();
	$endereco = $inscritobean->getendereco();
	$numero = $inscritobean->getnumero();
	$cba = $inscritobean->getnrcbalpad5();
	$cpf = $inscritobean->getcpf();
	$email = $inscritobean->getemail();;
	$nrcarro = $bean->getvalor();
	$cidade = $inscritobean->getcidade();
	$uf = $inscritobean->getuf();
	$fone = $inscritobean->gettelefone();
	$valor = $inscritobean->getvalorDecimal();
	include PATHKARTPHP.'/ContratoVP.php';
}
?>