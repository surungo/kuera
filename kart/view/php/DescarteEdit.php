<?php
$dbg = 1;
Util::echobr ( $dbg, 'DescarteEdit ', 1);

include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
$idinput = "btHidden";


?>
	<style>
	.classEtapa{
		border:1px solid black;
		font-size:11px;
	}
	.classChecked{
		font-weight: bold;
	}
	</style>
<TABLE>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
		</TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo $button->btSEV2($idobj,$idurl); ?>
		</TD>
	</TR>
	<TR>
		<TD>Sigla</TD>
		<TD><INPUT id="sigla" name="sigla" size="30" type="text"
			value="<?php echo $bean->getsigla();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Numero</TD>
		<TD><INPUT id="numero" name="numero" size="30" type="text"
			value="<?php echo $bean->getnumero();?>"></TD>
	</TR>

	<TR>
		<TD>Campeonato</TD>
		<TD><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
				  <?php
						
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$selcampeonatobean = $selcampeonatoCollection [$i];
					?>
				    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
				  <?php
					}
				?>
				</select></TD>
	</TR>
	<TR>
		<TD>Descarte Etapas</TD>
		<TD><?php
		for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
			$opsetapabean = $seletapaCollection [$i];
		        $rankingetapabean = new RankingEtapaBean();
		        $rankingetapabean->setranking($bean);
		        $rankingetapabean->setetapa($opsetapabean);
		        $rankingEtapaBusiness = new RankingEtapaBusiness();
		        $selecionadoEtapaRTrue = $rankingEtapaBusiness->hasetapa($rankingetapabean);
		        
			?>
			<span class="classEtapa  <?php echo ( $selecionadoEtapaRTrue )?"classChecked":"";?>">	
			 <input type="checkbox" id="etapas" name="etapas[]" value="<?php echo $opsetapabean ->getid();?>" 
		        <?php
		        echo ( $selecionadoEtapaRTrue )?"checked":"";
		        ?> 
		        /><?php echo $opsetapabean ->getnome();?>
		        </span>
		<?php
		
		} 
		?>
			
		</TD>
	</TR>
	<TR>
		<TD>Quantidade de Descartes</TD>
		<TD><INPUT id="quantidade" name="quantidade" size="30" type="text"
			value="<?php echo $bean->getquantidade();?>"></TD>
	</TR>
	<script>
$(document).ready(function() {
  $("#dtinicio").mask("99/99/9999 99:99:99");
  
});
</script>
	<TR>
		<TD>Data mostrar</TD>
		<TD><INPUT id="dtinicio" name="dtinicio" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtinicio());?>"></TD>
	</TR>

</TABLE>