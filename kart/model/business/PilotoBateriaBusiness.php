<?php
include_once DATASOURCEMANAGER;
include_once PATHPUBBEAN . '/ReturnDataBaseBean.php';

include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoCampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingVO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/BateriaBusiness.php';

class PilotoBateriaBusiness {
	public function findRanking($idcampeonato) {
		$cltPilotoCampeonato = Array ();
		$cltPilotoBateria = Array ();
		$cltRankingVO = Array ();
		$cltRankingAlfaVO = Array ();
		$arrRankingPontos = Array ();
		
		$pilotoCampeonatoBean = new PilotoCampeonatoBean ();
		$pilotoBateriaBean = new PilotoBateriaBean ();
		$rankingVO = new RankingVO ();
		
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			
			$pilotoCampeonatoDAO = new PilotoCampeonatoDAO ( $con );
			$objDAO = new PilotoBateriaDAO ( $con );
			
			$cltPilotoCampeonato = $pilotoCampeonatoDAO->findByCampeonatoRanking ( $idcampeonato );
			
			foreach ( $cltPilotoCampeonato as $k1 => $rankingVO ) {
				// teste com um sÃ³ piloto
				if (true || $rankingVO->getpiloto ()->getid () == 17) {
					$pesoMedio = 0;
					$pesoMedidas = 1;
					$cltPilotoBateria = $objDAO->findPilotoForRanking ( $rankingVO->getpiloto ()->getid (), $idcampeonato );
					$rankingVO->setcltPilotoBateria ( $cltPilotoBateria );
					if ($pesoMedio > $pesoMedidas) {
						$rankingVO->getPiloto ()->setPeso ( $pesoMedio / $pesoMedidas );
					}
					if ($rankingVO->getvalorpontuacao () == "") {
						$rankingVO->setvalorpontuacao ( 0 );
					}
					$cltRankingVO [] = $rankingVO;
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
		return $cltRankingVO;
	}
	public function findGraficoData($idcampeonato, $arrPilotos) {
		$results = Array ();
		$retorno = "";
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findGraficoData ( $idcampeonato, $arrPilotos );
			
			foreach ( $results as $k1 => $arrlinha ) {
				$linha = "";
				$maior = 0;
				foreach ( $arrlinha as $k3 => $valorM ) {
					$maior = ($k3 != 0 && ($maior == 0 || $maior < $valorM)) ? $valorM : $maior;
				}
				
				foreach ( $arrlinha as $k2 => $valor ) {
					
					$linha .= (($k2 != 0) ? ($valor - $maior) : $valor) . ', ';
				}
				$retorno .= "[" . substr ( $linha, 0, strlen ( $linha ) - 2 ) . "],";
			}
			$retorno = "[" . substr ( $retorno, 0, strlen ( $retorno ) - 1 ) . "]";
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
		return $retorno;
	}
	
	public function atualizaPosicoes($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->atualizaPosicoes( $bean);
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
	
	public function insertGridInversoPrecedente($bean)  {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$dbg = 0;
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			// adicionar pilotos se necessario
			$results = $objDAO-> insertGridInversoPrecedente($bean) ;
			// qualificar para criar grid
			// pegar tabela de ranking
			$rankingbus = new RankingBusiness();
			$rankingbean = new RankingBean();
			$bateriabus = new BateriaBusiness();
			$bateriabean = new BateriaBean();
			$bateriabean = $bateriabus->findbyid($bean->getbateria());
			$bateriabean = $bateriabus->findbyid($bateriabean->getbateriaprecedente());
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $bateriabean', Util::getIdObjeto($bateriabean ) );
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $bateriabean->getcategoria()', Util::getIdObjeto($bateriabean->getcategoria() ) );

			$rankingbean->setetapa($bateriabean->getetapa());
			$rankingbean->setcategoria($bateriabean->getcategoria());
			$rankingbean = $rankingbus->findByEtapaCategoria($rankingbean);
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $rankingbean->gettabelaranking() ', $rankingbean->gettabelaranking() );
			$results = $objDAO->qualificarGridInversoPrecedente($bean,$rankingbean ) ;
			$results = $objDAO->atualizaPosicoes($bean);
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
	
	public function qualificarGridInversoPrecedente($bean,$ranking){
		$result = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->qualificarGridInversoPrecedente($bean,$ranking);
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
		return $result;
	}
	
	public function insertGridInverso2Precedente1810($bean){
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			// adicionar pilotos se necessario
			$results = $objDAO-> insertGridInverso2Precedente1810($bean) ;
			$dbg = 0;
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insertGridInverso2Precedente1810 $results ', $results  );
			
			// qualificar para criar grid

			$results = $objDAO->qualificarGridInverso2Precedente1810($bean) ;
			$results = $objDAO->atualizaPosicoes($bean);
			
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
	
	
	public function insertGridInverso2PioresPrecedente1810($bean){
	
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			// adicionar pilotos se necessario
			$results = $objDAO-> insertGridInverso2PioresPrecedente1810($bean) ;
			// qualificar para criar grid
			// pegar tabela de ranking
			$rankingbus = new RankingBusiness();
			$rankingbean = new RankingBean();
			$bateriabus = new BateriaBusiness();
			$bateriabean = new BateriaBean();
			$bateriabean = $bateriabus->findbyid($bean->getbateria());
			$bateriabean = $bateriabus->findbyid($bateriabean->getbateriaprecedente());
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $bateriabean', Util::getIdObjeto($bateriabean ) );
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $bateriabean->getcategoria()', Util::getIdObjeto($bateriabean->getcategoria() ) );

			$rankingbean->setetapa($bateriabean->getetapa());
			$rankingbean->setcategoria($bateriabean->getcategoria());
			$rankingbean = $rankingbus->findByEtapaCategoria($rankingbean);
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness insGridInvPrc $rankingbean->gettabelaranking() ', $rankingbean->gettabelaranking() );
			$results = $objDAO->qualificarGridInverso2PioresPrecedente1810($bean,$rankingbean ) ;
			$results = $objDAO->atualizaPosicoes($bean);

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
	
	
	
	public function voltaGeral() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->voltaGeral ();
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
	public function findPilotoBateria($bean) {
		$this->results = new PilotoBateriaBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$this->results = $objDAO->findPilotoBateria ($bean);
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
		return $this->results;
	}
	
	public function mutiplica10pregridlargada($bean) {
		if (Util::getIdObjeto ( $bean->getbateria () ) == 0)
			return null;
			$results = Array ();
			$con = null;
			$dsm = new DataSourceManager ();
			try {
				$con = $dsm->getConnection ( $bean );
				$objDAO = new PilotoBateriaDAO ( $con );
				$results = $objDAO->mutiplica10pregridlargada ( $bean );
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
	
	public function mutiplica10posicao($bean) {
		if (Util::getIdObjeto ( $bean->getbateria () ) == 0)
			return null;
			$results = Array ();
			$con = null;
			$dsm = new DataSourceManager ();
			try {
				$con = $dsm->getConnection ( $bean );
				$objDAO = new PilotoBateriaDAO ( $con );
				$results = $objDAO->mutiplica10posicao ( $bean );
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
	
	public function findBateria($bean) {
		if (Util::getIdObjeto ( $bean->getbateria () ) == 0)
			return null;
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findBateria ( $bean );
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
	
	public function findBateriaPresente($bean) {
	    if (Util::getIdObjeto ( $bean->getbateria () ) == 0)
	        return null;
	        $results = Array ();
	        $con = null;
	        $dsm = new DataSourceManager ();
	        try {
	            $con = $dsm->getConnection ( $bean );
	            $objDAO = new PilotoBateriaDAO ( $con );
	            $results = $objDAO->findBateriaPresente ( $bean );
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
	public function findPilotosEtapa($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findPilotosEtapa ( $bean );
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
			$objDAO = new PilotoBateriaDAO ( $con );
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
	public function findBateriaByCampeonatoEtapa($idcampeonato, $idetapa) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findBateriaByCampeonatoEtapa ( $idcampeonato, $idetapa );
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
	
	public function findBateriaByCampeonatoEtapaBateria($idcampeonato, $idetapa, $idbateria) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findBateriaByCampeonatoEtapaBateria ( $idcampeonato, $idetapa, $idbateria );
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
	
	public function findBateriaByCampeonatoEtapaBateriaPiloto($idcampeonato, $idetapa, $idbateria, $idpiloto) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findBateriaByCampeonatoEtapaBateriaPiloto( $idcampeonato, $idetapa, $idbateria, $idpiloto);
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
		
	public function findBateriaByCampeonatoEtapaBateriaPilotoNome($idcampeonato, $idetapa, $idbateria, $nome) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
	$dbg = 0;
	Util::echobr ( $dbg, 'PilotoBateriaBusiness c e b c ', $idcampeonato.", ".$idetapa.", ".$idbateria.", ".$nome);
					    
			$results = $objDAO->findBateriaByCampeonatoEtapaBateriaPilotoNome( $idcampeonato, $idetapa, $idbateria, $nome);
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

	public function findBateriaByCampeonatoEtapaPilotoNome($idcampeonato, $idetapa, $nome) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$dbg = 0;
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			
			Util::echobr ( $dbg, 'PilotoBateriaBusiness c e b c ', $idcampeonato.", ".$idetapa.", ".$nome);
					    
			$results = $objDAO->findBateriaByCampeonatoEtapaPilotoNome( $idcampeonato, $idetapa, $nome);
			
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
	
	public function findPilotoSemBateriaNotBateria($idcampeonato, $idetapa, $idbateria) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findPilotoSemBateriaNotBateria($idcampeonato, $idetapa, $idbateria);
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
	
	public function findPilotoSemBateria($idcampeonato, $idetapa, $idbateria) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findPilotoSemBateria ( $idcampeonato, $idetapa, $idbateria);
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
	public function addTodosPilotoSemBateria($campeonato, $etapa, $bateria) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $this->findPilotoSemBateria($campeonato, $etapa);
			for($i = 0; $i < count ( $results ); $i ++) {
				$pilotoBateriaBeanList = $results [$i];
				$pilotoBateriaBeanList->setbateria ( $bateria );
				$this->salve ( $pilotoBateriaBeanList );
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
		return $results;
	}
	public function findAllSort($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
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
	
	public function findPilotoCPF( $cpf, $selbateria ) {
	    if ($cpf == 0 || $cpf == null)
	        return null;
	    if (Util::getIdObjeto($selbateria) == 0 )
            return null;
     
        $results = null;
        $con = null;
        $dsm = new DataSourceManager ();
        try {
            $con = $dsm->getConn (get_class($this));
            $objDAO = new PilotoBateriaDAO ( $con );
            $results = $objDAO->findPilotoCPF( $cpf, $selbateria );
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
	
	public function findById($bean) {
		if (UTIL::getIdObjeto($bean) == 0 )
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->findById ( $bean );
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
	
	public function validaResultado($entrada, $idcampeonato, $idetapa, $idbateria ) {
		$dbg = 0;
		$delimiter = 1; // 1 - tab , 2 - espacos ,  3 - virgulas
		$linhas = explode("\n", $entrada );
		$saida = array();
		$saidaTemp = array();
		foreach ($linhas as &$linha){
			$linha = trim($linha);
			$saidaTemp[] = explode("\t", $linha);
		}
		Util::echobr ( $dbg, 'PilotoBateriaBusiness nr tabs cols', count($saidaTemp[0]));
		
		if(count($saidaTemp[0])<2){
			$delimiter = 3;
			$saidaTemp = array();
			
			foreach ($linhas as &$linha){
				$linha = trim($linha);
				$saidaTemp[] = explode(',', $linha);
//				Util::echobr ( $dbg, 'PilotoBateriaBusiness virgula $saidaTemp', $saidaTemp);
		
			}
			Util::echobr ( $dbg, 'PilotoBateriaBusiness nr virgula cols', count($saidaTemp[0]));
		
			if(count($saidaTemp[0])<2){
				$delimiter = 2;
				$saidaTemp = array();
				foreach ($linhas as &$linha){
					$linha = strtolower(str_replace("("," (",$linha));
					$saidaTemp[] = explode(" ", $linha);
				}
			}
		}
		
		Util::echobr ( $dbg, 'PilotoBateriaBusiness $delimiter', $delimiter);
		foreach ($saidaTemp as &$lin){
			$linha = array();

			$sizelinha = count($lin);

			$pos = 0;
			$nome = '';
			$kart = 0;
			$volta = '';// 00:00:58,998
			$validade = '';
			$nmbateria = '';
			$pena = '';
			$colnum = 0;
			$finpena = 0;
			
			foreach ($lin as &$coluna){
				switch ($colnum ) {
					case 0 :
						//posicao
						$pos = trim($coluna);
					break;
					case 1 :
					        //kart
						$kart = trim($coluna);
					break;
					case 2 :
						//nome ou apelido
						$arrayNome = explode("(", $coluna);
						if(count($arrayNome)>1){
							$nome = $arrayNome[0];
							$pena = "(".trim($arrayNome[1]);						
						}else{
							$nome = trim($coluna);
						}
					
					break;
					case 3 :
						if($delimiter == 1){
							$volta = $coluna;
						}else if ($delimiter == 3 ){
							$pena = trim($arrayNome[1]);
						}else{
							$nome .= " ".trim($coluna);
						}
					break;
					case 4 :
						if($delimiter == 2){
							if(strpos(trim($coluna),"pen") > -1){
								$pena .= trim($coluna);
								if(strpos(trim($coluna),")") > -1)$finpena=1;
							}
						}
					break;
					case 5:
						if($delimiter == 2){
							if( strpos(trim($coluna),"pen") > -1 || ($pena != "" && $finpena == 0) ){
								$pena .= trim($coluna);
								if(strpos(trim($coluna),")") > -1)$finpena=1;
							}
						}
					break;
					case 6:
						if($delimiter == 2){
							if( $pena != "" && $finpena == 0 ){
								$pena .= trim($coluna);
								if(strpos(trim($coluna),")") > -1)$finpena=1;
							}
						}
					break;
					case 7:
						if($delimiter == 2 ){
							if($pena != "" && $finpena == 0 ){
								$pena .= trim($coluna);
								if(strpos(trim($coluna),")") > -1)$finpena=1;
							}
						}
						if($delimiter == 3 ){
							$volta = $coluna;
						}
					break;
					
					
				}
				
				// pegar volta
				if($delimiter == 2 && $sizelinha-3  == $colnum ){
					$volta = $coluna;
				
				}
				
				
				$colnum++;
			}
			$dbg=0;
			$cltpilotoBateria;
			if($nome!=''){
				$cltpilotoBateria = $this->findBateriaByCampeonatoEtapaPilotoNome($idcampeonato, $idetapa, $nome);
			}
			$validade = (count($cltpilotoBateria)>0)? "<span style='color:green'>valido</span>": "<span style='color:red'>invalido</span>";
			foreach ($cltpilotoBateria as &$pilotoBateria){
				$nmbateria .= " - ". $pilotoBateria->getbateria()->getnome() ;
				Util::echobr ( $dbg, 'PilotoBateriaBusiness pilotoBateria ', $pilotoBateria->getbateria()->getnome());
			
			}
			
			//$de =   array( "(dqf)", "(pen3s)", "(pen5s)", "(pen6s)", "(pen10s)", "(pen 5*)" ,"(pen 35*)", "(pen20*)", "(pen5*)", "(pen25s)");
			//$para = array( "DQF",    "3seg",    "5seg",    "6seg",    "10seg"   , "5seg"     ,"35seg"   ,  "20seg"  , "5seg"   , "25seg"   );
			$de =   array(" ", "(dqf)", "(pen", "s)",  "*)"    ,"pen");
			$para = array("",  "DQF",    "",    "seg", "seg"   ,""   );
			$pena = str_replace($de, $para, strtolower($pena));
			
			$saida[] = array( 
				'pos' => $pos, 
				'kart' => $kart,  
				'nome' => $nome,  
				'validade' => $validade,  
				'bateria' => $nmbateria,  
				'volta' => $this->ajustavolta( $volta ),  
				'pena' => $pena);
			
		}
		return $saida;
	}
	
	public function sorteioKart($bean) {
		$dbg = 0;
		$results = null;
		$this->limparSorteioKartBateria($bean);
		$bean->setsort("pilotobateria.idpregridlargada asc, pilotobateria.dtmodificacao desc ");
		$cltpilotobateria = $this->findBateriaPresente($bean);
		shuffle($cltpilotobateria);
		for($i = 0; $i < count ( $cltpilotobateria ); $i ++) {
			$cltpilotobateria[$i]->setposicaokart( $i + 1 );
			$this->salve($cltpilotobateria[$i]);
		}
		return $cltpilotobateria;
	}
	
	public function sorteioPreGrid($bean) {
		$dbg = 0;
		$results = null;
		$bean->setsort("pilotobateria.idpregridlargada asc, pilotobateria.dtmodificacao desc ");
		$cltpilotobateria = $this->findBateria($bean);
		shuffle($cltpilotobateria);
		for($i = 0; $i < count ( $cltpilotobateria ); $i ++) {
			$cltpilotobateria[$i]->setpregridlargada( $i + 1 );
			$this->salve($cltpilotobateria[$i]);
		}
		$this->ajustegridlargada($bean);
		return $cltpilotobateria;
	}
	
	public function remover($bean) {
	    $dbg = 0;
	    $results = null;
	    $beanpilotobateria = $bean;
	    $results = $this->delete($bean);
	    
	    $this->ajustepregridlargada($beanpilotobateria);
	    
	    return $results;
	}
	
	public function presente($bean) {
	    $dbg = 0;
	    $bean = $this->findById($bean);
	    $bean->setgridlargada($bean->getpregridlargada());
	    $bean->setpresente ("S");
	    $maxposicaokart = $this->maxposicaokart($bean);
	    $bean->setposicaokart($maxposicaokart+1);
	    $retorno = $this->salve($bean);
	    $this->ajustegridlargada($bean);
	    return $retorno;
	}
	
	public function ausente($bean) {
	    $dbg = 0;
	    $bean = $this->findById($bean);
	    $bean->setgridlargada(null);
	    $bean->setpresente ("N");
	    $bean->setposicaokart(null);
	    $bean->setkart(null);
	    $retorno = $this->salve($bean);
	    $this->ajustegridlargada($bean);
	    return $retorno;
	}
		
	public function adicionar($bean) {
	    $dbg = 0;
	    Util::echobr($dbg,'PilotoBateriaBusiness adicionar ', $bean );
	    $beanpilotobateria = $bean;
	    $bean->setpregridlargada("9999" );
	    $retorno = $this->salve($bean);
	    $this->ajustepregridlargada($beanpilotobateria);
	    return $retorno;
	}
	
	public function updateposicao($bean) {
		$dbg = 0;
		$results = null;
		$beanpilotobateria = $bean;
		$this->ajusteposicao($beanpilotobateria);
		return $results;
	}
	
	function ajusteposicao($beanpilotobateria){
		$this->mutiplica10posicao($beanpilotobateria);
		if( Util::getIdObjeto($beanpilotobateria->getpiloto()) > 0 ){
			$this->salve($beanpilotobateria);
		}
		
		$beanpilotobateria->setsort("pilotobateria.idposicao asc, pilotobateria.dtmodificacao desc ");
		$cltpilotobateria = $this->findBateriaPresente($beanpilotobateria);
		$poschegada=1;
		for($i = 0; $i < count ( $cltpilotobateria ); $i ++) {
			$beanpilotobateria = $cltpilotobateria [$i];
			if(Util::getIdObjeto( $beanpilotobateria->getposicao()) >9){
				$beanpilotobateria->setposicao($poschegada);
				$beanpilotobateria = $this->salve($beanpilotobateria);
				$poschegada++;
			}else{
				$beanpilotobateria->setposicao(null);
				$beanpilotobateria = $this->salve($beanpilotobateria);
			}
		}
	}
	
	
	public function updatepregridlargada($bean) {
		$dbg = 0;
		$results = null;
		$beanpilotobateria = $bean;
		$this->ajustepregridlargada($beanpilotobateria);
		return $results;
	}
	
	function ajustepregridlargada($beanpilotobateria){
		$this->mutiplica10pregridlargada($beanpilotobateria);
		if( Util::getIdObjeto($beanpilotobateria->getpiloto()) > 0 ){
			$this->salve($beanpilotobateria);
		}
		
		$beanpilotobateria->setsort("pilotobateria.idpregridlargada asc, pilotobateria.dtmodificacao desc ");
    	$cltpilotobateria = $this->findBateria($beanpilotobateria);
    	$pospregridlargada=1;
    	for($i = 0; $i < count ( $cltpilotobateria ); $i ++) {
    		$beanpilotobateria = $cltpilotobateria [$i];
    		$beanpilotobateria->setpregridlargada($pospregridlargada);
    		$beanpilotobateria = $this->salve($beanpilotobateria);
    		$pospregridlargada++;
    	}
	}
	
	public function maxpregridlargada($bean) {
        $results = 0;
        $con = null;
        $dsm = new DataSourceManager ();
        try {
            $con = $dsm->getConn (get_class($this));
            $objDAO = new PilotoBateriaDAO ( $con );
            $results = $objDAO->maxpregridlargada( $bean);
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
		
	public function limparPosicoes($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->limparPosicoes( $bean);
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
	
	public function limparSorteioKartBateria($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->limparSorteioKartBateria( $bean);
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
	
	public function todosPresenteBateria($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->todosPresenteBateria( $bean);
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
	
	public function todosAusenteBateria($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->todosAusenteBateria( $bean);
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
	
	
	public function updategridlargada($bean) {
		$dbg = 0;
		$results = null;
		$beanpilotobateria = $bean;
		$results = $this->salve($beanpilotobateria);
		$this->ajustegridlargada($beanpilotobateria);
		
		return $results;
	}
	
	function ajustegridlargada($beanpilotobateria){
		$beanpilotobateria->setsort("pilotobateria.idpregridlargada asc, pilotobateria.dtmodificacao desc ");
		$cltpilotobateria = $this->findBateriaPresente($beanpilotobateria);
		
		$posgridlargada=1;
		for($i = 0; $i < count ( $cltpilotobateria ); $i ++) {
			$pilotoBateriaBean = $cltpilotobateria [$i];
			$pilotoBateriaBean->setgridlargada($posgridlargada);
			$pilotoBateriaBean = $this->salve($pilotoBateriaBean);
			$posgridlargada++;
		}
	}
	
	public function maxgridlargada($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->maxgridlargada( $bean);
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
	
	public function maxposicaokart($bean) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->maxposicaokart( $bean);
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
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			
			$objDAO = new PilotoBateriaDAO ( $con );
			// piloto ausente limpar dados
			if ($bean->getpresente () == null || $bean->getpresente () == 'N') {
			    $bean->getposicaooficial ( null );
			    $bean->setgridlargada ( null );
			    $bean->setposicao ( null );
			    $bean->setkart ( null );
				$bean->setvolta ( null );
				
			}
			
			if ($bean->getid () == null || $bean->getid () == 0) {
				
				// mudan�0Š4a de regra agora piloto pode por causa de duas categorias baterias
				/*
				// piloto sÃ³ pode participar uma ves na etapa (antes
				$etapaBean = $etapaBusiness->findByBateria ( $bean->getbateria () );
				if (! $etapaBusiness->isPiloto ( $etapaBean, $bean->getpiloto () )) {
				*/	
				$beanaux = $this->findPilotoBateria($bean);
				
				if(Util::getIdObjeto($beanaux) > 0 ){
					$results->setresposta ( $bean );
					$results->setmensagem ( "<span class='vermelho'>J&aacute; esta cadastado nesta bateria:" . Util::getNomeObjeto($bean->getpiloto () ). ".</span>" );
					return $results;
				}
				
				
				$results = $objDAO->insert ( $bean );
				/*} else {
					$results->setresposta ( $id );
					$results->setmensagem ( "<span class='azul'>J&aacute; esta cadastado. idpiloto:" . $bean->getpiloto () . ".</span>" );
				}*/
			} else {
				$results = $objDAO->update ( $bean );
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
		return $results;
	}
	public function delete($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->delete ( $bean );
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
	public function deletebateria($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->deletebateria ( $bean );
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
	public function deleteetapa($idetapa) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoBateriaDAO ( $con );
			$results = $objDAO->deleteetapa ( $idetapa );
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
	
	public function ajustavolta($volta){
		$segundos = '00';
		$minutos = '00';
		$horas = '00';
		$milisegundos = '000';
		
		$voltaTemp = trim($volta);
		$voltaTemp = str_replace(".",",",$volta);
		// pegar milisegundos
		$div1 = explode(",", $voltaTemp);
		$milisegundos = (isset($div1[1]))?str_pad(trim($div1[1]), 3, "0", STR_PAD_RIGHT):'000'; 
		$voltaTemp = $div1[0];
		$div2 = explode(":", $voltaTemp);
		// pegar segundos,minutos ....
		$result = array_reverse($div2);
		for($inxpart = 0;$inxpart <3;$inxpart++){
			switch ( $inxpart ) {
				case 0:
					$segundos = (isset($result[$inxpart]))?str_pad(trim($result [$inxpart]), 2, "0", STR_PAD_LEFT):'00';
					break;
				case 1:
					$minutos = (isset($result [$inxpart]))?str_pad(trim($result [$inxpart]), 2, "0", STR_PAD_LEFT):'00'; 
					break;
				case 2:
					$horas = (isset($result [$inxpart]))?str_pad(trim($result [$inxpart]), 2, "0", STR_PAD_LEFT):'00'; 
					break;
			
			}
		}
		
		return $horas.':'.$minutos .':'.$segundos .','.$milisegundos;
	}
}
?>