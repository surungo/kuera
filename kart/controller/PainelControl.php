<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/bean/PainelBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PainelBusiness.php';

include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHPUBBEAN . '/UsuarioBean.php';
include_once PATHPUBBUS . '/UsuarioBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';

$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();
$usuarioBean = new UsuarioBean ();
$usuarioBusiness = new UsuarioBusiness ();
$campeonatoBean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$etapaBean = new EtapaBean ();
$etapaBusiness = new EtapaBusiness ();
$bateriaBean = new BateriaBean ();
$bateriaBusiness = new BateriaBusiness ();


$bean = new PainelBean ();
$painelBusiness = new PainelBusiness ();
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );

$bean->setusuario	 ( (isset ( $_POST ['usuario'] )) ? $_POST ['usuario'] : null );
$bean->setbateria	 ( (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : null );
$bean->setetapa	 ( (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : null );
$bean->setcampeonato	 ( (isset ( $_POST ['campeonato'] )) ? $_POST ['campeonato'] : null );
$bean->setfase	 ( (isset ( $_POST ['fase'] )) ? $_POST ['fase'] : null );
$bean->settaxaatualizacao	 ( (isset ( $_POST ['taxaatualizacao'] )) ? $_POST ['taxaatualizacao'] : null );
$bean->setcol01	 ( (isset ( $_POST ['col01'] )) ? $_POST ['col01'] : null );
$bean->setcol02	 ( (isset ( $_POST ['col02'] )) ? $_POST ['col02'] : null );
$bean->setcol03	 ( (isset ( $_POST ['col03'] )) ? $_POST ['col03'] : null );
$bean->setcol04	 ( (isset ( $_POST ['col04'] )) ? $_POST ['col04'] : null );
$bean->setcol05	 ( (isset ( $_POST ['col05'] )) ? $_POST ['col05'] : null );
$bean->setcol06	 ( (isset ( $_POST ['col06'] )) ? $_POST ['col06'] : null );
$bean->setcol07	 ( (isset ( $_POST ['col07'] )) ? $_POST ['col07'] : null );
$bean->setcol08	 ( (isset ( $_POST ['col08'] )) ? $_POST ['col08'] : null );
$bean->setcol09	 ( (isset ( $_POST ['col09'] )) ? $_POST ['col09'] : null );
$bean->setcol10	 ( (isset ( $_POST ['col10'] )) ? $_POST ['col10'] : null );
$bean->setcol11	 ( (isset ( $_POST ['col11'] )) ? $_POST ['col11'] : null );
$bean->setcol12	 ( (isset ( $_POST ['col12'] )) ? $_POST ['col12'] : null );
$bean->setcol13	 ( (isset ( $_POST ['col13'] )) ? $_POST ['col13'] : null );
$bean->setcol14	 ( (isset ( $_POST ['col14'] )) ? $_POST ['col14'] : null );
$bean->setcol15	 ( (isset ( $_POST ['col15'] )) ? $_POST ['col15'] : null );
$bean->setcol16	 ( (isset ( $_POST ['col16'] )) ? $_POST ['col16'] : null );
$bean->setcol17	 ( (isset ( $_POST ['col17'] )) ? $_POST ['col17'] : null );
$bean->setcol18	 ( (isset ( $_POST ['col18'] )) ? $_POST ['col18'] : null );

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($painelBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $painelBusiness->findAll();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $painelBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		$usuarioCollection = $usuarioBusiness->findAll ();
		$campeonatoCollection = $campeonatoBusiness->findAllAtivo();
		if(Util::getIdObjeto($bean->getcampeonato())>0){
			$etapaCollection = $etapaBusiness->findByCampeonato(Util::getIdObjeto($bean->getcampeonato()));
		}else{
			$etapaCollection = $etapaBusiness->findAllAtivo();
		}
		if(Util::getIdObjeto($bean->getcampeonato())>0){
			$bateriaCollection = $bateriaBusiness->findAtivoByCampeonato(Util::getIdObjeto($bean->getcampeonato()));
		}
		else if(Util::getIdObjeto($bean->getetapa())>0){
			$bateriaBean->setetapa ( $etapaBean );
			$bateriaCollection = $bateriaBusiness->findBateriaByEtapa($bateriaBean);

		}else{
			$bateriaCollection = $bateriaBusiness->findAllAtivo();
		}
		
		if ($idobj > 0) {
			$bean = $painelBusiness->findById ( $idobj );
		}
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>