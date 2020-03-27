<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
		$(document).ready(function() {
			  $('#cpf').mask('999.999.999-99');
		});
	</script>

<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="text"
			value="<?php echo $bean->getcpf();?>"></TD>
	</TR>
	<TR>
		<TD>Grupos/Categoria/Tipo</TD>
			<?php 
			$selecionadoGrupo = "";
			$selecionadoCategoria = "";
			$selecionadoTipo = "";
			for($i = 0; $i < count ( $cltCategoriasCollection ); $i ++) {
				$categoriabean = $cltCategoriasCollection [$i];	
				for($o = 0; $o < count ( $cltCategoriasSelecionadas ); $o ++) {
					$selecionadoGrupo = "";
					if ($cltCategoriasSelecionadas[$o]->getcategoria()->getId () == $categoriabean->getid ()) {
						$selecionadoGrupo = "checked='checked'";
						break;
					}
				}?>
			<TD>
			&nbsp;&nbsp;<input type="checkbox" id="idgrupo" name="idgrupo[]"
		     value="<?php echo $categoriabean->getid();?>"
			<?php echo $selecionadoGrupo;?>>&nbsp;<?php echo $categoriabean->getnome();?>
			
			&nbsp;&nbsp;<input type="checkbox" id="idcategoria" name="idcategoria[]"
		     value="<?php echo $categoriabean->getid();?>"
			<?php echo $selecionado;?>>&nbsp;<?php echo $categoriabean->getnome();?>
			
			&nbsp;&nbsp;<input type="checkbox" id="idtipo" name="idtipo[]"
		     value="<?php echo $categoriabean->getid();?>"
			<?php echo $selecionado;?>>&nbsp;<?php echo $categoriabean->getnome();?>
			</TD>
			<?php }?>
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
