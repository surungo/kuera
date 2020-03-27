<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Codigo</TD>
		<TD><INPUT id="codigo" name="codigo" size="30" type="text"
			value="<?php echo $bean->getcodigo();?>"></TD>
	</TR>
	<TR>
		<TD>Valor</TD>
		<TD><TEXTAREA id="valor" name="valor" cols="60" rows="8"><?php echo $bean->getvalor();?></TEXTAREA>
		</TD>
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
