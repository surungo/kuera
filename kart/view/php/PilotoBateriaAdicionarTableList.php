

<div id="pilotobateria" style="float: left; width: <?php echo $divLargura;?>;"> 
Piloto da bateria <?php echo $seletapabean->getsigla()." - ".Util::getNomeObjeto($selbateriabean)."[".$selbateriabean->getdtbateria()."]";?>
<div class="options1">Filtros:</div>
<div class="options1">
	Processos:<?php echo $button->btCustom($idurl,$idobj,"Remover todos",$target,Choice::EXCLUIR_TODOS);?>
</div>

	<table class="listTable" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr><?php
	if ($editar == true) {
		?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
	}
	$foto = false;
	if ($foto){
	?>    
		 <th class="header">&nbsp;</th>
	<?php } ?>	 
				<th class="header">Pos</th>
				<th class="header">NR</th>
				<th class="header">Piloto</th>
				<th class="header">Ch</th>
				
		 <?php if($seletapa==null || $seletapa==0){?> 
		 <th class="header">Etapa</th>
		 <?php } if($selbateria==null || $selbateria==0){?>
		 <th class="header">Bateria</th>
		 <?php }?>
		</tr>
		</thead>
		<tbody>
	<?php
	$dbg=0;	
	$countcolletion = count ( $collection );
	for($i = 0; $i < count ( $collection ); $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
		$idpilotobateria = $pilotoBateriaBeanList->getid ();
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
		

		Util::echobr ( $dbg, 'PilotoBateriaAdicionarList  Util::getIdObjeto($pilotoBeanList)', Util::getIdObjeto ( $pilotoBeanList ) );

		if (Util::getIdObjeto ( $pilotoBeanList ) > 0) {
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
				echo $button->btExcluirImagem ( $idpilotobateria, $idurl );
				?>
			</td>     
			<?php
			}
			if ($foto){
			?>
			<td><img border="0" width="60"
					src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>"></td>
			<?php } ?>
			<td>
				<?php
				$idpregridlargada = gettype ( $pilotoBateriaBeanList->getpregridlargada () ) == "object" ? $pilotoBateriaBeanList->getpregridlargada ()->getid () : $pilotoBateriaBeanList->getpregridlargada ();
				echo "<span style='display:none;'>".Util::lpad( $idpregridlargada , 3 , "0")."</span>";
        		?>
			
				<select id="pregridlargada_<?php echo $idpilotobateria;?>" name="pregridlargada_<?php echo $idpilotobateria;?>"
					class="btn_select"
        			<?php
        			echo $button->atributos ( $idurl, $idobj, $action, $target, Choice::ATUALIZAR );
        			?>>
					<?php
					for($posidpregridlargada = 1; $posidpregridlargada <= $countcolletion; $posidpregridlargada ++) {
				    ?>
			    	<option value="<?php echo $posidpregridlargada;?>"
			    	<?php echo ($idpregridlargada==$posidpregridlargada)?"selected='selected'":""; ?>>
							<?php echo  $posidpregridlargada;?>
						</option>
				<?php
					}
					?>
				</select>
				
				
				
			</td>
			<td> 
				<?php echo $pilotoBeanList->getnrpiloto(); ?>
			</td>
			<td> 
				<?php echo $pilotoBeanList->getapelido (); ?>
			</td>
			<td>
				<?php echo  Util::getNomeObjeto($pilotoBateriaBeanList->getposicao());?>
			</td>
			
		    <?php if($seletapa==null || $seletapa==0){?>
			<td align="center"> 
		      <?php
				echo $etapaBeanList->getsigla ();
				?>
		    </td>
		    <?php } if($selbateria==null || $selbateria==0){?>
			<td align="center">
		      <?php
				echo $bateriaBeanList->getsigla ();
				?>
		    </td>
		    <?php }?>
		</tr>
		<?php
		}
	}
	?>
  </tbody>
	</table>
</div>