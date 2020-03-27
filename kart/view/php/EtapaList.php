<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?> 
Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="0">Todos</option>
  <?php
		
		for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
			$icampeonatobean = $selcampeonatoCollection [$i];
			?>
    <option value="<?php echo $icampeonatobean->getid();?>"
		<?php echo ($icampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $icampeonatobean->getnome();?></option>
  <?php
		}
		?>
</select>
&nbsp;
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<?php
			if ($editar == true) {
				?> 
			<th class="headerlink">&nbsp;
			
			</td> 
			<?php
			}
			?>    
			<!-- <th class="header" width="100px">Codigo</td> -->
			<th class="header">Sigla</th>
			<th class="header">Nome</th>
			<th class="header">Mostrar em</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		
		$etapaBean = new EtapaBean ();
		$etapaBean = $collection [$i];
		
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
			<?php echo $etapaBean->getsigla();?>
	    </td>
			<td>
				<?php echo $etapaBean->getnome();?>
	    </td>
			<td>
				<?php echo Util::timestamptostr('d/m/Y H:i:s',$etapaBean->getdtinicio());?>
	    </td>
		</tr>
	<?php }?>
  </tbody>
</table>
