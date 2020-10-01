<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CategoriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PistaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/CampeonatoDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PontuacaoEsquemaDAO.php';

class BateriaDAO extends AbstractDAO
{

    protected $dbprexis = "kart_";

    protected $alias = "bateria";

    protected $tabela = "bateria";

    protected $idtabela = "idbateria";

    protected $campos = array(
        "idetapa",
        "sigla",
        "nome",
        "idpontuacaoesquema",
        "dtbateria",
        "idpista",
        "idcategoria",
        "idbateriaprecedente",
        "urlresultados",
    	"gridfechado",
        "idbateria"
    );

    protected $ordernome = "bateria.nome";

    public function __construct($_conn)
    {
        parent::__construct($_conn);
    }

    public function update($bean)
    {
        $this->results = new BateriaBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            $query = " UPDATE " . $this->dbprexis . $this->tabela() . " SET " . " dtmodificacao = now(), " . //
" modificador = ? , " . // 1
" dtvalidade = ? , " . // 2
" dtinicio = ? , " . // 3
" idetapa = ? , " . // 4
" sigla = ? , " . // 5
" nome = ? , " . // 6
" idpontuacaoesquema = ? , " . // 7
" dtbateria = ? , " . // 8
" idpista = ?, " . // 9
" idcategoria = ?,  " . // 10
" idbateriaprecedente = ? ," . // 11
" urlresultados = ? , " . // 12
" gridfechado = ? " . // 13
" WHERE " . $this->idtabela() . " =  ? "; // 14
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setNumero(4, Util::getIdObjeto($bean->getetapa()));
            $this->con->setTexto(5, $bean->getsigla());
            $this->con->setTexto(6, $bean->getnome());
            $this->con->setNumero(7, Util::getIdObjeto($bean->getpontuacaoesquema()));
            $this->con->setData(8, $bean->getdtbateria());
            $this->con->setNumero(9, Util::getIdObjeto($bean->getpista()));
            $this->con->setNumero(10, Util::getIdObjeto($bean->getcategoria()));
            $this->con->setNumero(11, Util::getIdObjeto($bean->getbateriaprecedente()));
            $this->con->setTexto(12, $bean->geturlresultados());
            $this->con->setTexto(13, $bean->getgridfechado());
            $this->con->setNumero(14, $bean->getid());
            $this->con->setsql($query);
            // echo $this->con->getsql();
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($bean->getid());
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $this->returnDataBaseBean;
    }

