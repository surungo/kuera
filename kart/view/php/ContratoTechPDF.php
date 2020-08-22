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
if ($idobj > 0) {
	$bean = $pessoaBusiness->findId ( $idobj );
}

include PATHORIGEM."/php/contratotech.php";

?>