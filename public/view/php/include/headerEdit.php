<table class="tableheader" cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td style="padding-left: 5px;">Editar <?php echo $beanPaginaAtual->getnome(); ?></td>
	<?php
		if ($novo == true) {
			?>
		<td align="Right" style="padding-right: 5px; font-size: 12pt;">
			Criar novo 
			<?php
			echo $button->btNovoImagem ( $idurl );
			?>
		</td>
		<?php
		}
		?>
	</tr>	
	<tr>
		<td>&nbsp;</td>
		<td align="Right" class="info"><img id="btn_log" name="btn_log"
			src="<?php echo URLAPPVER;?>/public/view/images/icon-info.png">&nbsp;</td>
	</tr>
</table>

<div id="log" name="log" style="display: none;">
	<TABLE style="border: 1px solid black; background-color: #aaaaaa">
		<TR>
			<TD>Criador</TD>
			<TD><?php echo $bean->getcriador();?></TD>
		</TR>
		<TR>
			<TD>Data Criação</TD>
			<TD><?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtcriacao());?></TD>
		</TR>
		<TR>
			<TD>Modificador</TD>
			<TD><?php echo $bean->getmodificador();?></TD>
		</TR>
		<TR>
			<TD>Data Modificação</TD>
			<TD><?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtmodificacao());?></TD>
		</TR>
		<TR>
			<TD>Id</TD>
			<TD><?php echo Util::getIdObjeto($bean);?></TD>
		</TR>
		<script>
$(document).ready(function() {
	$("#dtinicio").mask("99/99/9999 99:99:99");
	$("#dtvalidade").mask("99/99/9999 99:99:99");
	  
});
</script>
		<TR>
			<TD>Data Inicio</TD>
			<TD><INPUT id="dtinicio" name="dtinicio" type="text"
				value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtinicio());?>"></TD>
		</TR>
		<TR>
			<TD>Data Validade</TD>
			<TD><INPUT id="dtvalidade" name="dtvalidade" type="text"
				value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtvalidade());?>"></TD>
		</TR>
	</TABLE>
</div>