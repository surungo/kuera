<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?> 
    <th class="header">Foto</th>
			<th class="header">N&uacute;mero</th>
			<th class="header">Nome</th>
			<th class="header">CPF</th>
			<th class="header">Idade</th>
			<th class="header">Peso</th>
			<th class="header">&nbsp;</th>
			<th class="header">&nbsp;</th>
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
		<td><img border="1" width="60"
				src="<?php echo $collection[$i]->getfotourl();?>" /></td>
			<td>
			<?php echo $collection[$i]->getnrpiloto();?>
		</td>
			<td>
			<?php echo $collection[$i]->getnome();?>
		</td>
			<td>
			<?php echo $collection[$i]->getcpf();?>
		</td>
			<td>
			<?php echo $collection[$i]->getidade();?>
		</td>
			<td>
			<?php echo $collection[$i]->getpeso();?>
		</td>
			<td>
			<?php
		if ($collection [$i]->getfacebook () != "") {
			$btnFacebook = URLAPP . '/mvc/public/view/images/btn-facebook.png';
			?><a border="0" href="<?php echo $collection[$i]->getfacebook();?>"
				target="_blank"> <img border="0" width="30px"
					src="<?php echo $btnFacebook;?>" />
			</a>	
		 <?php
		} 
		?>
		</td>
		<td>
		<?php
		if(Util::getIdObjeto($collection[$i]->getpessoa()) < 1)
			echo "Sem Pessoa"
		?>
		</td>
		</tr>
	<?php }?>
  	</tbody>
</table>
