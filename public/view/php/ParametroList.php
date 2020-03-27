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
		  <th class="header">Codigo</th>
			<th class="header">Valor</th>
			<th class="header">Data Validade</th>
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
			<?php echo $collection[$i]->getcodigo();?>
    </td>
			<td>
			<?php echo $collection[$i]->getvalor();?>
		</td>
			<td>
			<?php echo $collection[$i]->getdtvalidade();?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
