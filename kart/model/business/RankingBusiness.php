<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/RankingDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';

include_once PATHAPP . '/mvc/kart/model/dao/RankingPilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingPilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/dao/RankingEtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingEtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingEtapaBusiness.php';

include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoCampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
class RankingBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
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
	
	
	public function atualizaRanking ($idobj ) {
	    $dbg=1;
		$results = false;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$bean = $objDAO ->findByIdEdit ( $idobj );
			Util::echobr ( $dbg, 'RankingBusiness $bean->gettabelaranking() ', $bean->gettabelaranking() );
			if($objDAO->existsRankTemp($bean))
			    $results = $objDAO->dropRankTemp($bean);

			$results = $objDAO->createRankTemp($bean);
			//verificar se passou a quinta etapa para ajuste descarte
			$etapaBean = new EtapaBean();
			$etapaBean->setnumero(5);
			$etapaBean->setcampeonato($bean->getcampeonato());
			$etapaBusiness = new EtapaBusiness();
			$etapaRanking = $etapaBusiness->findbyid($bean->getetapa());
			if( $etapaRanking->getnumero() > 4 && 
				$etapaBusiness->isPassouNrEtapa($etapaBean)){
				
				$objDAO->descarte5RankTemp($bean);
			}
			Util::echobr ( $dbg, 'RankingBusiness etapaRanking->getnumero() ', $etapaRanking->getnumero() );
				
			//verificar etapa final para ajuste descarte
			if( $etapaRanking->getnumero() > 9 ){
				Util::echobr ( $dbg, 'RankingBusiness $bean->gettabelaranking() ', $bean->gettabelaranking() );
				$objDAO->descarte10RankTemp($bean);
			}
			
			$results = $objDAO->somaRankTemp($bean);
			
			$results = $objDAO->ordenaRanking ( $bean );
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
			$objDAO = new RankingDAO ( $con );
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
	public function findAllCampeonato($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findAllCampeonato ( $bean );
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
	
	public function findByEtapaCategoria($bean) {
		$result = new RankingBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$result = $objDAO->findByEtapaCategoria( $bean );
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
	
	public function findAllByEtapa($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findAllByEtapa( $bean );
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
	
	public function findRankTemp($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		Util::echobr ( 0, 'RankingBusiness findRankTemp', $bean);
			
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			//print_r($bean);
			if($objDAO->existsRankTemp($bean))
				$results = $objDAO->findRankTemp($bean);
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
	
	public function findAllCampeonatoMostrar($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			//print_r($bean);
			$results = $objDAO->findAllCampeonatoMostrar ( $bean );
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
	
	public function findByCampeonato($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			//print_r($bean);
			$results = $objDAO->findByCampeonato( $bean );
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
	
	
	public function findAtualEtapaInfo($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			//print_r($bean);
			$results = $objDAO->findAtualEtapaInfo( $bean );
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

	public function findAtualCampeonatoInfo($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			//print_r($bean);
			$results = $objDAO->findAtualCampeonatoInfo( $bean );
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

	public function findUltimoForCampeonatoMostrar($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findUltimoForCampeonatoMostrar ( $bean );
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
	public function findById($id) {
		if ($id == 0 || $id == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findById ( $id );
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
	public function findGraficoData($idcampeonato, $arrPilotos) {
		$results = Array ();
		$retorno = "";
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findGraficoData ( $idcampeonato, $arrPilotos );
			
			foreach ( $results as $k1 => $arrlinha ) {
				$linhafim = "";
				$linha = "";
				$maior = 0;
				foreach ( $arrlinha as $k3 => $valorM ) {
					$maior = ($k3 != 0 && ($maior == 0 || $maior < $valorM)) ? $valorM : $maior;
				}
				
				foreach ( $arrlinha as $k2 => $valor ) {
					
					$linha .= ($k2 != 0) ? ($maior - $valor) . ', ' : $valor . ', ';
					$linhafim .= ($k2 == 0) ? (( string ) (( float ) $valor - 1)) . ', ' : ($maior - $valor) . ', ';
				}
				// $retorno .= "[".substr($linhafim,0,strlen($linhafim)-2 )."],";
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
	public function findGraficoPosicao($idcampeonato, $arrPilotos) {
		$results = Array ();
		$retorno = "";
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConnection ( $bean );
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findGraficoPosicao ( $idcampeonato, $arrPilotos );
			
			foreach ( $results as $k1 => $arrlinha ) {
				$linha = "";
				$linhafim = "";
				foreach ( $arrlinha as $k2 => $valor ) {
					$linha .= $valor . ', ';
					$linhafim .= ($k2 == 0) ? (( string ) (( float ) $valor - 1)) . ', ' : $valor . ', ';
				}
				$retorno .= "[" . substr ( $linhafim, 0, strlen ( $linhafim ) - 2 ) . "],";
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
	public function findMaxByIdCampeonato($idCampeonato) {
		if ($idCampeonato == 0 || $idCampeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findMaxByIdCampeonato ( $idCampeonato );
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
	public function findByIdEdit($id) {
		if ($id == 0 || $id == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$results = $objDAO->findByIdEdit ( $id );
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
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		try {
			$dbg = 1;
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			// guarda coleção de etapas para atualizar depois
			$rankingetapaclt = $bean->getrankingetapaclt();
			
			if ($bean->getid () == null || $bean->getid () == 0) {
				$results = $objDAO->insert ( $bean );
			} else {
				$results = $objDAO->update ( $bean );
			}
			//salvar ranking etapa
			Util::echobr ( 0, 'RankingBusiness salve Util::getIdObjeto($bean)', Util::getIdObjeto($bean) );
			$rankingetapaBusiness = new RankingEtapaBusiness();
			$rankingetapaBusiness->deleteByIdRanking(Util::getIdObjeto($bean));

			foreach ($rankingetapaclt as &$rankingEtapasBean) {
				$rankingetapaBusiness->salve($rankingEtapasBean);
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
	public function rankearPilotos($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		$rankingBean = new RankingBean ();
		
		$cltPilotoCampeonato = Array ();
		$rankingpilotoclt = Array ();
		
		try {
			
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$pilotoCampeonatoDAO = new PilotoCampeonatoDAO ( $con );
			$bateriaDAO = new BateriaDAO ( $con );
			$etapaDAO = new EtapaDAO ( $con );
			$pilotoBateriaDAO = new PilotoBateriaDAO ( $con );
			$rankingPilotoDAO = new RankingPilotoDAO ( $con );
			if ($bean->getid () != null && $bean->getid () != 0) {
				$results = $objDAO->update ( $bean );
				$cltPilotoCampeonato = $pilotoCampeonatoDAO->findByCampeonato ( $idcampeonato );
				
				/*
				 * $rankingBean = $results->getresposta (); $idcampeonato = $rankingBean->getcampeonato (); $idetapa = $rankingBean->getetapa (); $etapaBean = $etapaDAO->findById($idetapa); $pilotoBean = new PilotoBean(); if(empty($rankingBean->getrankingpilotoclt())){ $rankingPilotoDAO->deleteByIdRanking($idRanking); } $cltBateria = Array(); foreach ( $cltPilotoCampeonato as $k => $pilotoBean ) { $idpiloto = $pilotoBean->getid(); $rankingPilotoBean = new RankingPilotoBean (); $cltBateria = $bateriaDAO->findByCampeonatoPiloto($idcampeonato, $idpiloto); $pilotoBateriaDAO->findPilotosEtapa($bean); foreach ( $cltPilotoCampeonato as $k => $pilotoBean ) { $rankingPilotoBean->setposicao ( $objDAO->getPosicao($idRanking, $idpiloto) ); //$rankingPilotoBean->setdesempate ( $beanRakingVO->getdesempate () ); //$rankingPilotoBean->setpontuacao ( $beanRakingVO->getvalorpontuacao () ); //$rankingPilotoBean->setranking ( $rankingBean->getid () ); //$rankingPilotoBean->setpiloto ( $beanRakingVO->getpiloto () ); $results = $rankingPilotoDAO->insert ( $rankingPilotoBean ); $rankingpilotoclt [] = $rankingPilotoBean; } // usort($cltRankingPiloto, array ("RankingPilotoBean", "cmp_obj")); $rankingBean->setrankingpilotoclt ( $rankingpilotoclt ); $results = $rankingBean; Util::echobr ( 0, "RankingBusiness cadastraPilotoRanking rankingBean ", $rankingBean );
				 */
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
	public function cadastraPilotoRankingOld($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		$rankingBean = new RankingBean ();
		
		$cltPilotoCampeonato = Array ();
		$rankingpilotoclt = Array ();
		
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingDAO ( $con );
			$pilotoCampeonatoDAO = new PilotoCampeonatoDAO ( $con );
			$rankingPilotoDAO = new RankingPilotoDAO ( $con );
			if ($bean->getid () != null && $bean->getid () != 0) {
				$results = $objDAO->update ( $bean );
				$rankingBean = $results->getresposta ();
				
				$idcampeonato = $rankingBean->getcampeonato ();
				$idetapa = $rankingBean->getetapa ();
				$cltPilotoCampeonato = $pilotoCampeonatoDAO->findByCampeonatoRankingEtapa ( $idcampeonato, $idetapa );
				// deletar rankingPiloto
				// $results = $rankingPilotoDAO->insert($rankingPilotoBean);
				$beanRakingVO = new RankingVO ();
				$i = 1;
				foreach ( $cltPilotoCampeonato as $k => $beanRakingVO ) {
					
					$rankingPilotoBean = new RankingPilotoBean ();
					
					$rankingPilotoBean->setposicao ( $i ++ );
					$rankingPilotoBean->setdesempate ( $beanRakingVO->getdesempate () );
					$rankingPilotoBean->setpontuacao ( $beanRakingVO->getvalorpontuacao () );
					$rankingPilotoBean->setranking ( $rankingBean->getid () );
					$rankingPilotoBean->setpiloto ( $beanRakingVO->getpiloto () );
					
					$results = $rankingPilotoDAO->insert ( $rankingPilotoBean );
					$rankingpilotoclt [] = $rankingPilotoBean;
				}
				
				// usort($cltRankingPiloto, array ("RankingPilotoBean", "cmp_obj"));
				
				$rankingBean->setrankingpilotoclt ( $rankingpilotoclt );
				$results = $rankingBean;
				Util::echobr ( 0, "RankingBusiness cadastraPilotoRanking rankingBean ", $rankingBean );
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
			$idRanking = $bean->getid ();
			if ($idRanking != null && $idRanking != 0) {
				$rankingPilotoDAO = new RankingPilotoDAO ( $con );
				$results = $rankingPilotoDAO->deleteByIdRanking ( $idRanking );
			}
			$objDAO = new RankingDAO ( $con );
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
}
?>