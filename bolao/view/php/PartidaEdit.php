<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
    $(document).ready(function() {
      $("#dtpartida").mask("99/99/9999 99:99:99");
      
    });
</script>

<TABLE>
	<?php if($idobj>0){ ?>
	<TR>
		<TD>Data</TD>
		<TD><INPUT id="dtpartida" name="dtpartida" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtpartida());?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Placar1</TD>
		<TD><INPUT id="placar1" name="placar1" size="30" type="text"
			value="<?php echo $bean->getplacar1();?>"></TD>
	</TR>
	<TR>
		<TD>Placar2</TD>
		<TD><INPUT id="placar2" name="placar2" size="30" type="text"
			value="<?php echo $bean->getplacar2();?>"></TD>
	</TR>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $bean->getpeso();?>"></TD>
	</TR>
	<?php } ?>
	<TR>
		<TD>Peso</TD>
		<TD>
			<textarea id="texto" name="texto" rows="30" cols="80" style="font-size: 7pt;"><?php echo $bean->gettexto();?></textarea>
		</TD>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>

	<TR>
		<TD>
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
		<TD></TD>
	</TR>
</TABLE>
