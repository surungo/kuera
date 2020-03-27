Campeonato:
<?php if(true){?>
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="0">Todos</option>
  <?php

		for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
			$campeonatobean = $cltCampeonatoCollection [$i];
			?>
    <option value="<?php echo $campeonatobean->getid();?>"
		<?php echo ($campeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $campeonatobean->getnome();?></option>
  <?php
		}
		?>
</select>
<?php if(false){?>
<br>
<input type="checkbox" id="allevents" name="allevents" 
<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>
<?php echo ($allevents==1)?"checked":"" ?>>
<small>Todos eventos</small>
<?php }
	}else{ ?>
	<input type="hidden" value="<?php echo $selcampeonato;?>">
	<?php echo Util::getNomeObjeto($selcampeonatoBean);?>
<?php }?>