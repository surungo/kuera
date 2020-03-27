<?php
include "include/headerEdit.php";
?>
<TABLE>
	<TR>
		<TD>Keysession</TD>
		<TD><INPUT id="nome" name="nome" size="30" readonly="readonly"
			type="text" value="<?php echo $bean->getkeysession();?>"></TD>
	</TR>
	<TR>
		<TD>Ip</TD>
		<TD><INPUT id="ip" name="ip" size="30" type="text"
			value="<?php echo $bean->getip();?>"></TD>
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
