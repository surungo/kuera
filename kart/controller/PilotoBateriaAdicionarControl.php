<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PosicaoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PosicaoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';


$dbg = 0;
$bean = new PilotoBateriaBean ();
$pilotoBateriaBusiness = new PilotoBateriaBusiness ();
$pilotoCampenonatoBean = new PilotoCampeonatoBean ();
$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness ();
$pilotoBusiness = new PilotoBusiness ();
$bateriaBusiness = new BateriaBusiness ();
$posicaoBusiness = new PosicaoBusiness ();

$selcampeonatobean = new CampeonatoBean ();
$campeonatoBusiness = new CampeonatoBusiness ();
$selcampeonatoCollection = $campeonatoBusiness->findAllAtivo();

// campeonato ativo
$selcampeonatoBean = $campeonatoBusiness->atual ();
$selcampeonatoBean = (isset ( $_POST ['campeonato'] ) && $_POST ['campeonato'] > 0) ? $campeonatoBusiness->findById ( $_POST ['campeonato'] ) : $selcampeonatoBean;
$selcampeonato = Util::getIdObjeto ( $selcampeonatoBean );
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selcampeonato', $selcampeonato );

// etapa
$seletapabean = new EtapaBean ();
$seletapaBusiness = new EtapaBusiness ();
$seletapaCollection = $seletapaBusiness->findByCampeonato ( $selcampeonato );
$seletapa = (isset ( $_POST ['etapa'] )) ? $_POST ['etapa'] : '';
$seletapabean->setcampeonato($selcampeonato);
$seletapabean->setid($seletapa);
$seletapabean = $seletapaBusiness->findByEtapaCampeonatoAtivo($seletapabean);
$seletapa = Util::getIdObjeto($seletapabean);
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $seletapa', $seletapa );

