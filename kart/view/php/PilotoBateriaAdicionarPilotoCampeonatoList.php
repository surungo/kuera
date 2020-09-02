
<div id="pilotocampeonato" style="float: left; width: <?php echo $divLargura;?>; background-color: silver;">
<?php echo $listaOpcoesMostrar[$consulta_adicao];?><br>
<?php 
Util::echobr ( $dbg , 'PilotoBateriaAdicionarControl cltPilotos', $cltPilotos);
?>
	<table class="listTable" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr><?php
	if ($adicionarPilotoCampeonato == true) {
		?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
	}
	if ($foto){
	?>    
		 <th class="header">&nbsp;</th>
	<?php } ?>
				<th class="header">N&uacute;mero</th>
				<th class="header">Piloto</th>
				<th class="header">Categoria</th>
			</tr>
		</thead>
		<tbody>
	<?php
	
	$imagemADD = URLAPPVER."/public/view/images/add.png";
	for($i = 0; $i < count ( $cltPilotos ); $i ++) {
		$categoria = "";
		$pilotoBateriaBeanList = $cltPilotos[$i];
		Util::echobr ($dbg, 'PilotoBateriaAdicionarControl $cltPilotos[$i]', $cltPilotos[$i]);
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
		Util::echobr ($dbg, 'PilotoBateriaAdicionarControl $pilotoBeanList', $pilotoBeanList);
		$inscritoBean = new InscritoBean();
		$inscritoBusiness = new InscritoBusiness();
		$idpessoa = Util::getIdObjeto($pilotoBeanList->getpessoa());
		Util::echobr ($dbg, 'PilotoBateriaAdicionarControl $idpessoa', $idpessoa);
		
		$containCategoria = false;
		if($idpessoa > 0){
			$inscritoBean->setpessoa($idpessoa);
			Util::echobr($dbg,'PilotoBateriaAdicionarList idpessoa', $idpessoa);
			$inscritoBean = $inscritoBusiness->findByPessoa($idpessoa);
			$dbg=0;
			Util::echobr($dbg,'PilotoBateriaAdicionarList inscritoBean ', $inscritoBean );
			$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
			$catClt = $categoriaInscritoBusiness->findByInscrito($inscritoBean);
			$catCltSize = count ( $catClt );
			
			for($izc = 0; $izc < $catCltSize ; $izc ++) {
				$catInscBean = new CategoriaInscritoBean ();				
				$catInscBean = $catClt[$izc];
				$catBean = $catInscBean->getCategoria();
				$categoria = $categoria . ( ($izc>0)?"<br>":"" ) . Util::getNomeObjeto ( $catBean );
				$idcategoria = Util::getIdObjeto( $catBean );
				$selidcategoria = Util::getIdObjeto( $selbateriabean->getcategoria());
				$dbg = 0;
				Util::echobr ( $dbg, 'PilotoBateriaAdicionarList $selidcategoria ', $selidcategoria );

				if($idcategoria == $selidcategoria)
					$containCategoria=true;
			}	
			if(count($catClt )>1){
				$categoria = "<small>".$categoria."</small>";
			}
				
		}
		
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
			?>
			<tr class="<?php echo $corlinha;?>">
			<?php
			if ($adicionarPilotoCampeonato == true) {
				?> 
			<td>
				<?php
				$imagem = URLAPPVER."/public/view/images/add.png";
				$idobj = Util::getIdObjeto($pilotoBeanList ); 
				$itemFK = $selbateria;
				$w = "20"."px";
				$h = $w;
				$choice = Choice::ADICIONAR;
				$dbg=0;
				Util::echobr($dbg,'PilotoBateriaAdicionarList idobj', $idobj);
				echo $button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);
				?>
			</td>     
			<?php
			}
			if ($foto){
			?>
			<td>
				<img border="0" width="60" src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>">
			</td>
			<?php }?>
			<td>
				<small><?php echo $pilotoBeanList->getnrpiloto();?></small>
			
			</td>
			<td>
				<?php echo $pilotoBeanList->getnome();?>
			
			</td>
			<td> 
			<?php
				if($containCategoria){
					echo $categoria;
				}
			?>
			</td>
		</tr>
		<?php 
			}
		?>
	  </tbody>
	</table>
</div>