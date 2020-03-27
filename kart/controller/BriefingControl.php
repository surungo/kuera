<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/public/model/bean/ParametroBean.php';
include_once PATHAPP . '/mvc/public/model/business/ParametroBusiness.php';
$dbg = 0;
$bean = new InscritoBean ();
$inscritoBusiness = new InscritoBusiness ();

$pilotoBusiness = new PilotoBusiness ();
$pilotoBateriaBusiness = new PilotoBateriaBusiness ();
$campeonatoBusiness = new CampeonatoBusiness ();

$cltCampeonatoSelecionar = $campeonatoBusiness->findAllAtivo();
Util::echobr ( $dbg, 'InscritoRelatorioControl  $cltCampeonatoSelecionar', $cltCampeonatoSelecionar );
// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'InscritoRelatorioControl  $selcampeonato', $selcampeonato );

$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : '';
$seletapabean = $seletapaBusiness->findById ( $seletapa );
Util::echobr ( $dbg, 'PilotoBateriaControl  $seletapa', $seletapa );

$selbateriabean = new BateriaBean ();
$selbateriaBusiness = new BateriaBusiness ();
$selbateriabean->setetapa ( $seletapabean );
$selbateriaCollection = $selbateriaBusiness->findBateriaByEtapa ( $selbateriabean );
$selbateria = (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : '';
$selbateriabean = $selbateriaBusiness->findById ( $selbateria );
Util::echobr ( $dbg, 'PilotoBateriaControl  $selbateria', $selbateria );

$cparametros = (isset ( $_POST ['cparametros'] ) && $_POST ['cparametros'] > '') ? $_POST ['cparametros'] : 'N';

$parametroBean = new PaginaBean ();
$parametroBusiness = new ParametroBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( $selcampeonato );

$tbcorrida = (isset ( $_POST ['tbcorrida'] )) ? $_POST ['tbcorrida'] : "S";

$verordem = (isset ( $_POST ['verordem'] )) ? $_POST ['verordem'] : "N";
$vercpf = (isset ( $_POST ['vercpf'] )) ? $_POST ['vercpf'] : "N";
$veridade = (isset ( $_POST ['veridade'] )) ? $_POST ['veridade'] : "N";
$verpeso = (isset ( $_POST ['verpeso'] )) ? $_POST ['verpeso'] : "S";
$verdtnasc = (isset ( $_POST ['verdtnasc'] )) ? $_POST ['verdtnasc'] : "N";
$vercat = (isset ( $_POST ['vercat'] )) ? $_POST ['vercat'] : "N";
$verpos = (isset ( $_POST ['verpos'] )) ? $_POST ['verpos'] : "S";
$sortArr = array(
    " posicao ",
    " nome "
);

$sort = (isset ( $_POST ['sort'] )) ? $_POST ['sort'] : $sortArr[0];

$situacao = (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : $situacao;
$selsituacao = $situacao;

Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $qtGrupo', $qtGrupo );
Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $lmDtNascimento', $lmDtNascimento );
Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $lmPeso', $lmPeso );

$bean->setsituacao ( $selsituacao );

$bean->getpostlog ();
$editar = false;
$novo = false;

if($selbateria != ""){
	$collection = $pilotoBateriaBusiness->findBateriaByCampeonatoEtapaBateria ( $selcampeonato, $seletapa, $selbateria );
}

function sortGrid($object1, $object2) { 
    return $object1->getgridlargada() > $object2->getgridlargada() ; 
} 

function sortNome($object1, $object2) { 
    return Util::getNomeObjeto($object1->getpiloto()) > Util::getNomeObjeto($object2->getpiloto()) ; 
} 
if($sortArr[0]==$sort){
	usort($collection , 'sortGrid');
}else{
	usort($collection , 'sortNome');
}
$urlC = LISTAR;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>