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
					<?php echo ($listbateriabean->getid()==$selbateria)?"selected":"";?>>
					<?php echo Util::getNomeObjeto($listbateriabean)." [".$listbateriabean->getdtbateria()."]";?>
					</option>
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
<style>
	.listTable th,.listTable td, .options1 {
		font-size: 12px;
	}
</style>
<INPUT id="consulta_adicao" name="consulta_adicao" type="hidden" value="<?php echo $consulta_adicao;?>">
<div class="options1">Filtros de adição:
<?php if($consulta_adicao!=Choice::PBA_OCULTAR) { echo $button->btCustom($idurl,$idobj,$listaOpcoesMostrar[Choice::PBA_OCULTAR],$target,Choice::PBA_OCULTAR); }?>
<?php if($consulta_adicao!=Choice::PBA_PILOTOCAMPEONATO) { echo $button->btCustom($idurl,$idobj,"Mostrar ".$listaOpcoesMostrar[Choice::PBA_PILOTOCAMPEONATO],$target,Choice::PBA_PILOTOCAMPEONATO ); }?>
<?php //if($consulta_adicao!=Choice::PBA_INSCRITOCAMPEONATO) echo $button->btCustom($idurl,$idobj,"Mostrar ".$listaOpcoesMostrar[Choice::PBA_INSCRITOCAMPEONATO],$target,Choice::PBA_INSCRITOCAMPEONATO);?>
<?php //if($consulta_adicao!=Choice::PBA_PILOTO) echo $button->btCustom($idurl,$idobj,"Mostrar ".$listaOpcoesMostrar[Choice::PBA_PILOTO],$target,Choice::PBA_PILOTO);?>
<?php //if($consulta_adicao!=Choice::PBA_PESSOA) echo $button->btCustom($idurl,$idobj,"Mostrar ".$listaOpcoesMostrar[Choice::PBA_PESSOA],$target,Choice::PBA_PESSOA);?>
</div>
<?php if(false){?>
<div class="options1">
	Processos:
	<?php echo $button->btCustom($idurl,$idobj,"Adicionar todos",$target,Choice::SALVA_TODOS);?>
	<?php echo $button->btCustom($idurl,$idobj,"Adicionar ou atualizar grid",$target,Choice::PASSO_1);?>
</div>
<?php	
	}
	if($consulta_adicao==Choice::PBA_PILOTOCAMPEONATO){
	   include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoBateriaAdicionarPilotoCampeonatoList.php";
    }
	
	include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoBateriaAdicionarTableList.php";
	
	
?>



<?php }?>

