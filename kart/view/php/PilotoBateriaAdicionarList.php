<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
if ($selbateria != null && $selbateria!="" && $selbateria>0 && false) {
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


	$(".selectFocus").focus(function() {
		   $(this).select();
	});

}); 
</script>
<style>
	.headerbotton{
		font-size: 20px;
		padding: 3px 30px 3px 30px;
	}
	
.fundinho{
	border: 1px solid white;margin: 4px;padding: 4px; background-color: #ffffff33
}

.fundinhoescuro{
	border: 1px solid white;margin: 4px;padding: 4px; background-color: #00000033
}
</style>

<?php
if ($adicionarPilotoCampeonato) {
?>
	<input id="campeonato" name="campeonato" type="hidden" value="<?php echo  $selcampeonato;?>"/>
	<input id="etapa" name="etapa" type="hidden" value="<?php echo  $seletapa;?>"/>
	<input id="bateria" name="bateria" type="hidden" value="<?php echo  $selbateria;?>"/>
	
<?php echo $button->btCustomCss($idurl,$idobj,
		$selcampeonatoBean->getsigla()." - ".
		$seletapabean->getsigla()." - ".
		Util::getNomeObjeto($selbateriabean),$target,Choice::VOLTAR,"headerbotton");?>
		
		
<?php } else { ?>
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

<?php } ?>
<DIV><?php echo $mensagem;?></DIV>
<?php
if ($adicionarPilotoCampeonato) {
	?>
<div style="clear:both;height: 25px;">
<span style="float: left; font-size: 18px;width:200px;" class="fundinho">
  <?php echo $step;?></span>

<input style="float: right;" id='btn_submenu' name='btn_submenu' value='Opções' title='Opções' 
 type='button' class='btn_submenu' />

</div>
<br>
<style>
	.listTable th,.listTable td , .listTable_pilotoBateria th,.listTable_pilotoBateria td {
		font-size: 12px;
		
	}
	
	.subMenu {
		width: 100%;
		float: left;
	}
	
	.options1{
		width: 100%;
	}
	
	.subMenuItem{
		width: 100%;
	}
	.subgrp{
		width: 100%;
		font-size: 14px;
		text-align: center;
		font-weight: bolder;
	}
	
</style>
<INPUT id="consulta_adicao" name="consulta_adicao" type="hidden" value="<?php echo $consulta_adicao;?>">


<div class="smalltotal">
	<small><small>Mostrar ausentes:
	<input type="radio" id="verausentes" name="verausentes" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$verausentes)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="verausentes" name="verausentes" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$verausentes)?" checked ":" ";?> value="N">N&atilde;o
	<?php if($umpresente > 0){?>		
	<span  class="<?php echo ($gridfechado)?"fundinhoescuro vermelho":" fundinho azul"?>" style="background-color:; float: right;padding:5px;">
	Grid esta <?php echo ($gridfechado)?"Fechado":"Aberto"?>
	<span>	
	<?php }?>
	</small></small>	
</div>


<div id="subMenu" >
<?php if(!$gridfechado){?>
<div id="adicionar" class="options1">
<div class="subgrp">Opções de cadastro</div>
<?php $textoAcao = "Adicionar "; ?>
<?php echo $button->btCustomCss($idurl,$idobj, $textoAcao.$listaOpcoesMostrar[Choice::PBA_PILOTOCAMPEONATO],$target,Choice::PBA_PILOTOCAMPEONATO, "subMenuItem" ); ?>
<?php echo $button->btCustomCss($idurl,$idobj, $textoAcao.$listaOpcoesMostrar[Choice::PBA_INSCRITOCAMPEONATO],$target,Choice::PBA_INSCRITOCAMPEONATO, "subMenuItem"); ?>
<?php echo $button->btCustomCss($idurl,$idobj, $textoAcao.$listaOpcoesMostrar[Choice::PBA_PILOTO],$target,Choice::PBA_PILOTO, "subMenuItem"); ?>
<?php //echo $button->btCustomCss($idurl,$idobj, $textoAcao.$listaOpcoesMostrar[Choice::PBA_PESSOA],$target,Choice::PBA_PESSOA, "subMenuItem");?>
<?php echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_FORM_ADD],$target,Choice::PBA_FORM_ADD, "subMenuItem");?>
<?php
	if($umpresente < 1){ 
		echo $button->btCustomCss($idurl,$idobj,"Remover todos",$target,Choice::EXCLUIR_TODOS, "subMenuItem");
	}
