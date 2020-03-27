<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/DescarteDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/DescarteEtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/DescarteEtapaBusiness.php';
class DescarteBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new DescarteDAO ( $con );
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
	        $objDAO = new DescarteDAO ( $con );
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
	
	public function findByEventoSortAtivo($bean){
	    $dbg = 0;
	    $results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new DescarteDAO ( $con );
			Util::echobr ( $dbg, 'DescarteBus' . '$findByEventoSortAtivo ', $bean );
			$results = $objDAO->findByEventoSortAtivo($bean);
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
	
	public function findAllSortAtivo($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new DescarteDAO ( $con );
			$results = $objDAO->findAllSortAtivo ( $bean );
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
			$objDAO = new DescarteDAO ( $con );
			$results = $objDAO->findByCampeonato ( $campeonato );
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
public function findByCampeonatoAtivos($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new DescarteDAO ( $con );
			$results = $objDAO->findByCampeonatoAtivos ( $campeonato );
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
			$objDAO = new DescarteDAO ( $con );
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
			$objDAO = new DescarteDAO ( $con );
			
			// guarda coleção de etapas para atualizar depois
			$descarteetapaclt = $bean->getdescarteetapa();
						
			if ($bean->getid () == null || $bean->getid () == 0) {
				$results = $objDAO->insert ( $bean );
			} else {
				$results = $objDAO->update ( $bean );
			}
			//salvar descarte etapa
			$bean = $results->getresposta();
			Util::echobr ( 1, 'DescarteBusiness salve Util::getIdObjeto($bean)', Util::getIdObjeto($bean) );
			$descarteEtapaBusiness = new DescarteEtapaBusiness();
			$descarteEtapaBusiness->deleteByIdDescarte(Util::getIdObjeto($bean));

			foreach ($descarteetapaclt as $descarteEtapasBean) {
				$descarteEtapasBean->setdescarte($bean);
				$descarteEtapaBusiness->salve($descarteEtapasBean);
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
			$objDAO = new DescarteDAO ( $con );
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