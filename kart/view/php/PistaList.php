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
		  <th class="header">Local</th>
			<th class="header">Nome</th>
			<th class="header">Sentido</th>
		</tr>
	</thead>

	<tbody>
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
			<?php echo $collection[$i]->getlocal();?>
    </td>
			<td>
			<?php echo $collection[$i]->getnome();?>
		</td>
			<td>
			<?php echo $collection[$i]->getsentido();?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
