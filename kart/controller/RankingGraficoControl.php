<?php
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';

$p1 = isset ( $_GET ['p1'] ) ? $_GET ['p1'] : 29;

$arrPilotos = array (
		$p1,
		74,
		55,
		30,
		12 
);
$idcampeonato = 1;
$pilotoBateriaBusiness = new PilotoBateriaBusiness ();

$retorno = $pilotoBateriaBusiness->findGraficoData ( $idcampeonato, $arrPilotos );

echo $retorno;

?>