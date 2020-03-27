<?php echo $button->btCustom($idurl,$idobj,"Voltar",$target,Choice::VOLTAR); ?>
<script>
function addInscrito(idinscrito){
	$("#inscrito").val(idinscrito);
	$('#idurl').val(<?php echo $idurl;?>);
	$('#choice').val(<?php echo Choice::SALVA_U;?>);
	$("#formDefault").submit();
}
</script>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?> 
    <th class="header">N&uacute;mero</th>
			<th class="header">Nome</th>
			<th class="header">Idade</th>
			<th class="header">Peso</th>
			<th class="header">Equipes</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $cltInscritoSelecionar ); $i ++) {
		$inscritoSelectBean = new InscritoBean ();
		$inscritoSelectBean = $cltInscritoSelecionar [$i];
		$inscritoEquipeBean = new InscritoEquipeBean ();
		$inscritoEquipeBean->setinscrito ( $inscritoSelectBean );
		$equipesClt = $inscritoEquipeBusiness->findByCampeonatoInscrito ( $inscritoEquipeBean );
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td><input id='custom' name='custom' value='custom' type='image'
				title='<?php echo $inscritoSelectBean->getid(); ?>'
				onclick="javascript:addInscrito(<?php echo $inscritoSelectBean->getid(); ?>)"
				src="mvc/public/view/images/add.png"
				style='border: 0px; color: white; background-color: transparent;' />

			</td>     
		<?php
		}
		?>    
		<td>
			<?php echo str_pad($inscritoSelectBean->getid(),3,"0",STR_PAD_LEFT);?>
		</td>
			<td>
			<?php echo $inscritoSelectBean->getnome();?>
		</td>
			<td>
			<?php echo $inscritoSelectBean->getidade();?>
		</td>
			<td>
			<?php echo $inscritoSelectBean->getpeso();?>
		</td>
			<td>
			<?php
		for($indexeq = 0; $indexeq < count ( $equipesClt ); $indexeq ++) {
			$inscritoEquipeItem = $equipesClt [$indexeq];
			echo Util::getNomeObjeto ( $inscritoEquipeItem->getEquipe () );
			?><br>
			<?php
		}
		?>
			
		</td>
		</tr>
	<?php }?>
  	</tbody>
</table>
<div style="display: none;">
<?php include 'mvc/' . $sistemaBean->getcodigo() . '/view/php/InscritoEquipeEdit.php';?>
</div>
