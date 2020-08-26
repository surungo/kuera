<?php
/*
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontoBean.php';

class PontoDAO extends AbstractDAO
{

    protected $dbprexis = "kart_";

    protected $alias = "ponto";

    protected $tabela = "ponto";

    protected $idtabela = "idponto";

    protected $campos = array(
        "posicao",
        "valor",
        "descartavel",
        "idcampeonato",
        "idponto"
    );

    protected $ordernome = "ponto.valor";

    public function __construct($_conn)
    {
        parent::__construct($_conn);
    }

    public function update($bean)
    {
        $this->results = new PontoBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            $query = " UPDATE " . //sql
                $this->dbprexis . $this->tabela() .//sql
                " SET " .//sql
                " dtmodificacao = now(), " .//sql
                " modificador = ? , " .//sql
                " dtvalidade = ? , " .//sql
                " dtinicio = ? , " .//sql
                " posicao = ? , " .//sql
                " valor = ?  ," .//sql
                " descartavel = ?,  " .//sql
                " idcampeonato = ?  " .//sql
                " WHERE " .//sql
                $this->idtabela() . " =  ? ";//sql
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setNumero(4, $bean->getposicao());
            $this->con->setNumero(5, $bean->getvalor());
            $this->con->setTexto(6, $bean->getdescartavel());
            $this->con->setNumero(7, $bean->getcampeonato());
            $this->con->setNumero(8, $bean->getid());
            $this->con->setsql($query);
            $this->con->execute();
            // echo "Ponto: ".$this->con->getsql();
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
            
            $query = " insert into " . //sql
                $this->dbprexis . $this->tabela() . //sql
                " ( " . //sql
                " dtcriacao, " . //sql
                " criador, " . //sql
                " dtvalidade, " . //sql
                " dtinicio, " . //sql
                " posicao, " . //sql
                " valor, " . //sql
                " descartavel, " . //sql
                " idcampeonato, " . //sql
                $this->idtabela() . //sql
                " )values ( " . //sql
                " now(), " . // dtcriacao,
                " ?, " . // criador,
                " ?, " . // dtvalidade,
                " ?, " . // dtinicio,
                " ?, " . // posicao,
                " ?, " . // valor,
                " ?, " . // descartavel,
                " ?, " . // idcampeonato,
                " ? )"; // id;
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setNumero(4, $bean->getposicao());
            $this->con->setNumero(5, $bean->getvalor());
            $this->con->setTexto(6, $bean->getdescartavel());
            $this->con->setNumero(7, $bean->getcampeonato());
            $this->con->setNumero(8, $bean->getid());
            $this->con->setsql($query);
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($bean->getid());
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . $this->con->affected_rows() . " foram afetados.</span>");
        } catch (Exception $e) {
            $bean->setid(0);
            throw new Exception($e->getMessage());
        }
        return $this->returnDataBaseBean;
    }

    public function getBeans($array)
    {
        $this->bean = new PontoBean();
        $this->bean->setposicao($this->getValorArray($array, "posicao", null));
        $this->bean->setvalor($this->getValorArray($array, "valor", null));
        $this->bean->setdescartavel($this->getValorArray($array, "descartavel", null));
        $this->bean->setcampeonato($this->getValorArray($array, "idcampeonato", null));
        
        $this->bean->setid($this->getValorArray($array, "idponto", null));
        
        $this->bean = $this->getLogBeans($array, $this->bean);
        return $this->bean;
    }

    // metodos padr�o
    public function findAll()
    {
        $this->clt = array();
        try {
            $query = " SELECT " . $this->camposSelect() .  //sql
            " FROM " . $this->dbprexis . $this->tabelaAlias() .  //sql
            " ORDER BY " . $this->ordernome; //sql
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
        try {
            if ($bean->getsort() != "") {
                $this->ordernome = $bean->getsort();
            }
            $query = " SELECT " . $this->camposSelect() .  //sql
            " FROM " . $this->dbprexis . $this->tabelaAlias() .  //sql
            " ORDER BY " . $this->ordernome; //sql
            
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
        $this->results = new PontoBean();
        try {
            $query = " SELECT " . $this->camposSelect() .  //sql
            " FROM " . $this->dbprexis . $this->tabelaAlias() .  //sql
            " where " . $this->idtabelaAlias() . " = ? "; //sql
            $this->con->setNumero(1, $id);
            $this->con->setsql($query);
            $result = $this->con->execute();
            
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
        $this->results = new PontoBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            
            $query = " DELETE " .  //sql
                " FROM " . $this->dbprexis . $this->tabela() .  //sql
                " WHERE " . $this->idtabela() . " = ? "; //sql
            
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
*/
?>