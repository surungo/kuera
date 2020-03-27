<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
Mostrar inativos <input type="checkbox" name="showinativos" id="showinativos" value="S" <?php echo ($showinativos=="S")?"checked":"";?> 
class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
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
		  <th class="header">Sigla</th>
			<th class="header">Nome</th>
			<th class="header">Data Inicio</th>
			<th class="header">Data Validade</th>
		</tr>
	</thead>

	<tbody>
	<?php

for($i = 0; $i < count ( $collection ); $i ++) {
	$listcampeonatobean = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?>
		<td>
		<?php
			echo $button->btEditar ( $listcampeonatobean->getid (), $idurl );
			echo $button->btExcluirImagem ( $listcampeonatobean->getid (), $idurl );
			if($listcampeonatobean->isvalidade()){
				echo $button->btDesativar( $listcampeonatobean->getid (), $idurl );
			}else{
				echo $button->btValidar( $listcampeonatobean->getid (), $idurl );
			}
			?>
		</td>
		<?php
		}
		?>
		<td>
			<?php echo $listcampeonatobean->getsigla();?>
    		</td>
		<td>
			<?php echo $listcampeonatobean->getnome();?>
		</td>
		<td>
			<?php echo Util::timestamptostr('d/m/Y H:i:s',$listcampeonatobean->getdtinicio());?>
		</td>
		<td>
			<?php echo $listcampeonatobean->getdtvalidade();?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
