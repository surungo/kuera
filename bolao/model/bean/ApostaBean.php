<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';

class ApostaBean extends AbstractBean {
	
    private $id;
    private $partida;
    private $nome;
	private $placar1;
	private $placar2;
	private $pontos;
	private $pontoacumulado;
	private $posicao;
	private $tipoacerto;
	
    public function getid()
    {
        return $this->id;
    }

    public function getpartida()
    {
        return $this->partida;
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

    public function getpontos()
    {
        return $this->pontos;
    }

    public function gettipoacerto()
    {
        return $this->tipoacerto;
    }

    public function getpontoacumulado()
    {
        return $this->pontoacumulado;
    }
    
    public function getposicao()
    {
        return $this->posicao;
    }
    
    public function setid($id)
    {
        $this->id = $id;
    }

    public function setpartida($partida)
    {
        $this->partida = $partida;
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

    public function setpontos($pontos)
    {
        $this->pontos = $pontos;
    }

    public function settipoacerto($tipoacerto)
    {
        $this->tipoacerto = $tipoacerto;
    }
    
    public function setpontoacumulado($pontoacumulado)
    {
    	$this->pontoacumulado = $pontoacumulado;
    }
    public function setposicao($posicao)
    {
    	$this->posicao = $posicao;
    }
    

}
?>