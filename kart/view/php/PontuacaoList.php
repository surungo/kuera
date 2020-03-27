<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<div id="copiar" name="copiar" style="display: block;">
	De: <select class="css_select" id="pontuacaoesquemade"
		name="pontuacaoesquemade">
	<?php
	$pontuacaoesquemade = (isset ( $pontuacaoesquemade )) ? $pontuacaoesquemade : 0;
	for($i = 0; $i < count ( $cltPontuacaoEsquemaSelecionar ); $i ++) {
		$beanPontuacaoEsquema = new PontuacaoEsquemaBean ();
		$beanPontuacaoEsquema = $cltPontuacaoEsquemaSelecionar [$i];
		?>
    		<option value="<?php echo $beanPontuacaoEsquema->getid();?>"
			<?php echo ($pontuacaoesquemade==$beanPontuacaoEsquema->getid())?"selected='selected'":""; ?>><?php echo  $beanPontuacaoEsquema->getnome();?></option>
<?php
	}
	?>
</select> Para: <select class="css_select" id="pontuacaoesquemapara"
		name="pontuacaoesquemapara">
	<?php
	$pontuacaoesquemapara = (isset ( $pontuacaoesquemapara )) ? $pontuacaoesquemapara : 0;
	for($i = 0; $i < count ( $cltPontuacaoEsquemaSelecionar ); $i ++) {
		$beanPontuacaoEsquema = new PontuacaoEsquemaBean ();
		$beanPontuacaoEsquema = $cltPontuacaoEsquemaSelecionar [$i];
		?>
    		<option value="<?php echo $beanPontuacaoEsquema->getid();?>"
			<?php echo ($pontuacaoesquemapara==$beanPontuacaoEsquema->getid())?"selected='selected'":""; ?>><?php echo  $beanPontuacaoEsquema->getnome();?></option>
<?php
	}
	?>
</select>
<?php
echo $button->btCustom ( $idurl, $idobj, "Copiar", '', Choice::SALVA_U );
?>
</div>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?>    
		<!-- <th class="header" width="100px">Codigo</th> -->
			<th class="header" width="100px">Valor</th>
			<th class="header" width="100px">Posicao</th>
			<th class="header" width="100px">Esquema Pontua&ccedil;&atilde;o</th>
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
			<?php echo $collection[$i]->getvalor();?>
    </td>
			<td>
			<?php
		
echo $collection [$i]->getposicao ()->getnome ();
		?>
		</td>
			<td>
			<?php
		
echo $collection [$i]->getpontuacaoesquema ()->getnome ();
		?>
		</td>
		</tr>
	<?php
	}
	?>


</table>
