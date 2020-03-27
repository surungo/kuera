

<?php
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
$fundo = URLAPP . '/mvc/kart/view/images/fundo.png';
$fast = URLAPP . '/mvc/kart/view/images/fast.png';
$p1 = URLAPP . '/mvc/kart/view/images/p1.png';
$fastW = URLAPP . '/mvc/kart/view/images/fastW.png';
$p1W = URLAPP . '/mvc/kart/view/images/p1W.png';

$bandaFlagTop = URLAPP . '/mvc/kart/view/images/bandaFlagTop.png';
$bandaFlagDown = URLAPP . '/mvc/kart/view/images/bandaFlagDown.png';
$bandaFlag = URLAPP . '/mvc/kart/view/images/bandaFlag.png';
$frontCard = PATHAPP . '/mvc/kart/view/php/PilotoCatalogoFront.php';
$backCard = PATHAPP . '/mvc/kart/view/php/PilotoCatalogoBack.php';

$btnFacebook = URLAPP . '/mvc/public/view/images/btn-facebook.png';
$btnFacebookNot = URLAPP . '/mvc/public/view/images/btn-facebook_not.png';

$jquery = URLAPP . '/mvc/public/view/js/jquery.js';
$flip = URLAPP . '/mvc/public/view/js/flip.js';

$faceSize = 30;
$fotoWidth = 90;
$cardWidth = 340; // 352
$cardHeght = 390; // 348-60=288
$sizeTipo = "px";
$sizeTipoFont = "px";
$bordaTesteCSS = "";
// $bordaTesteCSS = "border:1px solid black;";

?>
<!DOCTYPE html>
<html>
<head>
<title>Campeonato de Kart Engecar 2015</title>
<meta charset="<?php echo PRJCHARSET;?>" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<link href='http://fonts.googleapis.com/css?family=Orbitron'
	rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Inconsolata'
	rel='stylesheet' type='text/css'>

<script language="JavaScript" src="<?php echo $jquery;?>"></script>
<SCRIPT language="JavaScript" src="<?php echo $flip;?>"></SCRIPT>
<script>
$(function() {
  $(".cards").flip();
});

