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
    padding: 2px;
}
</style>
<div class="smalltotal"> 
[Total Master: <?php echo $totalMaster; ?> /2 =<?php echo ceil ( $totalMaster/2 );?>]
</div>
<div class="smalltotal"> 
[Total Sprinter: <?php echo $totalSprinter;?> /2 = <?php echo ceil ( $totalSprinter/2); ?>] 
</div>
<div class="smalltotal"> 
[Total com status pago: <?php echo $totalPago;?>]
</div>
<div class="smalltotal"> 
[Total sem status pago: <?php echo $totalNPago;?>]
</div>
<div class="smalltotal"> 
[Total inscritos: <?php echo $totalInscritos;?>]
</div>
<?php 
/*
<div class="smalltotal">
[Total com data pago: <?php echo $totalDtPago; ?>]
</div>
<div class="smalltotal"> 
[Total sem data pago: <?php echo $totalNDtPago;?>]
</div>
*/
?>
	<div class="smalltotal">Campeonato:
	<select id="campeonato" name="campeonato" class="btn_select"
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
			</select>
	</div>		
	<div class="smalltotal">Status pago:
		<select id="situacao" name="situacao" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="Pago"
					<?php echo ("Pago"==$selsituacao)?" selected ":" ";?>>Pagos</option>
				<option value="Todos"
					<?php echo ("Todos"==$selsituacao)?" selected ":" ";?>>Todos</option>
		</select>
	</div>		
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
	<div class="smalltotal">Gerar Grupos com parametros:
    	<input type="radio" id="cparametros" name="cparametros"
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
	</div>		
	<div class="smalltotal">CPF<input type="checkbox" id="vercpf" name="vercpf" class="btn_select"
			<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );	?>
			<?php echo ("S"==$vercpf)?" checked ":" ";?> value="S">
	</div>
	<div class="smalltotal">Idade<input type="checkbox" id="veridade" name="veridade" class="btn_select"
			<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );	?>
			<?php echo ("S"==$veridade)?" checked ":" ";?> value="S">
	</div>
	<div class="smalltotal">Dt Nascimento<input type="checkbox" id="verdtnasc" name="verdtnasc" class="btn_select"
			<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );	?>
			<?php echo ("S"==$verdtnasc)?" checked ":" ";?> value="S">
	</div>
	<div class="smalltotal">Categoria<input type="checkbox" id="vercat" name="vercat" class="btn_select"
			<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );	?>
			<?php echo ("S"==$vercat)?" checked ":" ";?> value="S">
	</div>
	<div class="smalltotal">Situação<input type="checkbox" id="versit" name="versit" class="btn_select"
			<?php echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );	?>
			<?php echo ("S"==$versit)?" checked ":" ";?> value="S">
	</div>
	
<?php

if ($cparametros == 'S') {
	$styleDisplay = " style='visibility: visible;display:block;' ";
} else {
	$styleDisplay = " style='visibility: hidden;display:none;' ";
}
?>
<div class="smalltotal">Qtd Linhas por Grupos:
<INPUT id="qtlinhaporgrupo" name="qtlinhaporgrupo" size="3" type="text"
			value="<?php echo $qtlinhaporgrupo;?>">
</div>
<div class="smalltotal">Tabelas de corrida:
<input type="radio" id="tbcorrida" name="tbcorrida"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("S"==$tbcorrida)?" checked ":" ";?> value="S">Sim&nbsp;&nbsp;&nbsp;
			<input type="radio" id="tbcorrida" name="tbcorrida"
			class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			<?php echo ("N"==$tbcorrida)?" checked ":" ";?> value="N">N&atilde;o
