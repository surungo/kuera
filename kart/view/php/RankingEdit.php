<?php
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
	<script>
	$( document ).ready(function(){
		/*$(".classEtapa").click(function(){
			if($(this).find("input").is(':checked')){
				$(this).find("input").attr('checked', false);
			}else{
				$(this).find("input").attr('checked', true);
			}
			
		});*/
	});

	</script>
<TABLE>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>
	<TR>
		<TD colspan="2">
				<?php
				if ($idobj == null) {
					echo $button->btNovo ( $idurl );
					?>
					&nbsp;&nbsp;&nbsp;
				<?php
				} else {
					echo $button->btSalvar ( $idobj, $idurl );
					?>
					&nbsp;&nbsp;&nbsp;
					<?php
					echo $button->btExcluir ( $idobj, $idurl );
					?>
					&nbsp;&nbsp;&nbsp;
				<?php
				}
				echo $button->btVoltar ( $idurl );
				?>
				&nbsp;&nbsp;&nbsp;
				
				
			</TD>
	</TR>
		<?php if($bean->getdtcriacao()!=null){?>
		<TR>
		<TD>Data Cria&ccedil;&atilde;o</TD>
		<TD><?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtcriacao());?></TD>
	</TR>
		<?php } ?>
		<?php if($bean->getdtmodificacao()!=null){?>
		<TR>
		<TD>Data Atuali&ccedil;&atilde;o</TD>
		<TD><?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtmodificacao());?></TD>
	</TR>
		<?php } ?>
		<TR>
		<TD>Informa&ccedil;&atilde;o</TD>
		<TD><INPUT id="info" name="info" size="30" type="text"
			value="<?php echo $bean->getinfo();?>"></TD>
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
		<TD>Etapa</TD>
		<TD><select id="etapa" name="etapa">
				<option value="">Obrigatorio</option>
				  <?php
						
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$seletapabean = $seletapaCollection [$i];
							?>
				    <option value="<?php echo $seletapabean->getid();?>"
					<?php echo ($seletapabean->getid()==$seletapa)?"selected":"";?>><?php echo $seletapabean->getnome();?></option>
				  <?php
						}
						?>
				</select></TD>
	</TR>

	<TR>
		<TD>Ranking das Etapas</TD>
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
		<TD>N&uacute;mero de Descartes</TD>
		<TD><INPUT id="descarte" name="descarte" size="30" type="text"
			value="<?php echo $bean->getdescarte();?>"></TD>
	</TR>
	<TR>
		<TD>Categoria</TD>
		<TD>		
		<select id="categoria" name="categoria">
			<option value="">Obrigatorio</option>
			<?php
			for($i = 0; $i < count ( $categoriaclt ); $i ++) {
				$categoriabean = $categoriaclt [$i]; ?>
			<option value="<?php echo $categoriabean->getid();?>"
				<?php echo ($categoriabean->getid()== $bean->getcategoria())?"selected":"";?>>
				<?php echo $categoriabean->getnome();?>
			</option>
			<?php
			}
			?>
		</select>
		</TD>
	</TR>
	<TR>
		<TD>Tabela Ranking</TD>
		<TD><INPUT id="tabelaranking" name="tabelaranking" size="30" type="text"
			value="<?php echo $bean->gettabelaranking();?>"></TD>
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


<?php
if ($idobj != null) {
	echo $button->btCustom ( $idurl, $idobj, "Atualizar Ranking", $target, Choice::PASSO_1 );
}


Util::echobr ( $dbg, 'Rankingedit count ( $cltTabela ) ', count ( $cltTabela ) ); 

if (count ( $cltTabela ) > 0) {
?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="header">&nbsp;</th>
		<?php 
		$linha = $cltTabela[0];
		foreach ( $linha as $k => $conteudo) {
		?>
			<th class="header"><?php echo $k;?></th>
		<?php  }?>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ( $cltTabela as $k => $linha ) {
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
	?>
		<tr class="<?php echo $corlinha;?>">
			<td>
				&nbsp;
			</td>     
		<?php
			foreach ( $linha as $k => $conteudo) {
		?>
			<td>
				<?php echo  $conteudo;?>
			</td>
		<?php
			}
		?>	
		</tr>
	<?php
		
		}
	?>
	</tbody>
</table>
<?php
}else{
?>
	Tabela de ranking vazia ou nè´™o exite.
<?php
}
?>


