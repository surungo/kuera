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
		<TD>Usuario</TD>
		<TD><INPUT id="usuario" name="usuario" size="30" type="text"
			value="<?php echo $bean->getusuario();?>"></TD>
	</TR>
	<TR>
		<TD>E-mail</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $bean->getemail();?>"></TD>
	</TR>
	<TR>
		<TD>Perfil Pagina</TD>
		<TD><select class="css_select" id="perfil" name="perfil"
			style="width: 505px;">
				<option></option>
		<?php
		for($i = 0; $i < count ( $perfilCollection ); $i ++) {
			?>
    		<option value="<?php echo $perfilCollection[$i]->getid();?>"
					<?php echo ($perfilCollection[$i]->getid() == $bean->getperfil() )?'selected="selected"':'';?>>
			
	    	<?php echo  $perfilCollection[$i]->getnome();?>
				</option>
	    	<?php }?>
			</select></TD>
	</TR>		
		<?php
		if ($senha) {
			?>
		<TR>
		<TD>Senha</TD>
		<TD><INPUT id="senha" name="senha" size="30" type="text" value=""></TD>
	</TR>
		<?php
		}
		?>
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