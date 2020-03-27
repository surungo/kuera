<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD><select id="campeonato" name="campeonato" 
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$campeonatobean = $cltCampeonatoCollection [$i];
						?>
			    <option value="<?php echo $campeonatobean->getid();?>"
					<?php echo ($campeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $campeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></TD>
	</TR>
	<TR>
		<TD>Sigla</TD>
		<TD><INPUT id="sigla" name="sigla" size="30" type="text"
			value="<?php echo $bean->getsigla();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<?php 
		if( $bean->getid() > 0){
	?>
	<TR><TD colspan="2">Categorias</TD></TR>
	<?php 
		$selecionado = "";
		for($i = 0; $i < count ( $cltCategoriasCollection ); $i ++) {
			$categoriabean = $cltCategoriasCollection [$i];	
			for($o = 0; $o < count ( $cltCategoriasSelecionadas ); $o ++) {
				$selecionado = "";
				if ($cltCategoriasSelecionadas[$o]->getcategoria()->getId () == $categoriabean->getid ()) {
					$selecionado = "checked='checked'";
					break;
				}
			}?>
	<TR>
		<TD colspan="2">
		    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="idcategoria" name="idcategoria[]"
		     
		     value="<?php echo $categoriabean->getid();?>"
			<?php echo $selecionado;?>>&nbsp;<?php echo $categoriabean->getnome();?>
		</TD>
	</TR>
		  <?php
		}
	 }?>
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
