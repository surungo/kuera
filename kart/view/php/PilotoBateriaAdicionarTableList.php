<?php $mostrarCPF=false;?>

<div id="pilotobateria" style="float: left; width: <?php echo $divLargura;?>;"> 
<?php /*
Piloto da bateria <?php echo $seletapabean->getsigla()." - ".Util::getNomeObjeto($selbateriabean)."[".$selbateriabean->getdtbateria()."]";?>
*/?>

	<table class="listTable_pilotoBateria" id="tb001" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr>
				<th class="headerlink">&nbsp;</th>
				<th class="header">Pré Grid</th>
				<th class="header">Grid</th>
				<th class="header">Piloto</th>
				<th class="header">Peso</th>
				<th class="header">Peso externo</th>
		 		<th class="header">Presença</th>
		 		<th class="header">Posicao Kart</th>
		 		<th class="header">Numero kart</th>
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
			<td>
				<?php
				echo $button->btExcluirImagem ( $idpilotobateria, $idurl );
				?>
			    
			</td>
            <td>
				<?php
				$displaypre = ( ($umpresente < 1)?"none":"block" );
					$idpregridlargada = gettype ( $pilotoBateriaBeanList->getpregridlargada () ) == "object" ? $pilotoBateriaBeanList->getpregridlargada ()->getid () : $pilotoBateriaBeanList->getpregridlargada ();
					echo "<span style='display:".$displaypre.";'>".Util::lpad( $idpregridlargada , 3 , "0")."</span>";
    				
    				if($umpresente < 1){
            		?>
    			
    				<select id="pregridlargada_<?php echo $idpilotobateria;?>" name="pregridlargada_<?php echo $idpilotobateria;?>"
    					class="btn_select"
            			<?php
            			echo $button->atributos ( $idurl, $idobj, $action, $target, Choice::AJUSTAPREGRID );
            			?>>
    					<?php
    					for($posidpregridlargada = 1; $posidpregridlargada <= $countcolletion; $posidpregridlargada ++) {
    				    ?>
    			    	<option value="<?php echo $posidpregridlargada;?>"
    			    	<?php echo ($idpregridlargada==$posidpregridlargada)?"selected='selected'":""; ?>>
    							<?php echo  Util::lpad( $posidpregridlargada , 3 , "0") ;?>
    						</option>
    				<?php
    					}
    					?>
    				</select>
    				<?php }?>
    		</td>
    		<td>
				<?php
				
    			 if ($pilotoBateriaBeanList->getpresente () == 'S') {
    			     $idgridlargada = gettype ( $pilotoBateriaBeanList->getgridlargada () ) == "object" ? $pilotoBateriaBeanList->getgridlargada ()->getid () : $pilotoBateriaBeanList->getgridlargada ();
    			     echo  Util::lpad( $idgridlargada , 3 , "0");
		          } else {
		          	
		          	echo "<span style='display:none;'>9".Util::lpad( $idpregridlargada , 3 , "0")."</span>";
				}?>
				
			</td>
			<td> 
				<?php echo $pilotoBeanList->getapelido (); ?>
			</td>
			<td>
				<span id="span_peso_<?php echo $idpilotobateria;?>">
					<?php echo "<span style='display:none;'>".Util::lpad( $pilotoBateriaBeanList->getpeso() , 10 , "0")."</span>"; ?>
					<input id="peso_<?php echo $idpilotobateria;?>" name="peso_<?php echo $idpilotobateria;?>"
					 type="text" class="btn_change"
					 <?php echo $button->atributos( $idurl, $idpilotobateria, Choice::ATUALIZAR_PESO, $target, Choice::ATUALIZAR_PESO );?>
					size="1"
					value="<?php echo  $pilotoBateriaBeanList->getpeso();?>"/>
					<img id="timer_peso_<?php echo $idpilotobateria;?>" style="display: none;" src='<?php echo URLAPPVER;?>/public/view/images/5sec.gif?peso<?php echo $idpilotobateria;?>' />
					
				</span>
			</td>
			<td>
				<?php echo "<span style='display:none;'>".Util::lpad( $pilotoBateriaBeanList->getpeso() , 10 , "0")."</span>"; ?>	
				<span id="span_pesoextra_<?php echo $idpilotobateria;?>">
					<input id="pesoextra_<?php echo $idpilotobateria;?>" name="pesoextra_<?php echo $idpilotobateria;?>"
					 type="text" class="btn_change"
					 <?php echo $button->atributos( $idurl, $idpilotobateria, Choice::ATUALIZAR_PESOEXTRA, $target, Choice::ATUALIZAR_PESOEXTRA );?>
					size="1"
					value="<?php echo  $pilotoBateriaBeanList->getpesoextra();?>"/>
					<img id="timer_pesoextra_<?php echo $idpilotobateria;?>" style="display: none;" src='<?php echo URLAPPVER;?>/public/view/images/5sec.gif?pesoextra<?php echo $idpilotobateria;?>' />
				</span>
			</td>
		    <td>
				<?php
				
				if ($pilotoBateriaBeanList->getpresente () == null || $pilotoBateriaBeanList->getpresente () == 'N') {
				    echo $button->btPresente($pilotoBateriaBeanList->getid (), $idurl );
				}else{
				    echo $button->btAusente($pilotoBateriaBeanList->getid (), $idurl );
				}
								
				?>
				
			</td>
			<td>
			<?php
				$posicaokart = $pilotoBateriaBeanList->getposicaokart();
				if($posicaokart > 0){
					$displayposkart = "block";
				}else{
					$displayposkart = "none";
					$posicaokart = 999;
				}
				echo "<span style='display:".$displayposkart.";'>".Util::lpad( $posicaokart , 3 , "0")."</span>";
			?>
    		</td>
    		<td>
				<span id="span_kart_<?php echo $idpilotobateria;?>">
					<?php 
						$kart = $pilotoBateriaBeanList->getkart();
						$kartordem = ($kart > 0)?Util::lpad( $kart , 3 , "0"):"9999";
						$kart = ($kart > 0)?Util::lpad( $kart , 3 , "0"):"";
						echo "<span style='display:none;'>".Util::lpad( $kartordem, 4 , "0")."</span>"; 
					?>
					<input id="kart_<?php echo $idpilotobateria;?>" name="kart_<?php echo $idpilotobateria;?>"
					 type="text" class="btn_change"
					 <?php echo $button->atributos( $idurl, $idpilotobateria, Choice::ATUALIZAR_KART, $target, Choice::ATUALIZAR_KART );?>
					size="1"
					value="<?php echo  $kart;?>"/>
					<img id="timer_kart_<?php echo $idpilotobateria;?>" style="display: none;" 
					src='<?php echo URLAPPVER;?>/public/view/images/5sec.gif?peso<?php echo $idpilotobateria;?>' />
					
				</span>
    		</td>  
		</tr>
		<?php
		}
	}
	?>
  </tbody>
	</table>
		<script>
	$(document).ready(function() {
		tablePB = $('.listTable_pilotoBateria').DataTable(tableOptions); 
		tablePB.destroy();
        tableOptions.bPaginate = false;
        tablePB = $('.listTable_pilotoBateria').DataTable(tableOptions);  
		
		
		<?php
		$arrayColunas = array(
			"edit"=>"0",
			"pregrid"=>"1",
			"grid"=>"2",
			"nome"=>"3",
			"peso"=>"4",
			"pesoextra"=>"5",
			"presenca"=>"6",
			"poskart"=>"7",
			"nrkart"=>"8");
		$arrayMostrarColunas = $arrayColunas;
		
		
		if ($editar == true && $umpresente < 1 ) {
			$arrayOcultarColunas = array(
					$arrayColunas["grid"],
					$arrayColunas["peso"],
					$arrayColunas["pesoextra"],
					$arrayColunas["poskart"],
					$arrayColunas["nrkart"]
				);
			$arrayMostrarColunas = array_diff($arrayColunas, $arrayOcultarColunas) ; 
			
		}else{
			$arrayOcultarColunas = array(
					$arrayColunas["edit"],
					$arrayColunas["pregrid"],
					$arrayColunas["peso"],
					$arrayColunas["pesoextra"]
					//,
					//$arrayColunas["poskart"],
					//$arrayColunas["nrkart"]
					
			);
			$arrayMostrarColunas = array_diff($arrayColunas, $arrayOcultarColunas) ;
		}	
		
		
		$arrayPresenca = array(
				$arrayColunas["presenca"]
		);
		//  CHAMADA
		if($consulta_adicao==Choice::PBA_CHAMADA){
			$arrayOcultarColunas = array_diff($arrayOcultarColunas,  $arrayPresenca) ;
			$arrayMostrarColunas = array_merge($arrayMostrarColunas, $arrayPresenca) ;
		}else{
			$arrayOcultarColunas = array_merge($arrayOcultarColunas,$arrayPresenca)	;
			$arrayMostrarColunas = array_diff($arrayMostrarColunas,	$arrayPresenca) ;
			
		}
		
		// AJUSTE DE PESOS
		$arrayPesos = array(
				$arrayColunas["peso"],
				$arrayColunas["pesoextra"]
			);
		if($consulta_adicao==Choice::PBA_AJUSTEDEPESOS){
			$arrayOcultarColunas = array_diff($arrayOcultarColunas,  $arrayPesos) ;
			$arrayMostrarColunas = array_merge($arrayMostrarColunas, $arrayPesos) ; 
		}else{
			$arrayOcultarColunas = array_merge($arrayOcultarColunas,$arrayPesos) ;
			$arrayMostrarColunas = array_diff($arrayMostrarColunas,	$arrayPesos) ;
			
		}
		
		// AJUSTE DE KART
		/*
		$arrayKart = array(
		$arrayColunas["poskart"],
		$arrayColunas["nrkart"]
		);
		if($consulta_adicao==Choice::PBA_AJUSTEDEKART){
			$arrayOcultarColunas = array_diff($arrayOcultarColunas,  $arrayKart)	;
			$arrayMostrarColunas = array_merge($arrayMostrarColunas, $arrayKart) ;
		}else{
			$arrayOcultarColunas = array_merge($arrayOcultarColunas,$arrayKart)	;
			$arrayMostrarColunas = array_diff($arrayMostrarColunas,	$arrayKart) ;
			
		}
		*/
			
		
		
		?> 
		tablePB.columns( [<?php echo implode(",",$arrayMostrarColunas);?>] ).visible( true );
		tablePB.columns( [<?php echo implode(",",$arrayOcultarColunas);?>] ).visible( false );
		
		
		//tableGlobal.page.len( -1 ).draw();
		//var oSettings = tableGlobal.settings;
        //oSettings.bPaginate  = false;
        //tableGlobal.settings.bPaginate  = false;
       
	       
		tablePB.columns.adjust().draw();
		$("#subMenu").hide();
	});
	</script>
	
</div>