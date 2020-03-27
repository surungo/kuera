<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/InscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/CategoriaInscritoBusiness.php';
include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
include_once PATHAPP . '/mvc/kart/model/factory/TipoEventoEnum.php';
class InscritoBusiness {
	
	public function ajustaValor($bean) {
		// ajuste do valor
		$dbg = 0;
		$desc = "InscritoBusiness.ajustavalor";
		$soma = 0;//($bean->getnrinscrito ()) / 100;

		$categoriaInscritoBusiness = new CategoriaInscritoBusiness ();
		$categoriaInscritoBean = new CategoriaInscritoBean ();
		$parametroBusiness = new ParametroBusiness ();
		$parametroBean = new ParametroBean ();
		$campeonatoBusiness = new CampeonatoBusiness();
		$campeonatoBean = new CampeonatoBean();
		$campeonatoBean = $campeonatoBusiness->findById(Util::getIdObjeto($bean->getcampeonato()));
		
		//Util::echobr ( $dbg, $desc . ' $campeonatoBean->getsigla()', $campeonatoBean->getsigla() );
		$gaucho=false;
		$valorComGaucho = '0';
		if('402ARRAN1701'==$campeonatoBean->getsigla()){
			$campeonatoGauchoBean = $campeonatoBusiness->findBySigla ( '201ARRAN1701' );
			$beanCPFverificadoPago = $this->findByCPFCampeonato ( $bean->getcpf(), Util::getIdObjeto($campeonatoGauchoBean) );
			//Util::echobr ( $dbg, $desc . ' $beanCPFverificadoPago', $beanCPFverificadoPago );
			if($beanCPFverificadoPago->getsituacao()==$parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_PG )){
				$valorComGaucho = $campeonatoBean->getvalorpaypal();
				$gaucho = true;
			}
		}
		
		$categoriaInscritoAux = new CategoriaInscritoBean();
		$categoriaInscritoBean = new CategoriaInscritoBean();
		
		$cltCategoriaInscrito = $bean->getcategoriainscrito();
		if(count($cltCategoriaInscrito)<1){
			$cltCategoriaInscrito = $categoriaInscritoBusiness->findByInscrito($bean);
		}
		$quantidadeTotal = count($cltCategoriaInscrito);
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness $quantidadeTotal', $quantidadeTotal );
		
	 	$cltAux = array();
	 	//  se o piloto esta se cadastrando na segunda etapa e particiou do gaucho paga 200
	 	$valor = ($gaucho)?$valorComGaucho:$campeonatoBean->getvalor();
	 	$valorEvento = 0;
	 	$valorAux = $valor;
		for($inx=0;$inx<$quantidadeTotal;$inx++){
			$categoriaInscritoBean = $cltCategoriaInscrito[$inx];
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness $categoriaInscritoBean->getnome()', $categoriaInscritoBean->getnome() );
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness $categoriaInscritoBean->getvalor()', $categoriaInscritoBean->getvalor() );
			
			$qtaaux = count($cltAux);
			if($qtaaux>0){
				for($inx2=0;$inx2<$qtaaux;$inx2++){
					$categoriaInscritoAux = $cltAux[$inx2];
					//Util::echobr ( $dbg, $desc . 'InscritoBusiness $categoriaInscritoAux->getnome()', $categoriaInscritoAux->getnome() );
					//Util::echobr ( $dbg, $desc . 'InscritoBusiness $categoriaInscritoAux->getvalor()', $categoriaInscritoAux->getvalor() );
						
					if($categoriaInscritoAux->getnome()==$categoriaInscritoBean->getnome() &&
	 					$categoriaInscritoAux->getvalor()==$categoriaInscritoBean->getvalor() ){
						//valor por extenso é com desconto se existir
						if($campeonatoBean->getvalor()!=$campeonatoBean->getvalorporextenso())	{
							$valorAux = $campeonatoBean->getvalorporextenso();
						}
					}
				}
			}
			
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness $va$valorAuxlor', $valorAux );
				
			$valorEvento = $valorEvento + $valorAux;
			$valorAux = $valor;
			$cltAux[] =  $categoriaInscritoBean;
		}

		$bean->setvalor ( $valorEvento );
		$bean->setcategoriainscrito($cltCategoriaInscrito);
		
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness ajustaValor $bean->getvalor()', $bean->getvalor () );
		$valorEvento = $soma + $bean->getvalor ();
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness ajustaValor $valorEvento', $valorEvento );
		$bean->setvalor ( $valorEvento );
			
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness ajustaValor $bean->getvalor()', $bean->getvalor () );
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness ajustaValor $bean->getnrinscrito()', $bean->getnrinscrito () );
		//Util::echobr ( $dbg, $desc . 'InscritoBusiness ajustaValor $bean->getsituacao()', $bean->getsituacao () );
		
