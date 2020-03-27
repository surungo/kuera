<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    		<th class="header">&nbsp;</th>
			<th class="header">Grupo</th>
			<th class="header">Canditato</th>
			<th class="header">Total Votos</th>
		</tr>
	</thead>

	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$candidatosObj = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<td>&nbsp;</td>
		<td>
			<?php echo $candidatosObj['grupo'];?>
		</td>
		<td>
			<?php echo $candidatosObj['candidato'];?>
		</td>
			<td>
			<?php echo $candidatosObj['total'];?>
		</td>
	</tr>
	<?php }?>
  </tbody>
</table>
