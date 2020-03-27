<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
Idade Media: <?php echo $idademedia;?> &nbsp;&nbsp;&nbsp;Peso Medio: <?php echo $pesomedio;?>
<br>
Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="">Todos</option>
  <?php
		
		for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
			$campeonatobean = $cltCampeonatoSelecionar [$i];
			?>
    <option value="<?php echo $campeonatobean->getid();?>"
		<?php echo ($campeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $campeonatobean->getnome();?></option>
  <?php
		}
		?>
</select>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?>    
		<th class="header">&nbsp;</th>
			<th class="header">Nome</th>
			<th class="header">CPF</th>
			<th class="header">Idade</th>
			<th class="header">Peso</th>
		<?php
		if ($selcampeonato == "") {
			?>	
			<th class="header">Campeonato</th>
		<?php
		}
		?> 			
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
		<td><img border="0" width="60"
				src="<?php echo $collection[$i]->getpiloto()->getfotoFilePNG("round");?>">
			</td>
			<td>
			<?php echo $collection[$i]->getpiloto()->getnome();?>
			<?php echo $button->btEditar($collection[$i]->getpiloto()->getid(),40);?>
    	</td>
			<td>
			<?php echo $collection[$i]->getpiloto()->getcpf();?>
    	</td>
			<td>
			<?php echo $collection[$i]->getpiloto()->getidade();?>
    	</td>
		<td>
			<?php echo $collection [$i]->getpiloto ()->getpeso ();?>
		</td>
		<?php
		if ($selcampeonato == "") {
			?>	
    	<td>
			<?php echo Util::getNomeObjeto($collection [$i]->getcampeonato ());?>
		</td>
		<?php }?>
	</tr>
	<?php }?>
  </tbody>
</table>
