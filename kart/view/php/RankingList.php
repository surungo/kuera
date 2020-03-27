<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
Util::echobr ( $dbg, 'RankingList ', 0);
?> 
Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="">Todos</option>
  <?php
		
		for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
			$selcampeonatobean = $selcampeonatoCollection [$i];
			?>
    <option value="<?php echo $selcampeonatobean->getid();?>"
		<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
  <?php
		}
		?>
</select>
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
			<th class="header">Data</th>
			<th class="header">Etapa</th>
			<th class="header">Descarte</th>
			<th class="header">Informação</th>
			<th class="header">Data Mostrar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		for($i = 0; $i < count ( $collection ); $i ++) {
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
			$etapa = gettype ( $collection [$i]->getetapa () ) == "object" ? $collection [$i]->getetapa ()->getsigla () : $collection [$i]->getetapa ();
			
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
			<?php echo Util::timestamptostr('d/m/Y H:i:s',$collection[$i]->getdtcriacao());?>
		</td>
			<td>
			<?php echo $etapa;?>
		</td>
			<td>
			<?php echo $collection[$i]->getdescarte();?>
		</td>
			<td>
			<?php echo $collection[$i]->getinfo();?>
		</td>
			<td>
			<?php echo Util::timestamptostr('d/m/Y H:i:s',$collection[$i]->getdtinicio());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
	<tfoot>
		<tr>
  			<?php
					if ($editar == true) {
						?> 
			<th class="headerlink">&nbsp;</th> 
			<?php
					}
					?>    
 			<th class="header">&nbsp;</th>
			<th class="header">&nbsp;</th>
			<th class="header">&nbsp;</th>
			<th class="header">&nbsp;</th>
			<th class="header">&nbsp;</th>

		</tr>
	</tfoot>
</table>
