<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';

?>

<?php echo $button->btVoltar2($idurl); ?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    		<th class="header">&nbsp;</th>
			<th class="header">Eleitores</th>
			<th class="header">Opções de Votos</th>
			<th class="header">Opções Votadas</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$totalVotosGeral = 0;
	$totalEleitorGeral = 0;
for($i = 0; $i < count ( $resultadoVotos ); $i ++) {
		$candidatoItem =$resultadoVotos[$i];
		$nome = $candidatoItem['eleitor'];
		$opcoesVotos = $candidatoItem['opcoes'];
		$votadavotos = $candidatoItem['votado'];
		
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<td>
		&nbsp;
		</td>
		<td>
			<?php echo $nome;?>
		</td>
		<td>
			<?php echo $opcoesVotos;?>
		</td>
				<td>
			<?php echo $votadavotos;?>
		</td>
	</tr>
<?php }?>
  </tbody>
</table>
  
