<?php

$categoria = $selbateriabean->getnome();
$etapa = $seletapabean->getnome()." - ".$seletapabean->getinfo();


?>

<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<link rel="stylesheet" href="<?php echo $urlgrid;?>js/jquery-ui.css">
		<link href="https://fonts.googleapis.com/css?family=Audiowide|Economica|Orbitron|Oswald|Press+Start+2P" rel="stylesheet">
		
		<script type="text/javascript" charset="utf8" src="<?php echo $urlgrid;?>js/jquery-3.3.1.js"></script>
		
		<script src="<?php echo $urlgrid;?>js/jquery-ui.js"></script>
		
		<title>Grids</title>
		
<style>
		
	#segundos{
		position: absolute;
		left : 640px;
		top: 720px;
		color : green;
	}
		
	#buffer{
		position : absolute;
		left : 1300px;
		top : 0px;	
		display: block;
	}
	#refreshX{
		position : absolute;
		left : 1324px;
		top : 5px;	
		
	}
	
	#linhaheader{
		height: 110px;
	}
	
	.tdfoto{
		background-repeat: no-repeat;
		background-position: bottom;
		
	}
	
	.linhacoluna1{
		width: 190px;
		
	}
	.linhacoluna2{
		width: 300px;
		
	}
	.linhacoluna3{
		width: 230px;
		
	}
	
	.tdcapa{
	
		filter : grayscale(80%) brightness(30%) contrast(180%) drop-shadow(8px 8px 10px black) saturate(7);
		opacity: 0.5;	
	}
	
	.trlinhas{
		display: none;
	}

</style>
	</head>
	<body>
	 <div id="refreshX"><?php echo $button->btRefreshLista($idurl); ?></div>
		
		<div id="tela"></div>
		<div id="quadro">&nbsp;</div>
		<img id="logo" src="<?php echo $urlgrid;?>img/engecarlogo.png" />
		<div id="titulo">GRID DA CATEGORIA <?php echo $categoria;?><br><?php echo $etapa;?></div>
		<div id="gpl"  class="gp gpI"></div>
		<div id="gpr"  class="gp gpI"></div>
		<div id="gplp" class="gp gpP"></div>
		<div id="gprp" class="gp gpP"></div>
		<div id="lt" class="nome">&nbsp;</div>
		<div id="rt" class="nome">&nbsp;</div>
		<div id="grid" class="grid">&nbsp;</div>
		<div id="l1" class="fotos"><img id="capal" class="capaBurn" src=""/></div>
		<div id="r1" class="fotos"><img id="capar" class="capaBurn" src=""/></div>
		<div id="equipel" class="equipeLogo" ></div>
		<div id="equiper" class="equipeLogo" ></div>
		<div id="patrocinadores" ></div>
		
		<div id="segundos">0</div>
		<div id="buffer"> </div>
		<script type="text/javascript" charset="utf8" >
		
		var tdc =  { position : "absolute",
			left : "0px",
			top : "800px" };
		$("#headerpage").css(tdc);
		
		<?php 
		$fotos = "";
		$urlx = "";
		
		$tbfotoslinhas = array();
		$tbfotositens = array();
		
		$lista = "var lista = [\n";
			
		for ($row = 0; $row < count($collection) ; $row++) {
			$pos = $row+1;
			$pilotoBateriaBean = new PilotoBateriaBean ();
			$pilotoBateriaBean = $collection[$row];
			
			$lado ="l";
			if($pos == 0){
				$lado ="r";
			}
			$foto = trim(strtoupper(tiraacentos( $pilotoBateriaBean->getpiloto()->getapelido() ) ) );
			
			$urlx =  $urlgrid."cards/piloto".$lado.".png";
			$fileExists = PATHAPPVER."/$sistemaCodigo/view/php/grid/cards/".$foto.".png";
			//echo "       //".$fileExists;
			if(file_exists( $fileExists )){
				$urlx = str_replace (" ","%20", $urlgrid."cards/".$foto.".png" );
			}
			
			$lista .= "{\n        nome : '";
			$lista .= trim($pilotoBateriaBean->getpiloto()->getapelido());
			$lista .= "',\n       ";
			$lista .= " equipe : '";
			$lista .= trim($pilotoBateriaBean->getpiloto()->getdescricao());
			$lista .= "',\n       ";
			$lista .= " foto: '";
			$lista .= $urlx ;
			$lista .= "',\n       ";
			$lista .= " apelido : '";
			$lista .= trim($pilotoBateriaBean->getpiloto()->getsigla());
			
			$lista .= "'\n }";
			if($row != count($collection))$lista .= ",\n";
			
			if($pos%2 == 0){
				$tbfotositens[] = $urlx;
				$tbfotoslinhas[] = $tbfotositens ;
			
			}else{
				$tbfotositens = array();
				$tbfotositens[] = $urlx;
				
			}
			
		}
		if(substr($lista,-1)==','){
			$lista = substr($lista,0,strlen($lista)-2);
		}
		$lista .= "];";
		
		echo $lista;
		
		$tableFotos = "<table id='tbfotos' border='1'>";
		$tableFotos .= "<tr id='linhaheader'><td colspan='5'>&nbsp;</td></tr>";
		for ($rowl = 0; $rowl < count($tbfotoslinhas) ; $rowl++) {
			
		
			$tableFotos .= "<tr id='trlinhas".$rowl ."' class='trlinhas'>";
			$tableFotos .= "<td class='linhacoluna1'>&nbsp;</td>";
			
			$tableFotos .= "<td id='tdfoto".$rowl ."' class='tdfoto' style='background-image: url(".$tbfotoslinhas[$rowl][1].");' valign='bottom' ><img id='tdcapa".$rowl ."' class='tdcapa' src='".$tbfotoslinhas[$rowl][1]."'/></td>";
			
			$tableFotos .= "<td class='linhacoluna2'>&nbsp;</td>";
			
			$tableFotos .= "<td id='tdfoto".$rowl ."' class='tdfoto' style='background-image: url(".$tbfotoslinhas[$rowl][0].");' valign='bottom' ><img id='tdcapa".$rowl ."' class='tdcapa' src='".$tbfotoslinhas[$rowl][0]."'/></td>";
			
			$tableFotos .= "<td class='linhacoluna3'>&nbsp;</td></tr>";
		}
		$tableFotos .= "</table>";
		
		?>
		
		
		</script>
<?php
		print_r($tableFotos);


?>

		<script> 
			<?php include $pathgrid."js/dadosPatrocinios.php"; ?>
		
			<?php include $pathgrid."js/util.php"; ?>
			<?php include $pathgrid."js/tempo.php"; ?>
			<?php include $pathgrid."js/propriedade.php"; ?>
			<?php include $pathgrid."js/run.functions.php"; ?>
			<?php include $pathgrid."js/run.php"; ?>
		
		</script>
	
	</body>
</html>

<?php


function tiraacentos($stringExemplo){
	$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
	$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
	return str_replace($comAcentos, $semAcentos, $stringExemplo);
}


?>