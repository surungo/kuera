<?php
include_once PATHPUBDAO . '/AbstractDAO.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoBateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/BateriaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/EtapaDAO.php';
include_once PATHAPP . '/mvc/kart/model/dao/PilotoCampeonatoDAO.php';

class PilotoDAO extends AbstractDAO
{

    protected $dbprexis = "kart_";

    protected $alias = "piloto";

    protected $tabela = "piloto";

    protected $idtabela = "idpiloto";

    protected $campos = array(
        "nome",
        "apelido",
        "peso",
        "pesoextra",
        "facebook",
        "foto",
        "fotoimg",
        "dtnascimento",
        "descricao",
        "observacao",
        "cpf",
        "telefone",
        "email",
        "nomejoin",
        "idpessoa",
        "idpiloto",
        "sigla"
    );

    protected $ordernome = "piloto.nome";

    public function __construct($_conn)
    {
        parent::__construct($_conn);
    }

    public function updateimg($bean)
    {
        $dbg = 0;
        $this->results = new PilotoBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            $query = " UPDATE " . // sql
$this->dbprexis . // sql
$this->tabela() . // sql
" SET " . // sql
" dtmodificacao = now(), " . // sql
" modificador = ? , " . // sql "
" dtvalidade = ? , " . // sql
" dtinicio = ? , " . // sql
" nome = trim(?) , " . // sql
" apelido = trim(?) , " . // sql
" peso = ? , " . // sql
" pesoextra = ? , " . // sql
" facebook = ? , " . // sql
" foto = ? , " . // sql
" fotoimg = ifnull(?,fotoimg) , " . // sql
" dtnascimento = ?, " . // sql
" descricao = ?, " . // sql
" observacao = ?, " . // sql
" cpf = ?, " . // sql
" telefone = ?, " . // sql
" email = ?, " . // sql
" nomejoin = trim(?), " . // sql
" idpessoa = ? , " . // sql
" sigla = ? " . // sql
" WHERE " . // sql
$this->idtabela() . " = ? ";
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setTexto(4, $bean->getnome());
            $this->con->setTexto(5, $bean->getapelido());
            $this->con->setTexto(6, $bean->getpeso());
            $this->con->setTexto(7, $bean->getpesoextra());
            $this->con->setTexto(8, $bean->getfacebook());
            $this->con->setTexto(9, $bean->getfoto());
            $this->con->setTexto(10, $bean->getfotoimg());
            $this->con->setData(11, $bean->getdtnascimento());
            $this->con->setTexto(12, $bean->getdescricao());
            $this->con->setTexto(13, $bean->getobservacao());
            $this->con->setTexto(14, $bean->getcpf());
            $this->con->setTexto(15, $bean->gettelefone());
            $this->con->setTexto(16, $bean->getemail());
            $this->con->setTexto(17, $bean->getnomejoin());
            $this->con->setNumero(18, Util::getIdObjeto($bean->getpessoa()));
            $this->con->setTexto(19, $bean->getsigla());
            $this->con->setNumero(20, $bean->getid());
            $this->con->setsql($query);
            Util::echobr($dbg, 'PilotoDAO updateimg $this->con->getsql()', $this->con->getsql());
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($bean);
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . // sql
$this->con->affected_rows() . " registro(s) atualizado(s).");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $this->returnDataBaseBean;
    }

    public function update($bean)
    {
        $this->results = new PilotoBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            $query = " UPDATE " . // sql
$this->dbprexis . $this->tabela() . // sql
" SET " . // sql
" dtmodificacao = now(), " . // sql
" modificador = ? , " . // sql
" dtvalidade = ? , " . // sql
" dtinicio = ? , " . // sql
" nome = trim(?) , " . // sql
" apelido = trim(?) , " . // sql
" peso = ? , " . // sql
" pesoextra = ? , " . // sql
" facebook = ? , " . // sql
" foto = ? , " . // sql
" dtnascimento = ?, " . // sql
" descricao = ?, " . // sql
" observacao = ?, " . // sql
" cpf = ?, " . // sql
" telefone = ?, " . // sql
" email = ?, " . // sql
" nomejoin = trim(?), " . // sql
" idpessoa = ?, " . // sql
" sigla = ? " . // sql
" WHERE " . // sql
$this->idtabela() . " =  ? ";
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setTexto(4, $bean->getnome());
            $this->con->setTexto(5, $bean->getapelido());
            $this->con->setTexto(6, $bean->getpeso());
            $this->con->setTexto(7, $bean->getpesoextra());
            $this->con->setTexto(8, $bean->getfacebook());
            $this->con->setTexto(9, $bean->getfoto());
            $this->con->setData(10, $bean->getdtnascimento());
            $this->con->setTexto(11, $bean->getdescricao());
            $this->con->setTexto(12, $bean->getobservacao());
            $this->con->setTexto(13, $bean->getcpf());
            $this->con->setTexto(14, $bean->gettelefone());
            $this->con->setTexto(15, $bean->getemail());
            $this->con->setTexto(16, $bean->getnomejoin());
            $this->con->setNumero(17, Util::getIdObjeto($bean->getpessoa()));
            $this->con->setTexto(18, $bean->getsigla());
            $this->con->setNumero(19, $bean->getid());
            $this->con->setsql($query);
            Util::echobr(0, 'PilotoDAO update $this->con->getsql()', $this->con->getsql());
            
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($bean);
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . // sql
$this->con->affected_rows() . " registro(s) atualizado(s).</span>");
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
            
            $query = " insert into " . // sql
