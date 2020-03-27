<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/bolao/model/bean/ApostaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/ApostaBusiness.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/PartidaBusiness.php';

$bean = new ApostaBean ();
$apostaBean = new ApostaBean ();
$apostaBusiness = new ApostaBusiness ();
$partidaBean = new PartidaBean ();
$partidaBusiness = new PartidaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$semAcumular = (isset ( $_POST ['semAcumular'] )) ? $_POST ['semAcumular'] : 0;
$inverterColunas = (isset ( $_POST ['inverterColunas'] )) ? $_POST ['inverterColunas'] : 0;
$posicao = (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : 0;


$editar = false;
$novo = false;

$collection = array ();
$cltaposta =  array ();
switch ($choice) {
    case Choice::LISTAR :
        $partidaBean->setsort("partida.dtpartida,  partida.nome");
        $collectionPartidas = $partidaBusiness->findAllSort($partidaBean);
	    $collectionApostadores = $apostaBusiness->apostadores();
	    foreach ($collectionApostadores as &$apostador) {
	        $pontos = array();
	        $pontoAnterior=0;
	        foreach ($collectionPartidas as &$partida) {
	            $apostador->setpartida($partida);
	            $apostaBean = $apostaBusiness->findByNomePartida($apostador);
	            if(!(Util::getIdObjeto($apostaBean)>0)){
	                $apostaBean = new ApostaBean ();
	                $apostaBean = $apostador;
	                $apostaBean->setpontos(0);
	                $apostaBean->setplacar1("");
	                $apostaBean->setplacar2("");	                
	            }
	            if($semAcumular==0){
	                $apostaBean->setpontoacumulado($pontoAnterior+$apostaBean->getpontos());
	                $pontoAnterior=$apostaBean->getpontoacumulado();
	            }
	            //count($partida->getcltaposta())>0$partida->getcltaposta();
	            $apostaBean->setpartida($partida);
	            $pontos[] = $apostaBean;
	        }
	        if($inverterColunas==1){
	           $pontos = array_reverse($pontos);
	        }
	        $collection[] = $pontos;
	    }
	    if($inverterColunas==1){
	        $collectionPartidas = array_reverse($collectionPartidas);
	    }
	   
	    $urlC = LISTAR;
		break;

}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>