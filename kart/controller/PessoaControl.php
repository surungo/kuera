<?php
include_once PATHPUBFAC . '/Util.php';
// include_once PATHPUBFAC.'/ParamentroEmun.php' ;
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

include_once PATHPUBBEAN . '/ParametroBean.php';
include_once PATHPUBBUS . '/ParametroBusiness.php';
$parametroBusiness = new ParametroBusiness ();
$parametroBean = new ParametroBean ();

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
$bean->settamanhocamisa ( (isset ( $_POST ['tamanhocamisa'] )) ? $_POST ['tamanhocamisa'] : null );
$bean->setdtvalidaemail ( (isset ( $_POST ['dtvalidaemail'] ) && $_POST ['dtvalidaemail'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidaemail'] ) : "" );
$bean->setsenha ( (isset ( $_POST ['senha'] )) ? $_POST ['senha'] : null );

$bean->getpostlog ();
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
		$collection = $pessoaBusiness->findAll();
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		$retorno = $pessoaBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pessoaBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		
		$urlC = EDITAR;
		break;
}
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>