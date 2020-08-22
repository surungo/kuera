<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';


    $campos = array (
	//	"apelido",
		"nome",
	//	"peso",
	//	"dtnascimento",
		"email",
		"cpf",
		"telefone",
		"rg",
        "endereco",
        "numero",
        "complemento",
        "bairro",
        "cidade",
        "uf",
        "cep",
        "tpsanguineo",
        "nmemergencia",
        "telefoneemergencia",
        "cidadeemergencia",
        "ufemergencia",
//		"tamanhocamisa",
//		"dtvalidaemail",
//		"senha",
		"idpessoa" 
    );
/*	
?>

<script>
		$(document).ready(function() {
			  $('#cpf').mask('999.999.999-99');
			  $('#telefone').mask('(99) 9999-9999');
			  $('#dtnascimento').mask('99/99/9999');
		});
	</script>
<?php */?>
<TABLE>
    <?php if ( in_array("apelido", $campos) ) { ?>
	<TR>
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $bean->getapelido();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("nome", $campos) ) { ?>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("cpf", $campos) ) { ?>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="text"
			value="<?php echo $bean->getcpf();?>"></TD>
	</TR>
	
	<?php 
	}
	if ( in_array("rg", $campos) ) { ?>
	<TR>
		<TD>RG</TD>
		<TD><INPUT id="rg" name="rg" size="30" type="text"
			value="<?php echo $bean->getrg();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("endereco", $campos) ) { ?>
	<TR>
		<TD>Endereço</TD>
		<TD><INPUT id="endereco" name="endereco" size="30" type="text"
			value="<?php echo $bean->getendereco();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("numero", $campos) ) { ?>
	<TR>
		<TD>Numero</TD>
		<TD><INPUT id="numero" name="numero" size="30" type="text"
			value="<?php echo $bean->getnumero();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("complemento", $campos) ) { ?>
	<TR>
		<TD>Complemento</TD>
		<TD><INPUT id="complemento" name="complemento" size="30" type="text"
			value="<?php echo $bean->getcomplemento();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("bairro", $campos) ) { ?>
	<TR>
		<TD>Bairro</TD>
		<TD><INPUT id="bairro" name="bairro" size="30" type="text"
			value="<?php echo $bean->getbairro();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("cidade", $campos) ) { ?>
	<TR>
		<TD>Cidade</TD>
		<TD><INPUT id="cidade" name="cidade" size="30" type="text"
			value="<?php echo $bean->getcidade();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("uf", $campos) ) { ?>
	<TR>
		<TD>UF</TD>
		<TD><INPUT id="uf" name="uf" size="30" type="text"
			value="<?php echo $bean->getuf();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("cep", $campos) ) { ?>
	<TR>
		<TD>CEP</TD>
		<TD><INPUT id="cep" name="cep" size="30" type="text"
			value="<?php echo $bean->getcep();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("telefone", $campos) ) { ?>
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="30" type="text"
			value="<?php echo $bean->gettelefone();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("email", $campos) ) { ?>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $bean->getemail();?>"></TD>
	</TR>	
	<?php 
	}
	if ( in_array("tpsanguineo", $campos) ) { ?>
	<TR>
		<TD>Tipo Sanguineo</TD>
		<TD><INPUT id="tpsanguineo" name="tpsanguineo" size="30" type="text"
			value="<?php echo $bean->gettpsanguineo();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("nmemergencia", $campos) ) { ?>
	<TR>
		<TD>Pessoa Emergencia</TD>
		<TD><INPUT id="nmemergencia" name="nmemergencia" size="30" type="text"
			value="<?php echo $bean->getnmemergencia();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("telefoneemergencia", $campos) ) { ?>
	<TR>
		<TD>Telefone Emergencia</TD>
		<TD><INPUT id="telefoneemergencia" name="telefoneemergencia" size="30" type="text"
			value="<?php echo $bean->gettelefoneemergencia();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("cidadeemergencia", $campos) ) { ?>
	<TR>
		<TD>Cidade Emergencia</TD>
		<TD><INPUT id="cidadeemergencia" name="cidadeemergencia" size="30" type="text"
			value="<?php echo $bean->getcidadeemergencia();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("ufemergencia", $campos) ) { ?>
	<TR>
		<TD>UF Emergencia</TD>
		<TD><INPUT id="ufemergencia" name="ufemergencia" size="30" type="text"
			value="<?php echo $bean->getufemergencia();?>"></TD>
	</TR>
	
	
	<?php 
	}
	if ( in_array("peso", $campos) ) { ?>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $bean->getpeso();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("dtnascimento", $campos) ) { ?>
	<TR>

		<TD>Data Nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtnascimento());?>">
		</TD>
	</TR>
	<?php 
	}
	if ( in_array("dtvalidaemail", $campos) ) { ?>
	<TR>
		<TD>Data valida email</TD>
		<TD><INPUT id="dtvalidaemail" name="dtvalidaemail" size="30"
			type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtvalidaemail());?>">
		</TD>
	</TR>
	<?php 
	}
	if ( in_array("tamanhocamisa", $campos) ) { ?>
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
	<?php 
	}
	if ( in_array("tamanhocamisa", $campos) ) { ?>
	<TR>
		<TD>Senha</TD>
		<TD><INPUT id="senha" name="senha" size="30" type="text"
		value="<?php echo $bean->getsenha();?>"></TD>
	</TR>
	<?php 
	}
	if ( in_array("tamanhocamisa", $campos) ) { ?>
	<TR>
	<TD colspan="2">
		<?php echo isset($mensagem)?$mensagem:''; ?>
		 </TD>
	</TR>
		<?php 
	}
    ?>

	<TR>
		<TD colspan="2">
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>
