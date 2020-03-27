<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
class BateriaBusiness {
	public function adicionaPilotos($bateriaBean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new BateriaDAO ( $con );
			$results = $objDAO->adicionaPilotos ( $bateriaBean );
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
			$objDAO = new BateriaDAO ( $con );
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
	public function findAtivoBateriaByCampeonatoEtapa($idcampeonato, $idetapa) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new BateriaDAO ( $con );
			$results = $objDAO->findAtivoBateriaByCampeonatoEtapa ( $idcampeonato, $idetapa );
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
	 
	public function findByCampeonato($campeonato) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new BateriaDAO ( $con );
	        $results = $objDAO->findByCampeonato($campeonato);
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
	public function findAtivoByCampeonato($campeonato) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new BateriaDAO ( $con );
	        $results = $objDAO->findAtivoByCampeonato($campeonato);
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
	public function findBateriaByEtapa($bean) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new BateriaDAO ( $con );
	        $dbg = 0;
		Util::echobr ( $dbg, 'BateriaBusiness  findBateriaByEtapa $bean', $bean);
	        $results = $objDAO->findBateriaByEtapa( $bean );
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
	public function findAllEtapaCampeonato() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new BateriaDAO ( $con );
			$results = $objDAO->findAllEtapaCampeonato ();
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
			$objDAO = new BateriaDAO ( $con );
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
			$objDAO = new BateriaDAO ( $con );
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
	public function findById($id) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new BateriaDAO ( $con );
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
			$objDAO = new BateriaDAO ( $con );
			if ($bean->getid () == null || $bean->getid () == 0) {
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
	public function delete($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new BateriaDAO ( $con );
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