<!DOCTYPE html>
<html>
<head>
<title>Fotos</title>


<body>
<?php
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';

foreach ( $cltPiloto as $k => $piloto ) {
	$pilotoBean = new PilotoBean ();
	$pilotoBean = $piloto;
	
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
			$fotourl = $pilotoBean->getfotourlPNG ();
		}
	}
	// 6 14 15 20 77 42 35 64
	
	if ($pilotoBean->getfotoimg () != null && $pilotoBean->getid () == $idpiloto) {
		?>	
<img class="foto" src="<?php echo $fotourl;?>" />
<?php echo $apelido;?>
<?php
		
		// $img1 = file('http://127.0.0.1:4001/kart/mvc/kart/view/images/pilotopng.php?idobj='.$pilotoBean->getid());
		// $imF = addslashes(implode("",$img1));
		
		// $pilotoBean->setfotoimg($imF);
		
		// $retorno = $pilotoBusiness->salve($pilotoBean);
		// $idobj = $retorno->getresposta();
		// $mensagem = $retorno->getmensagem();
	}
}

?>
</body>
</html>
