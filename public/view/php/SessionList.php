<?php
include "include/headerList.php";
?>
<table class="list" cellspacing="0" cellpadding="0" border="0">
	<tr><?php
	if ($editar == true) {
		?> 
		<td class="headerlink">&nbsp;</td> 
		<?php
	}
	?>    
		<td class="header" width="200px">Keysession</td>
		<td class="header" width="200px">Usuario</td>
		<td class="header" width="200px">IP</td>
		<td class="header" width="200px">Data Criacao</td>
		<td class="header" width="200px">Data Modificacao</td>

	</tr>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		$sessionBean = new SessionBean ();
		$sessionBean = $collection [$i];
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $sessionBean->getid (), $idurl );
			echo $button->btExcluirImagem ( $sessionBean->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $sessionBean->getkeysession();?>
		</td>
		<td>
   	 		<?php echo Util::getNomeObjeto($sessionBean->getusuario());?>
   	 	</td>
		<td>
   	 		<?php echo $sessionBean->getip();?>
   	 	</td>
   	 	<td>
			<?php echo $sessionBean->getdtcriacao();?>
		</td>
		
		<td>
			<?php echo $collection[$i]->getdtmodificacao();?>
		</td>
		
	</tr>
	<?php }?>
</table>