$selbateriabean = new BateriaBean ();
$selbateriaBusiness = new BateriaBusiness ();
$selbateriabean->setetapa ( $seletapabean );
$selbateriaCollection = $selbateriaBusiness->findBateriaByEtapa ( $selbateriabean );
$selbateria = (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : '';
$selbateriabean->setetapa($seletapabean);
$selbateriabean->setid($selbateria);
$selbateriabean = $selbateriaBusiness->findByBateriaEtapaAtivo ( $selbateriabean );
$selbateria = Util::getIdObjeto($selbateriabean);
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateria', $selbateria );
//Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateriabean->categoria', $selbateriabean->getcategoria() );
$bean->setbateria($selbateriabean);
$usuarioCollection = $usuarioBusiness->findAll ();
$cltPosicaoSelecionar = $posicaoBusiness->findAll ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $idobj ', $idobj );
$bean->setid ( $idobj );
$bean->setpiloto ( (isset ( $_POST ['piloto'] )) ? $_POST ['piloto'] : null );
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $bean->getpiloto', $bean->getpiloto () );

$bean->setbateria ( (isset ( $_POST ['bateria'] )) ? $_POST ['bateria'] : null );

$bean->setgridlargada ( (isset ( $_POST ['gridlargada'] )) ? $_POST ['gridlargada'] : null );
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $bean->getgridlargada', $bean->getgridlargada () );

$bean->setpresente ( (isset ( $_POST ['presente'] )) ? $_POST ['presente'] : null );
$bean->setposicao ( (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : null );
$bean->setkart ( (isset ( $_POST ['kart'] )) ? $_POST ['kart'] : null );
$bean->setvolta ( (isset ( $_POST ['volta'] )) ? $_POST ['volta'] : null );
$bean->setna ( (isset ( $_POST ['na'] )) ? $_POST ['na'] : null );
$bean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$bean->setpregridlargada ( (isset ( $_POST ['pregridlargada'] )) ? $_POST ['pregridlargada'] : null );
$bean->setposicaooficial ( (isset ( $_POST ['posicaooficial'] )) ? $_POST ['posicaooficial'] : null );
$bean->setkartlargada ( (isset ( $_POST ['kartlargada'] )) ? $_POST ['kartlargada'] : null );

$bean->setpenalizacao ( (isset ( $_POST ['penalizacao'] )) ? $_POST ['penalizacao'] : null );
$bean->setcartaoamarelo ( (isset ( $_POST ['cartaoamarelo'] )) ? $_POST ['cartaoamarelo'] : null );
$bean->setconvidado ( (isset ( $_POST ['convidado'] )) ? $_POST ['convidado'] : null );

$bean->setinformacao ( (isset ( $_POST ['informacao'] )) ? $_POST ['informacao'] : null );
$bean->setobservacao ( (isset ( $_POST ['observacao'] )) ? $_POST ['observacao'] : null );

$urlresultados =   (isset ( $_POST ['urlresultados'] )) ? $_POST ['urlresultados'] : null ;

///filtros campeonato
$versembateria = (isset ( $_POST ['versembateria'] )) ? $_POST ['versembateria'] : "N";

$collection = $pilotoBateriaBusiness->findBateria ( $bean );
$urlC = LISTAR;

switch ($choice) {
	case Choice::PASSO_1:
		//if(count($collection)>0){
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateriabean', Util::getNomeObjeto($selbateriabean) );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl Util::getIdObjeto($selbateriabean->getpontuacaoesquema()) == 327'
		, Util::getIdObjeto($selbateriabean->getcategoria()) == 327 );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl &&  !(strpos(Util::getNomeObjeto($selbateriabean),Sprinter A) === false)'
		,  !(strpos(Util::getNomeObjeto($selbateriabean),"Sprinter A") === false) );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateriabean categoria', Util::getIdObjeto($selbateriabean->getcategoria()) );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateriabean->getpontuacaoesquema()', Util::getNomeObjeto($selbateriabean->getpontuacaoesquema()) );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $selbateriabean->getpontuacaoesquema()', Util::getIdObjeto($selbateriabean->getpontuacaoesquema()) );
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $bean->getbateria()', Util::getIdObjeto($bean->getbateria () ) );
			$pilotoBateriaBusiness = new PilotoBateriaBusiness();
	
			if( Util::getIdObjeto($selbateriabean->getcategoria()) == 326){ 
			// Categoria Master
				Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl gera Categoria Master', Util::getIdObjeto($bean->getbateria () ) );
				$pilotoBateriaBusiness->insertGridInversoPrecedente($bean);
				
			}else if(Util::getIdObjeto($selbateriabean->getcategoria()) == 327
				&&  !(strpos(Util::getNomeObjeto($selbateriabean),"Sprinter A") === false )
			){ 
			// Categoria Sprinter A
				$dbg = 0;
				Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl gera Categoria Sprinter A', Util::getIdObjeto($bean->getbateria () ) );
				$pilotoBateriaBusiness->insertGridInverso2Precedente1810($bean);
				
			}else if(Util::getIdObjeto($selbateriabean->getcategoria()) == 327
				&&  !(strpos(Util::getNomeObjeto($selbateriabean),"Sprinter B" ) === false )
			){ 
			// Categoria Sprinter B
				Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl gera Categoria Sprinter B', Util::getIdObjeto($bean->getbateria () ) );
				$pilotoBateriaBusiness->insertGridInverso2PioresPrecedente1810($bean);
				
			}
			
		//}	
	
	
	$choice = Choice::LISTAR;
	break;

	case Choice::ADICIONAR :
		$dbg = 0;
		$pilotoBean = new PilotoBean();
		$pilotoBusiness = new PilotoBusiness();
		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria idpiloto ', $idobj );
		if ($idobj > 0) {
			$pilotoBean = $pilotoBusiness->findById ( $idobj );
		}
		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria idpiloto ', $idpiloto );
		$idbateria = (isset ( $_POST ['itemFK'] )) ? $_POST ['itemFK'] : null ;
		$bateriaBean = new BateriaBean();
		$bateriaBean->setid($idbateria);

		$pilotoBateriaBusiness = new PilotoBateriaBusiness();
		$pilotoBateriaBean = new PilotoBateriaBean();
		$pilotoBateriaBean->setpiloto($pilotoBean);
		$pilotoBateriaBean->setbateria($bateriaBean);
		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria pilotoBateriaBean', $pilotoBateriaBean);
		
		$pilotoBateriaBean = $pilotoBateriaBusiness->adicionar($pilotoBateriaBean);

		Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl ', $bean->getpiloto () );
		$choice = Choice::LISTAR;
		break;
	
	case Choice::VOLTAR :
		$choice = Choice::LISTAR;
		break;
	
	case Choice::SALVA_TODOS :
		if ($pilotoBateriaBusiness->addTodosPilotoSemBateria ( $selcampeonato, $seletapa, $selbateria )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
		$choice = Choice::LISTAR;
		break;
	
	case Choice::EXCLUIR_TODOS :
		if ($pilotoBateriaBusiness->deletebateria ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
		$choice = Choice::LISTAR;
		break;
	
	case Choice::EXCLUIR :
		if ($pilotoBateriaBusiness->remover ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
		$choice = Choice::LISTAR;
		break;

}
switch ($choice) {
	
    case Choice::ATUALIZAR :
	    // reposicionamento do grid
	    $collection = $pilotoBateriaBusiness->findBateria ( $bean );
	    for($i = 0; $i < count ( $collection ); $i ++) {
	        $pilotoBateriaBeanList = $collection [$i];
	        $idpilotobateria = $pilotoBateriaBeanList->getid ();
	        $bean = $pilotoBateriaBusiness->findById($idpilotobateria);
	        $pregridlargada = $pilotoBateriaBeanList->getpregridlargada ();
	        $newpregridlargada =   (isset ( $_POST ['pregridlargada_'.$idpilotobateria] )) ? $_POST ['pregridlargada_'.$idpilotobateria] : null ;
	        if ( $newpregridlargada != $pregridlargada ) {
	            $bean->setpregridlargada($newpregridlargada);
	            $pilotoBateriaBusiness->updatepregridlargada($bean);
	            break;
	        }
	    }
	    
    case Choice::LISTAR :
	    $mensagem = "";
		$urlC = LISTAR;
		break;
	
	case Choice::VALIDAR:
		$entrada = isset ( $_POST ['entrada'] ) ? $_POST ['entrada'] : null ;
		if($entrada != null && $entrada != ''){
			$saida = $pilotoBateriaBusiness->validaResultado($entrada, $selcampeonato, $seletapa, $selbateria );
			$mensagem = "validado";
		}else{
			$mensagem = "entrada esta vazia";
		}
	
		
		$urlC = EDITAR;
		break;
	
	case Choice::LER:
		
		$choice = Choice::LER;
		$data = file_get_contents($urlresultados);
		$results="";
		
		$DOM = new DOMDocument;
		$DOM->loadHTML($data );
		
		//get all td
		$items = $DOM->getElementsByTagName('td');
				
		$soma = 17;
		$pos = 8;
		$poscount = 0;
		$nome = 9;
		$nomecount = 0;
		$volta = 20;
		$voltacount = 0;
		
		
		for ($i = 0; $i < $items->length; $i++){
		
			if( ($pos +$poscount) == $i ){
				$results .= str_replace(" ","", trim($items->item($i)->nodeValue) )."\t";
				$poscount= $poscount + $soma;
			}
			
			if( ($nome+$nomecount) == $i ){
				$conteudo = trim($items->item($i)->nodeValue) ;
				$split = explode(" ", $conteudo);
				unset($pieces);
				foreach ($split as &$value) {
					if(trim($value)!=""){
					    $value =  preg_replace( "/\t|\r|\n/", "",   trim($value));
					    $pieces[] = str_replace(" ","", trim($value)) ;
					}   
				    
				}
				
				$posstr = array_shift($pieces);
				$results .= str_replace("#","", $posstr)."\t";
				array_pop($pieces);
				
				$nomestr = preg_replace( "/\r|\n/", "",  implode(" ", $pieces) );
				$results .=  $nomestr."\t";
				$nomecount = $nomecount + $soma;
		        }
	        if( ($volta +$voltacount) == $i ){
	   		$results .= preg_replace( "/\r|\n/", "",  str_replace(" ","", trim($items->item($i)->nodeValue) ))."\t\n";
	   		$voltacount= $voltacount + $soma;
	        }
        
//$results .= "[".$i."]".trim($items->item($i)->nodeValue) ;

   }
		
		$entrada = $results;
		
	 	$mensagem = "Conteudo lido - ".$urlresultados;
	 	$urlC = EDITAR;
	 	break;

		
	case Choice::SALVAR :
		$entrada = isset ( $_POST ['entrada'] ) ? $_POST ['entrada'] : null ;
		$posicao=1;
		if($entrada != null && $entrada != ''){
			$saidatemp = $pilotoBateriaBusiness->validaResultado($entrada, $selcampeonato, $seletapa, $selbateria );
			$pilotoBateriaBusiness->ausentarTodosBateria($selbateria);
			$saida = array();
			foreach ($saidatemp as &$lin){
						
				$cltpilotoBateria = $pilotoBateriaBusiness->findBateriaByCampeonatoEtapaBateriaPilotoNome($selcampeonato, $seletapa, $selbateria, 
				$lin['nome']);
				if(count($cltpilotoBateria) > 0 ){
					$pBateriaBean = new PilotoBateriaBean ();
					$pBateriaBean = $cltpilotoBateria[0];
					$pBateriaBean->setpresente('S');
					$pBateriaBean->setkart($lin['kart']);
					$pBateriaBean->setposicao($posicao);//$lin['pos']);
					$pBateriaBean->setposicaooficial($posicao);
					$pBateriaBean->setvolta($pilotoBateriaBusiness->ajustavolta($lin['volta']));
					$pBateriaBean->setpenalizacao($lin['pena']);
					$retorno = $pilotoBateriaBusiness->salve ( $pBateriaBean );
					//$idobj = $retorno->getresposta ();
					$mensagem = $retorno->getmensagem ();
					$saida[] = array( 
						$lin['pos'], 
						$lin['kart'],  
						$lin['nome'],  
						$lin['validade'],  
						$pilotoBateriaBusiness->ajustavolta($lin['volta']),  
						$lin['pena'],
						$mensagem  );
					$posicao++;
				}

			}	
			
			
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $saida ', $saida);
		}
		//$retorno = $pilotoBateriaBusiness->salve ( $bean );
		//$idobj = $retorno->getresposta ();
		//$mensagem = $retorno->getmensagem ();
		$mensagem = "salvo";
		$urlC = EDITAR;
		break;
	case Choice::ABRIR :
		$urlC = EDITAR;
		break;
}


$bean->getpostlog ();
$editar = true;
$novo = false;
$adicionarPilotoCampeonato = $selcampeonato > 0 && $seletapa > 0 && $selbateria > 0;

$collection = $pilotoBateriaBusiness->findBateria ( $bean );


//if($versembateria=='S'){
$cltPilotos = $pilotoBateriaBusiness->findPilotoSemBateria( $selcampeonato, $seletapa, $selbateria );
$maxpregridlargada = $pilotoBateriaBusiness->maxpregridlargada($bean);

//}
/*
if($versembateria=='N'){
   $cltPilotos = $pilotoBateriaBusiness->findPilotoSemBateria( $selcampeonato, $seletapa);
	//$cltPilotosCampeonato = $pilotoCampeonatoBusiness->findPilotoSemBateria( $selcampeonato);
	Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $cltPilotosCampeonato', "antes" );
	//$cltPilotosCampeonato = $pilotoCampeonatoBusiness->findPilotoAtivo( $selcampeonato);
	Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $cltPilotosCampeonato', $cltPilotosCampeonato );
	
}
*/
Util::echobr ( 0, 'PilotoBateriaAdicionarControl cltPilotos', $cltPilotos);
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>