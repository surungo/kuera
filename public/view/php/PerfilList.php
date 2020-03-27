<?php
include "include/headerList.php"?>
<table class="list" cellspacing="0" cellpadding="0" border="0">
	<tr><?php
	if ($editar == true) {
		?> 
		<td class="headerlink">&nbsp;</td> 
		<?php
	}
	?>    
		<!-- <td class="header" width="100px">C�digo</td> -->
		<td class="header" width="200px">Nome</td>
		<td class="header" width="200px">Capa</td>
	</tr>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$beanPaginaSelect = $paginaBusiness->findById ( $collection [$i]->getpaginacapa () );
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $collection [$i]->getid (), $idurl );
			echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getnome();?></td>
		<td>
			<?php echo $beanPaginaSelect->getnome();?></td>
	</tr>
	<?php }?>
</table>
