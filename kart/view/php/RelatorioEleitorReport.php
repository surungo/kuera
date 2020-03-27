<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
$porcentagemGeral = round( ($totalVotosGeral*100) /$totalEleitorGeral );
$porcentagemEleitoresGeral = round( ($totalEleitoresVotaramGeral*100) /$totalEleitoresGeral );

?>
<table class="littleTable">
	<thead>
		<tr>
    		<th class="header" align="center">Porcentagem Votos</th>
	 		<th class="header" align="center">Total Votos</th>
			<th class="header" align="center">Total Votos Possíveis</th>
	</tr>
	</thead>
	<tr>
		<td align="center">
			<?php echo $porcentagemGeral;?>%
		</td>
		<td align="center">
			<?php echo $totalVotosGeral;?>
		</td>
		<td align="center">
			<?php echo $totalEleitorGeral;?>
		</td>
	</tr>
	<thead>
		<th class="header" align="center">Porcentagem Eleitores</th>
	 		<th class="header" align="center">Total Eleitores Votaram</th>
			<th class="header" align="center">Total Eleitores Geral</th>
		</tr>
	</thead>
	<tr>
		<td align="center">
			<?php echo $porcentagemEleitoresGeral;?>%
		</td>
		<td align="center">
			<?php echo $totalEleitoresVotaramGeral;?>
		</td>
		<td align="center">
			<?php echo $totalEleitoresGeral;?>
		</td>
		
	</tr>
</table>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    		<th class="header">&nbsp;</th>
			<th class="header">Grupo</th>
			<th class="header">Porcentagem Votos</th>
			<th class="header">Total Votos</th>
			<th class="header">Total Votos Possíveis</th>
		</tr>
	</thead>

	<tbody>
	<?php
for($i = 0; $i < count ( $grupoclt ); $i ++) {
		$grupoBean = new GrupoBean();
		$grupoBean = $grupoclt [$i];
		$totalVotos = $votoBusiness->totalVotosByGrupo($grupoBean);
		$totalEleitor =$eleitoBusiness->totalByGrupo($grupoBean);
		if($totalEleitor>0){
			$porcentagem = round( ($totalVotos*100) /$totalEleitor,1);
		}else{
			$porcentagem=0;
		}
		
		/*
		$totalVotosGeral+=$totalVotos;
		
		$totalEleitorGeral+=$totalEleitor;*/
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<td>
		<?php
			echo $button->btEditar ( Util::getIdObjeto($grupoBean), $idurl );
		?>
		</td>
		<td>
			<?php echo Util::getNomeObjeto($grupoBean);?>
		</td>
		<td>
			<?php echo $porcentagem;?>%
		</td>
		<td>
			<?php echo $totalVotos;?>
		</td>
				<td>
			<?php echo $totalEleitor;?>
		</td>
	</tr>
	<?php }
	?>
	  </tbody>
</table>
  

