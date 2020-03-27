<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/CandidatoCategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CandidatoCategoriaGrupoBean.php';

class CandidatoCategoriaGrupoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
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
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
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
	
	public function findByCandidatoEvento($candidato,$evento) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->findByCandidatoEvento($candidato,$evento);
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
	
	public function findByCandidato($candidato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->findByCandidato($candidato);
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
	
	public function findByCategoriaGrupo($categoriagrupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->findByCategoriaGrupo($categoriagrupo);
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
	
	public function findAllNotEleitor($eleitorCategoriaGrupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->findAllNotEleitor($eleitorCategoriaGrupo);
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
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
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
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
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
	
	
	public function salveCandidato($candidatobean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			
			$candidatoCategoriagrupoAtualClt = $this->findByCandidato(Util::getIdObjeto($candidatobean));
			$candidatoCategoriagrupoclt = $candidatobean->getCandidatoCategoriaGrupo();
			// teste array
			//for ($i = 0; $i < count($candidatobean->getcandidatoCategoriaGrupo()); $i ++){
			//	$candidatoCategoriaGrupoBeanTST = $candidatobean->getcandidatoCategoriaGrupo();
			//	Util::echobr (1, 'CandidatoCategoriaGrupoBusiness $candidatobean->getcandidatoCategoriaGrupo() ',$candidatoCategoriaGrupoBeanTST[$i]->getCategoriaGrupo());
			//}
					
						
			$cltIdCategoriagrupoNovas = array ();
			$cltIdCategoriagrupoAtuais = array ();
				
			$cltIdCategoriagrupoRemover = array ();
			$cltIdCategoriagrupoAdicionar = array ();
				
			// lista de ids atuais
			for($atualCount = 0; $atualCount < count ( $candidatoCategoriagrupoAtualClt ); $atualCount ++) {
				$cltIdCategoriagrupoAtuais [] = Util::getIdObjeto($candidatoCategoriagrupoAtualClt [$atualCount]->getCategoriaGrupo());
			}
				
			// lista de ids novos
			for($novaCount = 0; $novaCount < count ( $candidatoCategoriagrupoclt ); $novaCount ++) {
				$cltIdCategoriagrupoNovas [] = Util::getIdObjeto($candidatoCategoriagrupoclt [$novaCount]->getCategoriaGrupo());
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
				$candidatocategoriagrupobean = new CandidatoCategoriaGrupoBean ();
				$candidatocategoriagrupobean->setcandidato(Util::getIdObjeto($candidatobean));
				$idCandidat=array_pop ( $cltIdCategoriagrupoRemover );
				$candidatocategoriagrupobean->setcategoriagrupo( $idCandidat) ;
				
				$results = $objDAO->deleteCandidatoCategoriaGrupo($candidatocategoriagrupobean);
				$removido = $removido + $results->getmensagem ();
			}
				
			// adicionar
			while ( 0 < count ( $cltIdCategoriagrupoAdicionar ) ) {
				$candidatocategoriagrupobean = new CandidatoCategoriaGrupoBean ();
				$candidatocategoriagrupobean->setcandidato(Util::getIdObjeto($candidatobean));
				$candidatocategoriagrupobean->setcategoriagrupo( array_pop ( $cltIdCategoriagrupoAdicionar ));
				
				$results = $objDAO->insert($candidatocategoriagrupobean);
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
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
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
	
	public function deleteCandidato($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->deleteCandidato ( $bean );
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
	
	public function deleteCategoriaGrupo($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CandidatoCategoriaGrupoDAO ( $con );
			$results = $objDAO->deleteCategoriaGrupo($bean);
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