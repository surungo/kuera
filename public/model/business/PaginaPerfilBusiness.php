<?php
include_once DATASOURCEMANAGER;
include_once PATHPUBDAO . '/PaginaPerfilDAO.php';
include_once PATHPUBBEAN . '/PaginaPerfilBean.php';
class PaginaPerfilBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PaginaPerfilDAO ( $con );
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
	public function findByPagina($idpagina) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PaginaPerfilDAO ( $con );
			$results = $objDAO->findByPagina ( $idpagina );
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
	public function findByPerfil($perfilBean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PaginaPerfilDAO ( $con );
			$results = $objDAO->findByPerfil ( $perfilBean );
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
	public function salvePaginaPerfil($bean) {
		$results = null;
		$dbg=0;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PaginaPerfilDAO ( $con );
			//$results = $con->returnDataBaseBean;
			Util::echobr ( $dbg, 'PaginaPerfilBusiness $results 1', $results );
			$perfilBean = $bean->getperfil ();
			
			$cltPaginasNovas = $bean->getPagina ();
			$atual = $objDAO->findByPerfil ( $perfilBean );
			$cltPaginasAtuais = $atual->getPagina ();
			
			$cltIdPaginaNovas = array ();
			$cltIdPaginaAtuais = array ();
			
			$cltIdPaginaRemover = array ();
			$cltIdPaginaAdicionar = array ();
			
			// lista de ids atuais
			for($atualCount = 0; $atualCount < count ( $cltPaginasAtuais ); $atualCount ++) {
				$cltIdPaginaAtuais [] = $cltPaginasAtuais [$atualCount]->getId ();
			}
			
			// lista de ids novos
			for($novaCount = 0; $novaCount < count ( $cltPaginasNovas ); $novaCount ++) {
				$cltIdPaginaNovas [] = $cltPaginasNovas [$novaCount]->getId ();
			}
			
			// Remover
			$cltIdPaginaRemover = array_diff ( $cltIdPaginaAtuais, $cltIdPaginaNovas );
			
			// Adicionar
			$cltIdPaginaAdicionar = array_diff ( $cltIdPaginaNovas, $cltIdPaginaAtuais );
			
			$adicionado = 0;
			$removido = 0;
			// remover
			while ( 0 < count ( $cltIdPaginaRemover ) ) {
				$results = $objDAO->deletePaginaPerfil ( $perfilBean->getId (), array_pop ( $cltIdPaginaRemover ) );
				$removido = $removido + $results->getmensagem ();
			}
			Util::echobr ( $dbg, 'PaginaPerfilBusiness $results remover', $results );
				
			// adicionar
			while ( 0 < count ( $cltIdPaginaAdicionar ) ) {
				$results = $objDAO->insertPaginaPerfil ( $perfilBean->getId (), array_pop ( $cltIdPaginaAdicionar ) );
				$adicionado = $adicionado + $results->getmensagem ();
			}
			Util::echobr ( 1, 'PaginaPerfilBusiness $results adicionar', $results );
			$results->setresposta ( $perfilBean->getId () );
			$results->setmensagem ( "<span class='azul'>Total de " . $adicionado . " adicionados e " . " de " . $removido . " removidos.</span>" );
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
			$objDAO = new PaginaPerfilDAO ( $con );
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