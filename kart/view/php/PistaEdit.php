<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Local</TD>
		<TD><INPUT id="local" name="local" size="30" type="text"
			value="<?php echo $bean->getlocal();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Sentido</TD>
		<TD><INPUT id="sentido" name="sentido" size="30" type="text"
			value="<?php echo $bean->getsentido();?>"></TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>
	<TR>
		<TD colspan="2">
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>
