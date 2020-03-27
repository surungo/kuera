<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="headerlink">&nbsp;</th> 
			<th class="header">Data</th>
			<th class="header">Partida</th>
			<th class="header">Placar1</th>
			<th class="header">Placar2</th>
			<th class="header">Peso</th>
		</tr>
	</thead>

	<tbody>
	<?php
	for($i = 0; $i < count ( $collection ); $i ++) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
		<tr class="<?php echo $corlinha;?>">
    		<td>
    		<?php
    		  if ($editar == true) {
    		      echo $button->btEditar ( $collection [$i]->getid (), $idurl );
                  echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
    		  }
    	     ?>
    		</td>     
    		<td>
    			<?php echo Util::timestamptostr('d/m/Y H:i:s',$collection[$i]->getdtpartida());?>
    	    </td>
    		<td>
    			<?php echo $collection[$i]->getnome();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getplacar1();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getplacar2();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getpeso();?>
    		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
<?php
  echo $button->btValidar($idobj, $idurl);
 ?> Atualizar todas apostas
