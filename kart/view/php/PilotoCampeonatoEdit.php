<?php
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<?php 

//echo $button->btVoltar($idobj);
//echo $button->btSEV($idobj,$idurl); 
//echo $button->btCustom($idurl,$idobj,"Voltar",$target,Choice::VOLTAR); ?>

<TABLE>
	<TR>
		<TD>Piloto</TD>
		<TD><select class="css_select" id="piloto" name="piloto">
								
					<?php
					if ($idobj < 1) {
						?>
						<option value="0">Selecione...</option>
					<?php
					}
					for($i = 0; $i < count ( $cltPilotoSelecionar ); $i ++) {
						$beanPiloto = new PilotoBean ();
						$beanPiloto = $cltPilotoSelecionar [$i];
						if ($bean->getpiloto () != null && $bean->getpiloto ()->getid () > 0) {
							$idpiloto = $bean->getpiloto ()->getid ();
						}
						?>
			    		<option value="<?php echo $beanPiloto->getid();?>"
					<?php echo ($idpiloto==$beanPiloto->getid())?"selected='selected'":""; ?>><?php echo  $beanPiloto->getnrpiloto();?> - <?php echo  $beanPiloto->getnome();?></option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Campeonato</TD>
		<TD><select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="">Todos</option>
  <?php
		
		for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
			$campeonatobean = $cltCampeonatoSelecionar [$i];
			?>
    <option value="<?php echo $campeonatobean->getid();?>"
		<?php echo ($campeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $campeonatobean->getnome();?></option>
  <?php
		}
		?>
</select></TD>
	</TR>


	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>

	<TR>
		<TD>
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
		<TD></TD>
	</TR>
</TABLE>