		return $bean;
	}
	
	public function inscrever($bean) {
		$dbg = 1;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$parametroBusiness = new ParametroBusiness ();
		$parametroBean = new ParametroBean ();
		$pessoaBusiness = new PessoaBusiness ();
		$pessoaBean = new PessoaBean ();
		
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			
			$campeonato = Util::getIdObjeto ( $bean->getcampeonato () );
			$campeonatoBean = $bean->getcampeonato ();
			$campeonatoBusiness = new CampeonatoBusiness ();
			$campeonatoBean = $campeonatoBusiness->findById ( $campeonato );

			
			Util::echobr ( $dbg, $desc . ' InscritoBusiness inscrever procurar Existente id nome cpf campeonato', 
			    Util::getIdObjeto ( $bean ) . " " . 
			    Util::getNomeObjeto ( $bean ) . " " .
			    $bean->getcpf() . " " . $bean->getcampeonato()
			    );
			
			$inscritoExistente = new InscritoBean ();
			$inscritoExistente = $objDAO->findById($bean);
			Util::echobr ( $dbg, $desc . ' InscritoBusiness inscrever id $inscritoExistente id nome', Util::getIdObjeto ( $inscritoExistente ) . " " . Util::getNomeObjeto ( $inscritoExistente ) );
			if ($inscritoExistente == null || $inscritoExistente->getid () == 0) {
			    $inscritoExistente = $objDAO-> findByCPFCampeonato($bean->getcpf(),$bean->getcampeonato());
			}
			Util::echobr ( $dbg, $desc . ' InscritoBusiness inscrever cpf $inscritoExistente id nome', Util::getIdObjeto ( $inscritoExistente ) . " " . Util::getNomeObjeto ( $inscritoExistente ) );
			
			//  manter id nr situacao
			if ($inscritoExistente != null && $inscritoExistente->getid () > 0) {
			    $bean->setid ( $inscritoExistente->getid () );
			    $bean->setnrinscrito ( $inscritoExistente->getnrinscrito () );
			    $bean->setsituacao ( $inscritoExistente->getsituacao () );
			}
			
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness  inscrever $bean->getnrinscrito()', $bean->getnrinscrito () );
			if ($bean->getnrinscrito() != - 1 && $bean->getnrinscrito() < 1) {
				//Util::echobr ( $dbg, $desc . 'InscritoBusiness  inscrever $bean->getnrinscrito() dif -1 e <1', $bean->getnrinscrito () );
				
				$tentativas = 10;
				$nrinscritoNovo = 0;
				while ( $tentativas > 0 ) {
					$nrinscritoNovo = $this->getNovoNrInscrito ( $campeonato );
					$bean->setnrinscrito ( $nrinscritoNovo );
					$beanExisteNrInscrito = $this->findByNrInscrito ( $nrinscritoNovo, $campeonato );
					//Util::echobr ( $dbg, $desc . 'InscritoBusiness  inscrever $tentativas nrinscrito', $tentativas . " " . $nrinscritoNovo );
					
					if ($beanExisteNrInscrito != null && $bean->getnrinscrito () != $beanExisteNrInscrito->getnrinscrito ()) {
						$tentativas = 0;
					}
					$tentativas --;
				}
			}
			$dbg = 0;
			Util::echobr ( $dbg, 'inscritoBusiness inscrever $bean->getnome', $bean->getnome() );
			
			/* verifica se é nova situacao ou se deve continuar a mesma*/
			$aguardandoLiberacao = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_AP );
			$bean->setsituacao ( $bean->getsituacao () == null ? $aguardandoLiberacao : $bean->getsituacao () );
			
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness inscrever $bean->getsituacao()', $bean->getsituacao () );
			
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness  $campeonatoBean->gettipoevento()', $campeonatoBean->gettipoevento()  );
			if($campeonatoBean->gettipoevento()==TipoEventoEnum::ARRANCADA){
				$bean = $this->ajustaValor($bean);
			}
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness  $campeonatoBean->getadicionarcentavos()', $campeonatoBean->getadicionarcentavos()  );
			if($campeonatoBean->getadicionarcentavos()==1){
				$bean->setvalor($bean->getvalor()+ ($bean->getnrinscrito()/100));
			}

			/* dados para atualizar pessoa */
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness $bean->getcpf()', $bean->getcpf());
			$pessoaBean = $pessoaBusiness->findByCPF($bean->getcpf());
			$pessoaBean->setcpf($bean->getcpf());
			$pessoaBean->setapelido($bean->getapelido());
			$pessoaBean->setnome($bean->getnome());
			$pessoaBean->setdtnascimento($bean->getdtnascimento());
			$pessoaBean->setpeso($bean->getpeso());
			$pessoaBean->setemail($bean->getemail());
			$pessoaBean->settelefone($bean->gettelefone());
			$pessoaBean->settamanhocamisa($bean->gettamanhocamisa());
			$pessoaBusiness->salveNotNull($pessoaBean);
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness salvou pessoa)', $pessoaBean->getcpf());
				
			// guarda categoria para futura adição
			$categoriaClt = $bean->getcategoria();
			$categoriainscritoClt = $bean->getcategoriainscrito();
			// retrocompatibilidade 1 carro
			if(count($categoriainscritoClt)>0){
				$categoriainscritobean = $categoriainscritoClt[0];
				$bean->setcarro($categoriainscritobean->getnome());
				$bean->setnrcarro($categoriainscritobean->getvalor());
			}
				
			
			if ($bean == null || $bean->getid () == null || $bean->getid () < 1) {
				$results = $objDAO->insert ( $bean );
				$bean = $results->getresposta ();
				$mensagem = $campeonatoBean->getmsgsucesso();
			} else {
				$results = $objDAO->update ( $bean );
				$mensagem = $campeonatoBean->getmsgatualizadosucesso();
			}
			// atualiza categorias
			//Util::echobr ( $dbg, $desc . 'InscritoBusiness count($categoriainscritoClt', count($categoriainscritoClt)  );
			if(count($categoriainscritoClt)>0){
				$bean->setcategoriainscrito($categoriainscritoClt);
				
				$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
				$categoriaInscritoBusiness->salveInscrito($bean);
			}	
			$results->setmensagem ( $mensagem );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAll ();
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function gruposPorIdCampeonato($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->gruposPorIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllByIdCampeonato($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllByIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllByIdCampeonatoSortId($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllByIdCampeonatoSortId ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllByIdCampeonatoSemEspera($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllByIdCampeonatoSemEspera ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllByIdCampeonatoSortIdSemEspera($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllByIdCampeonatoSortIdSemEspera ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritosFatorGrupo($idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritosFatorGrupo ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllByGrupoIdCampeonatoSortId($idcampeonato, $grupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllByGrupoIdCampeonatoSortId ( $idcampeonato, $grupo );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllPesoRangeIdCampeonato($idcampeonato, $pesoMax, $pesoMin) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllPesoRangeIdCampeonato ( $idcampeonato, $pesoMax, $pesoMin );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findAllSort($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findAllSort ( $bean );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findOrdenarGrupos($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findOrdenarGrupos ( $bean );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findPagosComCPFComPiloto($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findPagosComCPFComPiloto ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findInscritoPiloto($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findInscritoPiloto ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findPagosComCPFSemPiloto($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findPagosComCPFSemPiloto ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function relatorioInscrito($inscrito) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new InscritoDAO ( $con );
	        $results = $objDAO->relatorioInscrito($inscrito);
	    } catch ( Exception $ex ) {
	        // rollback transaction
	        $con->rollback ();
	        $dsm->close ( $con );
	        throw new Exception ( $ex->getMessage () );
	    }
	    try {
	        if ($con != null) {
	            // commit transaction
	            $con->commit ();
	            $dsm->close ( $con );
	        }
	    } catch ( Exception $ex ) {
	        throw new Exception ( $ex->getMessage () );
	    }
	    return $results;
	}
	
	public function findPagos($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findPagos ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findNaoPagos($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findNaoPagos ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findNaoPagosNaoPiloto($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findNaoPagosNaoPiloto ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findPagosSemCPF($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findPagosSemCPF ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findPagosSemCPFSemPiloto($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findPagosSemCPFSemPiloto ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findByBetweenIdDtEnvioNull($id1, $id2) {
		if ($id1 == 0 || $id1 == null || $id2 == 0 || $id2 == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByBetweenIdDtEnvioNull ( $id1, $id2 );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function findById($inscrito) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findById ( $inscrito );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	
	public function findByCPF($cpf) {
		if ($cpf == 0 || $cpf == "")
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByCPF ( $cpf );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	
	public function findByPessoa($pessoa) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByPessoa ( $pessoa );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	
	public function findForInscricao($cpf, $campeonato) {
		$bean = $inscritoBusiness->findByCPFCampeonato ( $cpfBusca, $idcampeonato );
				
		//Util::echobr ( $dbg, $desc . ' $bean id', Util::getIdObjeto ( $bean ) );
		
		// não encontrou inscrito
		if ($bean == null || Util::getNomeObjeto ( $bean ) == "") {
			$pessoaEncontrada = false;
		}
		
		if (!$pessoaEncontrada){
			// busca inscrito Campeonato(Evento) id 2 Arrancadas antigas
			$bean = new InscritoBean ();
			$bean = $inscritoBusiness->findByCPFCampeonato ( $cpfBusca, 2 );
			//Util::echobr ( $dbg, $desc . ' $bean id', Util::getIdObjeto ( $bean ) );
		
			// não encontrou inscrito
			if ($bean == null || Util::getNomeObjeto ( $bean ) == "") {
				$pessoaEncontrada = false;
			}else{
				$bean->setid(null);
			}
		}
		
		if (!$pessoaEncontrada){
			// busca pessoa
			$pessoaBusiness = new PessoaBusiness ();
			$pessoaBean = new PessoaBean();
			$pessoaBean->setcpf($cpfBusca);
			$pessoaBean = $pessoaBusiness->findByCPF($cpfBusca);
		
			if (Util::getIdObjeto ( $pessoaBean ) > 0) {
				$bean->setpessoa($pessoaBean );
				if ($bean == null || Util::getNomeObjeto ( $bean ) == "") {
					$bean->setid(null);
					$bean->setapelido ( $pessoaBean->getapelido () );
					$bean->setnome ( $pessoaBean->getnome () );
					$bean->setpeso ( $pessoaBean->getpeso () );
					$bean->setdtnascimento ( $pessoaBean->getdtnascimento () );
					$bean->settelefone ( $pessoaBean->gettelefone () );
					$bean->setemail ( $pessoaBean->getemail () );
					//Util::echobr ( $dbg, $desc . ' $$pessoaBean', Util::getIdObjeto ( $pessoaBean ) );
				}
			}
		}
		$bean->setcpf ( $cpfBusca );
		$bean->setcategoriainscrito($categoriaInscritoBusiness->findByInscrito($bean));
		
		
	
	}
	
	public function findByCPFCampeonato($cpf, $campeonato) {
		if ($cpf == 0 || $cpf == "")
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByCPFCampeonato ( $cpf, $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	
	public function findByCPFArrancada($cpf) {
		if ($cpf == 0 || $cpf == "")
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByCPFArrancada ( $cpf );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
		
	public function findByNrInscrito($nrinscrito, $campeonato) {
		if ($nrinscrito == 0 || $nrinscrito == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->findByNrInscrito ( $nrinscrito, $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function getNovoNrInscrito($campeonato) {
		if ($campeonato == 0 || $campeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->getNovoNrInscrito ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritoPorDiaIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritoPorDiaIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalByIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalByIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritosPorGrupoIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritosPorGrupoIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalNPago($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalNPago ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalPago($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalPago ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalAguardandoPagamento($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalAguardandoPagamento ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalEspera($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalEspera ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalSemDtPagamento($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->totalSemDtPagamento ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function totalComDtPagamento($campeonato) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			
			$results = $objDAO->totalComDtPagamento ( $campeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritosPorTamanhoCamisetaIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritosPorTamanhoCamisetaIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritosPorPesoIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritosPorPesoIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function inscritosPorPesoIdadeIdCampeonato($idcampeonato) {
		if ($idcampeonato == 0 || $idcampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->inscritosPorPesoIdadeIdCampeonato ( $idcampeonato );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function salve($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$erro = false;
		$isupdate = false;
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			// $bean->setsituacao(($bean->getdtpagamento()=="")?"Aguardando pagamento":"Pago");
			// guarda categoria inscrito para furura adição
			$categoriainscritoClt = $bean->getcategoriainscrito();

			if (Util::getIdObjeto($bean) > 0) {
				//Util::echobr ( $dbg, 'InscritoBusiness salve update $bean->getid()', $bean->getid () );
				$results = $objDAO->update ( $bean );
				$bean = $results->getresposta();
				$isupdate=true;
			} else {
				$inscbean = $this->findByCPFCampeonato($bean->getcpf(), $bean->getcampeonato);
				if($inscbean==null){
					//Util::echobr ( $dbg, 'InscritoBusiness salve insert $bean->getnome()', $bean->getnome () );
					$results = $objDAO->insert ( $bean );
					$bean = $results->getresposta();
				}else{
					$results->setmensagem("<span class='erro'>Inscrito existe</span>");
					$results->setresposta($bean);
					$results->setsucesso(false);
					$erro = true;
				}
			}
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}

		if(!$erro){

			$pessoaBean = new PessoaBean();
			$pessoaBusiness = new PessoaBusiness();
			if($isupdate){
				$pessoaBean->setcpf($bean->getcpf());
				$pessoaBean->setapelido($bean->getapelido());
				$pessoaBean->setnome($bean->getnome());
			}
			$pessoaBean->setdtnascimento($bean->getdtnascimento());
			$pessoaBean->setpeso($bean->getpeso());
			$pessoaBean->setemail($bean->getemail());
			$pessoaBean->settelefone($bean->gettelefone());
			$pessoaBean->settamanhocamisa($bean->gettamanhocamisa());
			$pessoaBean->setdtvalidaemail($bean->getdtvalidaemail());
	//		$pessoaBean->setsenha($bean->getsenha());
			$pessoaBusiness->salveNotNull($pessoaBean);
			if(count($categoriainscritoClt)>0){
				$bean->setcategoriainscrito($categoriainscritoClt);
				$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
				$categoriaInscritoBusiness->salveInscrito($bean);
			}
		}
		return $results;
	}
	
	public function salveSemCategoria($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$erro = false;
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			// $bean->setsituacao(($bean->getdtpagamento()=="")?"Aguardando pagamento":"Pago");
			// guarda categoria inscrito para furura adição
			//Util::echobr ( $dbg, 'InscritoBusiness salve update $bean->getid()', Util::getIdObjeto($bean) );
			if (Util::getIdObjeto($bean) > 0) {
				//Util::echobr ( $dbg, 'InscritoBusiness salve update $bean->getid()', $bean->getid () );
				$results = $objDAO->update ( $bean );
				$bean = $results->getresposta();
			} else {
				$inscbean = $this->findByCPFCampeonato($bean->getcpf(), $bean->getcampeonato);
				if($inscbean==null){
					//Util::echobr ( $dbg, 'InscritoBusiness salve insert $bean->getnome()', $bean->getnome () );
					$results = $objDAO->insert ( $bean );
					$bean = $results->getresposta();
				}else{
					$results->setmensagem("<span class='erro'>Inscrito existe</span>");
					$results->setresposta($bean);
					$results->setsucesso(false);
					$erro = true;
				}
			}
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		if(!$erro){
			$pessoaBean = new PessoaBean();
			$pessoaBusiness = new PessoaBusiness();
			$pessoaBean->setcpf($bean->getcpf());
			$pessoaBean->setapelido($bean->getapelido());
			$pessoaBean->setnome($bean->getnome());
			$pessoaBean->setdtnascimento($bean->getdtnascimento());
			$pessoaBean->setpeso($bean->getpeso());
			$pessoaBean->setemail($bean->getemail());
			$pessoaBean->settelefone($bean->gettelefone());
			$pessoaBean->settamanhocamisa($bean->gettamanhocamisa());
			$pessoaBean->setdtvalidaemail($bean->getdtvalidaemail());
			//		$pessoaBean->setsenha($bean->getsenha());
			$pessoaBusiness->salveNotNull($pessoaBean);
				
		}
		return $results;
	}
	
	
	public function delete($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->delete ( $bean );
			$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
			$categoriaInscritoBean = new  CategoriaInscritoBean();
			$categoriaInscritoBean->setinscrito($bean);
			$results = $categoriaInscritoBusiness->deleteInscrito ( $categoriaInscritoBean );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function updateDtEnvio($id) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->updateDtEnvio ( $id );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function updateAguardandoPagamento($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->updateAguardandoPagamento ( $bean );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	
	
	public function relatorio($dataBase) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new InscritoDAO ( $con );
			$results = $objDAO->relatorio ( $dataBase );
		} catch ( Exception $ex ) {
			// rollback transaction
			$con->rollback ();
			$dsm->close ( $con );
			throw new Exception ( $ex->getMessage () );
		}
		try {
			if ($con != null) {
				// commit transaction
				$con->commit ();
				$dsm->close ( $con );
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
}
?>