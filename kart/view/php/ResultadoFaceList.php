<?php
$novo = false;
include_once PATHPUBPHPINCLUDE . '/headerList.php';

?>

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
						$selcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
	<tr>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
			<?php
			$dbg = 0;
			Util::echobr ( $dbg, 'GridFaceList  count ( $seletapaCollection )',count ( $seletapaCollection ) );
			?>
			<select id="etapa" name="etapa" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
				  <?php
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$seletapabeanindx = $seletapaCollection[$i];
							?>
				    <option value="<?php echo $seletapabeanindx->getid();?>"
					<?php echo ($seletapabeanindx->getid()==$seletapa)?"selected":"";?>><?php echo $seletapabeanindx->getnome();?></option>
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
							echo count ( $selbateriaCollection );
							for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
								$selbateriabeanindx = $selbateriaCollection [$i];
								?>
					    <option value="<?php echo $selbateriabeanindx->getid();?>"
					<?php echo ($selbateriabeanindx->getid()==$selbateria)?"selected":"";?>><?php echo $selbateriabeanindx->getnome();?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
	<tr>
		<td>Homenageado:</td>
		<td><input
			id="homenageado" name="homenageado" value="<?php echo $homenageado;?>" type="text"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>
			/></td>
	</tr>	<tr>
		<td></td>
		<td><input id="closeImage" name="closeImage" value="Close" type="button"/>
		<small>
		<?php
		$collection = removerNotPos($collection);
		usort($collection , 'comparator');

		$sizecoll = count($collection);
		$sizecolu = ceil($sizecoll/2);
		$sizecolu2 = ceil($sizecolu*2);
		$sizecolu3 = ceil($sizecolu*3);
		echo "Total pilotos: ".$sizecoll. "   Total pilotos  por coluna: ".$sizecolu.
		"     [".$sizecolu.",".$sizecolu2.",".$sizecolu3."]" ;
		$posline1 = 444;
		$sizeline = 38;
		$patrotoppos = $posline1+($sizecolu*$sizeline)+5;
		
		?>
		</small>
		</td>
	</tr>
</table>
<script>
$show = true;
$( document ).ready(function() {
$("#closeImage").click(function(){
	$(".obj").hide();
	$(".headercss").hide();
	$(".fundocss").hide();
	$(".bateriacss").hide();
	$(".horacss").hide();
	$(".diacss").hide();
	$(".etapacss").hide();
	$(".homenageadocss").hide();
	$(".coluna0css").hide();
	$(".coluna11css").hide();
	$(".coluna22css").hide();
	$(".numcss").hide();
	$(".nomecss").hide();
});
	

});
</script>
<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<style>
.obj{
	position: absolute;
	font-family: 'Oswald', Arial;
	
}
.headercss{
	font-family : 'Audiowide',  Arial, Helvetica, sans-serif;
	text-shadow : 1px 1px black;
}

.fundocss{
	left:0px;
	top:240px;
	
}
.addlinhas{
	left:11px;
}
.bateriacss{
	left:330px;
	top:285px;
	color: white;
	font-size: 34px;
}
.horacss{
	left:680px;
	top:300px;
	color: white;
	font-size: 24px;
}
.diacss{
	left:80px;
	top:380px;
	color: white;
	font-size: 24px;
}
.etapacss{
	left:280px;
	top:380px;
	color: white;
	font-size: 24px;
}

.homenageadocss{
	left:430px;
	top:380px;
	color: white;
	font-size: 24px;
}

.coluna1css{
	left:20px;
	top:<?php echo $posline1;?>px;
	color: white;
	font-size: 20px;
	background-color: rgba(155, 155, 155, 0.1);
}

.coluna2css{
	left:445px;
	top:<?php echo $posline1;?>px;
	color: white;
	font-size: 20px;
	background-color: rgba(155, 155, 155, 0.1);
	
}

.coluna3css{
	left:567px;
	top:<?php echo $posline1;?>px;
	color: black;
	font-size: 18px;
}



.linhacss td{
	padding: 0px 15px 0px 15px;
	height: <?php echo $sizeline-2 ;?>px;
	font-family : 'Oswald',  Arial, Helvetica, sans-serif;
	text-shadow : 1px 1px #AAAAAA;

}
.red1{
background-color: rgba(255, 0, 0, 0.6);
text-align: center;
}
.numcss{
	text-align:right;

}
.nomecss{

}

.patrocss{
	left:15px;
	top:<?php echo $patrotoppos; ?>px;

}


</style>
<img class="obj fundocss" src="<?php echo URLAPPVER."/kart/view/images/resultados.png";?>" >

<div class="obj bateriacss headercss">
	<?php echo $selbateriabean->getnome(); ?>
</div>
<div class="obj horacss headercss">
	<?php echo $seletapabean->getnome(); ?><?php //Util::echohtml( Util::timestamptostr('H:i',$selbateriabean->getdtbateria()) ); ?>
</div>
<div class="obj etapacss headercss">
	<?php //echo $seletapabean->getnome(); ?>
</div>
<div class="obj diacss headercss">
	Resultados <?php //echo Util::timestamptostr('d/m/Y',$selbateriabean->getdtbateria());?>
</div>
<div class="obj homenageadocss headercss">
	<?php echo $homenageado; ?>
</div>
<img class="obj patrocss" src="<?php echo URLAPPVER."/kart/view/images/gridpatro.png";?>" >


<?php
function comparator($object1, $object2) { 
    return $object1->getposicaooficial() > $object2->getposicaooficial() ; 
} 

tableC(1,$collection,0,$sizecolu );
tableC(2,$collection,$sizecolu ,$sizecolu2);
//tableC(3,$collection,$sizecolu2,$sizecolu3);



function tableC($col,$collection,$inicio,$fim){
	?>
	<table class="obj coluna<?php echo $col; ?>css">
	<?php
		for($i = $inicio; $i < count ( $collection ) && $i < $fim; $i ++) {
			$pilotoBateriaBeanList = $collection [$i];
			$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
			$bateriaBeanList = $pilotoBateriaBeanList->getbateria ();
			$etapaBeanList = $bateriaBeanList->getetapa ();
			?>
			<tr class="linhacss">
				<td class="red1 numcss">
					<?php echo $pilotoBateriaBeanList->getposicaooficial();  ?>
				</td>
				<td class="nomecss">
					<?php echo $pilotoBeanList->getapelido ();?>
				</td>
				<td class="nomecss">
					<?php echo $pilotoBateriaBeanList ->getkart();?>
				</td>
				<td class="nomecss">
					<?php echo str_replace("00:","",$pilotoBateriaBeanList ->getvolta());?>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
	<?php
}



function removerNotPos($collection){
	$clt = array();
	for($i = 0; $i < count ( $collection ) ; $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
		if(Util::getIdObjeto($pilotoBateriaBeanList->getposicaooficial())>0){
			$clt[] = $pilotoBateriaBeanList ;
		}
	}
	return $clt;
}


?>