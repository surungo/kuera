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
		<td>Categoria:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;"><select
			id="categoria" name="categoria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
					  <?php
							
							for($i = 0; $i < count ( $categorias ); $i ++) {
								$selcategoriabeanindx = $categorias [$i];
								?>
					    <option value="<?php echo $selcategoriabeanindx;?>"
					<?php echo ($selcategoriabeanindx==$selcategoria)?"selected":"";?>><?php echo $selcategoriabeanindx;?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
	<tr>
		<td></td>
		<td><input id="closeImage" name="closeImage" value="Close" type="button"/>
		<small>
		<?php
		$sizecoll = count($collection);
		$sizecolu = ceil($sizecoll/2);
		$sizecolu2 = ceil($sizecolu*2);
		echo "Total pilotos: ".$sizecoll. "   Total pilotos  por coluna: ".$sizecolu.
		"     [".$sizecolu.",".$sizecolu2."]" ;
		$posline1 = 328;
		$sizeline = 41;//38;
		$patrotoppos = $posline1+($sizecolu*$sizeline);
		
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
.titulocss{
	left:166px;
	top:284px;
	color: white;
	font-size: 16px;
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
	left:550px;
	top:286px;
	color: white;
	font-size: 16px;
}

.coluna1css{
	left:20px;
	top:337px;
	color: white;
	font-size: 20px;
	background-color: rgba(155, 155, 155, 0.1);
}

.coluna2css{
	left:466px;
	top:337px;
	color: white;
	font-size: 20px;
	background-color: rgba(155, 155, 155, 0.1);
	
}


.pontosSpan {
font-size: 12px;
}


.linhacss td{
	padding: 0px 15px 0px 15px;
	
	font-family : 'Oswald',  Arial, Helvetica, sans-serif;
	text-shadow : 1px 1px #AAAAAA;

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

.red1{
background-color: rgba(255, 0, 0, 0.6);
text-align: center;
}
.cssdescarte{
 color: #666;
}

</style>

<img class="obj fundocss" src="<?php echo URLAPPVER."/kart/view/images/ranking.png";?>" >
<?php



//addlinhas($sizecolu,$sizeline);
?>
<div class="obj titulocss headercss"><?php echo "CAMPEONATO KART ENGECAR 2019"; ?></div>
<div class="obj etapacss headercss"><?php echo "RESULTADOS APÓS ".$seletapabean->getnome(); ?></div>

<img class="obj patrocss" src="<?php echo URLAPPVER."/kart/view/images/gridpatro.png";?>" >


<?php

function comparator($object1, $object2) { 
    return $object1->getgridlargada() > $object2->getgridlargada() ; 
} 
//$collection = removerNotPos($collection);
//usort($collection , 'comparator');

tableC(1,$collection ,0,$sizecolu );
tableC(2,$collection ,$sizecolu ,$sizecolu2);



function tableC($col,$collection,$inicio,$fim){
$dbg=0;
Util::echobr ( $dbg, 'RankingFaceList   $collection ',count( $collection ) );
	?>
	<table class="obj coluna<?php echo $col; ?>css" >
	<tbody>	
				<?php
				for($idrp = 0; $idrp < count ( $collection); $idrp ++) {
					$linha = $collection [$idrp];
					if($inicio <= $idrp && $fim >$idrp)
					{
				?>
					<tr>
						<td  class="red1">
							&nbsp;
						</td>
						<td class="red1">
							<?php echo $linha ['posicao'];?>
						</td>
						<td>
							<?php Util::echohtml(  $linha ['nomepiloto'] );?>
						</td>
						<td>
							<big><b><?php echo  $linha ['total'];?></b></big>
						</td>
<?php for($x=1;$x< 11; $x++){

	$cssdescarte=$linha ['descartaretapa'.$x]=="S"?"cssdescarte":"";
?>
<td class="etapaDiv">
	<span class="pontosSpan <?php echo  "classposetapa".$linha ['posetapa'.$x]." ".$cssdescarte; ?>">
		<?php echo  $linha ['ptsetapa'.$x]==""?"0":$linha ['ptsetapa'.$x];?>
	</span>
	<?php 
	if(false){
	?><br>
	<span class="posSpan <?php echo  "classposetapa".$linha ['posetapa'.$x]; ?>">
		<?php 
		echo  $linha ['posetapa'.$x];
		echo ($linha ['posetapa'.$x]=="")?"-":"º";
		?>
	</span><br>
	<span class="penaSpan">
		<?php echo  ($linha ['penaetapa'.$x]=="")?"&nbsp;": $linha ['penaetapa'.$x];?>
	</span>
	<?php }?>
</td>
<?php }
if(false){
?>			 
	<td>
		<?php echo  $linha ['tpena'];?>
	</td>			
<?php
}?>
	<td>
		&nbsp;
	</td>			
					</tr>
				<?php	
				
				}
			}
				?>
				</tbody>
				</table>
	</table>
	<?php
}

function addlinhas($sizecolu,$sizeline){
	$topline =745;
	for($x=8;$x < $sizecolu; $x++){
		
?>
	<img class="obj addlinhas" 
	style="top:<?php echo $topline;?>px;" 
	src="<?php echo URLAPPVER."/kart/view/images/gridlinha.png";?>" >
<?
		$topline+=$sizeline;
	}
}



function removerNotPos($collection){
	$clt = array();
	for($i = 0; $i < count ( $collection ) ; $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
		if(Util::getIdObjeto($pilotoBateriaBeanList->getgridlargada())>0){
			$clt[] = $pilotoBateriaBeanList ;
		}
	}
	return $clt;
}


?>