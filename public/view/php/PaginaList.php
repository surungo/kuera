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
		<td class="header" width="200px">Nome</td>
		<td class="header" width="200px">URL</td>
		<td class="header" width="200px">Ordem</td>
		<td class="header" width="200px">Hierarquia</td>
		<td class="header" width="200px">Target</td>
		<td class="header" width="200px">Sistema</td>
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
			echo $button->btEditar ( $collection [$i]->getid (), $idurl );
			echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getnome();?>
		</td>
		<td>
   	 		<?php echo $collection[$i]->geturl();?>
   	 	</td>
		<td>
   	 		<?php echo $collection[$i]->getordem();?>
   	 	</td>
		<td>
   	 		<?php echo $collection[$i]->gethierarquia(); ?>
   	 	</td>
		<td>
   	 		<?php echo sistema($collection[$i]->gettarget());		?>
   	 	</td>
		<td>
   	 		<?php echo $collection[$i]->getsistema(); ?>
   	 	</td>
	</tr>
	<?php }?>
</table>
<?php
function sistema($path) {
	switch ($path) {
		case 0 :
			return "Sites externos";
		case 1 :
			return "Gerenciador";
		case 2 :
			return "Tela Cheia";
	}
	return "";
}

?>
