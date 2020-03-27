<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/bolao/model/bean/ApostaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/ApostaBusiness.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/PartidaBusiness.php';

$bean = new ApostaBean ();
$apostaBusiness = new ApostaBusiness ();
$partidaBean = new PartidaBean ();
$partidaBusiness = new PartidaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setplacar1 ( (isset ( $_POST ['placar1'] )) ? $_POST ['placar1'] : null );
$bean->setplacar2 ( (isset ( $_POST ['placar2'] )) ? $_POST ['placar2'] : null );
$bean->setpontos ( (isset ( $_POST ['pontos'] )) ? $_POST ['pontos'] : null );
$bean->settipoacerto( (isset ( $_POST ['tipoacerto'] )) ? $_POST ['tipoacerto'] : null );

$partidaUltima = $partidaBusiness->ultima();
$bean->setpartida ( (isset ( $_POST ['partida'] ) && $_POST ['partida']!="") ? $_POST ['partida']  : Util::getIdObjeto($partidaUltima) );
$slpartida=Util::getIdObjeto($bean->getpartida());

$bean->getpostlog ();
if($idperfilatual==1){
    $editar = true;
    $novo = true;
}else{
    $editar = false;
    $novo = false;
}
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($apostaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
	    if($bean->getpartida()>0){
	       $collection = $apostaBusiness->findByPartida( $bean->getpartida() );
	       $partidabean =  $partidaBusiness->findById($slpartida);
	    }else{
	        $collection = $apostaBusiness->findAll();
	        $partidabean = new PartidaBean();
	    }
	    
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $apostaBusiness->salve ( $bean );
		$idobj = $retorno->getresposta ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $apostaBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$cltpartidas = $partidaBusiness->findAll();

$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);

?>