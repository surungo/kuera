<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/RankingPilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingPilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/RankingBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/RankingBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
class RankingPilotoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
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
	public function findAllSort($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
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
	public function findByRanking($idRanking) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
			$results = $objDAO->findByRanking ( $idRanking );
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
			$objDAO = new RankingPilotoDAO ( $con );
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
	public function salve($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
			if ($bean->getid () == null || $bean->getid () == 0) {
				// verificar duplicidade
				$rankingPilotoBean = new RankingPilotoBean ();
				$rankingPilotoBean = $this->findById ( $id );
				if (($rankingPilotoBean->getpiloto ()->getid () == $bean->getpiloto ()->getid ()))
					$results = $objDAO->insert ( $bean );
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
	public function cadastraPilotos($idranking) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		try {
			$rankingBusiness = new RankingBusiness ();
			Util::echobr ( 0, "RankingPilotoBusiness $idranking ", $idranking );
			$rankingBean = $rankingBusiness->findById ( $idranking );
			$idranking = Util::getIdObjeto ( $rankingBean );
			$idcampeonato = Util::getIdObjeto ( $rankingBean->getcampeonato () );
			Util::echobr ( 0, "RankingPilotoBusiness $idcampeonato ", $idcampeonato );
			if ($idcampeonato < 1 || $idranking < 1) {
				return $results;
			}
			$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness ();
			$pilotoCampeonatoClt = $pilotoCampeonatoBusiness->findByCampeonato ( $idcampeonato );
			$totalPilotos = 0;
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
			$results = $objDAO->deleteByIdRanking ( $idranking );
			foreach ( $pilotoCampeonatoClt as $k => $piloto ) {
				$bean = new RankingPilotoBean ();
				$bean->setpiloto ( $piloto );
				$bean->setranking ( $idranking );
				$results = $objDAO->insert ( $bean );
				$totalPilotos = $totalPilotos + $results->getqta ();
			}
			$results->setmensagem ( "<span class='azul'>Total de pilotos " . $totalPilotos . " cadastrados no Ranking.</span>" );
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
	public function rankear($idranking) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new RankingPilotoDAO ( $con );
			$results = $objDAO->rankear ( $idranking );
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
			$objDAO = new RankingPilotoDAO ( $con );
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