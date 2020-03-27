<?php
include "include/headerList.php";
?>
<table class="list" cellspacing="0" cellpadding="0" border="0">
	<tr><?php
	if ($editar == true) {
		?> 
		<td class="headerlink">&nbsp;</td> 
		<?php
	}
	?>    
		<td class="header" width="200px">Tabela</td>
		<td class="header" width="200px">Id</td>
	</tr>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btExcluirImagem ( $collection [$i]->gettabela (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->gettabela();?>
		</td>
		<td>
			<?php echo $collection[$i]->getid();?>
		</td>
	</tr>
	<?php }?>
</table>
