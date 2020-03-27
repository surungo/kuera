<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>

Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="0">Todos</option>
	
  <?php
		for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
			$icampeonatobean = $cltCampeonatoCollection [$i];
			?>
    <option value="<?php echo $icampeonatobean->getid();?>"
		<?php echo ($icampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $icampeonatobean->getnome();?></option>
  <?php
		}
  ?>
</select>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    <?php
				if ($editar == true) {
					?> 
      <th class="headerlink">&nbsp;</th> 
		<?php
				}
				?> 
    		<th class="header">CPF</th>
			<th class="header">Nome</th>
			<th class="header">Categoria - Grupo</th>
		</tr>
	</thead>

	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$candidatoBeanItem = new CandidatoBean();
		$candidatoBeanItem = $collection [$i];
		$pessoaBeanItem = new PessoaBean();
		$pessoaBeanItem = $candidatoBeanItem->getpessoa();
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $candidatoBeanItem->getid (), $idurl );
			echo $button->btExcluirImagem ( $candidatoBeanItem->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td><nobr><?php echo $pessoaBeanItem->getcpf();?></nobr></td>
			<td>
			<?php echo $pessoaBeanItem->getnome();?>
		</td>
		<td>
			<?php 
			if($selcampeonato>0){
				$cltCategoriasGruposSel = $candidatoCategoriaGrupoBusiness->findByCandidatoEvento($candidatoBeanItem,$selcampeonato);
			}else{
				$cltCategoriasGruposSel = $candidatoCategoriaGrupoBusiness->findByCandidato($candidatoBeanItem);
			}

			for($o = 0; $o < count ( $cltCategoriasGruposSel ); $o ++) {
				$categoriagrupobean = $cltCategoriasGruposSel[$o]->getcategoriagrupo();
				echo Util::getNomeObjeto($categoriagrupobean->getcategoria());?>&nbsp;-&nbsp;
				<?php echo Util::getNomeObjeto($categoriagrupobean->getgrupo());?><br><?php 
			}?>
				
		</td>
			</tr>
	<?php }?>
  </tbody>
</table>
