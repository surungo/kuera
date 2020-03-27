<?php
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';

$liscrollerJS = URLAPP . '/mvc/public/view/js/li-scroller/jquery.li-scroller.1.0.js';
$liscrollerCSS = URLAPP . '/mvc/public/view/js/li-scroller/li-scroller.css';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=windows-1252">
	<title></title>

	<meta name="description" content=" ">
		<meta name="keywords" content=" ">

			<script type="text/javascript" src="<?php echo $liscrollerJS;?>"></script>

			<link rel="stylesheet" href="<?php echo $liscrollerCSS;?>"
				type="text/css" media="screen">
				<link href='http://fonts.googleapis.com/css?family=Orbitron'
					rel='stylesheet' type='text/css'>

					<script type="text/javascript">
$(function(){
	$("ul#ticker01").liScroll({travelocity: 0.095});
});
</script>
					<style>
.numero {
	font-size: 12pt;
	font-family: 'Orbitron', Arial, sans-serif;
	color: white;
	text-align: center;
	padding: 0px 20px 0px 20px;
	margin: 0px 0px 0px 10px;
}

.nome {
	font-size: 9pt;
	font-family: 'Orbitron', Arial, sans-serif;
	color: white;
	text-align: center;
	padding: 0px 40px 0px 10px;
	margin: 10px 40px 0px 10px;
}

.bgb {
	background-color: black;
}

.bg1 {
	background-color: #EF6C00;
}

.bg2 {
	background-color: #558B2F;
}
</style>
					<body marginheight="0" marginwidth="0" rightmargin="0"
						bottommargin="0" leftmargin="0" topmargin="0">

						<ul id="ticker01" class="newsticker">
<?php
$posicaoRanking = 0;
$posicaoContinua = 0;
$pontuacaoanterior = null;
foreach ( $cltPilotos as $k => $rankingPilotoBean ) {
	
	if ($k % 2 == 0) {
		$imageRankingLinha = $rLbluered;
		$corRankingLinha = "bg1";
	} else {
		$corRankingLinha = "bg2";
		$imageRankingLinha = $rLredblue;
	}
	
	$pilotoBean = null;
	if ($rankingPilotoBean->getpiloto () != null) {
		$pilotoBean = $rankingPilotoBean->getpiloto ();
	}
	$apelido = "";
	if ($pilotoBean != null) {
		if ($pilotoBean->getapelido () != null) {
			$apelido = $pilotoBean->getapelido ();
		}
	}
	$posicaoRanking ++;
	?>	
	<li><span class="nome <?php echo $corRankingLinha;?>"><span
									class="numero bgb"><?php echo $posicaoRanking;?></span>
	<?php echo $apelido;?></span>&nbsp;</li>
<?php }?>
</ul>


					</body>

</html>