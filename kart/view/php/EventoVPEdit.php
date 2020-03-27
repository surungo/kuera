<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>

	<TR>
		<TD>Nome</TD>
		<TD><?php echo $bean->getnome();?></TD>
	</TR>

	<?php /* 
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
		<TD>TipoEvento</TD>
		<TD>
		<select id="tipoevento" name="tipoevento" >
			<option value="">Selecione</option>
			<option value="1" <?php echo ($bean->gettipoevento() == 1)?"selected":"";?>>Campeonato</option>
			<option value="2" <?php echo ($bean->gettipoevento() == 2)?"selected":"";?>>Endurance</option>
			<option value="3" <?php echo ($bean->gettipoevento() == 3)?"selected":"";?>>Liga</option>
			<option value="4" <?php echo ($bean->gettipoevento() == 4)?"selected":"";?>>Milhao</option>
			<option value="5" <?php echo ($bean->gettipoevento() == 5)?"selected":"";?>>Arrancada</option>
		</select>
		</TD>
	</TR>
	<TR>
		<TD>Total Vagas</TD>
		<TD><INPUT id="totalvaga" name="totalvaga" size="30" type="text"
			value="<?php echo $bean->gettotalvaga();?>"></TD>
	</TR>
	<TR>
		<TD>Total Vagas por Equipe</TD>
		<TD><INPUT id="totalvagaequipe" name="totalvagaequipe" size="30"
			type="text" value="<?php echo $bean->gettotalvagaequipe();?>"></TD>
	</TR>
	<TR>
		<TD>Total Inscritos em Equipe Diferentes</TD>
		<TD><INPUT id="totalinscritoequipe" name="totalinscritoequipe"
			size="30" type="text"
			value="<?php echo $bean->gettotalinscritoequipe();?>"></TD>
	</TR>
	*/ ?>
	<TR>
		<TD>Valor Normal </TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalor();?>"></TD>
	</TR>
	<?php /* 
	<TR>
		<TD>Adicionar centavos</TD>
		<TD>
		<select id="adicionarcentavos" name="adicionarcentavos" >
			<option value="0" <?php echo ($bean->getadicionarcentavos() == 0)?"selected":"";?>>Não</option>
			<option value="1" <?php echo ($bean->getadicionarcentavos() == 1)?"selected":"";?>>Sim</option>
		</select>
		</TD>
	</TR>
	*/ ?>

	<TR>
		<TD>Valor desconto segunda categoria</TD>
		<TD><INPUT id="valorporextenso" name="valorporextenso" size="30"
			type="text" value="<?php echo $bean->getvalorporextenso();?>"></TD>
	</TR>
	<TR>
		<TD>Valor desconto segundo evento</TD>
		<TD><INPUT id="valorpaypal" name="valorpaypal" size="30" type="text"
			value="<?php echo $bean->getvalorpaypal();?>"></TD>
	</TR>
	<TR>
		<TD colspan="2">
			Preencher com ponto para centavos. Exemplo: 2500.99
			 </TD>
	</TR>

	<?php /* 
	<TR>
		<TD>Email paypal</TD>
		<TD><INPUT id="emailpaypal" name="emailpaypal" size="30" type="text"
			value="<?php echo $bean->getemailpaypal();?>"></TD>
	</TR>
	<TR>
		<TD>Mostrar Espera</TD>
		<TD>
		<select id="mostrarespera" name="mostrarespera" >
			<option value="N" <?php echo ($bean->getmostrarespera() == 'N')?"selected":"";?>>Não</option>
			<option value="S" <?php echo ($bean->getmostrarespera() == 'S')?"selected":"";?>>Sim</option>
		</select>
		</TD>
	</TR>
	<TR>
		<TD>msg Lista Espera</TD>
		<TD><TEXTAREA id="msglistaespera" name="msglistaespera" cols="60"
				rows="8"><?php echo $bean->getmsglistaespera();?></TEXTAREA></TD>
	</TR>
	<TR>
		<TD>Listar Inscrito</TD>
		<TD>
		<select id="listainscrito" name="listainscrito" >
			<option value="N" <?php echo ($bean->getlistainscrito() == 'N')?"selected":"";?>>Não</option>
			<option value="S" <?php echo ($bean->getlistainscrito() == 'S')?"selected":"";?>>Sim</option>
		</select>
		
		</TD>
	</TR>
	<TR>
		<TD>msg Aguardando Pagamento</TD>
		<TD><TEXTAREA id="msgaguardandopagamento"
				name="msgaguardandopagamento" cols="60" rows="8"><?php echo $bean->getmsgaguardandopagamento();?></TEXTAREA></TD>
	</TR>
	<TR>
		<TD>msg Atualizado com Sucesso</TD>
		<TD><TEXTAREA id="msgatualizadosucesso" name="msgatualizadosucesso"
				cols="60" rows="8"><?php echo $bean->getmsgatualizadosucesso();?></TEXTAREA></TD>
	</TR>
	<TR>
		<TD>msg Sucesso</TD>
		<TD><TEXTAREA id="msgsucesso" name="msgsucesso" cols="60" rows="8"><?php echo $bean->getmsgsucesso();?></TEXTAREA></TD>
	</TR>
	<TR>
		<TD>msg Sucesso Cadastro Equipe</TD>
		<TD><TEXTAREA id="msgsucessoequipe" name="msgsucessoequipe" cols="60"
				rows="8"><?php echo $bean->getmsgsucessoequipe();?></TEXTAREA></TD>
	</TR>
*/ ?>
	<script>
$(document).ready(function() {
	$("#dtinicioinscricoes").mask("99/99/9999 99:99:99");
	$("#dtfinalinscricoes").mask("99/99/9999 99:99:99");
	  
});
</script>
		<TR>
			<TD>Data Inicio Inscricoes</TD>
			<TD><INPUT id="dtinicioinscricoes" name="dtinicioinscricoes" type="text"
				value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtinicioinscricoes());?>"></TD>
		</TR>
		<TR>
			<TD>Data Final Inscricoes</TD>
			<TD><INPUT id="dtfinalinscricoes" name="dtfinalinscricoes" type="text"
				value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtfinalinscricoes());?>"></TD>
		</TR>
	<TR>

	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>
	<TR>
		<TD colspan="2">
				<?php echo $button->btSV($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>
