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

<TABLE>
	<TR>
		<TD>idEleitor</TD>
		<TD><INPUT id="ideleitor" name="ideleitor" size="30" type="text"
			value="<?php echo Util::getIdObjeto($eleitorbean);?>"> 
		</TD>
	</TR>
	<TR>
		<TD>idCandidato</TD>
		<TD><INPUT id="idcandidato" name="idcandidato" size="30" type="text"
			value="<?php echo Util::getIdObjeto($candidatobean);?>" >
		</TD>
	</TR>
		<TR>
		<TD>idPessoa</TD>
		<TD><INPUT id="idpessoa" name="idpessoa" size="30" type="text"
			value="<?php echo Util::getIdObjeto($pessoabean);?>"> 
		</TD>
	</TR>
	<TR>
		<TD>Campeonato:</TD>
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
			</select>
		</TD>
	</TR>
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
</table>
	 <?php if($idobj > 0){
	 ?>
<TABLE>
	<TR><TD colspan="3">Categorias Grupos</TD></TR>
	<TR>
		<TD>&nbsp;Eleitor&nbsp;&nbsp;</TD>
		<TD>&nbsp;&nbsp;Candidato&nbsp;&nbsp;</TD>
		<TD>&nbsp;&nbsp;Descrição&nbsp;</TD>
	</TR>
	<?php 
		$selecionadoEleitor = "";
		$selecionadoCandidato = "";
		
		for($i = 0; $i < count ( $cltCategoriasGruposCollection ); $i ++) {
			$categoriagrupobean = $cltCategoriasGruposCollection [$i];	
			for($o = 0; $o < count ( $cltEleitorCategoriasGruposCollection ); $o ++) {
				$selecionadoEleitor = "";
				if ($cltEleitorCategoriasGruposCollection[$o]->getcategoriagrupo()->getId () == $categoriagrupobean->getid ()) {
					$selecionadoEleitor = "checked='checked'";
					break;
				}
			}
			for($o = 0; $o < count ( $cltCandidatoCategoriasGruposCollection ); $o ++) {
				$selecionadoCandidato = "";
				if ($cltCandidatoCategoriasGruposCollection[$o]->getcategoriagrupo()->getId () == $categoriagrupobean->getid ()) {
					$selecionadoCandidato = "checked='checked'";
					break;
				}
			}
			
			?>
	<TR>
		<TD>
		&nbsp;
		<?php if(Util::getIdObjeto($eleitorbean)>0){?>
		   <input type="checkbox" id="idcategoriagrupo_eleitor" name="idcategoriagrupo_eleitor[]"
		     value="<?php echo $categoriagrupobean->getid();?>"
			<?php echo $selecionado;?>>
		<?php 
			}
		?>
		</td>
		<TD>
		&nbsp;
		<?php 
		if(Util::getIdObjeto($candidatobean)>0){?>
		   <input type="checkbox" id="idcategoriagrupo_candidato" name="idcategoriagrupo_candidato[]"
		     value="<?php echo $categoriagrupobean->getid();?>"
			<?php echo $selecionado;?>>
		<?php }?>
		</td>
		
		<td>
		<?php echo Util::getNomeObjeto($categoriagrupobean->getcategoria());?>&nbsp;-&nbsp;<?php echo Util::getNomeObjeto($categoriagrupobean->getgrupo());?>
		</TD>
	</TR>
		  <?php
		}
		
	}
	 ?>
		<TR>
		<TD colspan="3">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>
	<TR>
		<TD colspan="3">
				<?php echo $button->btSEV2($idobj,$idurl); ?>
			</TD>
	</TR>
</TABLE>