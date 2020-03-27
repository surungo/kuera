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
	 	    
	});
</script>
<style type="text/css">

div.smalltotal{
       float: left;
    font-size:11pt;
    background-color: #CCCCCC;
    border: 1px solid black;
    padding: 3px;
	height:30px;
}
</style>

	<div class="smalltotal">Campeonato:
	<select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
						$listcampeonatobean = $cltCampeonatoSelecionar [$i];
				?>
			    <option value="<?php echo $listcampeonatobean->getid();?>"
					<?php echo ($listcampeonatobean->getid()==$selcampeonato)?" selected ":" ";?>><?php echo $listcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select>
	</div>	
	<div class="smalltotal" style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
		Etapa:
		<select id="etapa" name="etapa" class="btn_select"
		<?php
		echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
		?>>
			<option value="">Todas</option>
			<?php
			echo count ( $seletapaCollection );
			for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
				$listetapabean = $seletapaCollection [$i];
				?>
				<option value="<?php echo $listetapabean->getid();?>"
				<?php echo ($listetapabean->getid()==$seletapa)?"selected":"";?>><?php echo $listetapabean->getnome();?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="smalltotal" style="display: <?php echo ($seletapa>0)?"block":"none"?>;">
		Bateria:
		<select	id="bateria" name="bateria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
			<option value="">Todas</option>
			<?php
			echo count ( $selbateriaCollection );
			for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
				$listbateriabean = $selbateriaCollection [$i];
				?>
				<option value="<?php echo $listbateriabean->getid();?>"
				<?php echo ($listbateriabean->getid()==$selbateria)?"selected":"";?>><?php echo $listbateriabean->getnome();?></option>
				<?php
			}
			?>
		</select>
	</div>	
<?php if($selbateria>0){ ?>
	<div class="smalltotal">Ordem:
			<select id="sort" name="sort" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
			<?php for($ix=0;$ix<count($sortArr);$ix++){?>
				<option value="<?php echo $sortArr[$ix]; ?>"
				<?php echo ($sort== $sortArr[$ix])?" selected ":" ";?>
					><?php echo $sortArr[$ix]; ?></option>
			<?php }?>
			</select>
	</div>

	<div class="smalltotal">Ordem:
	<input type="radio" id="verordem" name="verordem" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$verordem)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="verordem" name="verordem" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$verordem)?" checked ":" ";?> value="N">N&atilde;o
	</div>
<div class="smalltotal">Posicao:
	<input type="radio" id="verpos" name="verpos" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$verpos)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="verpos" name="verpos" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$verpos)?" checked ":" ";?> value="N">N&atilde;o
</div>	
<div class="smalltotal">CPF:
	<input type="radio" id="vercpf" name="vercpf" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$vercpf)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="vercpf" name="vercpf" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$vercpf)?" checked ":" ";?> value="N">N&atilde;o
</div>
<div class="smalltotal">Idade:
	<input type="radio" id="veridade" name="veridade" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$veridade)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="veridade" name="veridade" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$veridade)?" checked ":" ";?> value="N">N&atilde;o
</div>
<div class="smalltotal">Peso:
	<input type="radio" id="verpeso" name="verpeso" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$verpeso)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="verpeso" name="verpeso" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$verpeso)?" checked ":" ";?> value="N">N&atilde;o
</div>
<div class="smalltotal">Dt Nascimento:
	<input type="radio" id="verdtnasc" name="verdtnasc" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$verdtnasc)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="verdtnasc" name="verdtnasc" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$verdtnasc)?" checked ":" ";?> value="N">N&atilde;o
</div>
<div class="smalltotal">Bateria:
	<input type="radio" id="vercat" name="vercat" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$vercat)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="vercat" name="vercat" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$vercat)?" checked ":" ";?> value="N">N&atilde;o
</div>
		

<div class="smalltotal">Tabelas de corrida:
	<input type="radio" id="tbcorrida" name="tbcorrida" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("S"==$tbcorrida)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
	<input type="radio" id="tbcorrida" name="tbcorrida" class="btn_select"
		<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice ); ?>
		<?php echo ("N"==$tbcorrida)?" checked ":" ";?> value="N">N&atilde;o
</div>
<?php

if ($cparametros == 'S') {
	$styleDisplay = " style='visibility: visible;display:block;' ";
} else {
	$styleDisplay = " style='visibility: hidden;display:none;' ";
}


