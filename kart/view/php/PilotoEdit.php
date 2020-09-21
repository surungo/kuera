<?php
if($consulta_adicao==Choice::PBA_FORM_ADD){
    ?>
    <div id="piloto" style="float: left; width: <?php echo $divLargura;?>; background-color: silver; border: 3px inset black; ">
<?php 
}else{
    include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
}
$pilotobean=($pilotobean==null)?new PilotoBean():$pilotobean;
?>
<script>

$(document).ready(function() {

	$("#cpf").focus();
	$("#cpf").mask('999.999.999-99');
});	
</script>	
<TABLE>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="14" type="text" 
<?php if($consulta_adicao==Choice::PBA_FORM_ADD || Util::getIdObjeto($bean)<1){		
	echo " class='btn_change' ";
    echo $button->atributos( $idurl, $idobj, Choice::ATUALIZAR_CPF, $target, Choice::ATUALIZAR_CPF );
}?>
			value="<?php echo $pilotobean->getcpf();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $pilotobean->getnome();?>"></TD>
	</TR>
<?php if($consulta_adicao!=Choice::PBA_FORM_ADD){?>
	<TR>
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $pilotobean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>Nome Join</TD>
		<TD><INPUT id="nomejoin" name="nomejoin" size="30" type="text"
			value="<?php echo $pilotobean->getnomejoin();?>"></TD>
	</TR>
	<TR>
		<TD>Sigla</TD>
		<TD><INPUT id="sigla" name="sigla" size="30" type="text"
			value="<?php echo $pilotobean->getsigla();?>"></TD>
	</TR>
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="100" type="text"
			value="<?php echo $pilotobean->gettelefone();?>"></TD>
	</TR>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="100" type="text"
			value="<?php echo $pilotobean->getemail();?>"></TD>
	</TR>
	<script>
$(document).ready(function() {
  $("#dtnascimento").mask("99/99/9999");
  
});
</script>
	<TR>
		<TD>Data de nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="text"
			value="<?php echo  Util::timestamptostr('d/m/Y',$pilotobean->getdtnascimento());?>"></TD>
	</TR>
<?php 
}
?>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $pilotobean->getpeso();?>"></TD>
	</TR>
	<TR>
		<TD>Peso Extra</TD>
		<TD><INPUT id="pesoextra" name="pesoextra" size="30" type="text"
			value="<?php echo $pilotobean->getpesoextra();?>"></TD>
	</TR>
<?php if($consulta_adicao!=Choice::PBA_FORM_ADD){?>

	<TR>
		<TD>Facebook</TD>
		<TD>
    <?php
				if ($pilotobean->getfacebook () != "") {
					$btnFacebook = URLAPP . '/mvc/public/view/images/btn-facebook.png';
					?><a border="0" href="<?php echo $pilotobean->getfacebook();?>"
			target="_blank"> <img border="0" width="30px"
				src="<?php echo $btnFacebook;?>" /></a><?php
				}
				?>
    <INPUT id="facebook" name="facebook" size="60" type="text"
			value="<?php echo $pilotobean->getfacebook();?>">
		</TD>
	</TR>
	<TR>
		<TD>Foto</TD>
		<TD><img border="1" width="30px"
			src="<?php echo $pilotobean->getfotourl();?>" /> <input type="file"
			name="fotoimg" id="fotoimg" /></TD>
	</TR>
	<TR>
		<TD>Descrição</TD>
		<TD><textarea name="descricao" id="descricao" rows="4" cols="40"><?php echo $pilotobean->getdescricao();?></textarea>
		</TD>
	</TR>

	<TR>
		<TD>Observação</TD>
		<TD><textarea name="observacao" id="observacao" rows="4" cols="40"><?php echo $pilotobean->getobservacao();?></textarea>
		</TD>
	</TR>
	
	<TR>
		<TD>Pessoa</TD>
			<?php $idpessoa = Util::getIdObjeto($pilotobean->getpessoa());?>
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
<?php }?>
	<TR>
		<TD colspan="2"><?php echo isset($mensagem)?$mensagem:''; ?></TD>
	</TR>
	<TR>
		<TD colspan="2">
		<?php 
		if($consulta_adicao!=Choice::PBA_FORM_ADD){
		    echo $button->btSEV($idobj,$idurl);
		}else{
		    echo $button->btCustom($idurl,$idobj, "Adicionar novo piloto",$target,Choice::ADICIONAR_NOVO);
		  
		}
		?>
		</TD>
	</TR>
</TABLE>
<?php 
if($consulta_adicao==Choice::PBA_FORM_ADD){
 ?>
 </div>
 <?php }?>