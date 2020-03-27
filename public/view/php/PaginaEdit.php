<?php
include "include/headerEdit.php";
?>
<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>URL</TD>
		<TD><INPUT id="url" name="url" size="30" type="text"
			value="<?php echo $bean->geturl();?>"></TD>
	</TR>
	<TR>
		<TD>Target <?php echo $bean->gettarget() ;?></TD>
		<TD><select class="css_select" id="idtarget" name="idtarget"
			style="width: 505px;">
				<option value="<?php echo Target::GERENCIADOR;?>"
					<?php echo ($bean->gettarget() == Target::GERENCIADOR || $bean->gettarget() == "")?'selected="selected"':'';?>>
					Gerenciador</option>
				<option value="<?php echo Target::TELACHEIA;?>"
					<?php echo ($bean->gettarget() == Target::TELACHEIA )?'selected="selected"':'';?>>
					Tela Cheia</option>
				<option value="<?php echo Target::POPUP;?>"
					<?php echo ($bean->gettarget() == Target::POPUP)?'selected="selected"':'';?>>
					Pop-Up</option>
				<option value="<?php echo Target::SERVICES;?>"
					<?php echo ($bean->gettarget() == Target::SERVICES)?'selected="selected"':'';?>>
					Services</option>
				<option value="<?php echo Target::PDFRELATORIO;?>"
					<?php echo ($bean->gettarget() == Target::PDFRELATORIO)?'selected="selected"':'';?>>
					RelatorioPDF</option>
					
				<option value="<?php echo Target::EXTERNO;?>"
					<?php echo ($bean->gettarget() == Target::EXTERNO)?'selected="selected"':'';?>>
					Site Externo</option>
		</select></TD>
	</TR>
	<TR>
		<TD>Hierarquia</TD>
		<TD><select class="css_select" id="hierarquia" name="hierarquia"
			style="width: 505px;">
				<option></option>
		<?php
		for($i = 0; $i < count ( $cltPagina ); $i ++) {
			if ($cltPagina [$i]->getid () != $bean->getid ()) {
				?>
    		<option value="<?php echo $cltPagina[$i]->getid();?>"
					<?php echo ($cltPagina[$i]->getid() == $bean->gethierarquia() )?'selected="selected"':'';?>>
			
	    	<?php echo  $cltPagina[$i]->getnome();?>
				</option>
	    	<?php
			}
		}
		?>
			</select></TD>
	</TR>
	<TR>
		<TD>Visivel</TD>
		<TD><select class="css_select" id="visivel" name="visivel">
				<option value="S"
					<?php echo ($bean->getvisivel()=="S")?"selected=selected":""; ?>>SIM</option>
				<option value="N"
					<?php echo ($bean->getvisivel()!="S")?"selected=selected":""; ?>>NÃO</option>
		</select></TD>
	</TR>
	<TR>
		<TD>Ativo</TD>
		<TD><select class="css_select" id="ativo" name="ativo">
				<option value="S"
					<?php echo ($bean->getativo()=="S")?"selected=selected":""; ?>>SIM</option>
				<option value="N"
					<?php echo ($bean->getativo()!="S")?"selected=selected":""; ?>>NÃO</option>
		</select></TD>
	</TR>
	<TR>
		<TD>Sistema</TD>
		<TD><select class="css_select" id="sistema" name="sistema"
			style="width: 505px;">
				<option></option>
		<?php
		for($i = 0; $i < count ( $cltSistema ); $i ++) {
			?>
    		<option value="<?php echo $cltSistema[$i]->getid();?>"
					<?php echo ($cltSistema[$i]->getid() == $bean->getsistema() )?'selected="selected"':'';?>>
			
	    	<?php echo  $cltSistema[$i]->getnome();?>
				</option>
	    	<?php }?>
			</select></TD>
	</TR>
	<TR>
		<TD>Ordem</TD>
		<TD><INPUT id="ordem" name="ordem" size="30" type="text"
			value="<?php echo $bean->getordem();?>"></TD>
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