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
			<th class="header">Nome</th>
			<th class="header">Valor normal</th>
			<th class="header">Valor desc cat</th>
			<th class="header">Valor desc evento</th>
		</tr>
	</thead>

	<tbody>
	<?php

for($i = 0; $i < count ( $collection ); $i ++) {
		$listcampeonatobean = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?>
		<td>
		<?php
			echo $button->btEditar ( $listcampeonatobean->getid (), $idurl );
			//echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
			if($listcampeonatobean->isvalidade()){
				echo $button->btDesativar( $listcampeonatobean->getid (), $idurl );
			}else{
				echo $button->btValidar( $listcampeonatobean->getid (), $idurl );
			}
			?>
		</td>
		<?php
		}
		?>
		<td>
			<?php echo $listcampeonatobean->getnome();?>
		</td>
		<td>
			<?php echo $listcampeonatobean->getvalor();?>
    	</td>
		<td>
			<?php echo $listcampeonatobean->getvalorporextenso();?>
		</td>
    	<td>
			<?php echo $listcampeonatobean->getvalorpaypal();?>
		</td>
    	</tr>
	<?php }?>
  </tbody>
</table>
