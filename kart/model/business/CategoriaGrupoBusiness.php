<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaGrupoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaGrupoBean.php';
include_once PATHPUBBEAN . '/ReturnDataBaseBean.php';
class CategoriaGrupoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
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
			$objDAO = new CategoriaGrupoDAO ( $con );
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
	
	public function findEleitorCandidatoCampeonato($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
			$results = $objDAO->findEleitorCandidatoCampeonato($campeonato);
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
			$objDAO = new CategoriaGrupoDAO ( $con );
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
	
	public function findByGrupo($grupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
			$results = $objDAO->findByGrupo($grupo);
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
	
	public function findByNomeGrupo($grupo) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
			$results = $objDAO->findByNomeGrupo($grupo);
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
			$objDAO = new CategoriaGrupoDAO ( $con );
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
			$objDAO = new CategoriaGrupoDAO ( $con );
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
	
	
	public function salveGrupo($grupoBean) {
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$grupo = 0;
		$categoriagrupoclt = array();
		$categoriagrupobean = new CategoriaGrupoBean();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
			
			$grupo = Util::getIdObjeto($grupoBean);
			$categoriagrupoclt = $grupoBean->getcategoriagrupo();
			$categoriagrupoAtualClt = $this->findByGrupo(Util::getIdObjeto($grupoBean));
			Util::echobr(0,'$categoriagrupoclt',$categoriagrupoclt);
			$cltIdCategoriasNovas = array ();
			$cltIdCategoriasAtuais = array ();
				
			$cltIdCategoriasRemover = array ();
			$cltIdCategoriasAdicionar = array ();
				
			// lista de ids atuais
			for($atualCount = 0; $atualCount < count ( $categoriagrupoAtualClt ); $atualCount ++) {
				$cltIdCategoriasAtuais [] = Util::getIdObjeto($categoriagrupoAtualClt [$atualCount]->getCategoria ());
			}
				
			// lista de ids novos
			for($novaCount = 0; $novaCount < count ( $categoriagrupoclt ); $novaCount ++) {
				$cltIdCategoriasNovas [] = Util::getIdObjeto($categoriagrupoclt [$novaCount]->getCategoria ());
			}
				
			// Remover
			$cltIdCategoriasRemover = array_diff ( $cltIdCategoriasAtuais, $cltIdCategoriasNovas );
				
			// Adicionar
			$cltIdCategoriasAdicionar = array_diff ( $cltIdCategoriasNovas, $cltIdCategoriasAtuais );
				
			$adicionado = 0;
			$removido = 0;
			// remover
			while ( 0 < count ( $cltIdCategoriasRemover ) ) {
				$categoriagrupobean = new CategoriaGrupoBean();
				$categoriagrupobean->setgrupo($grupo);
				$categoriagrupobean->setcategoria( array_pop ( $cltIdCategoriasRemover ));
				$results = $objDAO->deleteCategoriaGrupo($categoriagrupobean);
				$removido = $removido + $results->getmensagem ();
			}
				
			// adicionar
			while ( 0 < count ( $cltIdCategoriasAdicionar ) ) {
				$categoriagrupobean = new CategoriaGrupoBean();
				$categoriagrupobean->setgrupo($grupo);
				$categoriagrupobean->setcategoria( array_pop ( $cltIdCategoriasAdicionar ));
				
				$results = $objDAO->insert ( $categoriagrupobean );
				$adicionado = $adicionado + $results->getmensagem ();
			}
			$categoriagrupoAtualClt = $this->findByGrupo(Util::getIdObjeto($grupoBean));
			$grupoBean->setCategoriaGrupo($categoriagrupoAtualClt);
			$results->setresposta ( $grupoBean);
			$results->setmensagem ( "<span class='azul'>Total de " . $adicionado . " adicionados e " . " de " . $removido . " removidos.</span>" );
			
			
			//$results = $objDAO->insert ( $categoriagrupoclt[$i] );
			
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
			$objDAO = new CategoriaGrupoDAO ( $con );
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
	public function deleteGrupo($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaGrupoDAO ( $con );
			$results = $objDAO->deleteGrupo ( $bean );
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
			$objDAO = new CategoriaGrupoDAO ( $con );
			$results = $objDAO->deleteCategoriaGrupo ( $bean );
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