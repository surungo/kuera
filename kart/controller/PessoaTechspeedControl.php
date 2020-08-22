<?php


include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

$dbg=0;
Util::echobr ( $dbg, 'PessoaTechspeedControl $beanPaginaAtual',  $beanPaginaAtual );


$bean = new PessoaBean ();
$pessoaBusiness = new PessoaBusiness ();
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setapelido ( (isset ( $_POST ['apelido'] )) ? $_POST ['apelido'] : null );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$bean->setdtnascimento ( (isset ( $_POST ['dtnascimento'] ) && $_POST ['dtnascimento'] != "") ? Util::strtotimestamp ( $_POST ['dtnascimento'] ) : "" );
$bean->setemail ( (isset ( $_POST ['email'] )) ? $_POST ['email'] : null );
$bean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
$bean->settelefone ( (isset ( $_POST ['telefone'] )) ? $_POST ['telefone'] : null );

$bean->setrg ( (isset ( $_POST ['rg'] )) ? $_POST ['rg'] : null );
$bean->setendereco ( (isset ( $_POST ['endereco'] )) ? $_POST ['endereco'] : null );
$bean->setnumero ( (isset ( $_POST ['numero'] )) ? $_POST ['numero'] : null );
$bean->setcomplemento ( (isset ( $_POST ['complemento'] )) ? $_POST ['complemento'] : null );
$bean->setbairro ( (isset ( $_POST ['bairro'] )) ? $_POST ['bairro'] : null );
$bean->setcidade ( (isset ( $_POST ['cidade'] )) ? $_POST ['cidade'] : null );
$bean->setuf ( (isset ( $_POST ['uf'] )) ? $_POST ['uf'] : null );
$bean->setcep ( (isset ( $_POST ['cep'] )) ? $_POST ['cep'] : null );
$bean->settpsanguineo ( (isset ( $_POST ['tpsanguineo'] )) ? $_POST ['tpsanguineo'] : null );
$bean->setnmemergencia ( (isset ( $_POST ['nmemergencia'] )) ? $_POST ['nmemergencia'] : null );
$bean->settelefoneemergencia ( (isset ( $_POST ['telefoneemergencia'] )) ? $_POST ['telefoneemergencia'] : null );
$bean->setcidadeemergencia ( (isset ( $_POST ['cidadeemergencia'] )) ? $_POST ['cidadeemergencia'] : null );
$bean->setufemergencia ( (isset ( $_POST ['ufemergencia'] )) ? $_POST ['ufemergencia'] : null );

$bean->settamanhocamisa ( (isset ( $_POST ['tamanhocamisa'] )) ? $_POST ['tamanhocamisa'] : null );
$bean->setdtvalidaemail ( (isset ( $_POST ['dtvalidaemail'] ) && $_POST ['dtvalidaemail'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidaemail'] ) : "" );
$bean->setsenha ( (isset ( $_POST ['senha'] )) ? $_POST ['senha'] : null );

$bean->getpostlog ();
$dbg=0;
Util::echobr ( $dbg, 'PessoaTechspeedControl $bean',  $bean );
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pessoaBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		$collection = $pessoaBusiness->findAllValidos();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $pessoaBusiness->salveNotNull ( $bean );
		$bean = $retorno->getresposta ();
		$dbg=0;
        Util::echobr ( $dbg, 'PessoaTechspeedControl $bean',  $bean );
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pessoaBusiness->findId ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}

$phpAtual = $beanPaginaAtual->geturl ();
$phpAtual = str_replace("Pro", "", $phpAtual);
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>