<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
Util::echobr ( 0, 'InscritoRelatorioList  $collection', $collection );
?>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#printButton").click(function(){
	        var mode = 'iframe'; //popup
	        var close = mode == "popup";
	        var options = { mode : mode, popClose : close};
	        $("div.printableArea").printArea( options );
	    });

	  $('#lmDtNascimento').mask('99/99/9999');
	  var lmDtNascimento = $('#lmDtNascimento').val();
	    $( "#lmDtNascimento" ).datepicker({
	      showOn: "button",
	      buttonImage: "mvc/public/view/images/calendar.gif",
	      buttonImageOnly: true,
	      buttonText: "Selecione a data"
	    });
	  $('#lmDtNascimento').datepicker( "option", "dateFormat", "dd/mm/yy" );
	  $('#lmDtNascimento').val(lmDtNascimento);
	

	    
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
					
					for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
						$selcampeonatobean = $cltCampeonatoSelecionar [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?" selected ":" ";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
		<td>Status pago:</td>
		<td><select id="situacao" name="situacao" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="Pago"
					<?php echo ("Pago"==$selsituacao)?" selected ":" ";?>>Pagos</option>
				<option value="Todos"
					<?php echo ("Todos"==$selsituacao)?" selected ":" ";?>>Todos</option>
		</select></td>
		<td>&nbsp;Gerar Grupos com parametros:</td>
		<td><input type="radio" id="cparametros" name="cparametros"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("S"==$cparametros)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
			<input type="radio" id="cparametros" name="cparametros"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("N"==$cparametros)?" checked ":" ";?> value="N">N&atilde;o
		</td>
	</tr>
</table>
<?php

if ($cparametros == 'S') {
	$styleDisplay = " style='visibility: visible;display:block;' ";
} else {
	$styleDisplay = " style='visibility: hidden;display:none;' ";
}
?>
<table border="0" <?php echo $styleDisplay;?>>
	<tr>
		<td>Qtd Grupos:</td>
		<TD><INPUT id="qtGrupo" name="qtGrupo" size="3" type="text"
			value="<?php echo $qtGrupo;?>"></TD>
		<td>Dt Nascimento Esp:</td>
		<TD><INPUT id="lmDtNascimento" name="lmDtNascimento" size="6"
			type="text" value="<?php echo $lmDtNascimento;?>"></TD>
		<td>Peso Esp:</td>
		<TD><INPUT id="lmPeso" name="lmPeso" size="3" type="text"
			value="<?php echo $lmPeso;?>"></TD>
		<td>&nbsp;Especiais pro grupo E:</td>
		<td><input type="radio" id="contaesp" name="contaesp"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("S"==$contaesp)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
			<input type="radio" id="contaesp" name="contaesp" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("N"==$contaesp)?" checked ":" ";?> value="N">N&atilde;o</td>
	</tr>
	<tr>
		<td align="right">PesoA:</td>
		<TD><INPUT id="pesoA" name="pesoA" size="3" type="text"
			value="<?php echo $pesoA;?>"></TD>
		<td align="right">PesoB:</td>
		<TD><INPUT id="pesoB" name="pesoB" size="3" type="text"
			value="<?php echo $pesoB;?>"></TD>
		<td align="right">PesoC:</td>
		<TD><INPUT id="pesoC" name="pesoC" size="3" type="text"
			value="<?php echo $pesoC;?>"></TD>
		<td align="right">PesoD:</td>
		<TD><INPUT id="pesoD" name="pesoD" size="3" type="text"
			value="<?php echo $pesoD;?>"></TD>
	</tr>
	<tr style="display: none;">
		<td align="right" colspan="4">Separar tabela de grupos: <input
			type="radio" id="separagrupos" name="separagrupos" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("S"==$separagrupos)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
			<input type="radio" id="separagrupos" name="separagrupos"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("N"==$separagrupos)?" checked ":" ";?> value="N">N&atilde;o
		</TD>
	</tr>
</table>
<small><small><small>
&nbsp;&nbsp;[Total com data pago: <?php echo $totalDtPago; ?>] 
[Total sem data pago: <?php echo $totalNDtPago;?>]
[Total com status pago: <?php echo $totalPago;?>]
[Total sem status pago: <?php echo $totalNPago;?>]
[Total inscritos: <?php echo $totalInscritos;?>]
<div <?php echo $styleDisplay;?>>
				<span id="gpS"></span><br> <span id="esp"></span>
			</div>
	</small></small></small>
<input style="float: right;" type="button" value="Imprimir"
	id="printButton" />
<div class="printableArea" style="background-color: white;">
	<style>
.linhabrN {
	border: 1px solid black;
	padding: 2px;
}

.linhabr1 {
	font-weight: bold;
}

.header {
	border: 1px solid black;
	background-color: #cccccc;
}
</style>

	<?php
	if ($cparametros == 'S') {
		$colspan = 8;
	} else {
		$colspan = 6;
	}
	$grupo = 0;
	$auxidade40 = "-1";
	$qtinscritosgrp = 0;
	$esp = 0;
	$gpS = "";
	$sequencial = 0;
	for($i = 0; $i < count ( $collection ); $i ++) {
		$inscritobean = new InscritoBean ();
		$inscritobean = $collection [$i];
		if (($qtinscritosgrp >= $qtGrupo || $auxidade40 != $inscritobean->getcategoria ()) && ($cparametros == 'S')) {
			if ($grupo > 0) {
				$gpS .= "<br>" . $grupo . " - " . $auxidade40 . ": " . $qtinscritosgrp;
			}
			$auxidade40 = $inscritobean->getcategoria ();
			
			$grupo ++;
			$qtinscritosgrp = 0;
		}
		$qtinscritosgrp ++;
		$lider = "";
		if ($inscritobean->gettamanhocamisa () != 'N') {
			$esp ++;
		}
		
		if ($sequencial == 0 || ($qtinscritosgrp == 1 && "S" == $separagrupos)) {
			?>
  	
<center>
		<h1>Relatorio de Inscritos na <?php echo Util::getNomeObjeto($selcampeonatoBean)?></h1>
	</center>

	<center>
		<table cellspacing="0" cellpadding="0" border="0">
			<thead>
				<th class="header" style="width: 18px; font-size: 12pt;">Ord</th>
				<th class="header" style="width: 380px; font-size: 12pt;">Nome</th>
				<th class="header" style="width: 200px; font-size: 12pt;">CPF</th>
				<th class="header" style="width: 60px; font-size: 12pt;">Peso</th>
				<th class="header" style="width: 60px; font-size: 12pt;">Idade</th>
				<th class="header" style="width: 60px; font-size: 12pt;">
					DtNascimento</th>
      <?php
			
if ($cparametros == 'S') {
				if ("N" == $separagrupos) {
					?>
      <th class="header" style="width: 300px; font-size: 12pt;">Grupo</th>
      <?php }?>
      <th class="header" style="width: 400px; font-size: 12pt;">
					Especiais</th>
	<?php }?>            
  	</thead>
			<tbody>
<?php }?>
		<tr>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: right; font-size: 10pt;">
		<?php echo $qtinscritosgrp;?>
		</td>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: left; font-size: 10pt;">
		<?php echo Util::getNomeObjeto($inscritobean);?>
		</td>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo $inscritobean->getCPF();?>
		</td>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo ($inscritobean->getpeso()==0)?"":$inscritobean->getpeso();?>
		</td>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo $inscritobean->getIdade();?>
		</td>
					<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo str_replace(" 00:00:00","",$inscritobean->getdtnascimento());?>
		</td>
		<?php
		
if ($cparametros == 'S') {
			if ("N" == $separagrupos) {
				?>
		<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo $inscritobean->getcategoria()?>
		</td>
			<?php }?>
		<td class="linhabrN linhabr<?php echo $lider;?>"
						style="text-align: center; font-size: 10pt;">
		<?php echo $inscritobean->gettamanhocamisa()?>
		</td>
		<?php }?>
		</tr>
	<?php
		
if ($sequencial >= count ( $collection ) - 1) {
			$gpS .= "<br>" . $grupo . " - " . $auxidade40 . ": " . $qtinscritosgrp . "<br>Total de " . $grupo . " grupos.";
			?>
	<script>
	
	$("#gpS").html("<?php echo $gpS;?>");
	$("#esp").html("<?php echo "Especiais: ".$esp;?>");
  	</script>

				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="<?php echo $colspan;?>" class="linhabrN">&nbsp;</td>
				</tr>

			</tbody>
		</table>
	<?php
		
}
		$sequencial++;?>
</center>
<?php }?>	
	</div>