    public function insert($bean)
    {
        try {
            $usuarioLoginBean = $this->setoperador();
            $bean->setid($this->getid($this->dbprexis));
            
            $query = " insert into " . $this->dbprexis . $this->tabela() . "
			 ( " . " dtcriacao, " . //sql
			 " criador, " .  //sql
			 " dtvalidade, " .  //sql
			 " dtinicio, " .  //sql
			 " idetapa , " .  //sql
			 " sigla, " .  //sql
			 " nome, " .  //sql
			 " idpontuacaoesquema, " .  //sql
			 " dtbateria," .  //sql
			 " idpista, " .  //sql
			 " idcategoria, " .  //sql
			 " idbateriaprecedente, " .  //sql
			 " urlresultados, " .  //sql
			 " gridfechado, " .  //sql
			 $this->idtabela() .  //sql
			 " )values ( " .  //sql
			 " now(), " . // dtcriacao,
" ?, " . // criador,
" ?, " . // dtvalidade,
" ?, " . // dtinicio,
" ?, " . // idetapa,
" ?, " . // sigla,
" ?, " . // nome,
" ?, " . // idpontuacaoesquema,
" ?, " . // dtbateria,
" ?, " . // idpista,
" ? , " . // categoria
" ? , " . // idbateriaprecedente
" ? , " . // urlresultados
" ? , " . // gridfechado
" ? )"; // id;
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setNumero(4, Util::getIdObjeto($bean->getetapa()));
            $this->con->setTexto(5, $bean->getsigla());
            $this->con->setTexto(6, $bean->getnome());
            $this->con->setNumero(7, Util::getIdObjeto($bean->getpontuacaoesquema()));
            $this->con->setData(8, $bean->getdtbateria());
            $this->con->setNumero(9, Util::getIdObjeto($bean->getpista()));
            $this->con->setNumero(10, Util::getIdObjeto($bean->getcategoria()));
            $this->con->setNumero(11, Util::getIdObjeto($bean->getbateriaprecedente()));
            $this->con->setTexto(12, $bean->geturlresultados());
            $this->con->setTexto(13, $bean->getgridfechado());
            $this->con->setNumero(14, $bean->getid());
            $this->con->setsql($query);
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($id);
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>");
        } catch (Exception $e) {
            $bean->setid(0);
            throw new Exception($e->getMessage());
        }
        return $this->returnDataBaseBean;
    }

    public function getBeans($array)
    {
        $this->bean = new BateriaBean();
        $this->bean->setid($this->getValorArray($array, $this->idtabela(), null));
        $this->bean->setsigla($this->getValorArray($array, "sigla", null));
        $this->bean->setnome($this->getValorArray($array, "nome", null));
        $this->bean->setdtbateria($this->getValorArray($array, "dtbateria", null));
        $this->bean->seturlresultados($this->getValorArray($array, "urlresultados", null));
        $this->bean->setgridfechado($this->getValorArray($array, "gridfechado", null));
        
        $this->bean->setetapa($this->getValorArray($array, "idetapa", new EtapaDAO($this->con)));
        $this->bean->setpista($this->getValorArray($array, "idpista", new PistaDAO($this->con)));
        
        $this->bean->setbateriaprecedente($this->getValorArray($array, "idbateriaprecedente", null));
        
        $this->bean->setpontuacaoesquema($this->getValorArray($array, "idpontuacaoesquema", new PontuacaoEsquemaDAO($this->con)));
        $this->bean->setcategoria($this->getValorArray($array, "idcategoria", new CategoriaDAO($this->con)));
        
        $this->bean = $this->getLogBeans($array, $this->bean);
        return $this->bean;
    }

    // metodos padr�o
    public function getQueryBase()
    {
        $categoriaDAO = new CategoriaDAO($this->con);
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        $query = " SELECT " . $this->camposSelect() . ", " . $pistaDAO->camposSelect() . ", " . $etapaDAO->camposSelect() . ", " . $campeonatoDAO->camposSelect() . ", " . $categoriaDAO->camposSelect() . ", " . $pontuacaoesquemaDAO->camposSelect() . " " . " FROM " . $this->getdbprexis() . $this->tabelaAlias() . " left outer join " . $this->getdbprexis() . $etapaDAO->tabelaAlias() . " on " . $this->getalias() . ".idetapa =  " . $etapaDAO->idtabelaAlias() . " left outer join " . $this->getdbprexis() . $pistaDAO->tabelaAlias() . " on " . $this->getalias() . ".idpista =  " . $pistaDAO->idtabelaAlias() . " left outer join " . $this->getdbprexis() . $campeonatoDAO->tabelaAlias() . " on " . $etapaDAO->getalias() . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias() . " left outer join " . $this->getdbprexis() . $pontuacaoesquemaDAO->tabelaAlias() . " on " . $this->getalias() . ".idpontuacaoesquema =  " . $pontuacaoesquemaDAO->idtabelaAlias() . " left outer join " . $this->getdbprexis() . $categoriaDAO->tabelaAlias() . " on " . $this->getalias() . ".idcategoria =  " . $categoriaDAO->idtabelaAlias();
        // echo $query;
        return $query;
    }
    

    public function findBateriaByEtapa($bean)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        $dbg = 0;
        Util::echobr($dbg, 'BateriaDAO  findBateriaByEtapa $bean', $bean);
        try {
            $query = $this->getQueryBase() . " where " . $this->getalias() . ".idetapa =  ? " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            
            $this->con->setNumero(1, Util::getIdObjeto($bean->getetapa()));
            $this->con->setsql($query);
            Util::echobr($dbg, 'BateriaDAO  findBateriaByEtapa $this->con->getsql', $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findByCampeonatoPiloto($idcampeonato, $idpiloto)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = $this->getQueryBase() . " where " . $this->getalias() . ".idcampeonato =  ? " . " and " . $this->getalias() . ".idpiloto =  ? " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            
            $this->con->setNumero(1, $idcampeonato);
            $this->con->setNumero(2, $idpiloto);
            $this->con->setsql($query);
            Util::echobr(0, "BateriaDAO findByCampeonatoPiloto", $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findBateriaByCampeonatoEtapa($idcampeonato, $idetapa)
    {
        $this->clt = array();
        $categoriaDAO = new CategoriaDAO($this->con);
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = $this->getQueryBase() . " where " . $campeonatoDAO->idtabelaAlias() . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias() . " ) " . " and " . $etapaDAO->idtabelaAlias() . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias() . " )  " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            $this->con->setNumero(1, $idcampeonato);
            $this->con->setNumero(2, $idetapa);
            $this->con->setsql($query);
            Util::echobr(0, "BateriaDAO findBateriaByCampeonatoEtapa", $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findAtivoBateriaByCampeonatoEtapa($campeonato, $idetapa)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        $this->setordernome($this->getalias() . ".dtbateria ");
        
        try {
            $query = $this->getQueryBase() . " where " . $this->whereAtivo();
            
            if (is_array($campeonato)) {
                $query .= " and " . $campeonatoDAO->idtabelaAlias() . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias() . " ) ";
            } else {
                $query .= " and " . $campeonatoDAO->idtabelaAlias() . " = IFNULL( ? ," . $campeonatoDAO->idtabelaAlias() . " ) ";
            }
            
            $query .= " and " . $etapaDAO->idtabelaAlias() . " =   IFNULL( ? ," . $etapaDAO->idtabelaAlias() . " )  " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            
            $this->con->setNumero(1, $campeonato);
            $this->con->setNumero(2, $idetapa);
            $this->con->setsql($query);
            Util::echobr(0, "BateriaDAO findBateriaByCampeonatoEtapa", $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findByCampeonato($campeonato)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = " SELECT " . $this->camposSelect() . ", " . 
            // $pistaDAO->camposSelect () . ", " .
            $etapaDAO->camposSelect() . ", " . $campeonatoDAO->camposSelect() . " " . 
            // $pontuacaoesquemaDAO->camposSelect () . " " .
            " FROM " . $this->getdbprexis() . $this->tabelaAlias() . " inner join " . $this->getdbprexis() . $etapaDAO->tabelaAlias() . " on " . $this->getalias() . ".idetapa =  " . $etapaDAO->idtabelaAlias() . " inner join " . $this->getdbprexis() . $campeonatoDAO->tabelaAlias() . " on " . $etapaDAO->getalias() . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias() . 
            
            // " inner join " . $this->getdbprexis () . $pistaDAO->tabelaAlias () .
            // / " on " . $this->getalias () . ".idpista = " . $pistaDAO->idtabelaAlias () .
            // " inner join " . $this->getdbprexis () . $pontuacaoesquemaDAO->tabelaAlias () .
            // " on " . $this->getalias () . ".idpontuacaoesquema = " . $pontuacaoesquemaDAO->idtabelaAlias ().
            " where " . $campeonatoDAO->idtabelaAlias() . " = ? " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            $this->con->setNumero(1, $campeonato);
            $this->con->setsql($query);
            Util::echobr(0, 'BateriaDAO findByCampeonato', $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findAtivoByCampeonato($campeonato)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = " SELECT " . $this->camposSelect() . ", " . 
            // $pistaDAO->camposSelect () . ", " .
            $etapaDAO->camposSelect() . ", " . $campeonatoDAO->camposSelect() . " " . 
            // $pontuacaoesquemaDAO->camposSelect () . " " .
            " FROM " . $this->getdbprexis() . $this->tabelaAlias() . " inner join " . $this->getdbprexis() . $etapaDAO->tabelaAlias() . " on " . $this->getalias() . ".idetapa =  " . $etapaDAO->idtabelaAlias() . " inner join " . $this->getdbprexis() . $campeonatoDAO->tabelaAlias() . " on " . $etapaDAO->getalias() . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias() . 
            
            // " inner join " . $this->getdbprexis () . $pistaDAO->tabelaAlias () .
            // / " on " . $this->getalias () . ".idpista = " . $pistaDAO->idtabelaAlias () .
            // " inner join " . $this->getdbprexis () . $pontuacaoesquemaDAO->tabelaAlias () .
            // " on " . $this->getalias () . ".idpontuacaoesquema = " . $pontuacaoesquemaDAO->idtabelaAlias ().
            " where " . $this->whereAtivo() . " and " . $etapaDAO->whereAtivo() . " and " . $campeonatoDAO->whereAtivo() . " and " . $campeonatoDAO->idtabelaAlias() . " = ? " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            $this->con->setNumero(1, $campeonato);
            $this->con->setsql($query);
            // echo $this->con->getsql ( ) ;
            Util::echobr(0, 'BateriaDAO findByCampeonato', $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findByBateriaEtapaAtivo($bean)
    {
        $this->results = new BateriaBean();
        $etapaDAO = new EtapaDAO($this->con);
        
        try {
            
            $querySelect = " SELECT " . // sql
$this->camposSelect() . ", " . // sql
$etapaDAO->camposSelect() . "  "; // sql
            
            $queryFrom = " FROM " . $this->getdbprexis() . $this->tabelaAlias() . // sql
" inner join " . $this->getdbprexis() . $etapaDAO->tabelaAlias() . // sql
" on " . $this->getalias() . ".idetapa =  " . $etapaDAO->idtabelaAlias(); // sql
            
            $queryWhere = " where " . $this->whereAtivo() . // sql
" and " . $etapaDAO->whereAtivo() . // sql
" and " . $this->idtabelaAlias() . " = ? " . // sql
" and " . $etapaDAO->idtabelaAlias() . " = ? " . // sql
" ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            
            $query = $querySelect . $queryFrom . $queryWhere;
            $id = Util::getIdObjeto($bean);
            $idetapa = Util::getIdObjeto($bean->getetapa());
            $this->con->setNumero(1, $id);
            $this->con->setNumero(2, $idetapa);
            $this->con->setsql($query);
            // echo $this->con->getsql ( ) ;
            Util::echobr(0, 'BateriaDAO findByCampeonato', $this->con->getsql());
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->results = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->results;
    }

    public function findAllEtapaCampeonato()
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = $this->getQueryBase() . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            $this->con->setsql($query);
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findAll()
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = $this->getQueryBase() . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            $this->con->setsql($query);
            $result = $this->con->execute();
            
            while ($array = $result->fetch_assoc()) {
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findAllAtivo()
    {
    	$this->clt = array();
    	$categoriaDAO = new CategoriaDAO($this->con);
    	$campeonatoDAO = new CampeonatoDAO($this->con);
    	$etapaDAO = new EtapaDAO($this->con);
    	$pistaDAO = new PistaDAO($this->con);
    	$pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
    	
    	try {
    		$query = " SELECT " . //sql 
      		$this->camposSelect() . ", " . //sql
      		$pistaDAO->camposSelect() . ", " . //sql
      		$etapaDAO->camposSelect() . ", " . //sql
      		$campeonatoDAO->camposSelect() . ", " . //sql
      		$categoriaDAO->camposSelect() . ", " . //sql
      		$pontuacaoesquemaDAO->camposSelect() . " " . //sql
      		" FROM " . $this->getdbprexis() . $this->tabelaAlias() . //sql
      		" left outer join " . $this->getdbprexis() . $etapaDAO->tabelaAlias() . //sql
      		" on " . $this->getalias() . ".idetapa =  " . $etapaDAO->idtabelaAlias() . //sql
      		" left outer join " . $this->getdbprexis() . $pistaDAO->tabelaAlias() . //sql
      		" on " . $this->getalias() . ".idpista =  " . $pistaDAO->idtabelaAlias() . //sql
      		" left outer join " . $this->getdbprexis() . $campeonatoDAO->tabelaAlias() . //sql
      		" on " . $etapaDAO->getalias() . ".idcampeonato =  " . $campeonatoDAO->idtabelaAlias() . //sql
      		" left outer join " . $this->getdbprexis() . $pontuacaoesquemaDAO->tabelaAlias() . //sql
      		" on " . $this->getalias() . ".idpontuacaoesquema =  " . $pontuacaoesquemaDAO->idtabelaAlias() . //sql
      		" left outer join " . $this->getdbprexis() . $categoriaDAO->tabelaAlias() . " on " . $this->getalias() . ".idcategoria =  " . $categoriaDAO->idtabelaAlias() .
      		" where " .
    		" " . $this->whereAtivo().
    		" and " . $etapaDAO->whereAtivo() .
    		" and " . $campeonatoDAO->whereAtivo() .
    		" ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
    		$this->con->setsql($query);
    		$result = $this->con->execute();
    		
    		while ($array = $result->fetch_assoc()) {
    			$this->clt[] = $this->getBeans($array);
    		}
    	} catch (Exception $e) {
    		throw new Exception($e->getMessage());
    	}
    	
    	return $this->clt;
    }

    public function findAllSort($bean)
    {
        $this->clt = array();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            if ($bean->getsort() != "") {
                $this->ordernome = $bean->getsort();
            }
            
            $query = $this->getQueryBase() . " ORDER BY " . $this->ordernome;
            
            $this->con->setsql($query);
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findById($id)
    {
        $this->results = new BateriaBean();
        $campeonatoDAO = new CampeonatoDAO($this->con);
        $etapaDAO = new EtapaDAO($this->con);
        $pistaDAO = new PistaDAO($this->con);
        $pontuacaoesquemaDAO = new PontuacaoEsquemaDAO($this->con);
        
        try {
            $query = $this->getQueryBase() . " where " . $this->idtabelaAlias() . " = ? " . " ORDER BY " . $etapaDAO->getordernome() . ", " . $this->getordernome();
            // $query = "SELECT bateria.idetapa bateria_idetapa, bateria.nome bateria_nome, bateria.idpontuacaoesquema bateria_idpontuacaoesquema, bateria.dtbateria bateria_dtbateria, bateria.idbateria bateria_idbateria, bateria.criador bateria_criador, bateria.dtcriacao bateria_dtcriacao, bateria.modificador bateria_modificador, bateria.dtmodificacao bateria_dtmodificacao, bateria.dtvalidade bateria_dtvalidade, etapa.idcampeonato etapa_idcampeonato, etapa.nome etapa_nome, etapa.idetapa etapa_idetapa, etapa.criador etapa_criador, etapa.dtcriacao etapa_dtcriacao, etapa.modificador etapa_modificador, etapa.dtmodificacao etapa_dtmodificacao, etapa.dtvalidade etapa_dtvalidade, campeonato.nome campeonato_nome, campeonato.idcampeonato campeonato_idcampeonato, campeonato.criador campeonato_criador, campeonato.dtcriacao campeonato_dtcriacao, campeonato.modificador campeonato_modificador, campeonato.dtmodificacao campeonato_dtmodificacao, campeonato.dtvalidade campeonato_dtvalidade, pontuacaoesquema.nome pontuacaoesquema_nome, pontuacaoesquema.idpontuacaoesquema pontuacaoesquema_idpontuacaoesquema, pontuacaoesquema.criador pontuacaoesquema_criador, pontuacaoesquema.dtcriacao pontuacaoesquema_dtcriacao, pontuacaoesquema.modificador pontuacaoesquema_modificador, pontuacaoesquema.dtmodificacao pontuacaoesquema_dtmodificacao, pontuacaoesquema.dtvalidade pontuacaoesquema_dtvalidade FROM kart_bateria bateria, kart_etapa etapa, kart_campeonato campeonato, kart_pontuacaoesquema pontuacaoesquema where bateria.idetapa = etapa.idetapa and etapa.idcampeonato = campeonato.idcampeonato and bateria.idpontuacaoesquema = pontuacaoesquema.idpontuacaoesquema and bateria.idbateria = ? ORDER BY etapa.nome, bateria.nome";
            // echo $query;
            $this->con->setNumero(1, $id);
            $this->con->setsql($query);
            $result = $this->con->execute();
            // echo $this->con->getsql();
            while ($array = $result->fetch_assoc()) {
                $this->results = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->results;
    }

    public function delete($bean)
    {
        $this->results = new BateriaBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            
            $query = " DELETE " . " FROM " . $this->dbprexis . $this->tabela() . " WHERE " . $this->idtabela() . " = ? ";
            
            $this->con->setNumero(1, $bean->getid());
            $this->con->setsql($query);
            $this->con->execute();
            $this->returnDataBaseBean->setresposta($bean->getid());
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $this->results;
    }
}

?>