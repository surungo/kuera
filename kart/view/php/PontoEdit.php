<?php
/*
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Posição</TD>
		<TD><INPUT id="posicao" name="posicao" size="30" type="text"
			value="<?php echo $bean->getposicao();?>"></TD>
	</TR>
	<TR>
		<TD>Pontos</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalor();?>"></TD>
	</TR>
	<TR>
		<TD>Descartável</TD>
		<TD><select id="descartavel" name="descartavel">
				<option value="0"
					<?php echo ($bean->getdescartavel()==0)?"selected:selected":"";?>>Não</option>
				<option value="1"
					<?php echo ($bean->getdescartavel()==1)?"selected='selected'":"";?>>Sim</option>

		</select></TD>
	</TR>
	<TR>
		<TD>Campeonato</TD>
		<TD><select class="css_select" id="idcampeonato" name="idcampeonato">
								
					<?php
					for($i = 0; $i < count ( $cltCampeonatoSelecionar ); $i ++) {
						$beanCampeonato = new CampeonatoBean ();
						$beanCampeonato = $cltCampeonatoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanCampeonato->getid();?>"
					<?php echo ($bean->getidcampeonato()==$beanCampeonato->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanCampeonato->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Ativo</TD>
		<TD><select id="ativo" name="ativo">
				<option value="0"
					<?php echo ($bean->getativo()==0)?"selected:selected":"";?>>Não</option>
				<option value="1"
					<?php echo ($bean->getativo()==1)?"selected='selected'":"";?>>Sim</option>

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
<?php */ ?>
