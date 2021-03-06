<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/bolao/model/dao/PartidaDAO.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
include_once PATHAPP . '/mvc/bolao/model/bean/ApostaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/ApostaBusiness.php';

class PartidaBusiness {
    public function atualizarApostas() {
        $results = Array ();
        $con = null;
        $dsm = new DataSourceManager ();
        try {
            $con = $dsm->getConn (get_class($this));
            $objDAO = new PartidaDAO ( $con );
            $results = $objDAO->findAll ();
            
            foreach ($results as &$partida) {
                $partida->setplacar1(null);
                $partida->settexto($partida->gettexto());
                $this->salve($partida);
                
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
    
    public function findAll() {
        $results = Array ();
        $con = null;
        $dsm = new DataSourceManager ();
        try {
            $con = $dsm->getConn (get_class($this));
            $objDAO = new PartidaDAO ( $con );
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
			$objDAO = new PartidaDAO ( $con );
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
	            $objDAO = new PartidaDAO ( $con );
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
	public function ultima() {
	        $results = null;
	        $con = null;
	        $dsm = new DataSourceManager ();
	        try {
	            $con = $dsm->getConn (get_class($this));
	            $objDAO = new PartidaDAO ( $con );
	            $results = $objDAO->ultima ( );
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
			$objDAO = new PartidaDAO ( $con );
			if ($bean->getid () == null || $bean->getid () == 0) {
				$results = $objDAO->insert ( $bean );
			} else {
				$results = $objDAO->update ( $bean );
			}
			$apostaBean = new ApostaBean();
			$apostaBusiness = new ApostaBusiness();
			foreach ($bean->getcltaposta() as &$apostaBean) {
			    $apostaBean->setpartida($bean->getid());
			    $apostaBusiness->salve($apostaBean);
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
			$objDAO = new PartidaDAO ( $con );
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
	
	
	
	public function getselecoes(){
	    $selecoes = array(
	        "Uruguai",
	        "Rússia",
	        "Arábia Saudita",
	        "Egito",
	        
	        "Marrocos",
	        "Irã",
	        "Portugal",
	        "Espanha",
	        
	        "França",
	        "Austrália",
	        "Peru",
	        "Dinamarca",
	        
	        "Argentina",
	        "Nigéria",
	        "Islândia",
	        "Croácia",
	        
	        "Brasil",
	        "Suíça",
	        "Costa Rica",
	        "Sérvia",
	        
	        "Alemanha",
	        "Coréia do Sul",
	        "México",
	        "Suécia",
	        
	        "Bélgica",
	        "Tunísia",
	        "Inglaterra",
	        "Panamá",
	        
	        "Japão",
	        "Senegal",
	        "Polônia",
	        "Colômbia"
	        
	    );
	    return $selecoes;
	}
	
	public function getpessoas(){
	    $pessoas = array(
	        "Roberto Schroeder",
	        "leonardo",
	        "Alex Francisco",
	        "Eduardo Bortoluzzi",
	        "Emerson Paim de Oli...",
	        "Henrique Becker",
	        "Rodrigo Fehse",
	        "Gabriel Borba",
	        "Espinoza",
	        "Rafael Girardi Mote...",
	        "Rodrigo Couto De So...",
	        "Sandro",
	        "Rafuxo",
	        "Juliano",
	        "Paulo Barcelos");
	    sort($pessoas);
	    return $pessoas;
	}
	
	
}
?>