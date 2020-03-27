<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';

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
&nbsp;&nbsp;Etapa:
<select id="etapa" name="etapa" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="">Todas</option>
  <?php
		echo count ( $seletapaCollection );
		for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
			$seletapabean = $seletapaCollection [$i];
			?>
    <option value="<?php echo $seletapabean->getid();?>"
		<?php echo ($seletapabean->getid()==$seletapa)?"selected":"";?>><?php echo $seletapabean->getnome();?></option>
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
			<th class="header">Pilotos</th>
		<?php
		}
		?>    
 		<th class="header">Nome</th>
		<th class="header">Sigla</th>
                <th class="header">Etapa</th>
                <th class="header">Pista</th>
                <th class="header">Esquema Pontuação</th>
                <th class="header">Categoria</th>
	    </tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$nomePista = "";
		$nomeEtapa = "";
		try {
		    if ($collection [$i]->getpista () != null) {
		        $nomePista = $collection [$i]->getpista ()->getnome ();
		    }
		    if ($collection [$i]->getetapa () != null) {
		        $nomeEtapa = Util::getNomeObjeto($collection [$i]->getetapa ());
		    }
		    
		} catch ( Exception $e ) {
			$nomePista = "";
			$nomeEtapa = "";
		}
		
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
			<td>
			<?php
			echo $button->btEditar ( $collection [$i]->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getnome();?>
                </td>
		<td>
			<?php echo $collection[$i]->getsigla();?>
                </td>
			<td>
			<?php
			 echo $nomeEtapa;
		?>
		</td><td>
			<?php
                echo $nomePista;
		?>
		</td>
			<td>
			<?php
		
                echo $collection [$i]->getpontuacaoesquema ()->getnome ();
		?>
		</td>
			<td>
			<?php echo Util::getNomeObjeto($collection [$i]->getcategoria());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
	
</table>
