<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';
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
$pilotobean = new PilotoBean();
$bateriaBusiness = new BateriaBusiness ();
$posicaoBusiness = new PosicaoBusiness ();
$pessoabusiness = new PessoaBusiness();

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


/*
$bean->setgridlargada ( (isset ( $_POST ['gridlargada'] )) ? $_POST ['gridlargada'] : null );
Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl $bean->getgridlargada', $bean->getgridlargada () );

$bean->setpresente ( (isset ( $_POST ['presente'] )) ? $_POST ['presente'] : null );
$bean->setposicao ( (isset ( $_POST ['posicao'] )) ? $_POST ['posicao'] : null );
$bean->setkart ( (isset ( $_POST ['kart'] )) ? $_POST ['kart'] : null );
$bean->setposicaokart ( (isset ( $_POST ['posicaokart'] )) ? $_POST ['posicaokart'] : null );
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
*/

$urlresultados =   (isset ( $_POST ['urlresultados'] )) ? $_POST ['urlresultados'] : null ;

$consulta_adicao =   (isset ( $_POST ['consulta_adicao'] )) ? $_POST ['consulta_adicao'] : Choice::PBA_OCULTAR ;
$compacto =   (isset ( $_POST ['compacto'] )) ? $_POST ['compacto'] : true ;

$collection = $pilotoBateriaBusiness->findBateria ( $bean );
$urlC = LISTAR;

$umpresente=0;

