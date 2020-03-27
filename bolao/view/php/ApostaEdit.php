<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<TABLE>
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
		<TD>Pontos</TD>
		<TD><INPUT id="pontos" name="pontos" size="30" type="text"
			value="<?php echo $bean->getpontos();?>"></TD>
	</TR>
	<TR>
		<TD>Tipo Acerto</TD>
		<TD><INPUT id="tipoacerto" name="tipoacerto" size="30" type="text"
			value="<?php echo $bean->gettipoacerto();?>"></TD>
	</TR>
	<TR>
		<TD>Partida</TD>
		<TD><?php if(count($cltpartidas)>0){?>
	<select id="partida" name="partida">
		<option value=""></option>
	<?php foreach ($cltpartidas as &$partida) {?>
		<option value="<?php echo $partida->getid(); ?>" <?php echo ($slpartida==$partida->getid())?"selected":";"?>
		><?php echo Util::timestamptostr('d/m/Y H:i:s',$partida->getdtpartida());?> - <?php echo $partida->getnome(); ?></option>
	<?php }?></TD>
	</TR>
	
	
	
	</select>
<?php }?>
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
