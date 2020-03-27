<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/PilotoDAO.php';
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoCampeonatoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoCampeonatoBean.php';
class PilotoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
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
	public function findCampeonatoNotBateria($idcampeonato) {
		$results = Array ();
		$con = null;
		if ($idcampeonato < 1)
			return;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			Util::echobr ( 0, 'PilotoBusiness findCampeonatoNotBateria', $idcampeonato );
			$results = $objDAO->findCampeonatoNotBateria ( $idcampeonato );
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
	public function findCatalogo() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			$results = $objDAO->findCatalogo ();
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
			$objDAO = new PilotoDAO ( $con );
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
			$objDAO = new PilotoDAO ( $con );
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
	public function findByCPF($cpf) {
		if ($cpf == 0 || $cpf == null || $cpf == '')
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			$results = $objDAO->findByCPF ( $cpf );
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

	public function findByPessoa($pessoa) {
		if ($pessoa== 0 || $pessoa== null || $pessoa== '')
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			$results = $objDAO->findByPessoa ( $pessoa);
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

	public function findInscritoSemelhante($inscritoBean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			$results = $objDAO->findInscritoSemelhante ( $inscritoBean );
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
	public function inscritoToPiloto($bean) {
		$results = null;
		$results2 = null;
		$dbg = 0;
		try {
			
			if ($bean != null) {
				$idinscrito = $bean->getid ();
				$idpiloto = Util::getIdObjeto ( $bean->getpiloto () );
				$idcampeonato = Util::getIdObjeto ( $bean->getcampeonato () );
				
				Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto  $idinscrito', $idinscrito );
				Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto  $idpiloto', $idpiloto );
				Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto  $idcampeonato', $idcampeonato );
				
				if ($idinscrito > 0 && $idcampeonato > 0 && $bean->getpiloto ()->getnome () != '') {
					
					// adiciona ou atualiza piloto
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto $bean->getpiloto()->getnome()', $bean->getpiloto ()->getnome () );
					
					$results = $this->salve ( $bean->getpiloto () );
					$pilotoBean = new PilotoBean ();
					$pilotoBean = $results->getresposta ();
					
					$idpiloto = $pilotoBean->getid ();
					
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after add piloto $results->getmensagem()', $results->getmensagem () );
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after add piloto $idpiloto', $idpiloto );
					
					// adiciona piloto no campeonato
					$pilotoCampeonatoBean = new PilotoCampeonatoBean ();
					$pilotoCampeonatoBean->setcampeonato ( $bean->getcampeonato () );
					$pilotoCampeonatoBean->setpiloto ( $pilotoBean->getid () );
					$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness ();
					$results2 = $pilotoCampeonatoBusiness->salve ( $pilotoCampeonatoBean );
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after add capeonatoPiloto $results2->getmensagem()', $results2->getmensagem () );
					
					// adiciona piloto no inscrito
					$inscritoBusiness = new InscritoBusiness ();
					$bean = $inscritoBusiness->findById ( $idinscrito );
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after busca inscrito $bean->getid', $bean->getid () );
					$idpilotoBusca = Util::getIdObjeto ( $bean->getpiloto () );
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after busca inscrito $idpilotoBusca', $idpilotoBusca );
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after busca inscrito $idpiloto', $idpiloto );
					
					$bean->setpiloto ( $idpiloto );
					
					$results3 = $inscritoBusiness->salve ( $bean );
					
					Util::echobr ( $dbg, 'PilotoBusiness inscritoToPiloto after salve inscrito  $results3->getmensagem()', $results3->getmensagem () );
					$results->setmensagem ( "<span class='azul'>Inscrito adicionado como Piloto do campeonato.</span>" );
				}
			}
		} catch ( Exception $ex ) {
			throw new Exception ( $ex->getMessage () );
		}
		return $results;
	}
	public function salve($bean) {
		$dbg = 0;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new PilotoDAO ( $con );
			if ($bean != null || gettype ( $bean ) == "object") {
				Util::echobr ( $dbg, 'PilotoBusiness salve $bean->getid()', $bean->getid () );
				if ($bean->getid () < 1) {
					$results = $objDAO->insert ( $bean );
				} else {
					if ($bean->getfotoimg () != null) {
						$results = $objDAO->updateimg ( $bean );
					} else {
						$results = $objDAO->update ( $bean );
					}
				}
			} else {
				throw new Exception ( "Erro: PilotoBusiness salvar, deve receber PilotoBean." );
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
			$objDAO = new PilotoDAO ( $con );
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