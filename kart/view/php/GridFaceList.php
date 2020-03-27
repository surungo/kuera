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
		<td>
		<small><small><small>
		<input id="closeImage" name="closeImage" value="hide" type="button"/>
		
		<input id="croma" name="croma" value="croma" type="button"/>
		
		<input id="hidebg" name="hidebg" value="hidebg" type="button"/>
		
		<input id="update" name="update" value="update" type="button"/>
		Color font <input id="colorfont" name="colorfont" value="black" size="10" type="text" />
		Color shadown <input id="textShadow" name="textShadow" value="1px 1px #AAAAAA" size="20" type="text" />
		background-color <input id="backgroundColor" name="backgroundColor" value="gray" size="10" type="text" />
		
		<?php
		$sizecoll = count($collection);
		$sizecolu = ceil($sizecoll/3);
		$sizecolu2 = ceil($sizecolu*2);
		$sizecolu3 = ceil($sizecolu*3);
		echo "Total pilotos: ".$sizecoll. "   Total pilotos  por coluna: ".$sizecolu.
		"     [".$sizecolu.",".$sizecolu2.",".$sizecolu3."]" ;
		$posline1 = 445;
		$sizeline = 38;
		$patrotoppos = $posline1+($sizecolu*$sizeline);
		
		?>
		</small></small></small>
		</td>
	</tr>
</table>
<script>
$show = false;
$( document ).ready(function() {
$("#closeImage").click(function(){
	if($show){
		$show = false;
		$("#closeImage").val("hide");
		$(".obj").show();
		$(".headercss").show();
		$(".fundocss").show();
		$(".bateriacss").show();
		$(".horacss").show();
		$(".diacss").show();
		$(".etapacss").show();
		$(".homenageadocss").show();
		$(".coluna0css").show();
		$(".coluna11css").show();
		$(".coluna22css").show();
		$(".numcss").show();
		$(".nomecss").show();
	}else{
		$show = true;
		$("#closeImage").val("show");
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
	}
});

$showcroma=false;
$("#croma").click(function(){
	if($showcroma){
		$showcroma=false;
		$("#colorfont").val("black");
		$("#textShadow").val("1px 1px #AAAAAA");
		$("#backgroundColor").val("gray");
		$(".bateriacss").css("top","285px");
		$(".horacss").css("top","300px");
		$(".diacss").css("top","380px");
		$(".etapacss").css("top","380px");
		$(".homenageadocss").css("top","380px");
		$showbg=true;
		$(".fundocss, .addlinhas, .patrocss").show();
	}else{
		$showcroma=true;
		$("#colorfont").val("white");
		$("#textShadow").val("1px 1px black");
		$("#backgroundColor").val("green");
		$(".bateriacss").css("top","345px");
		$(".horacss").css("top","400px");
		$(".diacss").css("top","400px");
		$(".etapacss").css("top","400px");
		$(".homenageadocss").css("top","400px");
		$showbg=false;
		$(".fundocss, .addlinhas, .patrocss").hide();
	}
	
	$(".linhacss td").css("color",$("#colorfont").val());
	$(".linhacss td").css("textShadow",$("#textShadow").val());
	$("body").css("backgroundColor",$("#backgroundColor").val());
});


$showbg=false;
$("#hidebg").click(function(){
	if($showbg){
		$showbg=true;
		$(".fundocss, .addlinhas, .patrocss").show();
	}else{
		$showbg=false;
		$(".fundocss, .addlinhas, .patrocss").hide();
	}
});

$("#update").click(function(){
	$(".linhacss td").css("color",$("#colorfont").val());
	$(".linhacss td").css("textShadow",$("#textShadow").val());
	$("body").css("backgroundColor",$("#backgroundColor").val());
	
	
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
	left:15px;
	top:440px;
	
}

.coluna2css{
	left:288px;
	top:440px;
	
}

.coluna3css{
	left:565px;
	top:440px;
	
}



.linhacss td{
	padding: 0px 15px 0px 15px;
	
	font-family : 'Oswald',  Arial, Helvetica, sans-serif;
	text-shadow : 1px 1px #AAAAAA;
	color: black;
	font-size: 24px;

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
<img class="obj fundocss" src="<?php echo URLAPPVER."/kart/view/images/grid8.png";?>" >
<?php
addlinhas($sizecolu,$sizeline);
?>
<div class="obj bateriacss headercss"><?php echo $selbateriabean->getnome(); ?></div>
<div class="obj horacss headercss"><?php Util::echohtml( Util::timestamptostr('H:i',$selbateriabean->getdtbateria()) ); ?></div>
<div class="obj etapacss headercss"><?php echo $seletapabean->getnome(); ?></div>
<div class="obj diacss headercss"><?php echo Util::timestamptostr('d/m/Y',$selbateriabean->getdtbateria());?></div>
<div class="obj homenageadocss headercss"><?php echo $homenageado; ?></div>
<img class="obj patrocss" src="<?php echo URLAPPVER."/kart/view/images/gridpatro.png";?>" >


<?php
function comparator($object1, $object2) { 
    return $object1->getgridlargada() > $object2->getgridlargada() ; 
} 
$collection = removerNotPos($collection);
usort($collection , 'comparator');


tableC(1,$collection,0,$sizecolu );
tableC(2,$collection,$sizecolu ,$sizecolu2);
tableC(3,$collection,$sizecolu2,$sizecolu3);



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
				<td class="numcss">
					<?php echo $pilotoBateriaBeanList->getgridlargada();  ?>
				</td>
				<td class="nomecss">
					<?php echo $pilotoBeanList->getapelido ();?>
				</td>
			</tr>
			<?php
		}
		?>
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