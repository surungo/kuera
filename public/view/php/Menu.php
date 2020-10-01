<span style="font-size: 6pt;background-color: #ffffff55;">
BUILDNUMBER:
<?php include PATHAPP."/release.id";?>
</span>
<?php
require_once (PATHPUBBEAN . '/PaginaBean.php');
require_once (PATHPUBFAC . '/ButtonClass.php');

$button = new ButtonClass ();

for($i = 0; $i < count ( $paginaCollection ); $i ++) {
	$beanPaginaMenu = new PaginaBean ();
	$beanPaginaMenu = $paginaCollection [$i];
	if ($beanPaginaMenu->isvisivel () && $beanPaginaMenu->isativo ()) {
		echo $button->btMenu ( $beanPaginaMenu->getnome (), (ENCRIPT_LINK) ? Cripto::encrypt ( $beanPaginaMenu->getid () ) : $beanPaginaMenu->getid (), "0", $beanPaginaMenu->geturl (), $beanPaginaMenu->gettarget (), Choice::LISTAR );
	}
}
?>


<!-- >div id="jsddm"><a href="?logout=logout">Sair</a></div>
	
<div id="jsddm"><a href="http://dbmy0026.whservidor.com/index.php?db=surfeeling&token=46d7088749fb564a9e907088e6683af3" 
target="_blank">Database</a></div>
	<div id="jsddm"><a href="http://127.0.0.1:4001/phpmy/index.php?db=stok" 
target="_blank">Database Local</a></div> 
	<div id="jsddm"><a href="https://docs.google.com/document/d/1GT8Cij11Gj4P0hhkToaUBlL-jNgCMXuOUwvC8nYqBOc/edit?hl=en&pli=1#"
target="_blank">Documento</a></div -->
