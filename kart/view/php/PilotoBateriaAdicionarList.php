<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
if ($selbateria != null && $selbateria!="" && $selbateria>0) {
	echo "<span style='float:right;padding-right: 5px; font-size: 12pt;'>Atualizar resultados ".$button->btEditar ( $selbateria, $idurl )."</span>";
}
?>
<script>
$( document ).ready(function(){
	$("#campeonato").change(function(){
		$("#etapa").hide();	
		$("#bateria").hide();
	});
	$("#etapa").change(function(){
		$("#bateria").hide();
	});
	
}); 
</script>
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
						$listcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $listcampeonatobean->getid();?>"
					<?php echo ($listcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $listcampeonatobean->getnome();?></option>
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
						//echo count ( $seletapaCollection );
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$listetapabean = $seletapaCollection [$i];
							?>
				    <option value="<?php echo $listetapabean->getid();?>"
					<?php echo ($listetapabean->getid()==$seletapa)?"selected":"";?>><?php echo $listetapabean->getnome();?></option>
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
							//echo count ( $selbateriaCollection );
							for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
								$listbateriabean = $selbateriaCollection [$i];
								?>
					    <option value="<?php echo $listbateriabean->getid();?>"
					<?php echo ($listbateriabean->getid()==$selbateria)?"selected":"";?>><?php echo $listbateriabean->getnome();?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
</table>
<DIV><?php echo $mensagem;?></DIV>
<?php
if ($adicionarPilotoCampeonato) {
	?>
<div style="float: left; width: 45%;"> 
Piloto da bateria&nbsp;&nbsp;&nbsp;<?php echo $button->btCustom($idurl,$idobj,"Remover todos",$target,Choice::EXCLUIR_TODOS);?><br>
<style>
	.listTable th,.listTable td{
		font-size: 12px;
	}
</style>
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
	for($i = 0; $i < count ( $collection ); $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
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
				echo $button->btExcluirImagem ( $pilotoBateriaBeanList->getid (), $idurl );
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
				<?php echo $pilotoBateriaBeanList->getgridlargada();?>
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

<div style="float: right; width: 45%;">
Piloto do campeonato&nbsp;&nbsp;&nbsp;

<?php echo $button->btCustom($idurl,$idobj,"Adicionar todos",$target,Choice::SALVA_TODOS);?>
<?php echo $button->btCustom($idurl,$idobj,"Adicionar ou atualizar grid",$target,Choice::PASSO_1);?><br>
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
	for($i = 0; $i < count ( $cltPilotosSemBateria ); $i ++) {
		$categoria = "";
		$pilotoBateriaBeanList = $cltPilotosSemBateria [$i];
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();

		$inscritoBean = new InscritoBean();
		$inscritoBusiness = new InscritoBusiness();
		$idpessoa = Util::getIdObjeto($pilotoBeanList->getpessoa());
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
		if($containCategoria){
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
				echo $categoria;
				
			?>
			</td>
		</tr>
		<?php 
			}
		}?>
	  </tbody>
	</table>
</div>
<?php }?>

