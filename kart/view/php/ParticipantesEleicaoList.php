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
    		<th class="header">CPF</th>
			<th class="header">Nome</th>
			<th class="header">Peso</th>
			<th class="header">Idade</th>
		</tr>
	</thead>

	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$painelBeanItem = new PessoaBean ();
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
		<td><nobr><?php echo $painelBeanItem->getcpf();?></nobr></td>
			<td>
			<?php echo $painelBeanItem->getnome();?>
		</td>
			<td>
			<?php echo $painelBeanItem->getpeso();?>
		</td>
			<td>
			<?php echo $painelBeanItem->getidade();?>
		</td>
	</tr>
	<?php }?>
  </tbody>
</table>