$this->dbprexis . $this->tabela() . // sql
" ( " . // sql
" dtcriacao, " . // sql
" criador, " . // sql
" dtvalidade, " . // sql
" dtinicio, " . // sql
" nome, " . // sql
" apelido, " . // sql
" peso, " . // sql
" pesoextra, " . // sql
" facebook, " . // sql
" foto, " . // sql
" fotoimg, " . // sql
" dtnascimento, " . // sql
" descricao, " . // sql
" observacao, " . // sql
" cpf, " . // sql
" telefone, " . // sql
" email, " . // sql
" nomejoin, " . // sql
" idpessoa, " . // sql
" sigla, " . // sql
$this->idtabela() . " )values ( " . // sql
" now(), " . // dtcriacao,
" ?, " . // criador,
" ?, " . // dtvalidade,
" ?, " . // dtinicio,
" trim(?), " . // nome,
" trim(?), " . // apelido,
" trim(?), " . // peso,
" trim(?), " . // pesoextra,
" ?, " . // facebook,
" ?, " . // foto,
" ?, " . // fotoimg,
" ?, " . // dtnascimento,
" ?, " . // descricao,
" ?, " . // observacao,
" ?, " . // cpf,
" ?, " . // telefone,
" ?, " . // email,
" trim(?), " . // nomejoin,
" ?, " . // idpessoa,
" ?, " . // sigla,
" ? )"; // id;
            
            $this->con->setTexto(1, $usuarioLoginBean->getusuario());
            $this->con->setData(2, $bean->getdtvalidade());
            $this->con->setData(3, $bean->getdtinicio());
            $this->con->setTexto(4, $bean->getnome());
            $this->con->setTexto(5, $bean->getapelido());
            $this->con->setTexto(6, $bean->getpeso());
            $this->con->setTexto(7, $bean->getpeso());
            $this->con->setTexto(8, $bean->getfacebook());
            $this->con->setTexto(9, $bean->getfoto());
            $this->con->setTexto(10, $bean->getfotoimg());
            $this->con->setData(11, $bean->getdtnascimento());
            $this->con->setTexto(12, $bean->getdescricao());
            $this->con->setTexto(13, $bean->getobservacao());
            $this->con->setTexto(14, $bean->getcpf());
            $this->con->setTexto(15, $bean->gettelefone());
            $this->con->setTexto(16, $bean->getemail());
            $this->con->setTexto(17, $bean->getnomejoin());
            $this->con->setNumero(18, Util::getIdObjeto($bean->getpessoa()));
            $this->con->setTexto(19, $bean->getsigla());
            $this->con->setNumero(20, $bean->getid());
            $this->con->setsql($query);
            // echo $this->con->getsql();
            $this->con->execute();
            
            $this->returnDataBaseBean->setresposta($bean);
            $this->returnDataBaseBean->setmensagem("<span class='azul'>Total de " . // sql
$this->con->affected_rows() . " foram afetados.</span>");
        } catch (Exception $e) {
            $bean->setid(0);
            throw new Exception($e->getMessage());
        }
        return $this->returnDataBaseBean;
    }

    public function getBeans($array)
    {
        $this->bean = new PilotoBean();
        $this->bean->setid($this->getValorArray($array, "idpiloto", null));
        $this->bean->setnome($this->getValorArray($array, "nome", null));
        $this->bean->setapelido($this->getValorArray($array, "apelido", null));
        $this->bean->setpeso($this->getValorArray($array, "peso", null));
        $this->bean->setpesoextra($this->getValorArray($array, "pesoextra", null));
        $this->bean->setfacebook($this->getValorArray($array, "facebook", null));
        $this->bean->setfoto($this->getValorArray($array, "foto", null));
        $this->bean->setfotoimg($this->getValorArray($array, "fotoimg", null));
        $this->bean->setdtnascimento($this->getValorArray($array, "dtnascimento", null));
        $this->bean->setcpf($this->getValorArray($array, "cpf", null));
        $this->bean->setemail($this->getValorArray($array, "email", null));
        $this->bean->settelefone($this->getValorArray($array, "telefone", null));
        $this->bean->setdescricao($this->getValorArray($array, "descricao", null));
        $this->bean->setobservacao($this->getValorArray($array, "observacao", null));
        $this->bean->setnomejoin($this->getValorArray($array, "nomejoin", null));
        $this->bean->setpessoa($this->getValorArray($array, "idpessoa", null));
        $this->bean->setsigla($this->getValorArray($array, "sigla", null));
        $this->bean = $this->getLogBeans($array, $this->bean);
        return $this->bean;
    }

    // metodos padrao
    public function findAllAtivo()
    {
        $this->clt = array();
        try {
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . " " . // sql
" where " . // sql
$this->whereAtivo() . // sql
" ORDER BY " . // sql
$this->ordernome;
            $this->con->setsql($query);
            Util::echobr(0, "PilotoDAO findAllAtivo", $this->con->getsql());
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
        try {
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . " " . // sql
" ORDER BY " . // sql
$this->ordernome;
            
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
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . " " . // sql
" ORDER BY " . // sql
$this->ordernome;
            
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

    public function findById($bean)
    {
        $this->results = new PilotoBean();
        try {
            
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . //sql
" where " . // sql
$this->idtabelaAlias() . " = ? ";
            
            $this->con->setNumero(1, Util::getIdObjeto($bean));
            $this->con->setsql($query);
            // echo $this->con->getsql();
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->results = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->results;
    }

    public function findByCPF($cpf)
    {
        $this->results = new PilotoBean();
        try {
            
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . // sql
" where cpfClean(" . // sql
$this->getalias() . ".cpf) = ? ";
            
            $this->con->setTexto(1, $cpf);
            $this->con->setsql($query);
            Util::echobr(0, "PilotoDAO findByCPF", $this->con->getsql());
            
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->results = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->results;
    }

    public function findByPessoa($pessoa)
    {
        $this->results = new PilotoBean();
        try {
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . // sql
" where " . // sql
$this->getalias() . ".idpessoa = ? ";
            $this->con->setNumero(1, Util::getIdObjeto($pessoa));
            $this->con->setsql($query);
            Util::echobr(0, "PilotoDAO findByPessoa", $this->con->getsql());
            
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->results = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->results;
    }

    public function findInscritoSemelhante($inscritoBean)
    {
        $this->clt = array();
        try {
            $query = " SELECT " . // sql
$this->camposSelect() . // sql
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . // sql
" where " . // sql
" (  " . // sql
" tiraacento(upper(" . // sql
$this->getalias() . ".nome)) = tiraacento(upper(?))" . // sql
" or " . // sql
" tiraacento(upper(" . // sql
$this->getalias() . ".apelido)) = tiraacento(upper(?))" . // sql
" or " . // sql
" tiraacento(upper(" . // sql
$this->getalias() . ".nomejoin)) = tiraacento(upper(?)) " . // sql
" or " . // sql
" (" . // sql
$this->getalias() . ".dtnascimento = ? AND " . // sql
" " . // sql
$this->getalias() . ".dtnascimento != '' )" . // sql
" ) ";
            $this->con->setTexto(1, $inscritoBean->getnome());
            $this->con->setTexto(2, $inscritoBean->getnome());
            $this->con->setTexto(3, $inscritoBean->getnome());
            $this->con->setTexto(4, $inscritoBean->getdtnascimento());
            $this->con->setsql($query);
            Util::echobr(0, "PilotoDAO findInscritoSemelhante sql", $this->con->getsql());
            
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->clt[] = $this->getBeans($array);
            }
            Util::echobr(0, "PilotoDAO findInscritoSemelhante return", $this->clt);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function findCampeonatoNotBateria($idcampeonato)
    {
        $this->clt = array();
        $pilotoCampeonatoDao = new PilotoCampeonatoDAO($this->con);
        $pilotoBateriaDao = new PilotoBateriaDAO($this->con);
        
        $bateriaDao = new BateriaDAO($this->con);
        $etapaDao = new EtapaDAO($this->con);
        
        try {
            Util::echobr(0, 'PilotoDao findCampeonatoNotBateria', $idcampeonato);
            $query = " SELECT " . // sql
$this->camposSelect() . //sql 
" FROM " . // sql
$this->dbprexis . $this->tabelaAlias() . // sql
" inner join " . // sql
$this->dbprexis . $pilotoCampeonatoDao->tabelaAlias() . // sql
" on " . // sql
$this->idtabelaAlias() . " . // sql  
" . // sql
$pilotoCampeonatoDao->getalias() . ".idpiloto " . // sql
" where " . // sql
$this->whereAtivo() . // sql
" and " . // sql
$pilotoCampeonatoDao->getalias() . ".idcampeonato = ? " . // sql
" and not exists ( " . // sql
" select 1 " . // sql
" from " . // sql
$this->dbprexis . $pilotoBateriaDao->tabelaAlias() . // sql
" inner join " . // sql
$this->dbprexis . $bateriaDao->tabelaAlias() . // sql
" on " . // sql
$pilotoBateriaDao->getalias() . ".idbateria = " . // sql
$bateriaDao->idtabelaAlias() . // sql
" inner join " . // sql
$this->dbprexis . $etapaDao->tabelaAlias() . // sql
" on " . // sql
$bateriaDao->getalias() . ".idetapa = " . // sql
$etapaDao->idtabelaAlias() . // sql
" where " . // sql
$pilotoBateriaDao->getalias() . ".idpiloto = " . // sql
$this->getalias() . ".idpiloto" . // sql
" and " . // sql
$pilotoBateriaDao->whereAtivo() . // sql
" and " . // sql
$bateriaDao->whereAtivo() . // sql
" and " . // sql
$etapaDao->whereAtivo() . // sql  
" ORDER BY " . // sql
$this->ordernome;
            Util::echobr(0, 'PilotoDao $query', $query);
            $this->con->setNumero(1, $idcampeonato);
            $this->con->setsql($query);
            Util::echobr(0, 'PilotoDAO findCampeonatoNotBateria sql', $this->con->getsql());
            
            $result = $this->con->execute();
            while ($array = $result->fetch_assoc()) {
                $this->clt[] = $this->getBeans($array);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
        return $this->clt;
    }

    public function delete($bean)
    {
        $this->results = new PilotoBean();
        try {
            $usuarioLoginBean = $this->setoperador();
            
            $query = " DELETE " . // sql
" FROM " . // sql
$this->dbprexis . $this->tabela() . //sql
" WHERE " . // sql
$this->idtabela() . " = ? ";
            
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