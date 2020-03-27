<?php
include_once DATASOURCEMANAGER;
include_once PATHPUBDAO . '/ItemPerfilDAO.php';
include_once PATHPUBBEAN . '/ItemPerfilBean.php';
class ItemPerfilBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new ItemPerfilDAO ( $con );
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
	public function findByItem($iditem) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new ItemPerfilDAO ( $con );
			$results = $objDAO->findByItem ( $iditem );
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
			$objDAO = new ItemPerfilDAO ( $con );
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
	
	public function isItemPerfil($perfilBean,$itemBean) {
		$results = false;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new ItemPerfilDAO ( $con );
			$results = $objDAO->isItemPerfil($perfilBean,$itemBean);
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
	
	
	public function salvePerfil($perfilBean) {
		$dbg = 0;
		$resultBean = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new ItemPerfilDAO ( $con );
			
			// garantindo perfil na resposta
			$resultBean->setresposta($perfilBean);
			
			// lista de ids novos
			$cltItemPerfilNovas = $perfilBean->getItemPerfil();
			$itemperfilbeanNovas = new ItemPerfilBean();
			$cltIdItemNovas = array ();
			while ( 0 < count ( $cltItemPerfilNovas ) ) {
				$itemperfilbeanNovas = array_pop($cltItemPerfilNovas);
				$cltIdItemNovas [] = Util::getIdObjeto($itemperfilbeanNovas->getitem());
			}
						
			// lista de ids atuais
			$itemPerfilCltAtuais = $objDAO->findByPerfil ( $perfilBean );
			Util::echobr ( $dbg, 'ItemPerfilBusiness count ( $itemPerfilCltAtuais ) ', count ( $itemPerfilCltAtuais ) );
			$itemPerfilBeanAtual = new ItemPerfilBean();
			$cltIdItemAtuais = array ();
			while ( 0 < count ( $itemPerfilCltAtuais ) ) {
				$itemPerfilBeanAtual = array_pop($itemPerfilCltAtuais);
				Util::echobr ( $dbg, 'ItemPerfilBusiness $itemPerfilBeanAtual ', $itemPerfilBeanAtual );
				$cltIdItemAtuais [] = Util::getIdObjeto($itemPerfilBeanAtual->getitem());
			}

			$cltIdItemRemover = array ();
			$cltIdItemAdicionar = array ();
				
			// Remover
			$cltIdItemRemover = array_diff ( $cltIdItemAtuais, $cltIdItemNovas );
			
			// Adicionar
			$cltIdItemAdicionar = array_diff ( $cltIdItemNovas, $cltIdItemAtuais );
			
			Util::echobr ( 0, 'ItemPerfilBusiness $cltIdItemAtuais ', $cltIdItemAtuais );
			Util::echobr ( 0, 'ItemPerfilBusiness $cltIdItemNovas ', $cltIdItemNovas );
			Util::echobr ( 0, 'ItemPerfilBusiness $cltIdItemAdicionar ', $cltIdItemAdicionar );
			Util::echobr ( 0, 'ItemPerfilBusiness $cltIdItemRemover ', $cltIdItemRemover );
			$returnDataBaseBean = new ReturnDataBaseBean ();
			// remover
			while ( 0 < count ( $cltIdItemRemover ) ) {
				$itemperfilbean = new ItemPerfilBean();
				$itemperfilbean->setperfil($perfilBean);
				$itemperfilbean->setitem( array_pop ( $cltIdItemRemover ));
				$returnDataBaseBean = $objDAO->deleteItemPerfil ( $itemperfilbean );
				$mensagem=$returnDataBaseBean->getmensagem();
			}
			
			Util::echobr ( 0, 'ItemPerfilBusiness $cltIdItemAdicionar ', $cltIdItemAdicionar );
			
			// adicionar
			while ( 0 < count ( $cltIdItemAdicionar ) ) {
				$itemperfilbean = new ItemPerfilBean();
				$itemperfilbean->setperfil($perfilBean);
				$itemperfilbean->setitem( array_pop ( $cltIdItemAdicionar ));
				$returnDataBaseBean = $objDAO->insert( $itemperfilbean );
				$mensagem=$returnDataBaseBean->getmensagem();
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
		$resultBean->setmensagem($mensagem);
		return $resultBean;
	}
	public function delete($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new ItemPerfilDAO ( $con );
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