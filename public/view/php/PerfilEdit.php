<?php
require_once (PATHPUBBEAN . '/PaginaBean.php');
include "include/headerEdit.php";
?>
<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
		<?php if(0 < count($cltPaginaSelecionar)){?>
		<TR>
		<TD>Capa</TD>
		<TD><select class="css_select" id="idpaginaCapa" name="idpaginaCapa">
								
					<?php
			for($i = 0; $i < count ( $cltPaginaSelecionar ); $i ++) {
				$beanPaginaSelectPerfil = new PaginaBean ();
				$beanPaginaSelectPerfil = $cltPaginaSelecionar [$i];
				if ($beanPaginaSelectPerfil->geturl () != null) {
					?>
			    		<option value="<?php echo $beanPaginaSelectPerfil->getid();?>"
					<?php echo ($bean->getpaginacapa()==$beanPaginaSelectPerfil->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPaginaSelectPerfil->getnome();?>
						</option>
				<?php
				}
			}
			?>
				</select></TD>
	</TR>
		<?php }else{?>
			<INPUT id="idpaginaCapa" name="idpaginaCapa" type="hidden" value="1">
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
