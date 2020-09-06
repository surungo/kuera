<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
		$(document).ready(function() {
			  $('#cpf').mask('999.999.999-99');
			  $('#telefone').mask('(99) 9999-9999');
			  $('#dtnascimento').mask('99/99/9999');
		});
	</script>

<TABLE>
	<TR>
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $bean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="text"
			value="<?php echo $bean->getcpf();?>"></TD>
	</TR>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $bean->getpeso();?>"></TD>
	</TR>
	<TR>
		<TD>Peso extra</TD>
		<TD><INPUT id="pesoextra" name="pesoextra" size="30" type="text"
			value="<?php echo $bean->getpesoextra();?>"></TD>
	</TR>
	<TR>

		<TD>Data Nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtnascimento());?>">
		</TD>
	</TR>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $bean->getemail();?>"></TD>
	</TR>
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="30" type="text"
			value="<?php echo $bean->gettelefone();?>"></TD>
	</TR>
	<TR>
		<TD>Data valida email</TD>
		<TD><INPUT id="dtvalidaemail" name="dtvalidaemail" size="30"
			type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtvalidaemail());?>">
		</TD>
	</TR>
	<TR>
		<TD>Camisa Tamanho</TD>
		<TD><select id="tamanhocamisa" name="tamanhocamisa"
			<?php
			$tamanhoCamisa = array (
					"P",
					"M",
					"G",
					"GG",
					"3XG" 
			);
			?>>
				<option value=""
					<?php echo ("" == $bean->gettamanhocamisa())?"selected":"";?>>Escolha
					um tamanho</option>
				<?php
				
				for($i = 0; $i < count ( $tamanhoCamisa ); $i ++) {
					?>
				  <option value="<?php echo $tamanhoCamisa[$i]?>"
					<?php echo ( $tamanhoCamisa[$i] == $bean->gettamanhocamisa())?"selected":"";?>><?php echo $tamanhoCamisa[$i]?></option>			    
				  <?php
				}
				?>
				</select></TD>
		</TR>
		<TR>
			<TD>Senha</TD>
			<TD><INPUT id="senha" name="senha" size="30" type="text"
			value="<?php echo $bean->getsenha();?>"></TD>
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