</div>
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
	padding: 2px;
	font-weight: bold;
	font-size: 11pt;
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
//for($x = 0; $x < count ( $cltbateria ); $x++) {
$z=1;
if("S"==$cparametros){
    if("S"==$tbcorrida){
        $z=8;
    }else{
        $z=4;
    }
}
for($x = 0; $x < $z; $x++) {
    $bateria = new BateriaBean ();
    $bateria = $cltbateria[$x];
    $etapa = $bateria->getetapa();
    if("S"==$cparametros){
        
        echo '<br><span class="quebrapagina">'.Util::getNomeObjeto($etapa).' - '.Util::getNomeObjeto($bateria).'</span>';
    }
    Util::echobr ( 0, 'InscritoRelatorioList $cltbateria', $cltbateria );
?>
<br>
<table cellspacing="0" cellpadding="0" border="0" >
	<thead>
		<th class="header" style="width: 18px; font-size: 12pt;">SQ.</th>
		<th class="header" style="width: 18px; font-size: 12pt;">Nr.</th>
		<th class="header" style="width: 380px; font-size: 12pt;">Nome</th>
		<th class="header" style="width: 50px; font-size: 12pt;">Peso Insc</th>
		<?php if("S"==$tbcorrida){ ?>
		<th class="header" style="width: 60px; font-size: 12pt;">Peso</th>
		<th class="header" style="width: 60px; font-size: 12pt;">Lastro</th>
		<th class="header" style="width: 60px; font-size: 12pt;">Grid</th>
		<th class="header" style="width: 60px; font-size: 12pt;">PosicaoBox</th>
		<th class="header" style="width: 60px; font-size: 12pt;">Kart</th>
		<?php }else{ ?>
		       
<?php if($vercpf    == 'S'){ ?><th class="header" style="width: 200px; font-size: 12pt;">CPF</th>           <?php } ?>
<?php if($veridade  == 'S'){ ?><th class="header" style="width: 60px; font-size: 12pt;">Idade</th>          <?php } ?>
<?php if($verdtnasc == 'S'){ ?><th class="header" style="width: 70px; font-size: 12pt;">Dt Nascimento</th>  <?php } ?>
<?php if($vercat    == 'S'){ ?><th class="header" style="width: 60px; font-size: 12pt;">Categoria</th>      <?php } ?>
<?php if($versit    == 'S'){ ?><th class="header" style="width: 60px; font-size: 12pt;">Situação</th>       <?php } ?>
	    <?php }?>
  	</thead>
	<tbody>
	<?php
	$count = 1;
	for($i = 0; $i < count ( $collection ); $i ++) {
	    $categoriainscrito = new CategoriaInscritoBean ();
	    $categoriainscrito =  $collection [$i];
	    $inscritobean = new InscritoBean ();
	    $inscritobean = $categoriainscrito->getinscrito();
		$categoriaBean = new CategoriaBean();
		$categoriaBean = $categoriainscrito->getcategoria();
		
		if((stristr( Util::getNomeObjeto($bateria), Util::getNomeObjeto($categoriaBean)) > -1 && 
		    $collection[$i]->getinscrito()->getsort()!=Util::getNomeObjeto($etapa) )
		    || "S"!==$cparametros){
		        $collection[$i]->getinscrito()->setsort(Util::getNomeObjeto($etapa));
		?>
	<tr>
		<td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: right;">
			<?php echo $count;?>
		</td>
		<td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: right;">
			<?php echo $inscritobean->getnrinscrito();?>
		</td>
		<td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: left;">
			<?php echo Util::getNomeObjeto($inscritobean);?>
		</td>
		<td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;">
			<?php echo ($inscritobean->getpeso()==0)?"":$inscritobean->getpeso();?>
		</td>
	<?php if("S"==$tbcorrida){ ?>
		<td class="linhabrN linhabr">&nbsp;</td>
		<td class="linhabrN linhabr">&nbsp;</td>
		<td class="linhabrN linhabr">&nbsp;</td>
		<td class="linhabrN linhabr">&nbsp;</td>
		<td class="linhabrN linhabr">&nbsp;</td>
	<?php } else {?>
<?php if($vercpf    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo $inscritobean->getCPF();?></td><?php } ?>
<?php if($veridade  == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo $inscritobean->getIdade();?></td><?php } ?>
<?php if($verdtnasc == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo str_replace(" 00:00:00","",$inscritobean->getdtnascimento());?></td><?php } ?>
<?php if($vercat    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo Util::getNomeObjeto($categoriaBean);?></td><?php } ?>
<?php if($versit    == 'S'){ ?><td class="linhabrN linhabr<?php echo $lider;?>" style="text-align: center;"><?php echo $inscritobean->getsituacao(); ?></td><?php } ?>
	<?php } ?>
	</tr>
<?php
        
        $count ++;
       }
       if( (stristr(Util::getNomeObjeto($bateria),"Master")>-1 &&   $count > ceil ($totalMaster/2) ||
           stristr(Util::getNomeObjeto($bateria),"Sprinter")>-1 && $count > ceil ($totalSprinter/2))&&
           "S"==$cparametros ||
           ($i+2) > count ( $collection )
       ){
               
             while($qtlinhaporgrupo>=$count){
            ?>
            <tr>
            <td class="linhabrN linhabr" style="text-align: right;"><?php echo $count;?></td>
    		<td class="linhabrN linhabr">&nbsp;</td>
    		<td class="linhabrN linhabr">&nbsp;</td>
    		<td class="linhabrN linhabr">&nbsp;</td>
<?php if($vercpf    == 'S' || "S"==$tbcorrida){ ?><td class="linhabrN linhabr">&nbsp;</td><?php } ?>
<?php if($veridade  == 'S' || "S"==$tbcorrida){ ?><td class="linhabrN linhabr">&nbsp;</td><?php } ?>
<?php if($verdtnasc == 'S' || "S"==$tbcorrida){ ?><td class="linhabrN linhabr">&nbsp;</td><?php } ?>
<?php if($vercat    == 'S' || "S"==$tbcorrida){ ?><td class="linhabrN linhabr">&nbsp;</td><?php } ?>
<?php if($versit    == 'S' || "S"==$tbcorrida){ ?><td class="linhabrN linhabr">&nbsp;</td><?php } ?>
            </td>
            </tr>
            <?php
            $count++;
            }
           $i = count ( $collection );
           
	   }
	}
?>	
	</tbody>
</table>
<?php 

}
?>

</div>
