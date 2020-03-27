<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
Util::echobr ( 0, 'InscritoEquipeControl  $cltCampeonatoSelecionar', $cltCampeonatoSelecionar );
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
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select>
			&nbsp;
			&nbsp;
			Pagos: 
			<select id="situacao" name="situacao" class="btn_select"<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="Pago" <?php echo ($situacao=="Pagos")?"selected":"";?>>Sim</option>
				<option value="Aguardando pagamento" <?php echo ($situacao=="Aguardando pagamento")?"selected":"";?>>Não</option>
				<option value="" <?php echo ($situacao=="")?"selected":"";?>>Todos</option>
			</select>
		<select id="ativos" name="ativos" class="btn_select"
<?php
echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
?>>
	<option value="A" <?php echo ($ativos == "A")?"selected":""; ?>>Ativos</option>
	<option value="T" <?php echo ($ativos == "T")?"selected":""; ?>>Todas</option>
		  
</select>
			
		</td>
	</tr>
</table>
<input style="float: right;" type="button" value="Imprimir"
	id="printButton" />
<div class="printableArea" style="background-color: white;">
	<style>
.linhabrN {
	border: 1px solid black;
	padding: 2px;
}

.linhabrLider {
	font-weight: bold;
}

.header {
	border: 1px solid black;
	background-color: #cccccc;
}
</style>

	<center>
		<table>
			<tbody>
	<?php
	$dbg=0;
	Util::echobr ( $dbg, 'InscritoEquipeList $collection', $collection );
		
	$ordem = 0;
	$idequipe = 0;
	$nrEquipe = 0;
	$cpflider = 0;
	$lider = "";
	for($i = 0; $i < count ( $collection ); $i ++) {
		$inscritoequipebean = new InscritoEquipeBean ();
		$inscritoequipebean = $collection [$i];
		
		$dbg=0;
		Util::echobr ( $dbg, 'InscritoEquipeList idinscritoequipe', Util::getIdObjeto ( $inscritoequipebean ) );
	
		$equipeBean = $inscritoequipebean->getequipe ();
		Util::echobr ( $dbg, 'InscritoEquipeList idequipe', Util::getIdObjeto ( $inscritoequipebean->getequipe() ) );
		if($equipeBean->isvalidade() || "T" == $ativos){
			
			$cpflider = $equipeBean->getcampoaux ();
			Util::echobr ( $dbg, 'InscritoEquipeList cpflider ', Util::getIdObjeto ( $equipeBean->getcampoaux() ) );
			
			$inscritobean = $inscritoequipebean->getinscrito();
			Util::echobr ( $dbg, 'InscritoEquipeList idinscrito', Util::getIdObjeto ( $inscritobean ) );
			Util::echobr ( $dbg, 'InscritoEquipeList inscrito', $inscritobean );
			Util::echobr ( $dbg, 'InscritoEquipeList isObjeto inscrito', Util::isObjeto($inscritobean) );
			if( !Util::isObjeto($inscritobean)){
				$inscritobean = 0;
			}
			
			
			if(Util::getIdObjeto($inscritobean) > 0){
				Util::echobr ( $dbg, 'InscritoEquipeList idinscrito getCPF', $inscritobean->getCPF() );
				$lider = ($cpflider == $inscritobean->getCPF() ) ? "Lider" : "";
			}
			Util::echobr ( $dbg, 'InscritoEquipeList lider ', $lider );
			
			
			if ($idequipe != Util::getIdObjeto ( $inscritoequipebean->getequipe () )) {
				$ordem++;
				if ($idequipe != 0 ) {
					?>
		<tr>
						<td colspan="4" class="linhabrN">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4" class="linhabrN">&nbsp;</td>
					</tr>
	
				</tbody>
			</table>
			<h1 style="page-break-after: always;"></h1>
		<?php
				
	}
				
				$inscritoEquipeBusiness = new InscritoEquipeBusiness ();
				$totalinscritos = $inscritoEquipeBusiness->totalInscritos ( $equipeBean->getid () );
				$pesoMax = $inscritoEquipeBusiness->pesoMaxInscrito ( $equipeBean->getid () );
				$pesoMin = $inscritoEquipeBusiness->pesoMinInscrito ( $equipeBean->getid () );
				
				// echo "<small><small><nobr>".$inscritoBean->getapelido()."</nobr><br>".
				// "<nobr>".$inscritoBean->gettelefone()."</nobr><br>".
				// "<nobr>Total integrantes: ".$totalinscritos."</nobr><br>".
				// "<nobr>Peso entre ".$pesoMin." e ".$pesoMax."</nobr>".
				// "</small></small>";
				
				$idequipe = Util::getIdObjeto ( $inscritoequipebean->getequipe () );
				$nrEquipe ++;
				/*
				 * if($nrEquipe<30 && $inscritoequipebean->getequipe()->getcategoria()==2){ $nrEquipe = 30; }
				 */
				?>
	<h1><?php echo $ordem." - ".Util::getNomeObjeto($inscritoequipebean->getequipe());?></h1>
			<small><small> 
			<?php echo "nr Inscricao: ". $inscritoequipebean->getequipe()->getnrinscrito(); ?><br>
			<nobr>Categoria: <?php echo Util::getNomeObjeto($inscritoequipebean->getequipe()->getcategoria())?></nobr>
					&nbsp;&nbsp;&nbsp;&nbsp; <nobr>Total integrantes: <?php echo $totalinscritos ?></nobr></small></small>
			<table cellspacing="0" cellpadding="0" border="0">
				<thead>
					<th class="header" style="width: 400px; font-size: 12pt;">Nome</th>
					<th class="header" style="width: 200px; font-size: 12pt;">CPF</th>
					<th class="header" style="width: 60px; font-size: 12pt;">Peso</th>
					<th class="header" style="width: 60px; font-size: 12pt;">Idade</th>
				</thead>
				<tbody>
				<?php
			}
			if(Util::getIdObjeto($inscritobean) >0){
			?>
			<tr>
				<td class="linhabrN linhabr<?php echo $lider;?>"
							style="font-size: 12pt;">
			<?php echo Util::getNomeObjeto($inscritobean);?>
			</td>
						<td class="linhabrN linhabr<?php echo $lider;?>"
							style="text-align: center; font-size: 12pt;">
			<?php echo $inscritobean->getCPF();?>
			</td>
						<td class="linhabrN linhabr<?php echo $lider;?>"
							style="text-align: center; font-size: 12pt;">
			<?php echo ($inscritobean->getpeso()==0)?"":$inscritobean->getpeso();?>
			</td>
						<td class="linhabrN linhabr<?php echo $lider;?>"
							style="text-align: center; font-size: 12pt;">
			<?php echo $inscritobean->getIdade();?>
			</td>
					</tr>
				
	<?php 			
			}
			
		}
	
	}
	?>

	<tr>
					<td colspan="4" class="linhabrN">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="linhabrN">&nbsp;</td>
				</tr>

			</tbody>
		</table>
	</center>

</div>
