<?php
$novo = $selbateria > 0;
include_once PATHPUBPHPINCLUDE . '/headerList.php';

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
					
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$selcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
	<tr>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
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
		</td>
	</tr>
	<tr>
		<td>Baterias:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;">
			<?php
			for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
				$listbateriabean = $selbateriaCollection [$i];
				echo $button->btCustom($idurl, Util::getIdObjeto($listbateriabean), Util::getNomeObjeto($listbateriabean),$target,Choice::ABRIR);
			}
			?>
		</td>
	</tr>
</table>