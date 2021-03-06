<?php

include_once PATHPUBPHPINCLUDE.'/headerList.php';

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
		<td>
			<select id="campeonato" name="campeonato" class="btn_select"
				<?php 
				echo $button->atributos($idurl,$idobj,Choice::LISTAR,$target,$choice);
				?>
				>
			  <option value="">Todos</option>
			  <?php
			  
			  for ($i = 0; $i < count($selcampeonatoCollection); $i++)   { 
			    $selcampeonatobean = $selcampeonatoCollection[$i];
			  ?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
			    <?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>
			    ><?php echo $selcampeonatobean->getnome();?></option>
			  <?php 
			  }
			  ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
			<select id="etapa" name="etapa" class="btn_select" 
				<?php 
				echo $button->atributos($idurl,$idobj,Choice::LISTAR,$target,$choice);
				?>>
				  <option value="">Todas</option>
				  <?php
				  echo count($seletapaCollection);
				  for ($i = 0; $i < count($seletapaCollection); $i++)   { 
				    $seletapabean = $seletapaCollection[$i];
				  ?>
				    <option value="<?php echo $seletapabean->getid();?>"
				    <?php echo ($seletapabean->getid()==$seletapa)?"selected":"";?>
				    ><?php echo $seletapabean->getnome();?></option>
				  <?php 
				  }
				  ?>
			</select>
		</td>
	</tr>
	<tr >
		<td>Bateria:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;">
			<select id="bateria" name="bateria" class="btn_select"
					<?php 
					echo $button->atributos($idurl,$idobj,Choice::LISTAR,$target,$choice);
					?>>
					  <option value="">Todas</option>
					  <?php
					  echo count($selbateriaCollection);
					  for ($i = 0; $i < count($selbateriaCollection); $i++)   { 
					    $selbateriabean = $selbateriaCollection[$i];
					  ?>
					    <option value="<?php echo $selbateriabean->getid();?>"
					    <?php echo ($selbateriabean->getid()==$selbateria)?"selected":"";?>
					    ><?php echo $selbateriabean->getnome();?></option>
					  <?php 
					  }
					  ?>
			</select>
		</td>
	</tr>
</table>
<?php 
if($adicionarPilotoCampeonato){
?>
<div style="float:left; width:45%;"> 
Piloto da bateria&nbsp;&nbsp;&nbsp;<?php echo $button->btCustom($idurl,$idobj,"Remover todos",$target,Choice::EXCLUIR_TODOS);?><br>		
<table class="listTable" cellspacing="0" cellpadding="0" border="0">    
	<thead><tr><?php 
		if($editar==true){
		?> 
		<th class="headerlink">&nbsp;</th> 
		<?php 
		}
		?>    
		 <th class="header">&nbsp;</th>
		 <th class="header">N&uacute;mero</th>
		 <th class="header">Piloto</th>
		 <?php if($seletapa==null || $seletapa==0){?> 
		 <th class="header">Etapa</th>
		 <?php } if($selbateria==null || $selbateria==0){?>
		 <th class="header">Bateria</th>
		 <?php }?>
		</tr></thead><tbody>
	<?php
	
	for ($i = 0; $i < count($collection); $i++)   {
  		$pilotoBateriaBeanList = $collection[$i];
  		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto();
  		
  		Util::echobr($dbg,'WizardPilotoBateriaList  Util::getIdObjeto($pilotoBeanList)', Util::getIdObjeto($pilotoBeanList));
  		if(Util::getIdObjeto($pilotoBeanList)>0){
	  		$bateriaBeanList = $pilotoBateriaBeanList->getbateria();
			$etapaBeanList = $bateriaBeanList->getetapa();
			$corlinha = ($i%2==0)?"par":"impar";?>
		<tr class="<?php echo $corlinha;?>">
			<?php 
			if($editar==true){
			?> 
			<td>
				<?php 
				echo $button->btExcluirImagem($pilotoBateriaBeanList->getid(),$idurl);
				?>
			</td>     
			<?php 
			}
			?>
			<td>
				<img border="0" width="60" src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>" >
			</td>    
			<td>
				<?php echo $pilotoBeanList->getnrpiloto();?>
			
			</td>    
			<td> 
		      <?php
		        echo $pilotoBeanList->getapelido();
		      ?>
		    </td>
		    <?php if($seletapa==null || $seletapa==0){?>
			<td align="center"> 
		      <?php
		        echo $etapaBeanList->getsigla();
		      ?>
		    </td>
		    <?php } if($selbateria==null || $selbateria==0){?>
			<td align="center">
		      <?php
		        echo $bateriaBeanList->getsigla();
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
<div style="float:right; width:45%;">
Piloto do campeonato&nbsp;&nbsp;&nbsp;<?php echo $button->btCustom($idurl,$idobj,"Adicionar todos",$target,Choice::SALVA_TODOS);?><br>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">    
	<thead><tr><?php 
		if($adicionarPilotoCampeonato==true){
		?> 
		<th class="headerlink">&nbsp;</th> 
		<?php 
		}
		?>    
		 <th class="header">&nbsp;</th>
		 <th class="header">N&uacute;mero</th>
		 <th class="header">Piloto</th>
       </tr></thead><tbody>
	<?php 
	
	$imagemADD = "mvc/public/view/images/add.png";
	for ($i = 0; $i < count($cltPilotosSemBateria); $i++)   {
  		$pilotoBateriaBeanList = $cltPilotosSemBateria[$i];
  		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto();
		$corlinha = ($i%2==0)?"par":"impar";?>
	<tr class="<?php echo $corlinha;?>">
		<?php 
		if($adicionarPilotoCampeonato==true){
		?> 
		<td>
			<?php 
			echo $button->btCustomImagem($pilotoBeanList->getid(),$idurl,Choice::ADICIONAR,$imagemADD);
			?>
		</td>     
		<?php 
		}
		?>
		<td>
			<img border="0" width="60" src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>" >
		</td>    
		<td>
			<?php echo $pilotoBeanList->getnrpiloto();?>
		
		</td>    
		<td> 
	      <?php
	        echo $pilotoBeanList->getapelido();
	      ?>
	    </td>
	</tr>
	<?php }?>
  </tbody>
</table>
</div>
<?php }?>

