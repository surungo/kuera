<!DOCTYPE html>
<html>
<head>

<meta charset="<?php echo PRJCHARSET;?>" />
<meta http-equiv="content-type" content="text/html;charset=" <?php echo PRJCHARSET;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo $beanPaginaAtual->getnome(); ?></title>

<script language="JavaScript" src="mvc/public/view/js/jquery.js"></script>
<script language="JavaScript" src="mvc/public/view/js/form.js"></script>

</head>
<body>
	<form name="formDefault" id="formDefault" method="post" action=""
		target="_top" enctype="multipart/form-data">
		<input type="hidden" id="keysession" name="keysession" size="32"
			value="<?php echo $keysession;?>"> <input type="hidden" id="idurl"
			name="idurl"
			value="<?php echo (ENCRIPT_LINK)?Cripto::encrypt($idurl):$idurl; ?>">
		<input type="hidden" id="idobj" name="idobj"> <input type="hidden"
			id="choice" name="choice"> <input type="hidden" id="choiceAnterior"
			name="choiceAnterior" value="<?php echo $choice;?>"> 
		<input
			type="hidden" id="idurlAnterior" name="idurlAnterior"
			value="<?php echo (ENCRIPT_LINK)?Cripto::encrypt($idurlAnterior):$idurlAnterior; ?>">
		<input type="hidden" id="action" name="action"
			value="<?php echo $action;?>">
		<input type="hidden" id="token" name="token"
			value="<?php echo $token;?>"> 
		
		<?php 
		Util::echobr ( 0, 'DefaultBlank $Mod_conteudo', $Mod_conteudo );
		if(file_exists($Mod_conteudo))include($Mod_conteudo);
		?>

		</form>
</body>
</html>