<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/PontuacaoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoBean.php';
class PontuacaoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
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
			$objDAO = new PontuacaoDAO ( $con );
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
		if ($id == 0 || $id == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
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
	public function findByPosicaoEsquema($bean) {
		if ($bean == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
			$results = $objDAO->findByPosicaoEsquema ( $bean );
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
	public function findByBateriaPosicao($bateriaBean, $posicaoChegadaBean) {
		if ($bateriaBean == null || $posicaoChegadaBean == null || $bateriaBean->getId () == 0 || $posicaoChegadaBean->getId () == 0)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
			$results = $objDAO->findByBateriaPosicao ( $bateriaBean, $posicaoChegadaBean );
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
	public function findByPontuacaoEsquema($pontuacaoesquema) {
		if (Util::getIdObjeto ( $pontuacaoesquema ) == 0)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
			$results = $objDAO->findByPontuacaoEsquema ( $pontuacaoesquema );
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
	public function copiarEsquema($pontuacaoesquemade, $pontuacaoesquemapara) {
		$results = null;
		$pontuacaoClt = $this->findByPontuacaoEsquema ( $pontuacaoesquemade );
		foreach ( $pontuacaoClt as $k1 => $pontuacaoBean ) {
			$pontuacaoBean->setid ( 0 );
			$pontuacaoBean->setpontuacaoesquema ( $pontuacaoesquemapara );
			$results = $this->salve ( $pontuacaoBean );
		}
		return $results;
	}
	public function salve($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PontuacaoDAO ( $con );
			$pontuacaoBeanExist = new PontuacaoBean ();
			$pontuacaoBeanExist->setposicao ( $bean->getposicao () );
			$pontuacaoBeanExist->setpontuacaoesquema ( $bean->getpontuacaoesquema () );
			$pontuacaoBeanExist = $this->findByPosicaoEsquema ( $pontuacaoBeanExist );
			if ($bean->getid () == null || $bean->getid () == 0) {
				if ($pontuacaoBeanExist == null || $pontuacaoBeanExist->getid () == 0)
					$results = $objDAO->insert ( $bean );
			} else {
				// para atualizar (existir não significa id igual mas sim posicao e pontuacaoesquema iguais)
				if(
           // se o registro deve existir
           // se for um registro diferente a posicao e o esquema tem que ser diferentes
           	 (
($pontuacaoBeanExist != null && $pontuacaoBeanExist->getid () != $bean->getid () && $pontuacaoBeanExist->getposicao () != $bean->getposicao () && $pontuacaoBeanExist->getpontuacaoesquema () != $bean->getpontuacaoesquema ()) ||
           	// ou ele existir e ser o registro atual
($pontuacaoBeanExist != null && $pontuacaoBeanExist->getid () == $bean->getid ()) || $pontuacaoBeanExist == null)
			)
					
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
			$objDAO = new PontuacaoDAO ( $con );
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