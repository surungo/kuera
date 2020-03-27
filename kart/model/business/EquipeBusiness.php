<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/dao/EquipeDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once 'InscritoEquipeBusiness.php';
include_once 'InscritoBusiness.php';
class EquipeBusiness {
	public function findByCPFcampeonato($cpfBusca,$idcampeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findByCPFcampeonato($cpfBusca,$idcampeonato);
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
			$objDAO = new EquipeDAO ( $con );
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
			$objDAO = new EquipeDAO ( $con );
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
	public function inscrever($bean) {
		$dbg = 0;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$parametroBusiness = new ParametroBusiness ();
		$parametroBean = new ParametroBean ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			
			$results = $this->preinsert ( $bean );
			if (! $results->getsucesso ()) {
				return $results;
			}
			
			if ($bean == null || $bean->getid () == null || $bean->getid () < 1) {
				$results = $objDAO->insert ( $bean );
				$bean = $results->getresposta ();
				$mensagem = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_MSG_SUCESSO );
			} else {
				$results = $objDAO->update ( $bean );
				$mensagem = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_MSG_ATUALIZADO_SUCESSO );
			}
			$results->setmensagem ( $mensagem );
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
			$objDAO = new EquipeDAO ( $con );
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
	
	public function findById($equipe) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findById ( $equipe );
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

	public function totalPagoCampeonato($equipe) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->totalPagoCampeonato($equipe);
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
	
