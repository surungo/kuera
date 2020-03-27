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
			<th class="header">Nome</th>
			<th class="header">Quantidade</th>
			<th class="header">Etapas</th>
			<th class="header">Data Mostrar</th>
		</tr>
	</thead>
	<tbody>
		<?php
		for($i = 0; $i < count ( $collection ); $i ++) {
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
			$descarteBean = $collection [$i];
			//$etapa = gettype ( $collection [$i]->getetapa () ) == "object" ? $collection [$i]->getetapa ()->getsigla () : $collection [$i]->getetapa ();
			
			?>
		<tr class="<?php echo $corlinha;?>">
			<?php
			if ($editar == true) {
				?> 
		<td>
			<?php
				echo $button->btEditar ( $descarteBean->getid (), $idurl );
				echo $button->btExcluirImagem ( $descarteBean->getid (), $idurl );
				?>
		</td>  		
			<?php
			}
			?>    
		<td>
			<?php echo $descarteBean->getnome();?>
		</td>
		<td>
			<?php echo $descarteBean->getquantidade();?>
		</td>
		<td>
			<?php echo $etapa;?>
		</td>
		<td>
			<?php echo Util::timestamptostr('d/m/Y H:i:s',$collection[$i]->getdtinicio());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
	
</table>