$fontsize = ceil(380/count($collection));

//echo "count:".count($collection);
//echo "  font:".$fontsize;

?>
<br><br>
<br><br>
<br><br>
<input style="float: right;" type="button" value="Imprimir"
	id="printButton" />
<div class="printableArea" style="background-color: white;">
<style type="text/css">
.quebrapagina {
   page-break-before: always;
}
.linhabrN {
	border: 1px solid black;
	padding: 4px;
	font-weight: bold;
	font-size: <?php echo $fontsize;?>pt;
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

$z=1;
if("S"==$cparametros){
    if("S"==$tbcorrida){
        $z=8;
    }else{
        $z=4;
    }
}

?>
<table cellspacing="0" cellpadding="5" border="1" width="100%">
	<tr>
		<td><?php echo Util::getNomeObjeto($selcampeonatoBean ); ?></td>
		<td><?php echo Util::getNomeObjeto($seletapabean); ?></td>
		<td><?php echo Util::getNomeObjeto($selbateriabean); ?></td>
		<td><?php Util::echohtml( Util::timestamptostr('d/m/Y H:i',$selbateriabean->getdtbateria()) ); ?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%" >
	<thead>
<?php if($verordem  == 'S'){ ?><th class="header" style="font-size: 12pt;">Ord.</th><?php } ?>
<?php if($verpos    == 'S'){ ?><th class="header" style="font-size: 12pt;">Pos.</th><?php } ?>
		<th class="header" style="font-size: 12pt;">Nome</th>
<?php if($verpeso  == 'S'){ ?><th class="header" style="font-size: 12pt;">Peso C</th><?php }?>
<?php if($vercpf    == 'S'){ ?><th class="header" style="font-size: 12pt;">CPF</th>           <?php } ?>
<?php if($veridade  == 'S'){ ?><th class="header" style="font-size: 12pt;">Idade</th>          <?php } ?>
<?php if($verdtnasc == 'S'){ ?><th class="header" style="font-size: 12pt;">Dt Nascimento</th>  <?php } ?>
<?php if($vercat    == 'S'){ ?><th class="header" style="font-size: 12pt;">Bateria</th>      <?php } ?>
		<?php if("S"==$tbcorrida){ ?>
		<th class="header" style="font-size: 12pt;">Peso</th>
		<th class="header" style="font-size: 12pt;">Lastro</th>
		<th class="header" style="font-size: 12pt;">Sorteio</th>
		<th class="header" style="font-size: 12pt;">Kart</th>
		<?php } ?>       
	    
  	</thead>
	<tbody>
	<?php
	$count = 1;
for($i = 0; $i < count ( $collection ); $i ++) {
	$pilotobateriaBean = $collection[$i];
	$pilotoBateriaBeanList = $collection [$i];
	$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
	$bateriaBeanList = $pilotoBateriaBeanList->getbateria ();
	$etapaBeanList = $bateriaBeanList->getetapa ();
	?>
	<tr>
	<?php if($verordem  == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: right;">
	<?php echo $count;  ?>
	</td><?php } ?>
	<?php if($verpos    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: right;">
	<?php echo $pilotoBateriaBeanList->getgridlargada();  ?>
	</td><?php } ?>
	<td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: left;">
	<?php echo $pilotoBeanList->getapelido ();?>
	</td>
<?php if($verpeso  == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;">
	<?php echo $pilotoBeanList->getpeso();?>
	</td><?php } ?>
	<?php if($vercpf    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo $pilotoBeanList->getcpf ();?></td><?php } ?>
	<?php if($veridade  == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo $pilotoBeanList->getIdade();?></td><?php } ?>
	<?php if($verdtnasc == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo str_replace(" 00:00:00","",$pilotoBeanList->getdtnascimento());?></td><?php } ?>
	<?php if($vercat    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo Util::getNomeObjeto($bateriaBeanList);?></td><?php } ?>
	<?php if("S"==$tbcorrida){ ?>
	<td class="linhabrN linhabr">&nbsp;</td>
	<td class="linhabrN linhabr">&nbsp;</td>
	<td class="linhabrN linhabr">&nbsp;</td>
	<td class="linhabrN linhabr">&nbsp;</td>
	<?php } ?>
	
	</tr>
	<?php
	$count ++;
}
?>	
</tbody>
</table>
<?php 


?>

</div>
<?php } ?>