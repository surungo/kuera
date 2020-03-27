<?php
include "include/headerEdit.php";

?>
<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD>
			<?php echo Util::getNomeObjeto($perfilBean);?>
		</TD>
	</TR>
	<TR>
		<TD valign="top">Itens</TD>
		<TD>
 		<?php
			for($i = 0; $i < count ( $selItemClt ); $i ++) {
				$itemBean = $selItemClt [$i];
				$selecionado = $itemPerfilBusiness->isItemPerfil($perfilBean,$itemBean)?"checked='checked'":"";
				?>
				<input type="checkbox" id="idItem" name="idItem[]"
				<?php echo $selecionado;?> value="<?php echo $itemBean->getid();?>">
				<?php echo $itemBean->getid();?> >-
				<?php echo $itemBean->getnome();?><br>
		<?php
			}
					?>
			</TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>

	<TR>
		<TD colspan="2">
				<?php echo $button->btSEV3($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>