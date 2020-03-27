<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/bolao/model/bean/ApostaBean.php';
include_once PATHAPP . '/mvc/bolao/model/dao/PartidaDAO.php';

class ApostaDAO extends AbstractDAO {
    protected $dbprexis = "bolao_";
    protected $alias = "aposta";
    protected $tabela = "aposta";
    protected $idtabela = "idaposta";
    protected $campos = array (
        "nome",
        "placar1",
        "placar2",
        "pontos",
        "tipoacerto",
        "idpartida",
        "idaposta"
    );
    protected $ordernome = "aposta.pontos desc";
    public function __construct($_conn) {
        parent::__construct ( $_conn );
    }
    public function update($bean) {
        $this->results = new ApostaBean ();
        try {
            $usuarioLoginBean = $this->setoperador ();
            $query =
            " UPDATE " . $this->dbprexis . $this->tabela () .
            " SET " .
            " dtmodificacao = now(), " .
            " modificador = ? , " .
            " dtvalidade = ? , " .
            " dtinicio = ? , " .
            " nome = ?  ," .
            " placar1 = ?  ," .
            " placar2 = ?  ," .
            " pontos = ?  ," .
            " tipoacerto = ?  ," .
            " idpartida = ?  " .
            " WHERE " . $this->idtabela () . " =  ? ";
            
            $this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
            $this->con->setData ( 2, $bean->getdtvalidade () );
            $this->con->setData ( 3, $bean->getdtinicio () );
            $this->con->setTexto ( 4, $bean->getnome () );
            $this->con->setNumero ( 5, $bean->getplacar1 () );
            $this->con->setNumero ( 6, $bean->getplacar2 () );
            $this->con->setNumero ( 7, $bean->getpontos () );
            $this->con->setNumero ( 8, $bean->gettipoacerto () );
            $this->con->setNumero ( 9, $bean->getpartida () );
            $this->con->setNumero ( 10, $bean->getid () );
            $this->con->setsql ( $query );
            $this->con->execute ();
            // echo "Aposta: ".$this->con->getsql();
            $this->returnDataBaseBean->setresposta ( $bean->getid () );
            $this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        return $this->returnDataBaseBean;
    }
    public function insert($bean) {
        try {
            $usuarioLoginBean = $this->setoperador ();
            $bean->setid ( $this->getid ( $this->dbprexis ) );
            
            $query = " insert into " .
                $this->dbprexis . $this->tabela () .
                " ( " .
                " dtcriacao, " .
                " criador, " .
                " dtvalidade, " .
                " dtinicio, " .
                " nome, " .
                " placar1, " .
                " placar2,  " .
                " pontos, " .
                " tipoacerto, " .
                " idpartida, " .
                $this->idtabela () .
                " )values ( " .
                " now(), " . 		// dtcriacao,
                " ?, " . 			// criador,
                " ?, " . 			// dtvalidade,
                " ?, " . 			// dtinicio,
                " ?, " . 			// nome,
                " ?, " . 			// placar1,
                " ?, " . 			// placar2,
                " ?, " . 			// pontos,
                " ?, " . 			// tipoacerto,
                " ?, " . 			// idpartida,
                " ? )"; // id;
                
                $this->con->setTexto ( 1, $usuarioLoginBean->getusuario () );
                $this->con->setData ( 2, $bean->getdtvalidade () );
                $this->con->setData ( 3, $bean->getdtinicio () );
                $this->con->setTexto ( 4, $bean->getnome () );
                $this->con->setNumero ( 5, $bean->getplacar1 () );
                $this->con->setNumero ( 6, $bean->getplacar2 () );
                $this->con->setNumero ( 7, $bean->getpontos () );
                $this->con->setNumero ( 8, $bean->gettipoacerto() );
                $this->con->setNumero ( 9, $bean->getpartida () );
                $this->con->setNumero ( 10, $bean->getid () );
                $this->con->setsql ( $query );
                $this->con->execute ();
                
                $this->returnDataBaseBean->setresposta ( $bean->getid () );
                $this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
        } catch ( Exception $e ) {
            $bean->setid ( 0 );
            throw new Exception ( $e->getMessage () );
        }
        return $this->returnDataBaseBean;
    }
    public function getBeans($array) {
        $this->bean = new ApostaBean ();
        
        $this->bean->setid ( $this->getValorArray ( $array, "idaposta", null ) );
        $this->bean->setnome ( $this->getValorArray ( $array, "nome", null ) );
        $this->bean->setplacar1 ( $this->getValorArray ( $array, "placar1", null ) );
        $this->bean->setplacar2 ( $this->getValorArray ( $array, "placar2", null ) );
        $this->bean->setpontos ( $this->getValorArray ( $array, "pontos", null ) );
        $this->bean->settipoacerto ( $this->getValorArray ( $array, "tipoacerto", null ) );
        $this->bean->setpartida ( $this->getValorArray ( $array, "partida", new PartidaDAO ( $con ) ) );
        
        $this->bean = $this->getLogBeans ( $array, $this->bean );
        return $this->bean;
    }
    
    // metodos padr�o
    public function findAll() {
        $this->clt = array ();
        $partidaDAO = new PartidaDAO ( $con );
        try {
            $query = " SELECT " .
                $this->camposSelect () .", ".
                $partidaDAO->camposSelect().
                " FROM " . $this->dbprexis . $this->tabelaAlias () .
                " inner join " . $this->dbprexis . $partidaDAO->tabelaAlias() .
                " on " . $this->alias . ".idpartida = ". $partidaDAO->idtabelaAlias() . 
                " ORDER BY " . $this->ordernome;
            $this->con->setsql ( $query );
            $result = $this->con->execute ();
            
            while ( $array = $result->fetch_assoc () ) {
                $this->clt [] = $this->getBeans ( $array );
            }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->clt;
    }
    
    public function apostadores() {
        $this->clt = array ();
        $partidaDAO = new PartidaDAO ( $con );
        try {
            $query = " SELECT " .
                " distinct ".$this->alias.".nome nome".
                " FROM " . $this->dbprexis . $this->tabelaAlias () .
                " ORDER BY ".$this->alias.".nome";
                $this->con->setsql ( $query );
                $result = $this->con->execute ();
                
                while ( $array = $result->fetch_assoc () ) {
                    $this->bean = new ApostaBean ();
                    $this->bean->setnome ( $array["nome"] );
                    $this->clt [] = $this->bean;
                }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->clt;
    }
    
    public function findByNomePartida($bean) {
        $this->results = new ApostaBean ();
        try {
            $query = " SELECT " .
                $this->camposSelect () .
                " FROM " . $this->dbprexis . $this->tabelaAlias () .
                " WHERE " .
                " ".$this->alias.".nome = ? and ".
                " ".$this->alias.".idpartida = ? "    ;
            $this->con->setTexto ( 1, $bean->getnome () );
            $this->con->setNumero ( 2, Util::getIdObjeto($bean->getpartida ()) );
            $this->con->setsql ( $query );
            $result = $this->con->execute ();
            
            while ( $array = $result->fetch_assoc () ) {
                $this->results = $this->getBeans ( $array );
            }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->results;
    }
    
    
    public function findAllSort($bean) {
        $this->clt = array ();
        try {
            if ($bean->getsort () != "") {
                $this->ordernome = $bean->getsort ();
            }
            $query = " SELECT " . $this->camposSelect () .
            " FROM " . $this->dbprexis . $this->tabelaAlias () .
            " ORDER BY " . $this->ordernome;
            
            $this->con->setsql ( $query );
            $result = $this->con->execute ();
            
            while ( $array = $result->fetch_assoc () ) {
                $this->clt [] = $this->getBeans ( $array );
            }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->clt;
    }
    
    public function findById($id) {
        $this->results = new ApostaBean ();
        try {
            $query = " SELECT " . $this->camposSelect () .
            " FROM " . $this->dbprexis . $this->tabelaAlias () .
            " where " . $this->idtabelaAlias () . " = ? ";
            $this->con->setNumero ( 1, $id );
            $this->con->setsql ( $query );
            $result = $this->con->execute ();
            
            while ( $array = $result->fetch_assoc () ) {
                $this->results = $this->getBeans ( $array );
            }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->results;
    }
    
    
    public function findByPartida($partida) {
        $this->results = Array ();
        $partidaDAO = new PartidaDAO ( $con );
        try {
            $query = " SELECT " . 
            $this->camposSelect () .", ".
            $partidaDAO->camposSelect().
            " FROM " . $this->dbprexis . $this->tabelaAlias () .
            " inner join " . $this->dbprexis . $partidaDAO->tabelaAlias() .
            " on " . $this->alias . ".idpartida = ". $partidaDAO->idtabelaAlias() . 
            " where " . $this->alias . ".idpartida = ? ";
            $this->con->setNumero ( 1, Util::getIdObjeto( $partida ) );
            $this->con->setsql ( $query );
            $result = $this->con->execute ();
            
            while ( $array = $result->fetch_assoc () ) {
                $this->results[] = $this->getBeans ( $array );
            }
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        
        return $this->results;
    }
    
    
    public function delete($bean) {
        $this->results = new ApostaBean ();
        try {
            $usuarioLoginBean = $this->setoperador ();
            
            $query = " DELETE " .
                " FROM " . $this->dbprexis . $this->tabela () .
                " WHERE " . $this->idtabela () . " = ? ";
            
            $this->con->setNumero ( 1, $bean->getid () );
            $this->con->setsql ( $query );
            $this->con->execute ();
            $this->returnDataBaseBean->setresposta ( $bean->getid () );
            $this->returnDataBaseBean->setmensagem ( "<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>" );
        } catch ( Exception $e ) {
            throw new Exception ( $e->getMessage () );
        }
        return $this->results;
    }
}

?>