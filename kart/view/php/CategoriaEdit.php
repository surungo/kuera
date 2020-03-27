<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD><select class="css_select" id="campeonato" name="campeonato">
								
					<?php
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$beanCampeonato = new CampeonatoBean ();
						$beanCampeonato = $cltCampeonatoCollection [$i];
						?>
			    		<option value="<?php echo $beanCampeonato->getid();?>"
					<?php echo ($bean->getcampeonato()==$beanCampeonato->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanCampeonato->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Valor</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalor();?>"></TD>
	</TR>
	<TR>
		<TD>Valor Lote 1(Ex.:100.00)</TD>
		<TD><INPUT id="valorlote1" name="valorlote1" size="30" type="text"
			value="<?php echo $bean->getvalorlote1();?>"></TD>
	</TR>
	<TR>
		<TD>Valor Lote 2(Ex.:200.00)</TD>
		<TD><INPUT id="valorlote2" name="valorlote2" size="30" type="text"
			value="<?php echo $bean->getvalorlote2();?>"></TD>
	</TR>
	<TR>
		<TD>Valor Lote 3(Ex.:300.00)</TD>
		<TD><INPUT id="valorlote3" name="valorlote3" size="30" type="text"
			value="<?php echo $bean->getvalorlote3();?>"></TD>
	</TR>
		<TR>
		<TD>Regulamento</TD>
		<TD><INPUT id="regulamento" name="regulamento" size="30" type="text"
			value="<?php echo $bean->getregulamento();?>"></TD>
	</TR>
		<TR>
		<TD>Requisitos</TD>
		<TD><INPUT id="requisitos" name="requisitos" size="30" type="text"
			value="<?php echo $bean->getrequisitos();?>"></TD>
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
	</TR>
</TABLE>
