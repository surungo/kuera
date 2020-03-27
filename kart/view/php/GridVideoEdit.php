<input type="hidden" id="campeonato" name="campeonato" value="<?php echo $selcampeonato;?>" ?>
<input type="hidden" id="etapa" name="etapa" value="<?php echo $seletapa;?>" ?>
<input type="hidden" id="bateria" name="bateria" value="<?php echo $selbateria;?>" ?>

<?php
$urlgrid = URLAPPVER. '/kart/view/php/grid/';
$pathgrid = PATHAPP . '/mvc/kart/view/php/grid/';
include_once $pathgrid.'grid.php';

?>