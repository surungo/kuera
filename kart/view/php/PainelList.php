<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    <?php
				if ($editar == true) {
					?> 
      <th class="headerlink">&nbsp;</th> 
		<?php
				}
				?> 
    		<th class="header">usuario</th>
			<th class="header">bateria</th>
			<th class="header">etapa</th>
			<th class="header">campeonato</th>
			<th class="header">fase</th>
			<th class="header">taxaatualizacao</th>
<?php if(false){ ?>				
			<th class="header">col01</th>
			<th class="header">col02</th>
			<th class="header">col03</th>
			<th class="header">col04</th>
			<th class="header">col05</th>
			<th class="header">col06</th>
			<th class="header">col07</th>
			<th class="header">col08</th>
			<th class="header">col09</th>
			<th class="header">col10</th>
			<th class="header">col11</th>
			<th class="header">col12</th>
			<th class="header">col13</th>
			<th class="header">col14</th>
			<th class="header">col15</th>
			<th class="header">col16</th>
			<th class="header">col17</th>
			<th class="header">col18</th>
<?php } ?>	
		</tr>
	</thead>

	<tbody>
	<?php

	for($i = 0; $i < count ( $collection ); $i ++) {
		$painelBeanItem = new PainelBean ();
		$painelBeanItem = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $painelBeanItem->getid (), $idurl );
			echo $button->btExcluirImagem ( $painelBeanItem->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td><?php echo $painelBeanItem->getusuario();?></td>
			<td><?php echo $painelBeanItem->getbateria();?></td>
			<td><?php echo $painelBeanItem->getetapa();?></td>
			<td><?php echo $painelBeanItem->getcampeonato();?></td>
			<td><?php echo $painelBeanItem->getfase();?></td>
			<td><?php echo $painelBeanItem->gettaxaatualizacao();?></td>
<?php if(false){ ?>		
		<td><?php echo $painelBeanItem->getcol01();?></td>
			<td><?php echo $painelBeanItem->getcol02();?></td>
			<td><?php echo $painelBeanItem->getcol03();?></td>
			<td><?php echo $painelBeanItem->getcol04();?></td>
			<td><?php echo $painelBeanItem->getcol05();?></td>
			<td><?php echo $painelBeanItem->getcol06();?></td>
			<td><?php echo $painelBeanItem->getcol07();?></td>
			<td><?php echo $painelBeanItem->getcol08();?></td>
			<td><?php echo $painelBeanItem->getcol09();?></td>
			<td><?php echo $painelBeanItem->getcol10();?></td>
			<td><?php echo $painelBeanItem->getcol11();?></td>
			<td><?php echo $painelBeanItem->getcol12();?></td>
			<td><?php echo $painelBeanItem->getcol13();?></td>
			<td><?php echo $painelBeanItem->getcol14();?></td>
			<td><?php echo $painelBeanItem->getcol15();?></td>
			<td><?php echo $painelBeanItem->getcol16();?></td>
			<td><?php echo $painelBeanItem->getcol17();?></td>
			<td><?php echo $painelBeanItem->getcol18();?></td>
	<?php }?>
	</tr>
	<?php }?>
  </tbody>
</table>
<?php

if (false) {
	$arrayColunas = array (
			"edit" => "0",
			"usuario" => "1",
			"bateria" => "2",
			"etapa" => "3",
			"campeonato" => "4",
			"fase" => "5",
			"taxaatualizacao" => "6",
			"col01" => "7",
			"col02" => "8",
			"col03" => "9",
			"col04" => "10",
			"col05" => "11",
			"col06" => "12",
			"col07" => "13",
			"col08" => "14",
			"col09" => "15",
			"col10" => "16",
			"col11" => "17",
			"col12" => "18",
			"col13" => "19",
			"col14" => "20",
			"col15" => "21",
			"col16" => "22",
			"col17" => "23",
			"col18" => "24"
	);
	$arrayMostrarColunas = $arrayColunas;
	$arrayOcultarColunas = array (
			// $arrayColunas["usuario"],
			// $arrayColunas["bateria"],
			// $arrayColunas["etapa"],
			// $arrayColunas["campeonato"],
			// $arrayColunas["fase"],
			// $arrayColunas["taxaatualizacao"],
			$arrayColunas ["col01"],
			$arrayColunas ["col02"],
			$arrayColunas ["col03"],
			$arrayColunas ["col04"],
			$arrayColunas ["col05"],
			$arrayColunas ["col06"],
			$arrayColunas ["col07"],
			$arrayColunas ["col08"],
			$arrayColunas ["col09"],
			$arrayColunas ["col10"],
			$arrayColunas ["col11"],
			$arrayColunas ["col12"],
			$arrayColunas ["col13"],
			$arrayColunas ["col14"],
			$arrayColunas ["col15"],
			$arrayColunas ["col16"],
			$arrayColunas ["col17"],
			$arrayColunas ["col18"]
	);
	$arrayMostrarColunas = array_diff ( $arrayColunas, $arrayOcultarColunas );

	?>
<script>
	$(document).ready(function() {
		tableGB = $('.listTable').DataTable(tableOptions); 
		tableGB.destroy();
       // tableOptions.bPaginate = false;
        tableGB = $('.listTable').DataTable(tableOptions);  
		tableGB.columns( [<?php echo implode(",",$arrayMostrarColunas);?>] ).visible( true );
		tableGB.columns( [<?php echo implode(",",$arrayOcultarColunas);?>] ).visible( false );
		
		tableGB.columns.adjust().draw();

			});
	</script>
<?php
}
?>