</script>
<style>
body {
	background-color: rgb(3, 7, 10);
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

.cards { <?php echo $bordaTesteCSS; ?>
	display: inline-block;
	width: <?php echo$cardWidth; ?><?php echo $sizeTipo; ?>;
	height: <?php echo$cardHeght; ?><?php echo $sizeTipo; ?>;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

.card { <?php echo $bordaTesteCSS; ?>
	width: <?php echo$cardWidth; ?><?php echo $sizeTipo; ?>;
	height: <?php echo$cardHeght; ?><?php echo $sizeTipo; ?>;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

.listTb { <?php echo $bordaTesteCSS; ?>
	padding: 0 0 0 0;
	margin: 0 0 0 0;
	width: <?php echo$cardWidth; ?><?php echo $sizeTipo; ?>;
	height: <?php
	
echo $cardHeght;
	?><?php
	
	echo $sizeTipo;
	?>;
}

.cardTb { <?php echo $bordaTesteCSS; ?>
	width: <?php echo$cardWidth; ?><?php echo $sizeTipo; ?>;
	height: <?php echo$cardHeght-60; ?><?php echo $sizeTipo; ?>;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

.front { <?php echo $bordaTesteCSS; ?>
	
}

.frontCardTD { <?php echo $bordaTesteCSS; ?>
	background-image: url(<?php echo $fundo;?>);
	/*background-color: rgb(255, 255, 180);*/
}

.back { <?php echo $bordaTesteCSS; ?>
	
}

.backCardTD { <?php echo $bordaTesteCSS; ?>
	background-image: url(<?php echo $fundo;?>);
	/*background-color: rgb(250, 250, 190);*/
}

.cor_par {
	background-color: rgb(210, 250, 190);
}

.cor_impar {
	background-color: rgb(210, 250, 230);
}

.texto_x { <?php echo $bordaTesteCSS; ?>
	padding: 0pt 12pt 0pt 12pt;
	font-size: 14pt;
	font-family: 'Inconsolata', Arial, sans-serif;
	background-color: rgb(250, 200, 0);
}

.texto_Apelido { <?php echo $bordaTesteCSS; ?>
	text-align: center;
	padding: 5 5 5 5;
	font-size: 24pt;
	font-family: 'Orbitron', Arial, sans-serif;
	font-weight: bold;
	height: 80<?php echo$sizeTipo; ?>;
	color: white;
}

.texto_Apelido_back { <?php echo $bordaTesteCSS; ?>
	text-align: center;
	padding: 5 5 5 5;
	font-size: 18pt;
	font-family: 'Orbitron', Arial, sans-serif;
	font-weight: bold;
	color: white;
}

.texto_pontos { <?php echo $bordaTesteCSS; ?>
	text-align: center;
	padding: 20 10 0 0;
	font-size: 42pt;
	font-family: 'Orbitron', Arial, sans-serif;
	font-weight: bold;
	color: white;
}

.labelPontos { <?php echo $bordaTesteCSS; ?>
	padding: 10 0 0 0;
	font-size: 22pt;
	font-family: 'Orbitron', Arial, sans-serif;
	font-weight: normal;
}

.banner1 {
	height: 30<?php echo$sizeTipo; ?>;
	background-image: url(<?php echo $bandaFlag;?>);
}

.bannerTop {
	height: 30<?php echo$sizeTipo; ?>;
	background-image: url(<?php echo $bandaFlagTop;?>);
}

.bannerDown {
	height: 30<?php echo$sizeTipo; ?>;
	background-image: url(<?php echo $bandaFlagDown;?>);
}

.tdFacebook { <?php echo $bordaTesteCSS; ?>
	width: <?php echo$faceSize; ?><?php echo $sizeTipo; ?>;
	height: <?php
	
echo $faceSize;
	?><?php
	
	echo $sizeTipo;
	?>;
}

.imgFace {
	width: <?php echo$faceSize; ?><?php echo $sizeTipo; ?>;
	height: <?php
	
echo $faceSize;
	?><?php
	
	echo $sizeTipo;
	?>;
}

.tdFacebook {
	vertical-align: bottom;
	padding: 2pt;
}

.foto {
	width: <?php
	
echo $fotoWidth;
	?><?php
	
	echo $sizeTipo;
	?>;
}

.tdfoto { <?php echo $bordaTesteCSS; ?>
	vertical-align: top;
	text-align: center;
	width: <?php echo $fotoWidth +6; ?><?php echo $sizeTipo; ?>;
	padding: 6px;
}

.texto_header_geral td {
	background-color: rgb(250, 200, 0);
	font-size: 10pt;
	font-weight: bolder;
	font-family: 'Orbitron', Arial, sans-serif;
	padding: 4px;
}

.texto_linha_geral {
	font-size: 10pt;
	font-family: 'Inconsolata', Arial, sans-serif;
	padding: 4px;
}

.rankback {
	color: black;
	font-size: 14pt;
	font-family: 'Orbitron', Arial, sans-serif;
	padding: 6px;
	margin: 4px;
	background-color: rgb(250, 200, 0);
}

.bottonInfo {
	font-size: 10pt;
	font-family: 'Inconsolata', Arial, sans-serif;
	margin: 4pt;
	background-color: rgb(250, 200, 0);
}

.bottonInfo td {
	padding: 5px;
}

.bottonInfoTx {
	font-size: 8pt;
	font-family: 'Inconsolata', Arial, sans-serif;
}

.bottonInfoTxP {
	font-size: 7pt;
	font-family: 'Inconsolata', Arial, sans-serif;
}

.toque { <?php echo $bordaTesteCSS; ?>
	font-size: 8pt;
	font-family: 'Orbitron', Arial, sans-serif;
	text-align: center;
	width: <?php echo$cardWidth; ?><?php echo $sizeTipo; ?>;
	color: white;
}

.wrapper {
	/*max-width: 1200px;
	width: 100%;
	background-color: white;
	margin: auto;
	margin-top: 20px;
	padding: 15px;
	box-sizing: border-box;*/
	text-align: justify;
	margin: 2pt;
	padding: 0;
}

.logo {
	top: 0px;
}
</style>
</head>
<body>
	<div class="toque">Toque no cartão para abrir.</div>
	<div class="wrapper">
	
<?php
$posicaoRanking = 0;
$posicaoContinua = 0;
$pontuacaoanterior = null;
foreach ( $cltRanking as $k => $rankingVO ) {
	
	$pilotoBean = null;
	if ($rankingVO->getpiloto () != null) {
		$pilotoBean = $rankingVO->getpiloto ();
	}
	$apelido = "";
	$nome = "";
	$facebook = "";
	$idade = "";
	$peso = "";
	$fotourl = "";
	if ($pilotoBean != null) {
		if ($pilotoBean->getapelido () != null) {
			$apelido = $pilotoBean->getapelido ();
		}
		if ($pilotoBean->getnome () != null) {
			$nome = $pilotoBean->getnome ();
		}
		if ($pilotoBean->getfacebook () != "") {
			$facebook = $pilotoBean->getfacebook ();
		}
		if ($pilotoBean->getidade () != "") {
			$idade = $pilotoBean->getidade ();
		}
		if ($pilotoBean->getpeso () != "") {
			$peso = round ( $pilotoBean->getpeso () );
		}
		if ($pilotoBean->getfotourl () != "") {
			$fotourl = $pilotoBean->getfotourl ();
		}
	}
	
	$posicao = "";
	if ($rankingVO->getposicao () != null) {
		$posicao = $rankingVO->getposicao ();
	}
	
	$pontuacao = "";
	if ($rankingVO->getvalorpontuacao ()) {
		$pontuacao = $rankingVO->getvalorpontuacao ();
		// if($pontuacaoanterior==null || $pontuacaoanterior>$pontuacao){
		// $posicaoRanking=$posicaoRanking+$posicaoContinua;
		$posicaoRanking ++;
		// $pontuacaoanterior=$pontuacao;
		// $posicaoContinua = 0;
		// }else{
		// $posicaoContinua++;
		// }
	}
	
	$desempate = 0;
	if ($rankingVO->getdesempate ()) {
		$desempate = $rankingVO->getdesempate ();
	}
	
	$cltPilotoBateria = Array ();
	if ($rankingVO->getcltPilotoBateria () != null) {
		$cltPilotoBateria = $rankingVO->getcltPilotoBateria ();
	}
	
	?>	
<div id="card-<?php echo $k;?>" class="cards">
			<span class="front card">
				<table class="listTb" cellspacing="0" cellpadding="0">
					<tr class="bannerTop">
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td class="frontCardTD">
					<?php include $frontCard;?>
				</td>
					</tr>
					<tr class="bannerDown">
						<td colspan="4">&nbsp;</td>
					</tr>

				</table>
			</span> <span class="back card">
				<table class="listTb" cellspacing="0" cellpadding="0">
					<tr class="bannerTop">
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td class="frontCardTD">
					<?php include $backCard;?>	
				</td>
					</tr>
					<tr class="bannerDown">
						<td colspan="4">&nbsp;</td>
					</tr>

				</table>
			</span>
		</div>	
<?php }?>
</div>
</body>
</html>
