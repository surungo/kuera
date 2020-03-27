<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<TABLE>
	<TR>
		<TD>id</TD>
		<TD><INPUT id="idView" name="idView" size="30" type="text" readonly="readonly" 
			value="<?php echo $bean->getid();?>">  
		</TD>
	</TR>
	<TR>
		<TD>eleitorcategoriagrupo</TD>
		<TD><INPUT id="eleitorcategoriagrupo" name="eleitorcategoriagrupo" size="30" type="text"
			value="<?php echo $bean->geteleitorcategoriagrupo();?>"></TD>
	</TR>
	<TR>
		<TD>candidatocategoriagrupo</TD>
		<TD><INPUT id="candidatocategoriagrupo" name="candidatocategoriagrupo" size="30"
			type="text"
			value="<?php echo $bean->getcandidatocategoriagrupo();?>">
		</TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>
	<TR>
		<TD colspan="2">
				<?php echo $button->btSEV2($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>
