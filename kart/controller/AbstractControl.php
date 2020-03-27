<?php
if (isset ( $_POST ['selcampeonato'] )) {
	$SESSION ['selcampeonato'] = $_POST ['selcampeonato'];
}
$selcampeonato = ((isset ( $SESSION ['selcampeonato'] )) ? $SESSION ['selcampeonato'] : null);

if (isset ( $_POST ['seletapa'] )) {
	$SESSION ['seletapa'] = $_POST ['seletapa'];
}
$seletapa = ((isset ( $SESSION ['seletapa'] )) ? $SESSION ['seletapa'] : null);

?>