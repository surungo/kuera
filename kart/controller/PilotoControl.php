<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/PessoaBean.php';
include_once PATHAPP . '/mvc/kart/model/business/PessoaBusiness.php';

$bean = new PilotoBean ();
$pilotoBusiness = new PilotoBusiness ();
$pessoaBean = new PessoaBean ();
$pessoaBusiness = new PessoaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$bean->setid ( $idobj );
$bean->setnome ( (isset ( $_POST ['nome'] )) ? $_POST ['nome'] : null );
$bean->setapelido ( (isset ( $_POST ['apelido'] )) ? $_POST ['apelido'] : null );
$bean->setsigla ( (isset ( $_POST ['sigla'] )) ? $_POST ['sigla'] : null );
$bean->setcpf ( (isset ( $_POST ['cpf'] )) ? $_POST ['cpf'] : null );
$bean->settelefone ( (isset ( $_POST ['telefone'] )) ? $_POST ['telefone'] : null );
$bean->setemail ( (isset ( $_POST ['email'] )) ? $_POST ['email'] : null );
$bean->setpeso ( (isset ( $_POST ['peso'] )) ? $_POST ['peso'] : null );
$bean->setpesoextra ( (isset ( $_POST ['pesoextra'] )) ? $_POST ['pesoextra'] : null );
$bean->setfacebook ( (isset ( $_POST ['facebook'] )) ? $_POST ['facebook'] : null );
$bean->setfoto ( (isset ( $_POST ['foto'] )) ? $_POST ['foto'] : null );
$bean->setdtnascimento ( (isset ( $_POST ['dtnascimento'] ) && $_POST ['dtnascimento'] != "") ? Util::strtotimestamp ( $_POST ['dtnascimento'] ) : "" );
$bean->setdescricao ( (isset ( $_POST ['descricao'] )) ? $_POST ['descricao'] : null );
$bean->setobservacao ( (isset ( $_POST ['observacao'] )) ? $_POST ['observacao'] : null );
$bean->setnomejoin ( (isset ( $_POST ['nomejoin'] )) ? $_POST ['nomejoin'] : null );
$bean->setpessoa ( (isset ( $_POST ['pessoa'] )) ? $_POST ['pessoa'] : null );

$bean->setfotoimg ( null );
// foto
$imagem = isset ( $_FILES ["fotoimg"] ) ? $_FILES ["fotoimg"] : null;
// echo $_FILES["fotoimg"]."asd<br>";
if ($imagem != NULL) {
	$nomeFinal = ($bean->getfoto () == null ? "piloto" : $bean->getfoto ()) . '.jpg';
	if (move_uploaded_file ( $imagem ['tmp_name'], $nomeFinal )) {
		$tamanhoImg = filesize ( $nomeFinal );
		$mysqlImg = addslashes ( fread ( fopen ( $nomeFinal, "r" ), $tamanhoImg ) );
		$bean->setfotoimg ( $mysqlImg );
	}
}

$bean->getpostlog ();
$editar = true;
$novo = true;
switch ($choice) {
	
	case Choice::EXCLUIR :
		if ($pilotoBusiness->delete ( $bean )) {
			$mensagem = SUCESSO;
		} else {
			$mensagem = FALHOU;
		}
	
	case Choice::LISTAR :
		// opcional server como padrao desta pagina
		$bean->setsort ( (isset ( $_POST ['clsort_' . (ENCRIPT_LINK) ? Cripto::decrypt ( $idurl ) : $idurl] )) ? $_POST ['clsort_' . (ENCRIPT_LINK) ? Cripto::decrypt ( $idurl ) : $idurl] : '' );
		$collection = $pilotoBusiness->findAllSort ( $bean );
		$urlC = LISTAR;
		break;
	
	case Choice::SALVAR :
		
		$bean->setdtvalidade ( (isset ( $_POST ['dtvalidade'] ) && $_POST ['dtvalidade'] != "") ? Util::strtotimestamp ( $_POST ['dtvalidade'] ) : "" );
		$retorno = $pilotoBusiness->salve ( $bean );
		$bean = $retorno->getresposta ();
		$idobj = $bean->getid ();
		$mensagem = $retorno->getmensagem ();
	// echo $mensagem.$idobj;
	
	case Choice::ABRIR :
		if ($idobj > 0) {
			$bean = $pilotoBusiness->findById ( $idobj );
		}
		$usuarioCollection = $usuarioBusiness->findAll ();
		$cltPessoaCollection = $pessoaBusiness->findAll ();
		
		
		$urlC = EDITAR;
		break;
}
$pilotobean=$bean;
$phpAtual = $beanPaginaAtual->geturl ();
$sistemaCodigo = $sistemaBean->getcodigo ();
$siteUrl = PATHAPPVER."/$sistemaCodigo/view/php/$phpAtual$urlC.php";
include ($siteUrl);
?>