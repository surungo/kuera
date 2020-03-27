<h3>Editar Item Perfil</h3>
<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD>
			<?php echo $bean->getperfil()->getnome();?></TD>
	</TR>
	<TR>
		<TD valign="top">Paginas</TD>
		<TD>
		 		<?php
					$cltPaginaSelecionadas = $bean->getpagina ();
					$selecionado = "";
					for($i = 0; $i < count ( $cltPagina ); $i ++) {
						$pagina = $cltPagina [$i];
						for($o = 0; $o < count ( $cltPaginaSelecionadas ); $o ++) {
							$selecionado = "";
							if ($cltPaginaSelecionadas [$o]->getId () == $pagina->getid ()) {
								$selecionado = "checked='checked'";
								break;
							}
						}
						?>
						<input type="checkbox" id="idpagina" name="idpagina[]"
			<?php echo $selecionado;?> value="<?php echo $pagina->getid();?>">
						<?php echo $pagina->getid();?>"	>-
						<?php echo $pagina->getnome();?><br>
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