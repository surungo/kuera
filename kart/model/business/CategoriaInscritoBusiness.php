<?php
include_once DATASOURCEMANAGER;
include_once PATHAPP . '/mvc/kart/model/business/InscritoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaInscritoDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/CategoriaInscritoBean.php';
include_once PATHPUBBEAN . '/ReturnDataBaseBean.php';
class CategoriaInscritoBusiness {
	public function findAll() {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	
	public function findAtivosByCampeonatoSort($campeonato,$sort) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findAtivosByCampeonatoSort($campeonato,$sort);
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
	
	public function findAtivosByCampeonato($campeonato) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new CategoriaInscritoDAO ( $con );
	        $results = $objDAO->findAtivosByCampeonato($campeonato);
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
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	
	public function findAtivosByCampeonatoPagos($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findAtivosByCampeonatoPagos($campeonato);
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

	public function findAtivosByCampeonatoPagosSort($campeonato,$sort) {
	    $results = Array ();
	    $con = null;
	    $dsm = new DataSourceManager ();
	    try {
	        $con = $dsm->getConn (get_class($this));
	        $objDAO = new CategoriaInscritoDAO ( $con );
	        $results = $objDAO->findAtivosByCampeonatoPagosSort($campeonato,$sort);
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
	
	public function findByCampeonatoPagos($campeonato) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findByCampeonatoPagos($campeonato);
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
	
	public function isCategoriaInscrito($bean) {
		$results = false;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->isCategoriaInscrito ( $bean );
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
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	
	public function findByInscrito($inscrito) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findByInscrito($inscrito);
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
	
	public function findByNomeInscrito($inscrito) {
		$results = Array ();
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findByNomeInscrito($inscrito);
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
	
	public function findById($bean) {
		if (Util::getIdObjeto($bean) == 0)
			return null;
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->findById ( $bean );
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
	
	
	
	
	public function update($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$mensagem = "<span class='azul'>";
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$inscritoBusiness = new InscritoBusiness();
			$results = $inscritoBusiness->salveSemCategoria($bean->getinscrito());
			$mensagem = $mensagem.($results->getsucesso())?"Atualizado Inscrito<br>":"";
			Util::echobr ( $dbg, 'CategoriaInscritoBusiness update $bean->getid()', Util::getIdObjeto($bean) );
			if (Util::getIdObjeto($bean) > 0) {
				$results = $objDAO->update ( $bean );
			}
			$mensagem = $mensagem.($results->getsucesso())?"Atualizada Categoria<br>":"";
			$results->setmensagem($mensagem."</span>");	
			$results->setresposta($bean);
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
	
	public function desativar($bean) {
		$dbg = 0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$mensagem = "<span class='azul'>";
		try {
			$bean = $this->findById($bean);
			//remover pago
			
			$inscritoBusiness = new InscritoBusiness();
			$results = $inscritoBusiness->updateAguardandoPagamento($bean->getinscrito());
				
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	
	
	public function salve($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	
	
	public function salveInscrito($inscritoBean) {
		$dbg=0;
		$results = new ReturnDataBaseBean ();
		$con = null;
		$dsm = new DataSourceManager ();
		$inscrito = 0;
		$categoriainscritoclt = array();
		$categoriainscritobean = new CategoriaInscritoBean();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			
			$inscrito = Util::getIdObjeto($inscritoBean);
			
			$categoriainscritoclt = $inscritoBean->getcategoriainscrito();
			$categoriainscritobean = $categoriainscritoclt[0];
			$results = $objDAO->deleteInscrito($categoriainscritobean);
			
			$N = count($categoriainscritoclt);
			Util::echobr ( $dbg, 'InscritoBusiness count($categoriainscritoClt',$N  );
			for($i = 0; $i < $N; $i ++) {
				$categoriainscritobean = $categoriainscritoclt[$i];
				$results = $objDAO->insert ( $categoriainscritobean );
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
			$objDAO = new CategoriaInscritoDAO ( $con );
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
	public function deleteInscrito($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->deleteInscrito ( $bean );
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
	public function deleteCategoriaInscrito($bean) {
		$results = null;
		$con = null;
		$dsm = new DataSourceManager ();
		try {
			$con = $dsm->getConn (get_class($this));
			$objDAO = new CategoriaInscritoDAO ( $con );
			$results = $objDAO->deleteCategoriaInscrito ( $bean );
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