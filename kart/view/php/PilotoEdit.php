<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $bean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>Nome Join</TD>
		<TD><INPUT id="nomejoin" name="nomejoin" size="30" type="text"
			value="<?php echo $bean->getnomejoin();?>"></TD>
	</TR>
	<TR>
		<TD>Sigla</TD>
		<TD><INPUT id="sigla" name="sigla" size="30" type="text"
			value="<?php echo $bean->getsigla();?>"></TD>
	</TR>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="14" type="text"
			value="<?php echo $bean->getcpf();?>"></TD>
	</TR>
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="100" type="text"
			value="<?php echo $bean->gettelefone();?>"></TD>
	</TR>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="100" type="text"
			value="<?php echo $bean->getemail();?>"></TD>
	</TR>
	<script>
$(document).ready(function() {
  $("#dtnascimento").mask("99/99/9999");
  
});
</script>
	<TR>
		<TD>Data de nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="text"
			value="<?php echo  Util::timestamptostr('d/m/Y',$bean->getdtnascimento());?>"></TD>
	</TR>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $bean->getpeso();?>"></TD>
	</TR>
	<TR>
		<TD>Facebook</TD>
		<TD>
    <?php
				if ($bean->getfacebook () != "") {
					$btnFacebook = URLAPP . '/mvc/public/view/images/btn-facebook.png';
					?><a border="0" href="<?php echo $bean->getfacebook();?>"
			target="_blank"> <img border="0" width="30px"
				src="<?php echo $btnFacebook;?>" /></a><?php
				}
				?>
    <INPUT id="facebook" name="facebook" size="60" type="text"
			value="<?php echo $bean->getfacebook();?>">
		</TD>
	</TR>
	<TR>
		<TD>Foto</TD>
		<TD><img border="1" width="30px"
			src="<?php echo $bean->getfotourl();?>" /> <input type="file"
			name="fotoimg" id="fotoimg" /></TD>
	</TR>
	<TR>
		<TD>Descrição</TD>
		<TD><textarea name="descricao" id="descricao" rows="4" cols="40"><?php echo $bean->getdescricao();?></textarea>
		</TD>
	</TR>

	<TR>
		<TD>Observação</TD>
		<TD><textarea name="observacao" id="observacao" rows="4" cols="40"><?php echo $bean->getobservacao();?></textarea>
		</TD>
	</TR>
	<TR>
		<TD>Pessoa</TD>
			<?php $idpessoa = Util::getIdObjeto($bean->getpessoa());?>
			<TD><select id="pessoa" name="pessoa">
				<option value="" <?php echo ($idpessoa<1)?"selected":"";?>>Sem
					pessoa</option>
				  <?php
				  for($i = 0; $i < count ( $cltPessoaCollection ); $i ++) {
					$pessoabean = $cltPessoaCollection [$i];
					?>
					<option value="<?php echo  Util::getIdObjeto($pessoabean)?>"
					<?php echo ( $idpessoa ==  Util::getIdObjeto($pessoabean))?"selected":"";?>
					>
						<?php echo Util::getNomeObjeto($pessoabean);?>
					</option>
					<?php
				  }
				   ?>		    
				</select></TD>
	</TR>
	
	<TR>
		<TD colspan="2"><?php echo isset($mensagem)?$mensagem:''; ?></TD>
	</TR>
	<TR>
		<TD colspan="2"><?php echo $button->btSEV($idobj,$idurl); ?></TD>
	</TR>
</TABLE>
