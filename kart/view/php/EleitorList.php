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
		$eleitorBeanItem = new EleitorBean();
		$eleitorBeanItem = $collection [$i];
		$painelBeanItem = new PessoaBean();
		$painelBeanItem = $eleitorBeanItem->getpessoa();
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $eleitorBeanItem->getid (), $idurl );
			echo $button->btExcluirImagem ( $eleitorBeanItem->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td><nobr><?php echo $painelBeanItem->getcpf();?></nobr></td>
			<td>
			<?php echo $painelBeanItem->getnome();?>
		</td>
		<td>
			<?php 
			if($selcampeonato>0){
				$cltCategoriasGruposSel = $eleitorCategoriaGrupoBusiness->findByEleitorEvento($eleitorBeanItem,$selcampeonato);
			}else{
				$cltCategoriasGruposSel = $eleitorCategoriaGrupoBusiness->findByEleitor($eleitorBeanItem);
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
