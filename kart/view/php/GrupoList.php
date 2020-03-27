<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<table border="0">
	<tr>
		<td>Campeonato:</td>
		<td><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$selcampeonatobean = $cltCampeonatoCollection [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
</table>
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
	  <th class="header">Sigla</th>
			<th class="header">Nome</th>
			<th class="header">Categoria</th>
			<th class="header">Campeonato</th>
			<th class="header">&nbsp;</th>
		</tr>
	</thead>

	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$grupoBean = new GrupoBean();
		$campeonato = new CampeonatoBean();
		
		$grupoBean = $collection[$i];
		$campeonato = $grupoBean->getCampeonato();
			
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $grupoBean->getid (), $idurl );
			echo $button->btExcluirImagem ($grupoBean->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $grupoBean->getsigla();?>
    	</td>
		<td>
			<?php echo $grupoBean->getnome();?>
		</td>
		<td>
			<?php 
				$cltCategoriaGrupo = $categoriaGrupoBusiness->findByGrupo($grupoBean->getid ());
				for($iccg = 0; $iccg < count ( $cltCategoriaGrupo ); $iccg ++) {
					$categoriaGrupoBean = new CategoriaGrupoBean();	
					$categoriaGrupoBean = $cltCategoriaGrupo[$iccg];
					$categoriaBean = new CategoriaBean();	
					$categoriaBean = $categoriaGrupoBean->getCategoria();
					echo Util::getNomeObjeto($categoriaBean);
				}
			?>
		</td>
		<td>
			<?php echo Util::getNomeObjeto($campeonato);?>
		</td>
		<td align="Right" class="info">
		<img id="btn_log" name="btn_log"
		title="dtinicio: <?php echo Util::timestamptostr('d/m/Y H:i:s',$grupoBean->getdtinicio());?>
dtvalidade: <?php echo Util::timestamptostr('d/m/Y H:i:s',$grupoBean->getdtvalidade());?>"
			src="mvc/public/view/images/icon-info.png">&nbsp;</td>
		</tr>
	<?php }?>
  </tbody>
</table>
