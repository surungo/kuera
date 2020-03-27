<?php
include_once PATHAPP . '/mvc/kart/model/bean/InscritoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/EquipeBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD><input type="hidden" id="campeonato" name="campeonato"
			value="<?php echo $selcampeonato;?>">
			<?php echo Util::getNomeObjeto($selcampeonatoBean);?> 
			 </TD>
	</TR>
	<TR>
		<TD>Equipe</TD>
		<TD><select class="btn_select" id="equipe" name="equipe"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<?php
				for($i = 0; $i < count ( $cltEquipeSelecionar ); $i ++) {
					$beanEquipe = new EquipeBean ();
					$beanEquipe = $cltEquipeSelecionar [$i];
					?>
			    		<option value="<?php echo $beanEquipe->getid();?>"
					<?php echo (Util::getIdObjeto($bean->getequipe())==$beanEquipe->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanEquipe->getnome();?>
						</option>
				<?php
				}
				?>
				</select> Total Inscritos: <?php echo $totalinscritoequipe;?>
			</TD>
	</TR>
	<TR>
		<TD>Inscrito</TD>
		<TD><input type="hidden" id="inscrito" name="inscrito"
			value="<?php echo Util::getIdObjeto($bean->getinscrito());?>">
	       		<?php
										if (Util::getIdObjeto ( $bean->getinscrito () ) > 0) {
											echo Util::getNomeObjeto ( $bean->getinscrito () );
											echo "<br><small><small>Trocar Inscrito </small></small>";
										} else {
											echo "<br><small><small>Adicionar Inscrito </small></small>";
										}
										echo ButtonClass::btCustomImagem ( $idobj, $idurl, Choice::ADICIONAR, "mvc/public/view/images/add.png" );
										?>
			</TD>
	</TR>

	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>

	<TR>
		<TD colspan="2">
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
		<TD></TD>
	</TR>
</TABLE>

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
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $inscritoEquipeClt ); $i ++) {
		$inscritoequipebean = new InscritoEquipeBean ();
		$inscritoequipebean = $inscritoEquipeClt [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
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
		</tr>
	<?php }?>
  </tbody>
</table>


