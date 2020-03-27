<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
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
$campeonatoBusiness = new CampeonatoBusiness ();

$cltCampeonatoSelecionar = $campeonatoBusiness->findAllAtivo();
Util::echobr ( $dbg, 'InscritoRelatorioControl  $cltCampeonatoSelecionar', $cltCampeonatoSelecionar );
// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();

$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'InscritoRelatorioControl  $selcampeonato', $selcampeonato );

$cparametros = (isset ( $_POST ['cparametros'] ) && $_POST ['cparametros'] > '') ? $_POST ['cparametros'] : 'N';

$parametroBean = new PaginaBean ();
$parametroBusiness = new ParametroBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( $selcampeonato );

$qtlinhaporgrupo = (isset ( $_POST ['qtlinhaporgrupo'] )) ? $_POST ['qtlinhaporgrupo'] : "24";
$tbcorrida = (isset ( $_POST ['tbcorrida'] )) ? $_POST ['tbcorrida'] : "N";

$vercpf = (isset ( $_POST ['vercpf'] )) ? $_POST ['vercpf'] : "N";
$veridade = (isset ( $_POST ['veridade'] )) ? $_POST ['veridade'] : "N";
$verdtnasc = (isset ( $_POST ['verdtnasc'] )) ? $_POST ['verdtnasc'] : "N";
$vercat = (isset ( $_POST ['vercat'] )) ? $_POST ['vercat'] : "N";
$versit = (isset ( $_POST ['versit'] )) ? $_POST ['versit'] : "N";
$sortArr = array(
    " categoria.nome, inscrito.nrinscrito, inscrito.peso ",
    " inscrito.nrinscrito, categoria.nome, inscrito.peso "
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
$bateriaBusiness = new BateriaBusiness();
$cltbateria = $bateriaBusiness->findByCampeonato($selcampeonato);
$collection = $inscritoBusiness->findAllSort ( $bean );
$totalInscritos = count ( $collection );

$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
Util::echobr ( 0, 'InscritoRelatorioControl $selsituacao', $selsituacao );

if($selsituacao=="Pago"){
    $collection = $categoriaInscritoBusiness->findAtivosByCampeonatoPagosSort($selcampeonato,$sort);
}else{
    $collection = $categoriaInscritoBusiness->findAtivosByCampeonatoSort($selcampeonato,$sort);
}
$totalMaster = 0;
$totalSprinter = 0;

for($i = 0; $i < count ( $collection ); $i ++) {
    $categoriainscrito = new CategoriaInscritoBean ();
    $categoriainscrito =  $collection [$i];
    $inscritobean = new InscritoBean ();
    $inscritobean = $categoriainscrito->getinscrito();
    $categoriaBean = new CategoriaBean();
    $categoriaBean = $categoriainscrito->getcategoria();
    if(stristr("Master", Util::getNomeObjeto($categoriaBean))>-1){
        $totalMaster++;
    }else{
        $totalSprinter++;
    }
}


$totalDtPago = $inscritoBusiness->totalComDtPagamento ( $selcampeonato );
$totalNDtPago = $inscritoBusiness->totalSemDtPagamento ( $selcampeonato );
$totalPago = $inscritoBusiness->totalPago ( $selcampeonato );
$totalNPago = $inscritoBusiness->totalNPago ( $selcampeonato );

$urlC = LISTAR;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>