

<div id="pilotobateria" style="float: left; width: <?php echo $divLargura;?>;"> 
Piloto da bateria <?php echo $seletapabean->getsigla()." - ".Util::getNomeObjeto($selbateriabean)."[".$selbateriabean->getdtbateria()."]";?>

<?php if($umpresente < 1){?>
<div class="options1">
	Processos:<?php echo $button->btCustom($idurl,$idobj,"Remover todos",$target,Choice::EXCLUIR_TODOS);?>
</div>
<?php }?>

	<table class="listTable" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr>
				<th class="headerlink">&nbsp;</th> 
				<th class="header">Pré Grid</th>
				<th class="header">Grid</th>
				<th class="header">NR</th>
				<th class="header">Piloto</th>
				<th class="header">Peso</th>
				<th class="header">Peso externo</th>
		 		<th class="header">Presença</th>
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
			if ($editar == true && $umpresente < 1 ) {
				?> 
			
				<?php
				echo $button->btExcluirImagem ( $idpilotobateria, $idurl );
				?>
			    
			<?php
			}
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
            			echo $button->atributos ( $idurl, $idobj, $action, $target, Choice::ATUALIZAR );
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
		          }  ?>
				
			</td>
			<td> 
				<?php echo $pilotoBeanList->getnrpiloto(); ?>
			</td>
			<td> 
				<?php echo $pilotoBeanList->getapelido (); ?>
			</td>
			<td>
				<?php echo  $pilotoBeanList->getpeso();?>
			</td>
			<td>
				<?php echo  $pilotoBeanList->getpeso();?>
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
		</tr>
		<?php
		}
	}
	?>
  </tbody>
	</table>
</div>