?>
</div>
<?php if(false){?>
	<div class="options1" id="processos">
		Processos
		<?php echo $button->btCustomCss($idurl,$idobj,"Adicionar todos",$target,Choice::SALVA_TODOS, "subMenuItem");?>
		<?php echo $button->btCustomCss($idurl,$idobj,"Adicionar ou atualizar grid",$target,Choice::PASSO_1, "subMenuItem");?>
	</div>
<?php 
	}
}
?>
	<div class="options1">
		<div class="subgrp">Opções de Processos</div>
		<?php echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_AJUSTEPREGRID],$target,Choice::PBA_AJUSTEPREGRID, "subMenuItem"); ?>
		<?php
		if(!$gridfechado){
			echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_CHAMADA],$target,Choice::PBA_CHAMADA, "subMenuItem"); 
		?>
		<?php echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_AJUSTEDEPESOS],$target,Choice::PBA_AJUSTEDEPESOS, "subMenuItem"); 
		}
		?>
		<?php echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_AJUSTEDEKART],$target,Choice::PBA_AJUSTEDEKART, "subMenuItem"); ?>
		<?php echo $button->btCustomCss($idurl,$idobj, $listaOpcoesMostrar[Choice::PBA_AJUSTEDEPOSICAO],$target,Choice::PBA_AJUSTEDEPOSICAO, "subMenuItem"); ?>
		
	</div>

</div>


<?php	
	
	if($consulta_adicao!=Choice::PBA_OCULTAR) { 
		?>
		<div class="subgrp">--------</div>
		<?php 
		echo $button->btCustomCss($idurl,$idobj,$listaOpcoesMostrar[Choice::PBA_OCULTAR],$target,Choice::PBA_OCULTAR,"subMenuItem vermelho"); 
	}
	
	if($consulta_adicao==Choice::PBA_AJUSTEPREGRID){
		
		
		if($gridfechado){
			echo $button->btCustomCss($idurl,$idobj, "Abrir grid",$target,Choice::ABRIRGRID, "certeza subMenuItem");
		}else{
			echo $button->btCustomCss($idurl,$idobj,"Sorteio grid",$target,Choice::SORTEIO_PREGRID,"certeza subMenuItem");
			echo $button->btCustomCss($idurl,$idobj, "Fechar grid",$target,Choice::FECHARGRID, "certeza subMenuItem");
		}
	}
	
	if($consulta_adicao==Choice::PBA_CHAMADA && !$gridfechado ){
		echo $button->btCustomCss($idurl,$idobj,"Todos presentes",$target,Choice::PRESENTE_TODOS,"certeza subMenuItem");
		echo $button->btCustomCss($idurl,$idobj,"Todos ausentes",$target,Choice::AUSENTE_TODOS,"certeza subMenuItem");
	}		
	
	if($consulta_adicao==Choice::PBA_AJUSTEDEKART && !$gridfechado){
		echo $button->btCustomCss($idurl,$idobj,"Sorteio posicao dos karts",$target,Choice::SORTEIO_KART,"certeza subMenuItem");
		echo $button->btCustomCss($idurl,$idobj,"Limpar posicao dos karts",$target,Choice::LIMPAR_SORTEIO_KART,"certeza subMenuItem");
	}
	
	if($consulta_adicao==Choice::PBA_AJUSTEDEPOSICAO && !$gridfechado){
		echo $button->btCustomCss($idurl,$idobj,"Limpar posicoes de chegada",$target,Choice::LIMPAR_POSICAO,"certeza subMenuItem");
	}

	if($consulta_adicao==Choice::PBA_PILOTOCAMPEONATO || $consulta_adicao==Choice::PBA_PILOTO){
		
	   include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoBateriaAdicionarPilotoCampeonatoList.php";
    }
    if($consulta_adicao==Choice::PBA_INSCRITOCAMPEONATO){
        include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoBateriaAdicionarInscritoCampeonatoList.php";
    }
    
    if($consulta_adicao==Choice::PBA_FORM_ADD){
        include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoEdit.php";
    }
    
    include PATHAPPVER."/".$sistemaCodigo."/view/php/"."PilotoBateriaAdicionarTableList.php";
	
	
?>



<?php }?>

