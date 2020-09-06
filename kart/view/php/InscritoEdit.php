<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
		$(document).ready(function() {
			  $('#cpf').mask('999.999.999-99');
			  $('#telefone').mask('(99) 9999-99999');
			  $('#celular').mask('(99) 9999-99999');
			  $('#peso').mask('999');
			  $('#pesoextra').mask('999');
			  $('#telefonecomercial').mask('(99) 9999-99999');
			  $('#dtnascimento').mask('99/99/9999');
			  $('#dtenvio').mask('99/99/9999');
			  $('#dtvalidaemail').mask('99/99/9999');
			  $('#dtinscricao').mask('99/99/9999');
			  $('#dtpagamento').mask('99/99/9999');
			  var dtpagamento = $('#dtpagamento').val();
			    $( "#dtpagamento" ).datepicker({
			      showOn: "button",
			      buttonImage: "mvc/public/view/images/calendar.gif",
			      buttonImageOnly: true,
			      buttonText: "Selecione a data"
			    });
			  $('#dtpagamento').datepicker( "option", "dateFormat", "dd/mm/yy" );
			  $('#dtpagamento').val(dtpagamento);
		});
	</script>

<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD>
		<?php if(true){?>
		<select class="css_select" id="campeonato" name="campeonato">
								
					<?php
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$beanCampeonato = new CampeonatoBean ();
						$beanCampeonato = $cltCampeonatoCollection [$i];
						?>
			    		<option value="<?php echo $beanCampeonato->getid();?>"
					<?php echo ($bean->getcampeonato()==$beanCampeonato->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanCampeonato->getnome();?>
						</option>
				<?php
					}
					?>
				</select>
				
		<?php }else { ?>
			<input type="hidden" value="<?php echo $selcampeonato;?>">
			<?php echo Util::getNomeObjeto($selcampeonatoBean);?>
		<?php }?>				
				</TD>
	</TR>
	<TR>
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $bean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>Nr Inscrito (Só altere se tiver certeza)</TD>
		<TD><INPUT id="nrinscrito" name="nrinscrito" size="30" type="text"
			value="<?php echo $bean->getnrinscrito();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="tel"
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
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtnascimento());?>">
		</TD>
	</TR>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $bean->getemail();?>"></TD>
	</TR>
	<TR>
		<TD>Data Envio</TD>
		<TD><INPUT id="dtenvio" name="dtenvio" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtenvio());?>"></TD>
	</TR>
	<TR>
		<TD>Data valida email</TD>
		<TD><INPUT id="dtvalidaemail" name="dtvalidaemail" size="30"
			type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtvalidaemail());?>">
		</TD>
	</TR>
	
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="30" type="tel"
			value="<?php echo $bean->gettelefone();?>"></TD>
	</TR>
	<TR>
		<TD>Celular</TD>
		<TD><INPUT id="celular" name="celular" size="30" type="tel"
			value="<?php echo $bean->getcelular();?>"></TD>
	</TR>
	<TR>
		<TD>Telefone Comercial</TD>
		<TD><INPUT id="telefonecomercial" name="telefonecomercial" size="30" type="tel"
			value="<?php echo $bean->gettelefonecomercial();?>"></TD>
	</TR>
	<TR>
		<TD>CEP</TD>
		<TD><INPUT id="cep" name="cep" size="30" type="text"
			value="<?php echo $bean->getcep();?>"></TD>
	</TR>
	<TR>
		<TD>Endereco</TD>
		<TD><INPUT id="endereco" name="endereco" size="30" type="text"
			value="<?php echo $bean->getendereco();?>"></TD>
	</TR>
	<TR>
		<TD>Numero</TD>
		<TD><INPUT id="numero" name="numero" size="30" type="text"
			value="<?php echo $bean->getnumero();?>"></TD>
	</TR>
		<TR>
		<TD>Complemento</TD>
		<TD><INPUT id="complemento" name="complemento" size="30" type="text"
			value="<?php echo $bean->getcomplemento();?>"></TD>
	</TR>
		<TR>
		<TD>Bairro</TD>
		<TD><INPUT id="bairro" name="bairro" size="30" type="text"
			value="<?php echo $bean->getbairro();?>"></TD>
	</TR>
		<TR>
		<TD>Cidade</TD>
		<TD><INPUT id="cidade" name="cidade" size="30" type="text"
			value="<?php echo $bean->getcidade();?>"></TD>
	</TR>
		<TR>
		<TD>UF</TD>
		<TD><INPUT id="uf" name="uf" size="30" type="text"
			value="<?php echo $bean->getuf();?>"></TD>
	</TR>
	<TR>
		<TD>Nr Carro</TD>
		<TD><INPUT id="nrcarro" name="nrcarro" size="30" type="text"
			value="<?php echo $bean->getnrcarro();?>"></TD>
	</TR>
	<TR>
		<TD>Carro</TD>
		<TD><INPUT id="carro" name="carro" size="30" type="text"
			value="<?php echo $bean->getcarro();?>"></TD>
	</TR>
	<TR>
		<TD>CBA</TD>
		<TD><INPUT id="nrcba" name="nrcba" size="30" type="text"
			value="<?php echo $bean->getnrcbalpad5();?>"></TD>
	</TR>
	<TR>
		<TD>Chefe Equipe</TD>
		<TD><INPUT id="chefeequipe" name="chefeequipe" size="30" type="text"
			value="<?php echo $bean->getchefeequipe();?>"></TD>
	</TR>
	<TR>
		<TD>Equipe</TD>
		<TD><INPUT id="evento" name="evento" size="30" type="text"
			value="<?php echo $bean->getevento();?>"></TD>
	</TR>
	<TR>
		<TD>IP Criacao</TD>
		<TD><INPUT id="ipcriacao" name="ipcriacao" size="30" type="text"
			value="<?php echo $bean->getipcriacao();?>"></TD>
	</TR>
	<tr>
		<td colspan="2" > Categoria:<br>
		</td>
	</tr>
	<tr>		
		
		<td colspan="2" >
			<table>
				<tr>
		<?php
		$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
		$categoriaBusiness = new CategoriaBusiness();
		$selCategoriaCollection = $categoriaBusiness->findByCampeonato(Util::getIdObjeto($bean->getcampeonato()));
		Util::echobr(0,"count categorias campeonato: ",count ( $selCategoriaCollection ) );
		for($catcount = 0; count ( $selCategoriaCollection ) > $catcount; $catcount ++) {
			$categoriaBean = $selCategoriaCollection [$catcount];
		?>
			<td>
		<div class="mdl-list__item" >
		    <span class="mdl-list__item-secondary-action">
		      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="list-switch-1">
		        <input type="checkbox" id="categoriainscrito" name="categoriainscrito[]" value="<?php echo $categoriaBean->getid();?>" class="mdl-switch__input categoriacheck" 
		        <?php 
		        $categoriaInscritoBean = new CategoriaInscritoBean();
		        $categoriaInscritoBean->setcategoria($categoriaBean->getid());
		        $categoriaInscritoBean->setinscrito($bean->getid());
		        
		        echo ($categoriaInscritoBusiness->isCategoriaInscrito($categoriaInscritoBean))?"checked":"";
		        ?> 
		        />
		      </label>
		    </span>
			<span class="mdl-list__item-primary-content">
		      <?php echo Util::getIdObjeto($categoriaBean);?> - 
		      <?php echo Util::getNomeObjeto($categoriaBean);?>
		    </span>
		</div>
			</td>
			<?php echo ($catcount%2==0)?"":"</tr><tr>";?> 
		<?php
		}
		?>
			</tr>
		</table>
		</td>
	</tr>
		
	<TR>
		<TD>Valor</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalorDecimal();?>">
			<input type="checkbox" id="recalcular" name="recalcular" value="1"> Recalcular valor</TD>
	</TR>
	<TR>
		<TD>Grupo</TD>
		<TD><select id="grupo" name="grupo">
				<option value=""
					<?php echo ("" == $bean->getgrupo())?"selected":"";?>>Sem grupo</option>
				<?php
				
				for($i = 0; $i < count ( $grupos ); $i ++) {
					$grupoBean = $grupos [$i];
					?>
				  <option
					<?php echo (Util::getIdObjeto($grupoBean)== Util::getIdObjeto($bean->getgrupo() ))?"selected":"";?>
					value="<?php echo Util::getIdObjeto($grupoBean);?>">
				    <?php echo Util::getNomeObjeto($grupoBean)?></option>			    
				  <?php
				}
				?>
				</select></TD>
	</TR>
	<TR>
		<TD>Situacao</TD>
		<TD><select id="situacao" name="situacao"
			<?php
			$aguardandoPG = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_AP );
			$pago = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_PG );
			$aguardandoLiberacao = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_AL );
			$listaEspera = $parametroBusiness->findByCodigo ( ParametroEmun::INSCRICAO_SITUACAO_LE );
			?>>
				<option value="">Selecione</option>
				<option value="<?php echo $aguardandoPG;?>"
					<?php echo ($aguardandoPG == $bean->getsituacao())?"selected":"";?>><?php echo $aguardandoPG;?></option>
				<option value="<?php echo $pago;?>"
					<?php echo ($pago == $bean->getsituacao())?"selected":"";?>><?php echo $pago;?></option>
				<option value="<?php echo $aguardandoLiberacao;?>"
					<?php echo ($aguardandoLiberacao == $bean->getsituacao())?"selected":"";?>><?php echo $aguardandoLiberacao;?></option>
				<option value="<?php echo $listaEspera;?>"
					<?php echo ($listaEspera == $bean->getsituacao())?"selected":"";?>><?php echo $listaEspera;?></option>
		</select></TD>
	</TR>
	<TR>
		<TD>Data abertura inscrição</TD>
		<TD><INPUT id="dtinscricao" name="dtinscricao" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtinscricao());?>">
		</TD>
	</TR>
	<TR>
		<TD>Data Pagamento</TD>
		<TD><INPUT id="dtpagamento" name="dtpagamento" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtpagamento());?>">
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
		<TD>Pessoa</TD>
			<?php $idpessoa = Util::getIdObjeto($bean->getpessoa());?>
			<TD><select id="pessoa" name="pessoa">
				<option value="" <?php echo ($idpessoa<1)?"selected":"";?>>Sem
					pessoa</option>
				  <?php
						
				if ($idpessoa < 1) {
							for($i = 0; $i < count ( $cltPessoaCollection ); $i ++) {
								$pessoabean = $cltPessoaCollection [$i];
								?>
					<option value="<?php echo  Util::getIdObjeto($pessoabean)?>">
						<?php echo Util::getNomeObjeto($pessoabean);?>
					</option>
				  <?php
							}
						} else {
							?>
				  
				  <option value="<?php echo $idpessoa?>"
					<?php echo ( $idpessoa > 0)?"selected":"";?>><?php echo $bean->getpessoa()->getnome();?></option>
				  <?php }?>			    
				</select></TD>
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
