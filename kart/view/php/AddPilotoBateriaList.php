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
					
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$selcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
	<tr>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
			<select id="etapa" name="etapa" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
				  <?php
						echo count ( $seletapaCollection );
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$seletapabean = $seletapaCollection [$i];
							?>
				    <option value="<?php echo $seletapabean->getid();?>"
					<?php echo ($seletapabean->getid()==$seletapa)?"selected":"";?>><?php echo $seletapabean->getnome();?></option>
				  <?php
						}
						?>
			</select>
		</td>
	</tr>
</table>
<?php if($seletapa>0 && count($selbateriaCollection) >0){?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
	if ($editar == true) {
		?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
	}
	?>    
		<th class="header">Piloto Nome</th>
			<th class="header">Piloto Apelido</th>
			<th class="header">Campeonato</th>
		</tr>
	</thead>
	<tbody>
<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			for($s = 0; $s < count ( $selbateriaCollection ); $s ++) {
				$bateriaBean = $selbateriaCollection [$s];
				?>
			<input type="button" value="<?php echo $bateriaBean->getnome();?>" /><br>
		<?php
			}
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getpiloto()->getnome();?>
    	</td>
			<td>
			<?php echo $collection[$i]->getpiloto()->getapelido();?>
    	</td>
			<td>
			<?php
		
echo $collection [$i]->getcampeonato ()->getnome ();
		?>
		</td>
		</tr>
<?php }?>
  </tbody>
</table>
<?php }?>
