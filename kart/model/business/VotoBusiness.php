<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/VotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/VotoBean.php';

class VotoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
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
	
	public function findByCampeonato($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
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
	
	public function relatorioFinal($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->relatorioFinal($campeonato);
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
	
	public function findGruposFaltaVotarByEleitor($eleitor) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->findGruposFaltaVotarByEleitor($eleitor);
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
	
	public function relatorioFinalByGrupo($grupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->relatorioFinalByGrupo($grupo);
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
	
	public function relatorioFinalEleitorByGrupo($grupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->relatorioFinalEleitorByGrupo($grupo);
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
	
	public function totalVotosByCampeonato($campeonato) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->totalVotosByCampeonato($campeonato);
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
	
	public function totalEleitoresByCampeonato($campeonato)  {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->totalEleitoresByCampeonato($campeonato) ;
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
	
	
	public function totalVotosByGrupo($grupo) {
		$results = 0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->totalVotosByGrupo($grupo);
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
			$objDAO = new VotoDAO ( $con );
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
	
	public function findByEleitorCategoriaGrupo($eleitorcategoriagrupo){
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->findByEleitorCategoriaGrupo($eleitorcategoriagrupo);
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
	

	public function findByEleitorECandidatoCategoriaGrupo($bean) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->findByEleitorECandidatoCategoriaGrupo($bean);
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
			$objDAO = new VotoDAO ( $con );
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
		$ulog = 0;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			Util::echobr ($ulog, 'votobusiness in candidatocategoriagrupo', Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()));
			Util::echobr ($ulog, 'votobusiness in eleitorcategoriagrupo', Util::getIdObjeto($bean->geteleitorcategoriagrupo()));
			Util::echobr ($ulog, 'votobusiness in idpessoa candidato', Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()->getcandidato()->getpessoa()));
			Util::echobr ($ulog, 'votobusiness in idpessoa eleitor', Util::getIdObjeto($bean->geteleitorcategoriagrupo()->geteleitor()->getpessoa()));
				
			$beanVerifica = $this->findByEleitorECandidatoCategoriaGrupo($bean);
			Util::echobr ($ulog, 'votobusiness $beanVerifica', Util::getIdObjeto($beanVerifica));
			Util::echobr ($ulog, 'votobusiness verifica candidatocategoriagrupo', Util::getIdObjeto($beanVerifica->getcandidatoCategoriaGrupo()));
			Util::echobr ($ulog, 'votobusiness verifica eleitorcategoriagrupo', Util::getIdObjeto($beanVerifica->geteleitorcategoriagrupo()));

			if ( Util::getIdObjeto($bean) == 0 && // novo
				 Util::getIdObjeto($beanVerifica) == 0 && // não repetido
				 Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()->getcandidato()->getpessoa())!= // eleitor não ser ele mesmo  
				 Util::getIdObjeto($bean->geteleitorcategoriagrupo()->geteleitor()->getpessoa()) &&    // o candidato
				 Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()) > 0 && // ter candidato
				 Util::getIdObjeto($bean->geteleitorcategoriagrupo()) > 0) {   // ter eleitor
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
	
	public function salveUnico($bean) {
		$ulog = 0;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			Util::echobr ($ulog, 'votobusiness in candidatocategoriagrupo', Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()));
			Util::echobr ($ulog, 'votobusiness in eleitorcategoriagrupo', Util::getIdObjeto($bean->geteleitorcategoriagrupo()));
			Util::echobr ($ulog, 'votobusiness in idpessoa candidato', Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()->getcandidato()->getpessoa()));
			Util::echobr ($ulog, 'votobusiness in idpessoa eleitor', Util::getIdObjeto($bean->geteleitorcategoriagrupo()->geteleitor()->getpessoa()));
	
			$cltvotos = $this->findByEleitorCategoriaGrupo($bean->geteleitorcategoriagrupo());
			
			if ( Util::getIdObjeto($bean) == 0 && // novo
					count($cltvotos)< 1 && // não ter voto
					Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()->getcandidato()->getpessoa())!= // eleitor não ser ele mesmo
					Util::getIdObjeto($bean->geteleitorcategoriagrupo()->geteleitor()->getpessoa()) &&    // o candidato
					Util::getIdObjeto($bean->getcandidatoCategoriaGrupo()) > 0 && // ter candidato
					Util::getIdObjeto($bean->geteleitorcategoriagrupo()) > 0) {   // ter eleitor
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
	
	
	public function salveEleitorCategoriaGrupo($cltbean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$votobean = new VotoBean();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			
			$N = count ( $cltbean );
			Util::echobr ( 0, "VotoBusiness N", $N );
			$votobean = $cltbean[0];
			//deleta todos para adicionar os novos
			$this->deleteEleitorCategoriaGrupo($votobean);
			//não tem nenhum grupo selecionado
			if($votobean->getcategoria()==0){
				$N=0;
			}			
			for($i = 0; $i < $N; $i ++) {
				$results = $objDAO->insert ( $votobean );
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
			$objDAO = new VotoDAO ( $con );
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
	public function deleteEleitorCategoriaGrupo($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new VotoDAO ( $con );
			$results = $objDAO->deleteEleitorCategoriaGrupo ( $bean );
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