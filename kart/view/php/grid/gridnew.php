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
		
	#refreshX{
		position : absolute;
		left : 1324px;
		top : 5px;	
		
	}

</style>
	</head>
	<body>
	<table class="listTable"></table>
	 <div id="refreshX"><?php echo $button->btRefreshLista($idurl); ?></div>
		
		<div id="tela"></div>
		<div id="quadro">&nbsp;</div>
		<img id="logo" src="<?php echo $urlgrid;?>img/engecarlogo.png" />
		<div id="titulo">GRID DA CATEGORIA <?php echo $categoria;?><br><?php echo $etapa;?></div>		
		<?php 
		
		$lado = "l";
		$listas = "";
		$urlx = "";
		
		$grid = "<table id='tabelagrid' >";
			
		for ($row = 0; $row < count($collection) ; $row++) {
			$pos = $row+1;
			if($row%2==0){
				$lado = "l";
			}else{
				$lado = "r";
			}
			
			$pilotoBateriaBean = new PilotoBateriaBean ();
			$pilotoBateriaBean = $collection[$row];
			$apelido = $pilotoBateriaBean->getpiloto()->getapelido();
			$foto = "cards/".trim(strtoupper(tiraacentos( $pilotoBateriaBean->getpiloto()->getapelido() ) ) ).".png";
			$equipe = "img/".trim(tiraacentos( $pilotoBateriaBean->getpiloto()->getdescricao() ) ).".png";
			
			//echo PATHAPPVER."/$sistemaCodigo/view/php/grid/".$foto."<br>";
			if(!file_exists( PATHAPPVER."/$sistemaCodigo/view/php/grid/".$foto)){
				$foto = "/cards/piloto".$lado.".png";
			}
			
			//echo PATHAPPVER."/$sistemaCodigo/view/php/grid/".$equipe."<br>";
			if(!file_exists( PATHAPPVER."/$sistemaCodigo/view/php/grid/".$equipe)){
				$equipe = "/img/velopark.png";
			}
			$urlx = $urlgrid . $foto;
			$urlequilex = $urlgrid . $equipe;
			
			
			$piloto = trim($pilotoBateriaBean->getpiloto()->getsigla());
			
			$listas .= "<div id='nome".$pos."' class='nomes nome".$lado."' >".$apelido."</div>";
			$listas .= "<img id='equipe".$pos."' class='equipes equipe".$lado."' src='".$urlequilex."'/>";
			$listas .= "<img id='foto".$pos."' class='fotoim fotoimg fotoimg".$lado."' src='".$urlx."'/>";
			$listas .= "<img id='capa".$pos."' class='fotoim capaBurn capaBurn".$lado."' src='".$urlx."'/>";
			
			$grid .= "<tr id='trl".$pos."' ></tr>";
			
			
			$gridPos = "<td id='tdp".$pos."' class='divgd'>".
						"<div id='divp".$pos."' class='divpos'>".
							"<span id='spanp".$pos."' class='spanpos'>".$pos."".txposnum($pos).
							"<br><span id='nomegrid".$pos."' class='nomegrid'><b>".$piloto."</b><br></span>".
						"</div>".
					"</td>";
			$gridMeio ="<td id='tdf1".$pos."' class='divmeio'>&nbsp;</td>";
			$gridEspaco = "<td id='tde1".$pos."' class='divespaco'>&nbsp;</td>";
			
			if($pos%2==0){
				$grid .= $gridPos;
				$grid .= $gridMeio;
				$grid .= $gridEspaco;
			}else{
				$grid .= $gridEspaco;
				$grid .= $gridMeio;
				$grid .= $gridPos;
			}
			$grid .= "</tr>";
			
		}
	
		
		echo $listas;
		
		$grid .= "</table>";
		
		
		echo $grid;
		?>
	</body>
</html>

<?php

function txposnum($pos){		
	switch ($pos) {
 	case 1:
		return "st";
	case 2:
		return "nd";
	case 3:
		return "rd";
	default:
		return "th";
	}
	return "th";
}

function tiraacentos($stringExemplo){
	$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
	$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
	return str_replace($comAcentos, $semAcentos, $stringExemplo);
}


?>