
<?php
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
$rLredblue = URLROOT . '/mvc/kart/view/images/RLredblue.png';
$rLbluered = URLROOT . '/mvc/kart/view/images/RLbluered.png';
$jquery = URLAPP . '/mvc/public/view/js/jquery.js';

?>
<script src="<?php echo $jquery;?>"></script>
<link href='http://fonts.googleapis.com/css?family=Orbitron'
	rel='stylesheet' type='text/css'>
<script>
	
	function scrolRankingLinha(){
		//var vemaqui = $( "#vemaqui" );
		//var position = vemaqui.position();
		//var leftposition = position.left+1900;
		//var strin = "-="+leftposition;
		$(".contentRankingLinha").css({"margin-left": "1200px" });
	 
		$(".contentRankingLinha").animate({"margin-left": '-=10750' }, 100000, function() {
		    // Animation complete.
			
			scrolRankingLinha()
		  });
	}
    $( document ).ready( function() {
	
		scrolRankingLinha();
    });
	
</script>
<style>
.scrolRankingLinha {
	overflow-y: hidden;
	overflow-x: hidden;
	width: 100%;
	height: 24px;
}

.contentRankingLinha {
	white-space: nowrap;
	height: 24px;
	padding: 0px 0px 0px 0px;
	margin: 0px;
}

.fontRankingLinha {
	font-size: 10pt;
	font-family: 'Orbitron', Arial, sans-serif;
	color: white;
	text-align: center;
	padding: 0px 28px 0px 28px;
	margin: 0px 0px 0px 0px;
}

.corRankingLinha1 {
	background-color: #558B2F;
}

.corRankingLinha2 {
	background-color: #EF6C00;
}
</style>
<div class="scrolRankingLinha">
	<div class="contentRankingLinha">
		<span id="inicioRankingLinha" class="fontRankingLinha"> Ranking </span>
	
<?php
$corRankingLinha = "corRankingLinha1";
$imageRankingLinha = $rLredblue;

$posicaoRanking = 0;
$posicaoContinua = 0;
$pontuacaoanterior = null;
foreach ( $cltRanking as $k => $rankingVO ) {
	
	if ($k % 2 == 0) {
		$imageRankingLinha = $rLbluered;
		$corRankingLinha = "corRankingLinha1";
	} else {
		$corRankingLinha = "corRankingLinha2";
		$imageRankingLinha = $rLredblue;
	}
	
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
		if ($pilotoBean->getfotourlpng () != "") {
			$fotourl = $pilotoBean->getfotourlpng ();
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
	<span class="<?php echo $corRankingLinha; ?> "> <span class="fontRankingLinha"  
	style=" background: url('<?php echo $imageRankingLinha;?>');background-repeat: no-repeat;"
	><?php echo $posicaoRanking;?> - <?php echo strtoupper($apelido);?></span>
		</span>	
<?php
}
?>	
<span id="vemaqui" class="fontRankingLinha"> Ranking </span>
	</div>

</div>
