<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
$pilotoBateriaBean = $pilotoBateriaBusiness->findById($bean->getpilotobateria());
?>
<TABLE>
	
	<TR>
		<TD>Piloto</TD>
		<TD><?php echo $pilotoBateriaBean->getpiloto()->getapelido();?>
		</TD>
	</TR>
	<TR>
		<TD>Pontos</TD>
		<TD><INPUT id="pontos" name="pontos" size="30" type="text"
			value="<?php echo $bean->getpontos();?>"></TD>
	</TR>
	<TR>
		<TD>Mehor Pessoal</TD>
		<TD><INPUT id="melhoressoal" name="melhoressoal" size="30" type="text"
			value="<?php echo $bean->getmelhorpessoal();?>"></TD>
	</TR>
	<TR>
		<TD>Dono da Volta</TD>
		<TD><INPUT id="donovolta" name="donovolta" size="30" type="text"
			value="<?php echo $bean->getdonovolta();?>"></TD>
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
		<TD></TD>
	</TR>
</TABLE>
