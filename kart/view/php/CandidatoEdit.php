<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
		$(document).ready(function() {
			  $('#cpf').mask('999.999.999-99');
			  $('#telefone').mask('(99) 9999-9999');
			  $('#dtnascimento').mask('99/99/9999');
			  $('#cpf').keyup(function(){
				  var cpf = $('#cpf').val();
				  var cpfsize = cpf.length;// cpf.indexOf("_");
				  if(cpfsize > 13){
					  $('#choice').val(<?php echo Choice::VALIDAR;?>);
					  $("#formDefault").submit();
				  }
			  });
			  $('#cpf').blur(function(){
				  var cpf = $('#cpf').val();
				  var cpfsize = cpf.indexOf("_");
				  if(cpfsize < 0){
					  $('#choice').val(<?php echo Choice::VALIDAR;?>);
					  $("#formDefault").submit();
				  }
			  });
			  
			  <?php if($idobj > 0){?>
				$("#idobj").val(<?php echo $idobj;?>);
			  <?php }?>
			  var cpf = $('#cpf').val();
			  var cpfsize = cpf.indexOf("_");
			  var cpflength = cpf.length;
			  if(cpfsize <= 0 && cpflength < 1){
				 $(".dadospessoais").hide();
			  }else{
				  $(".dadospessoais").show();
			  }
		});
	</script>
<INPUT id="idpessoa" name="idpessoa" size="30" type="hidden"
			value="<?php echo $pessoabean->getid();?>">
<TABLE>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="text" 
			value="<?php echo $pessoabean->getcpf();?>">  
		</TD>
	</TR>
	<TR class="dadospessoais">
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $pessoabean->getnome();?>">
			<?php if($idobj > 0){?>
				<small>CPF encontrado, dados recuperados no sistema.</small>
			<?php }?></TD>
	</TR>
	<?php
	//basico para eleiçoes 
	if(false){?>
	<TR class="dadospessoais">
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $pessoabean->getapelido();?>"></TD>
	</TR>
	<TR class="dadospessoais">
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $pessoabean->getpeso();?>"></TD>
	</TR>
	<TR class="dadospessoais">

		<TD>Data Nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$pessoabean->getdtnascimento());?>">
		</TD>
	</TR>
	<TR class="dadospessoais">
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $pessoabean->getemail();?>"></TD>
	</TR>
	<TR class="dadospessoais">
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="30" type="text"
			value="<?php echo $pessoabean->gettelefone();?>"></TD>
	</TR>
	<TR class="dadospessoais">
		<TD>Data valida email</TD>
		<TD><INPUT id="dtvalidaemail" name="dtvalidaemail" size="30"
			type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$pessoabean->getdtvalidaemail());?>">
		</TD>
	</TR>
	<TR class="dadospessoais">
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
					<?php echo ("" == $pessoabean->gettamanhocamisa())?"selected":"";?>>Escolha
					um tamanho</option>
				<?php
				
				for($i = 0; $i < count ( $tamanhoCamisa ); $i ++) {
					?>
				  <option value="<?php echo $tamanhoCamisa[$i]?>"
					<?php echo ( $tamanhoCamisa[$i] == $pessoabean->gettamanhocamisa())?"selected":"";?>><?php echo $tamanhoCamisa[$i]?></option>			    
				  <?php
				}
				?>
				</select></TD>
		</TR>
		<TR class="dadospessoais">
			<TD>Senha</TD>
			<TD><INPUT id="senha" name=""senha"" size="30" type="text"
			value="<?php echo $pessoabean->getsenha();?>"></TD>
		</TR>
		<?php }?>
		<TR>
		<TD>Campeonato</TD>
		<TD><select id="campeonato" name="campeonato"  class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$campeonatobean = $cltCampeonatoCollection [$i];
						?>
			    <option value="<?php echo $campeonatobean->getid();?>"
					<?php echo ($campeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $campeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></TD>
	</TR>
	 <?php if($idobj > 0){?>
	<TR><TD colspan="2">Categorias Grupos</TD></TR>
	<?php 
		$selecionado = "";
		for($i = 0; $i < count ( $cltCategoriasGruposCollection ); $i ++) {
			$categoriagrupobean = $cltCategoriasGruposCollection [$i];	
			$idcategoriaGrupo = Util::getIdObjeto($categoriagrupobean);	
			for($o = 0; $o < count ( $cltCategoriasGruposSelecionadas ); $o ++) {
				$selecionado = "";
				$idcategoriaGrupoSelecionado = Util::getIdObjeto($cltCategoriasGruposSelecionadas[$o]->getcategoriagrupo());
				if ($idcategoriaGrupoSelecionado == $idcategoriaGrupo) {
					$selecionado = "checked='checked'";
					break;
				}
			}?>
	<TR>
		<TD colspan="2">
		    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="idcategoriagrupo" name="idcategoriagrupo[]"
		     
		     value="<?php echo $idcategoriaGrupo;?>"
			<?php echo $selecionado;?>>&nbsp;<?php echo Util::getNomeObjeto($categoriagrupobean->getcategoria());?>&nbsp;-&nbsp;<?php echo Util::getNomeObjeto($categoriagrupobean->getgrupo());?>
		</TD>
	</TR>
		  <?php
		}
	}
	 ?>
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
</TABLE>
