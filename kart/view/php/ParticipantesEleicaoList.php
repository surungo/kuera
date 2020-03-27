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
		$pessoaBeanItem = new PessoaBean ();
		$pessoaBeanItem = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $pessoaBeanItem->getid (), $idurl );
			echo $button->btExcluirImagem ( $pessoaBeanItem->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td><nobr><?php echo $pessoaBeanItem->getcpf();?></nobr></td>
			<td>
			<?php echo $pessoaBeanItem->getnome();?>
		</td>
			<td>
			<?php echo $pessoaBeanItem->getpeso();?>
		</td>
			<td>
			<?php echo $pessoaBeanItem->getidade();?>
		</td>
	</tr>
	<?php }?>
  </tbody>
</table>
