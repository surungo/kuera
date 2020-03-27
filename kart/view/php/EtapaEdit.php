<?php
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Sigla</TD>
		<TD><INPUT id="sigla" name="sigla" size="30" type="text"
			value="<?php echo $bean->getsigla();?>"></TD>
	</TR>
	<TR>
		<TD>Numero</TD>
		<TD><INPUT id="numero" name="numero" size="30" type="text"
			value="<?php echo $bean->getnumero();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Data Resultado</TD>
		<TD><INPUT id="dtresultado" name="dtresultado" size="30" type="text"
			value="<?php echo $bean->getdtresultado();?>"></TD>
	</TR>
	<TR>
		<TD>Data Grid</TD>
		<TD><INPUT id="dtgrid" name="dtgrid" size="30" type="text"
			value="<?php echo $bean->getdtgrid();?>"></TD>
	</TR>
	<TR>
		<TD>Data Ranking</TD>
		<TD><INPUT id="dtranking" name="dtranking" size="30" type="text"
			value="<?php echo $bean->getdtranking();?>"></TD>
	</TR>
	<TR>
		<TD>Informações</TD>
		<TD><INPUT id="info" name="info" size="30" type="text"
			value="<?php echo $bean->getinfo();?>"></TD>
	</TR>
	<TR>
		<TD>Campeonato</TD>
		<TD><select class="css_select" id="campeonato" name="campeonato">
								
		<?php
		for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
			$beanCampeonato = new CampeonatoBean ();
			$beanCampeonato = $selcampeonatoCollection [$i];
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
	<script>
$(document).ready(function() {
  $("#dtinicio").mask("99/99/9999 99:99:99");
  
});
</script>
	<TR>
		<TD>Data mostrar etapa</TD>
		<TD><INPUT id="dtinicio" name="dtinicio" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtinicio());?>"></TD>
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