	public function findByCodigoAcesso($codigoacesso) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findByCodigoAcesso ( $codigoacesso );
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
	public function findByNome($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findByNome ( $bean );
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
	
	public function findByLider($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findByLider ( $bean );
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
	
	
	public function findByNrInscrito($nrinscrito, $campeonato) {
		if ($nrinscrito == 0 || $nrinscrito == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->findByNrInscrito ( $nrinscrito, $campeonato );
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
	public function getNovoNrInscrito($campeonato) {
		if ($campeonato == 0 || $campeonato == null)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->getNovoNrInscrito ( $campeonato );
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
	
	public function setOutroAdm($bean) {
		$dbg = 2; // banco
		
		if (Util::getIdObjeto($bean) < 1)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		$inscritoBusiness = new InscritoBusiness();
		$inscritoBean = new InscritoBean();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );

		// verifica se tem lider
			$equipeLiderAtual =  $this->findByLider($bean);
			Util::echobr ( $dbg, "EquipeBusiness setOutroAdm equipeLiderAtual", $equipeLiderAtual );
			if (Util::getIdObjeto($equipeLiderAtual) > 0)
				return $bean;
			
				
		// pega primeiro inscrito do grupo	
			Util::echobr ( $dbg, "EquipeBusiness setOutroAdm idNovoLider", $idNovoLider );
			$idNovoLider = $objDAO->getIdMinEquipe($bean);
				
					
			$beanEquipe = $this->findById($bean);
			Util::echobr ( $dbg, "EquipeBusiness setOutroAdm findById beanEquipe", $beanEquipe );
				
			$beanEquipe->setinscritolider(Util::getIdObjeto($idNovoLider));
			$resultsUpdate = $objDAO->update($beanEquipe);
			Util::echobr ( $dbg, "EquipeBusiness setOutroAdm resultsUpdate", $resultsUpdate );
			
			$results = $this->findById($beanEquipe);
			Util::echobr ( $dbg, "EquipeBusiness setOutroAdm atualizado equipe", $results );

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
			$objDAO = new EquipeDAO ( $con );
			if ($bean->getid () == null || $bean->getid () == 0) {
				$results = $this->preinsert ( $bean );
				if (! $results->getsucesso ()) {
					return $results;
				}
				
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
			$objDAO = new EquipeDAO ( $con );
			$inscritoEquipeBusiness = new InscritoEquipeBusiness ();
			$inscritoEquipeBusiness->deleteEquipe ( Util::getIdObjeto ( $bean ) );
			
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
	private function preinsert($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$results->setresposta ( $bean );
		$results->setsucesso ( true );
		$parametroBusiness = new ParametroBusiness ();
		
		$campeonato = Util::getIdObjeto ( $bean->getcampeonato () );
		$campeonatoBusiness = new CampeonatoBusiness ();
		$campeonatoBean = $campeonatoBusiness->findById ( $campeonato );
		
		$equipeExistente = new EquipeBean ();
		$equipeExistente = $this->findByNome ( $bean );
		Util::echobr ( $dbg, 'EquipeBusiness  inscrever $equipeExistente id nome', Util::getIdObjeto ( $equipeExistente ) . " " . Util::getNomeObjeto ( $equipeExistente ) );
		
		if ($equipeExistente != null && 
			Util::getIdObjeto ($equipeExistente) > 0 &&
			Util::getIdObjeto ( $equipeExistente->getcampeonato () ) == Util::getIdObjeto ( $bean->getcampeonato () )) {
			$results->setsucesso ( false );
			$results->setmensagem ( $mensagem );
			$results->setresposta ( $bean );
			return $results;
		}
		Util::echobr ( $dbg, 'EquipeBusiness  inscrever $bean->getnrinscrito()', $bean->getnrinscrito () );
		if ($bean->getnrinscrito () != - 1 && $bean->getnrinscrito () < 1) {
			Util::echobr ( $dbg, 'EquipeBusiness  inscrever $bean->getnrinscrito() dif -1 e <1', $bean->getnrinscrito () );
			
			$tentativas = 10;
			$nrinscritoNovo = 0;
			while ( $tentativas > 0 ) {
				$nrinscritoNovo = $this->getNovoNrInscrito ( $campeonato );
				$bean->setnrinscrito ( $nrinscritoNovo );
				$beanExisteNrInscrito = new EquipeBean ();
				$beanExisteNrInscrito = $this->findByNrInscrito ( $nrinscritoNovo, $campeonato );
				Util::echobr ( $dbg, 'EquipeBusiness  inscrever $tentativas nrinscrito', $tentativas . " " . $nrinscritoNovo );
				
				if ($beanExisteNrInscrito != null && $bean->getnrinscrito () != $beanExisteNrInscrito->getnrinscrito ()) {
					$tentativas = 0;
				}
				$tentativas --;
			}
		}
		// ajuste do valor
		$soma = ($bean->getnrinscrito ()) / 100;
		
		//$siglavl = 'INSC_' . $campeonatoBean->getsigla () . '_VL';
		//$bean->setvalor ( $parametroBusiness->findByCodigo ( $siglavl ) );
		$bean->setvalor ( $campeonatoBean->getvalorpaypal() );
		Util::echobr ( $dbg, 'EquipeBusiness inscrever $bean->getvalor()', $bean->getvalor () );
		//Util::echobr ( $dbg, 'EquipeBusiness inscrever $siglavl', $siglavl );
		
		$bean->setvalor ( $soma + $bean->getvalor () );
		
		if ($bean->getcodigoacesso () == "") {
			$bean->setcodigoacesso ( 
					str_pad ( $bean->getnrinscrito (), 5, Util::randomString ( $length = 5 ), STR_PAD_LEFT ) . 
					str_pad ( $bean->getcampeonato (), 5, Util::randomString ( $length = 5 ), STR_PAD_LEFT ) );
			$bean->setcodigoacesso ( strtolower ( $bean->getcodigoacesso () ) );
		}
		
		Util::echobr ( $dbg, ' EquipeBusiness inscrever $bean->getvalor()', $bean->getvalor () );
		Util::echobr ( $dbg, ' EquipeBusiness inscrever $bean->getnrinscrito()', $bean->getnrinscrito () );
		Util::echobr ( $dbg, ' EquipeBusiness inscrever $bean->getcodigoacesso()', $bean->getcodigoacesso () );
		
		$results->setsucesso ( true );
		$results->setmensagem ( "" );
		$results->setresposta ( $bean );
		return $results;
	}
	
	public function desativar($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$mensagem = "<span class='azul'>";
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO( $con );
			$results = $objDAO->desativar($bean);

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

	public function ativar($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$mensagem = "<span class='azul'>";
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new EquipeDAO ( $con );
			$results = $objDAO->ativar($bean);

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