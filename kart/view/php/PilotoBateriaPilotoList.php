<?php 
echo $button->btCustom($idurl,$idobj,"Voltar",$target,Choice::VOLTAR); ?>
<script>
function addPiloto(idpiloto){
	$("#piloto").val(idpiloto);
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
    <th class="header">Foto</th>
			<th class="header">N&uacute;mero</th>
			<th class="header">Nome</th>
			<th class="header">Idade</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $cltPilotoSelecionar ); $i ++) {
		$pilotoSelectBean = $cltPilotoSelecionar [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td><input id='custom' name='custom' value='custom' type='image'
				title='<?php echo $pilotoSelectBean->getid(); ?>'
				onclick="javascript:addPiloto(<?php echo $pilotoSelectBean->getid(); ?>)"
				src="mvc/public/view/images/add.png"
				style='border: 0px; color: white; background-color: transparent;' />

			</td>     
		<?php
		}
		?>    
		<td><img border="1" width="60"
				src="<?php echo $pilotoSelectBean->getfotourl();?>" /></td>
			<td>
			<?php echo str_pad($pilotoSelectBean->getid(),3,"0",STR_PAD_LEFT);?>
		</td>
			<td>
			<?php echo $pilotoSelectBean->getnome();?>
		</td>
			<td>
			<?php echo $pilotoSelectBean->getidade();?>
		</td>
		</tr>
	<?php }?>
  	</tbody>
</table>
<div style="display: none;">
<?php include 'mvc/' . $sistemaBean->getcodigo() . '/view/php/PilotoBateriaEdit.php';?>
</div>
