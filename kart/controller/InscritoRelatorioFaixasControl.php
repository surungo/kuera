<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
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
$separagrupos = (isset ( $_POST ['separagrupos'] ) && $_POST ['separagrupos'] > '') ? $_POST ['separagrupos'] : 'N';

$codigoParametro = "RELATORIO_INSCRITO";
$parametroBean = new PaginaBean ();
$parametroBusiness = new ParametroBusiness ();
$valorParam = $parametroBusiness->findByCodigo ( $codigoParametro );

$qtGrupo = '25';
$lmDtNascimento = '01/01/1976';
$lmPeso = '95';
$pesoA = 75;
$pesoB = 80;
$pesoC = 90;
$pesoD = 100;
$situacao = 'Todos';
$contaesp = 'S';

try {
	
	$valorParam = ($valorParam != null) ? $valorParam : "{\"qtGrupo\":\"" . $qtGrupo . "\",\"lmDtNascimento\":\"" . $lmDtNascimento . "\",\"pesoA\":\"" . $pesoA . "\",\"pesoB\":\"" . $pesoB . "\",\"pesoC\":\"" . $pesoC . "\",\"pesoD\":\"" . $pesoD . "\",\"situacao\":\"" . $situacao . "\",\"contaesp\":\"" . $contaesp . "\",\"campeonato\":\"" . $selcampeonato . "\",\"lmPeso\":\"" . $lmPeso . "\"}";
	
	Util::echobr ( $dbg, 'InscritoRelatorioControl  $valorParam', $valorParam );
	$dataBase = json_decode ( $valorParam, true );
	Util::echobr ( $dbg, 'InscritoRelatorioControl  $dataBase', $dataBase );
	
	$qtGrupo = (isset ( $dataBase ['qtGrupo'] )) ? $dataBase ['qtGrupo'] : $qtGrupo;
	$lmDtNascimento = (isset ( $dataBase ['lmDtNascimento'] )) ? $dataBase ['lmDtNascimento'] : $lmDtNascimento;
	$lmPeso = (isset ( $dataBase ['lmPeso'] )) ? $dataBase ['lmPeso'] : $lmPeso;
	$pesoA = (isset ( $dataBase ['pesoA'] )) ? $dataBase ['pesoA'] : $pesoA;
	$pesoB = (isset ( $dataBase ['pesoB'] )) ? $dataBase ['pesoB'] : $pesoB;
	$pesoC = (isset ( $dataBase ['pesoC'] )) ? $dataBase ['pesoC'] : $pesoC;
	$pesoD = (isset ( $dataBase ['pesoD'] )) ? $dataBase ['pesoD'] : $pesoD;
	$contaesp = (isset ( $dataBase ['contaesp'] )) ? $dataBase ['contaesp'] : $contaesp;
	$situacao = (isset ( $dataBase ['situacao'] )) ? $dataBase ['situacao'] : $situacao;
	
	Util::echobr ( $dbg, 'InscritoRelatorioControl  $qtGrupo', $qtGrupo );
	Util::echobr ( $dbg, 'InscritoRelatorioControl  $lmDtNascimento', $lmDtNascimento );
	Util::echobr ( $dbg, 'InscritoRelatorioControl  $lmPeso', $lmPeso );
} catch ( Exception $e ) {
	echo 'Caught exception: ', $e->getMessage (), "\n";
	break;
}

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setcampeonato ( $selcampeonato );

$qtGrupo = (isset ( $_POST ['qtGrupo'] )) ? $_POST ['qtGrupo'] : $qtGrupo;
$lmDtNascimento = (isset ( $_POST ['lmDtNascimento'] )) ? $_POST ['lmDtNascimento'] : $lmDtNascimento;
$lmPeso = (isset ( $_POST ['lmPeso'] )) ? $_POST ['lmPeso'] : $lmPeso;
$pesoA = (isset ( $_POST ['pesoA'] )) ? $_POST ['pesoA'] : $pesoA;
$pesoB = (isset ( $_POST ['pesoB'] )) ? $_POST ['pesoB'] : $pesoB;
$pesoC = (isset ( $_POST ['pesoC'] )) ? $_POST ['pesoC'] : $pesoC;
$pesoD = (isset ( $_POST ['pesoD'] )) ? $_POST ['pesoD'] : $pesoD;
$contaesp = (isset ( $_POST ['contaesp'] )) ? $_POST ['contaesp'] : $contaesp;
$situacao = (isset ( $_POST ['situacao'] )) ? $_POST ['situacao'] : $situacao;
$selsituacao = $situacao;

Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $qtGrupo', $qtGrupo );
Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $lmDtNascimento', $lmDtNascimento );
Util::echobr ( $dbg, 'InscritoRelatorioControl $_POST $lmPeso', $lmPeso );

$dataBase ['qtGrupo'] = $qtGrupo;
$dataBase ['lmDtNascimento'] = $lmDtNascimento;
$dataBase ['lmPeso'] = $lmPeso;
$dataBase ['pesoA'] = $pesoA;
$dataBase ['pesoB'] = $pesoB;
$dataBase ['pesoC'] = $pesoC;
$dataBase ['pesoD'] = $pesoD;
$dataBase ['contaesp'] = $contaesp;
$dataBase ['situacao'] = $situacao;
$dataBase ['campeonato'] = $selcampeonato;

$bean->setsituacao ( $selsituacao );
$bean->setdtnascimento ( Util::strtotimestamp ( $lmDtNascimento ) );
$bean->setPeso ( $lmPeso );

$parametroBusiness->updateCodigo ( $codigoParametro, json_encode ( $dataBase ) );

$bean->getpostlog ();
$editar = false;
$novo = false;

$bean->setsort ( 'inscrito_peso, inscrito_dtnascimento desc' );
$collection = $inscritoBusiness->findAllSort ( $bean );
$totalInscritos = count ( $collection );
if ($cparametros == 'S') {
	$collection = $inscritoBusiness->relatorio ( $dataBase );
} elseif ($situacao == 'Pago') {
	$collection = $inscritoBusiness->findPagos ( $selcampeonato );
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