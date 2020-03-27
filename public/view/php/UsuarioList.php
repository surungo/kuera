<?php
require_once (PATHPUBBEAN . '/PerfilBean.php');
require_once (PATHPUBBUS . '/PerfilBusiness.php');
$perfilBean = new PerfilBean ();
$perfilBusiness = new PerfilBusiness ();
include "include/headerList.php"?>
<table class="list" cellspacing="0" cellpadding="0" border="0">
	<tr><?php
	if ($editar == true) {
		?> 
		<td class="headerlink">&nbsp;</td> 
		<?php
	}
	?>    
		<td class="header" width="200px">Nome</td>
		<td class="header" width="200px">E-mail</td>
		<td class="header" width="200px">Usuario</td>
		<td class="header" width="200px">Perfil</td>
	</tr>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		$perfilBean = $perfilBusiness->findById ( $collection [$i]->getperfil () );
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
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getnome();?></td>
		<td>
			<?php echo $collection[$i]->getemail();?></td>
		<td>
   	 		<?php echo $collection[$i]->getusuario();?></td>
		<td>
   	 		<?php echo $perfilBean->getnome();?></td>
	</tr>
	<?php }?>
</table>