// PRIMEIRA ESCOLHA
switch ($choice) {
	case Choice::ATUALIZAR_PESO:
		$pesoidobj  = (isset ( $_POST ["peso_$idobj"] )) ? $_POST ["peso_$idobj"] : null ;
		$pilotoBateriaBean = $pilotoBateriaBusiness->findById($idobj);
		$pilotobean = $pilotoBateriaBean->getpiloto();
		$pilotobean->setpeso ( $pesoidobj );
		$pilotoBateriaBean->setpeso ( $pesoidobj );
		$pilotoBateriaBean->setpiloto($pilotobean);
		$pilotoBateriaBusiness->salve($pilotoBateriaBean);
		$pilotoBusiness->salve($pilotobean);
		$choice = Choice::LISTAR;
		break;
	
    case Choice::ADICIONAR_NOVO:
        $campovazio=false;
        $nome = (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null ;
        $cpf = (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null ;
        $peso = (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null ;
        
        if($cpf==null || $cpf==""){
            $mensagem="<span class='vermelho'>Preencha CPF.</span>";
            $campovazio=true;
        }
        if(!$campovazio &&($nome==null || $nome=="")){
            $mensagem="<span class='vermelho'>Preencha Nome.</span>";
            $campovazio=true;
        }
        if(!$campovazio &&($peso==null || $peso=="")){
            $mensagem="<span class='vermelho'>Preencha Peso.</span>";
            $campovazio=true;
        }
        
        $pilotobean = new PilotoBean();
        $pilotobean->setnome ( $nome );
        $pilotobean->setcpf ( $cpf );
        $pilotobean->setpeso ( $peso );
        
        if(!$campovazio){
            $pilotobean = $pilotoBusiness->findByCPF($cpf);
            $pessoabean = $pessoabusiness->findByCPF($cpf);
            $pilotobean->setpessoa($pessoabean);
            if(Util::getIdObjeto($pessoabean) < 1 ){
                $pessoabean->setnome ( $nome );
                $pessoabean->setcpf ( $cpf );
                $pessoabean->setpeso ( $peso );
                $results = $pessoabusiness->salve($pessoabean);
                $pessoabean = $results->getresposta();
            }
            if(Util::getIdObjeto($pilotobean) < 1 ){
                $pilotobean = new PilotoBean();
                $pilotobean->setnome ( $nome );
                $pilotobean->setcpf ( $cpf );
                $pilotobean->setpeso ( $peso );
                $pilotobean->setpessoa ( $pessoabean );
                $results = $pilotoBusiness->salve($pilotobean);
                $pilotobean = $results->getresposta();
            }
            $idobj=Util::getIdObjeto($pilotobean);
            $consulta_adicao = Choice::PBA_OCULTAR; 
            $choice = Choice::ADICIONAR;
        }
        break;
        
    case Choice::SORTEIO_PREGRID :
		$collection = $pilotoBateriaBusiness->sorteioPreGrid($bean);
		$choice = Choice::LISTAR;
		break;
    		
}

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
	
	
	case Choice::ATUALIZAR_CPF:
	    $cpf = (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null; 
	    $pessoabean = new PessoaBean();
	    $pessoabean = $pessoabusiness->findByCPF($cpf);
	    $pilotobean = new PilotoBean();
	    if(Util::getIdObjeto($pessoabean)>0){
	        $pilotobean->setnome(Util::getNomeObjeto($pessoabean));
	        $pilotobean->setpeso($pessoabean->getpeso());
	        $pilotobean->setpessoa($pessoabean);
	    }
	       
	    $pilotobean->setcpf( $cpf );
	    $choice = Choice::LISTAR;
    break;
	    
	case Choice::ADICIONAR_INSCRITO:
	    $dbg = 0;
	    $inscritoBean = new InscritoBean();
	    $inscritoBusiness = new InscritoBusiness();
	    Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria idinscrito ', $idobj );
	    if ($idobj > 0) {
	        $inscritoBean = $inscritoBusiness->findById ( $idobj );
	    }
	    $idpessoa = Util::getIdObjeto($inscritoBean->getpessoa());
	    $pilotoBean = $pilotoBusiness->findByPessoa($idpessoa);
	    $idpessoa = Util::getIdObjeto($pilotoBean);
	    if($idpessoa==0){
	        $results = $pilotoBusiness->inscritoToPilotoSemAdicionarAoCampeonato($bean);
	        $pilotoBean = $results->getresposta();
	    }
	    
	    
	case Choice::ADICIONAR :
		$dbg = 0;
		if(Util::getIdObjeto($pilotoBean) < 1 ){
    		$pilotoBean = new PilotoBean();
    		$pilotoBusiness = new PilotoBusiness();
    		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria idpiloto ', $idobj );
    		if ($idobj > 0) {
    			$pilotoBean = $pilotoBusiness->findById ( $idobj );
    		}
		}
    	
		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria Util::getIdObjeto($pilotoBean) ', Util::getIdObjeto($pilotoBean) );
		
		$pilotoBateriaBusiness = new PilotoBateriaBusiness();
		$pilotoBateriaBean = new PilotoBateriaBean();
		$pilotoBateriaBean->setpiloto($pilotoBean);
		$pilotoBateriaBean->setpeso($pilotoBean->getpeso());
		$pilotoBateriaBean->setpesoextra($pilotoBean->getpesoextra());
		
		$pilotoBateriaBean->setbateria($selbateriabean);
		Util::echobr($dbg,'PilotoBateriaAdicionarControl adicionar bateria pilotoBateriaBean', $pilotoBateriaBean);
		
		$pilotoBateriaBean = $pilotoBateriaBusiness->adicionar($pilotoBateriaBean);

		Util::echobr ( $dbg, 'PilotoBateriaAdicionarControl ', $bean->getpiloto () );
		$choice = Choice::LISTAR;
		break;
			
	case Choice::AUSENTE :
	    $pilotoBateriaBusiness->ausente ( $bean );
	    $choice = Choice::LISTAR;
	    break;
	
	case Choice::PRESENTE :
	    $pilotoBateriaBusiness->presente( $bean );
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

// SEGUNDA ESCOLHA
switch ($choice) {
		
	
    case Choice::ATUALIZAR :
	    // reposicionamento do grid
	    $collection = $pilotoBateriaBusiness->findBateria ( $bean );
	    for($i = 0; $i < count ( $collection ); $i ++) {
	        $pilotoBateriaBeanList = $collection [$i];
	        $idpilotobateria = $pilotoBateriaBeanList->getid ();
	        $bean = $pilotoBateriaBusiness->findById($idpilotobateria);
	        $pregridlargada = $pilotoBateriaBeanList->getgridlargada ();
	        $newpregridlargada =   (isset ( $_POST ['pregridlargada_'.$idpilotobateria] )) ? $_POST ['pregridlargada_'.$idpilotobateria] : null ;
	        if ( $newpregridlargada != $pregridlargada ) {
	            $bean->setpregridlargada($newpregridlargada);
	            $pilotoBateriaBusiness->updatepregridlargada($bean);
	            break;
	        }
	    }
	    
	case Choice::VALIDAR:
		$entrada = isset ( $_POST ['entrada'] ) ? $_POST ['entrada'] : null ;
		if($entrada != null && $entrada != ''){
			$saida = $pilotoBateriaBusiness->validaResultado($entrada, $selcampeonato, $seletapa, $selbateria );
			$mensagem = "validado";
		}else{
			$mensagem = "entrada esta vazia";
		}
	
		
		$urlC = LISTAR;
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
		$urlC = LISTAR;
		break;
	case Choice::ABRIR :
		$urlC = EDITAR;
		break;
}


switch ($choice){
	case Choice::LISTAR :
		$collection = $pilotoBateriaBusiness->findBateria ( $bean );
		$urlC = LISTAR;
		break;
	
}	

$bean->getpostlog ();
$editar = true;
$novo = false;
$adicionarPilotoCampeonato = $selcampeonato > 0 && $seletapa > 0 && $selbateria > 0;


$maxpregridlargada = $pilotoBateriaBusiness->maxpregridlargada($bean);

$listaOpcoesMostrar = array();
$listaOpcoesMostrar[Choice::PBA_OCULTAR] = "Cancelar Adição";
$listaOpcoesMostrar[Choice::PBA_PILOTOCAMPEONATO] = "Piloto Campeonato";
$listaOpcoesMostrar[Choice::PBA_INSCRITOCAMPEONATO] = "Inscrito Campeonato";
$listaOpcoesMostrar[Choice::PBA_PILOTO] = "Piloto Geral";
$listaOpcoesMostrar[Choice::PBA_PESSOA] = "Pessoa";
$listaOpcoesMostrar[Choice::PBA_FORM_ADD] = "Adicionar Novo";

$divLargura = "100%";
switch ($choice) {
    case Choice::PBA_OCULTAR :
        $consulta_adicao = Choice::PBA_OCULTAR;
        break;
        
    case Choice::PBA_PILOTOCAMPEONATO :
        $consulta_adicao = Choice::PBA_PILOTOCAMPEONATO;
        break;
        
    case Choice::PBA_INSCRITOCAMPEONATO :
        $consulta_adicao = Choice::PBA_INSCRITOCAMPEONATO;
        break;
        
    case Choice::PBA_PILOTO :
        $consulta_adicao = Choice::PBA_PILOTO;
        break;
        
    case Choice::PBA_PESSOA :
        $consulta_adicao = Choice::PBA_PESSOA;
        break;
    
    case Choice::PBA_FORM_ADD :
        $consulta_adicao = Choice::PBA_FORM_ADD;
        break;
        
}

if($selbateria!=null){
    $cltPilotosBateriaPresentes = $pilotoBateriaBusiness->findBateriaPresente( $bean );
    $umpresente = count($cltPilotosBateriaPresentes);
}

switch ($consulta_adicao) {
    case Choice::PBA_OCULTAR :
        break;
        
    case Choice::PBA_PILOTOCAMPEONATO :
        $cltPilotos = $pilotoBateriaBusiness->findPilotoSemBateria( $selcampeonato, $seletapa, $selbateria );
        Util::echobr ( 0, 'PilotoBateriaAdicionarControl cltPilotos', $cltPilotos);
        break;
        
    case Choice::PBA_INSCRITOCAMPEONATO :
        $inscritoBusiness = new InscritoBusiness();
        $inscritoBean = new InscritoBean();
        $inscritoBean->setcampeonato ($selcampeonato);
        $cltInscritos = $inscritoBusiness->findAllSort ( $inscritoBean );
        Util::echobr ( 0, 'PilotoBateriaAdicionarControl $cltInscritos', $cltInscritos);
        break;
        
    case Choice::PBA_PILOTO :
        $cltPilotos = $pilotoBusiness->findAllAtivo() ;
        Util::echobr ( 0, 'PilotoBateriaAdicionarControl cltPilotos', $cltPilotos);
        break;
        
    case Choice::PBA_PESSOA :
        break;
        
//     case Choice::PBA_FORM_ADD :
//         $cltPessoaCollection = $pessoabusiness->findAllValidos();
//         break;
        
}


$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>