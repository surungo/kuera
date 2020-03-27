<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/PartidaBusiness.php';
include_once PATHAPP . '/mvc/bolao/model/bean/ApostaBean.php';


class PartidaBean extends AbstractBean {
	
    private $id;
	private $nome;
	private $texto;
	private $placar1;
	private $placar2;
	private $peso;
	private $dtpartida;
	private $cltaposta;

	public function settexto($texto)
    {
        $this->texto = $texto;
        
        if($this->getpeso()==""||
            $this->getdtpartida()==""||
            $this->getnome()==""||
            $this->getplacar1()==""||
            $this->getplacar2()==""){
        
            $partidaBusiness = new PartidaBusiness ();
            $selecoes = $partidaBusiness->getselecoes();
            $pessoas = $partidaBusiness->getpessoas();
            
            $textoArray = preg_split( '/\r\n|\r|\n/', $texto);
            $jogoArray = preg_grep('/^\\d{1,2}\\/\\d{1,2}\\/\\d{4}.*/',$textoArray);
            sort($jogoArray);
            $jogoArray=array_filter($jogoArray);
            $jogo=$jogoArray[0];
            $selecao1 = "";
            $selecao2 = "";
            $posAnt=0;
            foreach ($selecoes as &$selecao) {
                $jogo = str_ireplace($selecao.$selecao, " ".$selecao, $jogo);
                $pos = stripos($jogo,$selecao);
                if($pos>-1){
                    if($pos>$posAnt){
                        if($selecoes2==""){
                            $selecoes2=$selecao;
                        }else{
                            $selecoes1=$selecoes2;
                            $selecoes2=$selecao;
                        }
                    }else{
                        $selecoes1=$selecao;
                    }
                    $posAnt = $pos;
                    
                }
                
            }
            preg_match_all('/\dX\d/',$jogo,$m);
            $v1 = $m[0][0];
            $resultado = preg_split( '/X/', $v1);
            if(count($resultado)<2){
                $resultado=array("0","0");
                $inppeso=20;
            }
            $part = preg_split( '/ - /', $jogo);
            $datajogo = $part[0];
            $peso = 0;
            foreach ($pessoas as &$pessoa) {
                $linha = "";
                foreach ($textoArray as &$linha) {
                    $pos = stripos($linha,$pessoa);
                    if($pos>-1){
                        break;
                    }
                }
                preg_match_all('/\dx\d/',$linha,$placarAux);
                if( $placarAux[0][0] == "" ){
                    continue;
                }
                $placar = $placarAux[0][0];
                $placarArr = preg_split( '/x/', $placar);
                $placar1 = $placarArr[0];
                $placar2 = $placarArr[1];
                
                $nomepontos= preg_split( '/\dx\d/', $linha);
                $pontos = 0;
                if(count($nomepontos)>1){
                    $pontos  = str_ireplace(" pontos","",$nomepontos[1]);
                    $pontos  = str_ireplace(" ponto","",$pontos);
                }
                
                $tipoAcerto = 0;
                
                // cabeça
                $result0 = ($result0=="")?$resultado[0]:$result0;
                $result1 = ($result1=="")?$resultado[1]:$result1;
                if($placar1==$result0 && $placar2==$result1){
                    $tipoAcerto = 25;
                }
                // vencedor e placar vencedor
                if( $tipoAcerto < 1  &&
                    $result0 > $result1 &&
                    $placar1 > $placar2 &&
                    $placar1==$result0 &&
                    $placar2!=$result1)
                {
                    $tipoAcerto = 18;
                }
                if( $tipoAcerto < 1  &&
                    $result0 < $result1 &&
                    $placar1 < $placar2 &&
                    $placar1!=$result0 &&
                    $placar2==$result1){
                        $tipoAcerto = 18;
                }
                // vencedor e saldo
                if( $tipoAcerto < 1 &&
                    $result0 > $result1 &&
                    $placar1 > $placar2 &&
                    ($placar1-$placar2) == ($result0-$result1))
                {
                    $tipoAcerto = 15;
                }
                if( $tipoAcerto < 1  &&
                    $result0 < $result1 &&
                    $placar1 < $placar2 &&
                    ($placar2 - $placar1) == ($result1-$result0))
                {
                    $tipoAcerto = 15;
                }
                if( $tipoAcerto < 1 &&
                    $result0 == $result1 &&
                    $placar1 == $placar2 &&
                    $placar1 != $result0 &&
                    ($placar1 - $placar2) == 0 &&
                    ($result0-$result1) == 0)
                {
                    $tipoAcerto = 15;
                }
                // vencedor e placar perdedor
                if( $tipoAcerto < 1  &&
                    $result0 > $result1 &&
                    $placar1 > $placar2 &&
                    $placar1!=$result0 &&
                    $placar2==$result1)
                {
                    $tipoAcerto = 12;
                }
                if( $tipoAcerto < 1  &&
                    $result0 < $result1 &&
                    $placar1 < $placar2 &&
                    $placar1==$result0 &&
                    $placar2!=$result1)
                    
                {
                    $tipoAcerto = 12;
                }
                // apenas vencedor
                if( $tipoAcerto < 1  &&
                    $result0 > $result1 &&
                    $placar1 > $placar2 &&
                    $placar1!=$result0 &&
                    $placar2!=$result1)
                {
                    $tipoAcerto = 10;
                }
                if( $tipoAcerto < 1  &&
                    $result0 < $result1 &&
                    $placar1 < $placar2 &&
                    $placar1!=$result0 &&
                    $placar2!=$result1)
                    
                {
                    $tipoAcerto = 10;
                }
                //empate
                if( $tipoAcerto < 1  &&
                    $placar1==$placar2 &&
                    ($result0-$result1)!=0)
                {
                    $tipoAcerto = 4;
                }
                
                //new aposta
                $aposta = new ApostaBean();
                $aposta->setnome($pessoa);
                $aposta->setplacar1($placar1);
                $aposta->setplacar2($placar2);
                $aposta->setpontos($pontos);
                $aposta->settipoacerto($tipoAcerto);
                
                $this->cltaposta[]=$aposta;
            }
            if( $tipoAcerto > 0 &&
                $peso !=  $pontos/$tipoAcerto){
                    $peso = $pontos/$tipoAcerto;
            }
            
            if($this->getpeso()=="")$this->setpeso($peso);
            if($this->getdtpartida()=="")$this->setdtpartida($datajogo);
            if($this->getnome()=="")$this->setnome($selecoes1." x ".$selecoes2);
            if($this->getplacar1()=="")$this->setplacar1($resultado[0]);
            if($this->getplacar2()=="")$this->setplacar2($resultado[1]);
           
        }
    }
    
    
    public function gettexto()
    {
        return $this->texto;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getnome()
    {
        return $this->nome;
    }

    public function getplacar1()
    {
        return $this->placar1;
    }

    public function getplacar2()
    {
        return $this->placar2;
    }

    public function getpeso()
    {
        return $this->peso;
    }

    public function getdtpartida()
    {
        return $this->dtpartida;
    }

    public function getcltaposta()
    {
        return $this->cltaposta;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function setnome($nome)
    {
        $this->nome = $nome;
    }

    public function setplacar1($placar1)
    {
        $this->placar1 = $placar1;
    }

    public function setplacar2($placar2)
    {
        $this->placar2 = $placar2;
    }

    public function setpeso($peso)
    {
        $this->peso = $peso;
    }

    public function setdtpartida($dtpartida)
    {
        $this->dtpartida = $dtpartida;
    }

    public function setcltaposta($cltaposta)
    {
        $this->cltaposta = $cltaposta;
    }


}

?>