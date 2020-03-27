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
		
		$lista = "var lista = [\n";
			
		for ($row = 0; $row < count($collection) ; $row++) {
			$pos = $row+1;
			$pilotoBateriaBean = new PilotoBateriaBean ();
			$pilotoBateriaBean = $collection[$row];
			
			$lado ="l";
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
		
		}
		if(substr($lista,-1)==','){
			$lista = substr($lista,0,strlen($lista)-2);
		}
		$lista .= "];";
		
		echo $lista;
		
		?>
		
		
		</script>
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