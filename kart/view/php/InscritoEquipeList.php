<?php
$novo = $selcampeonato > 0;
include_once PATHPUBPHPINCLUDE . '/headerList.php';
Util::echobr ( 0, 'InscritoEquipeControl  $cltCampeonatoSelecionar', $cltCampeonatoSelecionar );
?>
<table border="0">
	<tr>
		<td>Campeonato:</td>
		<td><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
						$selcampeonatobean = $cltCampeonatoSelecionar [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
</table>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?>    
		 <th class="header">Inscrito</th>
			<th class="header">Peso</th>
			<th class="header">Idade</th>
			<th class="header">Equipe</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$inscritoequipebean = new InscritoEquipeBean ();
		$inscritoequipebean = $collection [$i];
		// $corlinha = ($i%2==0)?"par":"impar";		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $inscritoequipebean->getid (), $idurl );
			echo $button->btExcluirImagem ( $inscritoequipebean->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>
		<td>
			<?php echo Util::getNomeObjeto($inscritoequipebean->getinscrito());?>
		</td>
			<td>
			<?php echo $inscritoequipebean->getinscrito()->getpeso();?>
		</td>
			<td>
			<?php echo $inscritoequipebean->getinscrito()->getidade();?>
		</td>
			<td>
			<?php echo Util::getNomeObjeto($inscritoequipebean->getequipe());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>

