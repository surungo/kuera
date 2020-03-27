<?php

// DESTRUIMOS AS VARI�VEIS
unset ( $_SESSION [$keysession] );
unset ( $_SESSION [DBPREFIXPUB . 'dtinicioPadrao'] );
unset ( $_SESSION [DBPREFIXPUB . 'dtterminoPadrao'] );
include PATHPUBPHP . '/Login.php';
?>