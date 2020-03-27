<?php
$novo = $selbateria > 0;
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
	<tr>
		<td>Bateria:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;"><select
			id="bateria" name="bateria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
					  <?php
							echo count ( $selbateriaCollection );
							for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
								$selbateriabean = $selbateriaCollection [$i];
								?>
					    <option value="<?php echo $selbateriabean->getid();?>"
					<?php echo ($selbateriabean->getid()==$selbateria)?"selected":"";?>><?php echo $selbateriabean->getnome();?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
</table>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?>    
		 <th class="header">&nbsp;</th>
			<th class="header">Nr.</th>
			<th class="header">Piloto</th>
			<th class="header">Etapa</th>
			<th class="header">Bateria</th>
			<th class="header">Pres</th>
			<th class="header">Pena</th>
			<th class="header">Volta</th>
			<th class="header">*Grd(FB)</th>
			<th class="header">*Grd(LG)</th>
			<th class="header">*Chg(VP)</th>
			<th class="header">*Chg(EC)</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
		$pilotoBeanList = new PilotoBateriaBean();
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
		$bateriaBeanList = $pilotoBateriaBeanList->getbateria ();
		$etapaBeanList = $bateriaBeanList->getetapa ();
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $pilotoBateriaBeanList->getid (), $idurl );
			echo $button->btExcluirImagem ( $pilotoBateriaBeanList->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>
		<td><img border="0" width="60"
				src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>"></td>
			<td>
			<?php echo $pilotoBeanList->getnrpiloto();?>
		
		</td>
			<td> 
      <?php
		echo $pilotoBeanList->getapelido ();
		?>
    </td>
		<td>
			<?php echo $etapaBeanList->getnome(); ?>
		</td>
		<td>
			<?php echo $bateriaBeanList->getnome(); ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpresente(); ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpenalizacao() ; ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getvolta() ; ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpregridlargada();  ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getgridlargada();  ?>
		</td>
		<td>
			<?php echo  Util::getNomeObjeto($pilotoBateriaBeanList->getposicao());?>
		</td>
		<td>
			<?php echo  Util::getNomeObjeto($pilotoBateriaBeanList->getposicaooficial());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
*Grid(FB)(LG) - Grid FaceBook / Grid LarGada
<br>
*Chegada(VP)(EC) - Chegada VeloPark / Chegada EngeCar
