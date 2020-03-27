<?php
$datafile = "RESULTADOS_MASTER.xlsx";
$categoria = "SPRINT BATERIA B";
$etapa = "1ª ETAPA - ADEMAR MORO";
$folder = "01etapa";
$f = isset($_GET['f'])?$_GET['f']:0;
$e = isset($_GET['e'])?$_GET['e']:0;
switch($f){
	case 1:
	$datafile = "GRID_MASTER.xlsx";
	$categoria = "MASTER";
	break;

	case 2:
	$datafile = "GRID_B_SPRINTER.xlsx";	
	$categoria = "SPRINT BATERIA B";
	break;

	case 3:
	$datafile = "GRID_A_SPRINTER.xlsx";	
	$categoria = "SPRINT BATERIA A";
	break;
	

}
switch($e){
	case 1:
	$etapa = "1ª ETAPA - ADEMAR MORO";
	$folder = "01etapa";
	break;

	case 2:
	$etapa = "2ª ETAPA - IGOR ESPEK";	
	$folder = "02etapa";
	break;

	case 3:
	$etapa = "3ª ETAPA - ADEMAR MORO";
	$folder = "03etapa";
	break;
	

}
	require_once "Classes/PHPExcel.php";
	$tmpfname = $folder."/".$datafile;
	$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
	$excelObj = $excelReader->load($tmpfname);
	$worksheet = $excelObj->getSheet(0);//
	$lastRow = $worksheet->getHighestRow();

?>

<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<link rel="stylesheet" href="js/jquery-ui.css">
		<link href="https://fonts.googleapis.com/css?family=Audiowide|Economica|Orbitron|Oswald|Press+Start+2P" rel="stylesheet">
		
		<script type="text/javascript" charset="utf8" src="js/jquery-3.3.1.js"></script>
		
		<script src="js/jquery-ui.js"></script>
		
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
		left : -10000px;
		top : -10000px;	
		display: none;
	}

</style>
	</head>
	<body>
		<div id="tela"></div>
		<div id="quadro">&nbsp;</div>
		<img id="logo" src="img/engecarlogo.png" />
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
		<div id="buffer"> 
		
		<script type="text/javascript" charset="utf8" >
		<?php 
		
		$lista = "var lista = [\n";
		for ($row = 2; $row <= $lastRow; $row++) {
			if($worksheet->getCell('B'.$row)->getValue()!=""){
				$lista .= "{\n        nome : '";
				$lista .= trim($worksheet->getCell('B'.$row)->getValue());
				$lista .= "',\n       ";
				$lista .= " equipe : '";
				$lista .= trim($worksheet->getCell('C'.$row)->getValue());
				$lista .= "',\n       ";
				$lista .= " apelido : '";
				$lista .= trim($worksheet->getCell('D'.$row)->getValue());
				$lista .= "'\n }";
				if($row != $lastRow)$lista .= ",\n";
			}else{
				$row = $lastRow+1;
			}
		}
		if(substr($lista,-1)==','){
			$lista = substr($lista,0,strlen($lista)-2);
		}
		$lista .= "];";
		
		echo $lista;
		
		?>
		
		
		</script>
		<script type="text/javascript" charset="utf8" src="js/dadosPatrocinios.js"></script>
		
		<script type="text/javascript" charset="utf8" src="js/util.js"></script>
		<script type="text/javascript" charset="utf8" src="js/tempo.js"></script>
		<script type="text/javascript" charset="utf8" src="js/propriedade.js"></script>
		<script type="text/javascript" charset="utf8" src="js/run.functions.js"></script>
		<script type="text/javascript" charset="utf8" src="js/run.js"></script>
	</body>
</html>