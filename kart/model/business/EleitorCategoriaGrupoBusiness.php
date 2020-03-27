<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/EleitorCategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EleitorCategoriaGrupoBean.php';

class EleitorCategoriaGrupoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
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
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
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
	
	public function findByEleitorEvento($eleitor,$evento) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
			$results = $objDAO->findByEleitorEvento($eleitor,$evento);
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
	
	public function findByEleitor($eleitor) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
			$results = $objDAO->findByEleitor($eleitor);
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
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
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
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
			if ($bean->getid () == null || $bean->getid () == 0) {
				$results = $objDAO->insert ( $bean );
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
	
	
	public function salveEleitor($eleitorbean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$eleitorcategoriagrupobean = new EleitorCategoriaGrupoBean();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
			
		
			$eleitorCategoriagrupoAtualClt = $this->findByEleitor(Util::getIdObjeto($eleitorbean));
			$eleitorCategoriagrupoclt = $eleitorbean->getEleitorCategoriaGrupo();
			// teste array
			//for ($i = 0; $i < count($eleitorbean->geteleitorCategoriaGrupo()); $i ++){
			//	$eleitorCategoriaGrupoBeanTST = $eleitorbean->geteleitorCategoriaGrupo();
			//	Util::echobr (1, 'EleitorCategoriaGrupoBusiness $eleitorbean->geteleitorCategoriaGrupo() ',$eleitorCategoriaGrupoBeanTST[$i]->getCategoriaGrupo());
			//}
					
						
			$cltIdCategoriagrupoNovas = array ();
			$cltIdCategoriagrupoAtuais = array ();
				
			$cltIdCategoriagrupoRemover = array ();
			$cltIdCategoriagrupoAdicionar = array ();
				
			// lista de ids atuais
			for($atualCount = 0; $atualCount < count ( $eleitorCategoriagrupoAtualClt ); $atualCount ++) {
				$cltIdCategoriagrupoAtuais [] = Util::getIdObjeto($eleitorCategoriagrupoAtualClt [$atualCount]->getCategoriaGrupo());
			}
				
			// lista de ids novos
			for($novaCount = 0; $novaCount < count ( $eleitorCategoriagrupoclt ); $novaCount ++) {
				$cltIdCategoriagrupoNovas [] = Util::getIdObjeto($eleitorCategoriagrupoclt [$novaCount]->getCategoriaGrupo());
			}
				
			// Remover
			$cltIdCategoriagrupoRemover = array_diff ( $cltIdCategoriagrupoAtuais, $cltIdCategoriagrupoNovas );
			Util::echobr(0,"remover",$cltIdCategoriagrupoRemover);	
			// Adicionar
			$cltIdCategoriagrupoAdicionar = array_diff ( $cltIdCategoriagrupoNovas, $cltIdCategoriagrupoAtuais );
			Util::echobr(0,"adicionar",$cltIdCategoriagrupoAdicionar);
				
			$adicionado = 0;
			$removido = 0;
			// remover
			while ( 0 < count ( $cltIdCategoriagrupoRemover ) ) {
				$eleitorcategoriagrupobean = new EleitorCategoriaGrupoBean ();
				$eleitorcategoriagrupobean->seteleitor(Util::getIdObjeto($eleitorbean));
				$eleitorcategoriagrupobean->setcategoriagrupo( array_pop ( $cltIdCategoriagrupoRemover ));
				
				$results = $objDAO->deleteEleitorCategoriaGrupo($eleitorcategoriagrupobean);
				$removido = $removido + $results->getmensagem ();
			}
				
			// adicionar
			while ( 0 < count ( $cltIdCategoriagrupoAdicionar ) ) {
				$eleitorcategoriagrupobean = new EleitorCategoriaGrupoBean ();
				$eleitorcategoriagrupobean->seteleitor(Util::getIdObjeto($eleitorbean));
				$eleitorcategoriagrupobean->setcategoriagrupo( array_pop ( $cltIdCategoriagrupoAdicionar ));
				
				$results = $objDAO->insert($eleitorcategoriagrupobean);
				$adicionado = $adicionado + $results->getmensagem ();
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
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
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
	public function deleteEleitor($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EleitorCategoriaGrupoDAO ( $con );
			$results = $objDAO->deleteEleitor ( $bean );
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