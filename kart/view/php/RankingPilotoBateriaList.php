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
		 
			<th class="header">N&uacute;mero</th>
			<th class="header">Piloto</th>
			<th class="header">Etapa</th>
			<th class="header">Bateria</th>
			<th class="header">Pontos</th>
			<th class="header">Dono Volta</th>
			<th class="header">Melhor Pessoa</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$dbg = 0;
	Util::echobr ( $dbg, 'RankingPilotoBateriaList count ( $collection ) ', count ( $collection ) );
for($i = 0; $i < count ( $collection ); $i ++) {
		$rankingPilotoBateriaBeanList = $collection [$i];
		Util::echobr ( $dbg, 'RankingPilotoBateriaList $rankingPilotoBateriaBeanList ', $rankingPilotoBateriaBeanList );
		$idrankingPilotoBateria = $rankingPilotoBateriaBeanList->getid();
		$pontos = $rankingPilotoBateriaBeanList->getpontos();	
		$donovolta = $rankingPilotoBateriaBeanList->getdonovolta();	
		$melhorpessoal = $rankingPilotoBateriaBeanList->getmelhorpessoal();	
		$pilotoBateriaBeanList= $rankingPilotoBateriaBeanList ->getpilotobateria();
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
		$pilotoBeanList = $pilotoBusiness->findById($pilotoBeanList );
		$nrpiloto = $pilotoBeanList->getnrpiloto();
		$apelido = $pilotoBeanList->getapelido ();
		$bateriaBeanList = $pilotoBateriaBeanList->getbateria ();
		$bateriasigla = $bateriaBeanList->getsigla();
		$etapaBeanList = $bateriaBeanList->getetapa ();
		$etapasigla = $etapaBeanList->getsigla();
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php echo $button->btEditar ( $idrankingPilotoBateria, $idurl ); ?>
			<?php echo $button->btExcluirImagem ( $idrankingPilotoBateria, $idurl );
			?>
		</td>     
		<?php
		}
		?>
		
		<td>
			<?php echo $nrpiloto;?>
		
		</td>
			<td> 
      			<?php echo $apelido; ?>
    </td>
		<td>
			<?php echo $etapasigla; ?>
		</td>
		<td>
			<?php echo $bateriasigla; ?>
		</td>
		<td>
			<?php echo $pontos; ?>
		</td>
		<td>
			<?php echo $donovolta;  ?>
		</td>
		<td>
			<?php echo $melhorpessoal;  ?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
