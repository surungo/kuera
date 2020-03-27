<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>

<script>
		$(document).ready(function() {
			
			$('#cpf').mask('999.999.999-99');
			  $('#telefone').mask('(99) 9999-99999');
			  $('#celular').mask('(99) 9999-99999');
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
<INPUT id="inscrito" name="inscrito" type="hidden" value="<?php echo Util::getIdObjeto($inscritobean);?>">
<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD>
		<?php if(false){?>
		<select class="css_select" id="campeonato" name="campeonato">
								
					<?php
					for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
						$beanCampeonato = new CampeonatoBean ();
						$beanCampeonato = $cltCampeonatoCollection [$i];
						?>
			    		<option value="<?php echo $beanCampeonato->getid();?>"
					<?php echo ($inscritobean->getcampeonato()==$beanCampeonato->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanCampeonato->getnome();?>
						</option>
				<?php
					}
					?>
				</select>
				
		<?php }else { ?>
			<input type="hidden" id="campeonato" name="campeonato" value="<?php echo $selcampeonato;?>">
			<?php echo Util::getNomeObjeto($selcampeonatoBean);?>
		<?php }?>				
				</TD>
	</TR>
	<TR style="display: none;">
		<TD>Apelido</TD>
		<TD><INPUT id="apelido" name="apelido" size="30" type="text"
			value="<?php echo $inscritobean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>Nr Inscrito (Só altere se tiver certeza)</TD>
		<TD><INPUT id="nrinscrito" name="nrinscrito" size="30" type="text"
			value="<?php echo $inscritobean->getnrinscrito();?>"></TD>
	</TR>
	<TR>
		<TD>Nome</TD>
		<TD><INPUT id="nome" name="nome" size="30" type="text"
			value="<?php echo $inscritobean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>CPF</TD>
		<TD><INPUT id="cpf" name="cpf" size="30" type="tel"
			value="<?php echo $inscritobean->getcpf();?>"></TD>
	</TR>
	<TR>
		<TD>Peso</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $inscritobean->getpeso();?>"></TD>
	</TR>
	<TR>

		<TD>Data Nascimento</TD>
		<TD><INPUT id="dtnascimento" name="dtnascimento" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$inscritobean->getdtnascimento());?>">
		</TD>
	</TR>
	<TR>
		<TD>Email</TD>
		<TD><INPUT id="email" name="email" size="30" type="text"
			value="<?php echo $inscritobean->getemail();?>"></TD>
	</TR>
	<TR style="display: none;">
		<TD>Data Envio</TD>
		<TD><INPUT id="dtenvio" name="dtenvio" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$inscritobean->getdtenvio());?>"></TD>
	</TR>
	<TR style="display: none;">
		<TD>Data valida email</TD>
		<TD><INPUT id="dtvalidaemail" name="dtvalidaemail" size="30"
			type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$inscritobean->getdtvalidaemail());?>">
		</TD>
	</TR>
	
	<TR>
		<TD>Telefone</TD>
		<TD><INPUT id="telefone" name="telefone" size="30" type="tel"
			value="<?php echo $inscritobean->gettelefone();?>"></TD>
	</TR>
	<TR style="display: none;">
		<TD>Celular</TD>
		<TD><INPUT id="celular" name="celular" size="30" type="tel"
			value="<?php echo $inscritobean->getcelular();?>"></TD>
	</TR>
	<TR style="display: none;">
		<TD>Telefone Comercial</TD>
		<TD><INPUT id="telefonecomercial" name="telefonecomercial" size="30" type="tel"
			value="<?php echo $inscritobean->gettelefonecomercial();?>"></TD>
	</TR>
	<TR>
		<TD>CEP</TD>
		<TD><INPUT id="cep" name="cep" size="30" type="text"
			value="<?php echo $inscritobean->getcep();?>"></TD>
	</TR>
	<TR>
		<TD>Endereco</TD>
		<TD><INPUT id="endereco" name="endereco" size="30" type="text"
			value="<?php echo $inscritobean->getendereco();?>"></TD>
	</TR>
	<TR>
		<TD>Numero</TD>
		<TD><INPUT id="numero" name="numero" size="30" type="text"
			value="<?php echo $inscritobean->getnumero();?>"></TD>
	</TR>
		<TR>
		<TD>Complemento</TD>
		<TD><INPUT id="complemento" name="complemento" size="30" type="text"
			value="<?php echo $inscritobean->getcomplemento();?>"></TD>
	</TR>
		<TR>
		<TD>Bairro</TD>
		<TD><INPUT id="bairro" name="bairro" size="30" type="text"
			value="<?php echo $inscritobean->getbairro();?>"></TD>
	</TR>
		<TR>
		<TD>Cidade</TD>
		<TD><INPUT id="cidade" name="cidade" size="30" type="text"
			value="<?php echo $inscritobean->getcidade();?>"></TD>
	</TR>
		<TR>
		<TD>UF</TD>
		<TD><INPUT id="uf" name="uf" size="30" type="text"
			value="<?php echo $inscritobean->getuf();?>"></TD>
	</TR>
	<TR>
		<TD>Nr Carro</TD>
		<TD><INPUT id="nrcarro" name="nrcarro" size="30" type="text"
			value="<?php echo $bean->getvalor();?>"></TD>
	</TR>
	<TR>
		<TD>Carro</TD>
		<TD><INPUT id="carro" name="carro" size="30" type="text"
			value="<?php echo $bean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>CBA</TD>
		<TD><INPUT id="nrcba" name="nrcba" size="30" type="text"
			value="<?php echo $inscritobean->getnrcbalpad5();?>"></TD>
	</TR>
	<TR>
		<TD>Chefe Equipe</TD>
		<TD><INPUT id="chefeequipe" name="chefeequipe" size="30" type="text"
			value="<?php echo $inscritobean->getchefeequipe();?>"></TD>
	</TR>
	<TR>
		<TD>Equipe</TD>
		<TD><INPUT id="evento" name="evento" size="30" type="text"
			value="<?php echo $inscritobean->getevento();?>"></TD>
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
		$selCategoriaCollection = $categoriaBusiness->findByCampeonato(Util::getIdObjeto($inscritobean->getcampeonato()));
		Util::echobr(0,"count categorias campeonato: ",count ( $selCategoriaCollection ) );
		for($catcount = 0; count ( $selCategoriaCollection ) > $catcount; $catcount ++) {
			$categoriaBean = $selCategoriaCollection [$catcount];
		?>
			<td>
		<div class="mdl-list__item" >
		    <span class="mdl-list__item-secondary-action">
		      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="list-switch-1">
		        <input type="radio" id="categoriainscrito" name="categoriainscrito[]" value="<?php echo $categoriaBean->getid();?>" class="mdl-switch__input categoriacheck" 
		        <?php 
		        $categoriaInscritoBean = new CategoriaInscritoBean();
		        $categoriaInscritoBean->setcategoria($categoriaBean->getid());
		        $categoriaInscritoBean->setinscrito($inscritobean->getid());
		        
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
		<TD>Valor total do inscrito</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $inscritobean->getvalorDecimal();?>">
			<input type="checkbox" id="recalcular" name="recalcular" value="1" > Recalcular valor</TD>
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
					<?php echo ($aguardandoPG == $inscritobean->getsituacao())?"selected":"";?>><?php echo $aguardandoPG;?></option>
				<option value="<?php echo $pago;?>"
					<?php echo ($pago == $inscritobean->getsituacao())?"selected":"";?>><?php echo $pago;?></option>
				<option value="<?php echo $aguardandoLiberacao;?>"
					<?php echo ($aguardandoLiberacao == $inscritobean->getsituacao())?"selected":"";?>><?php echo $aguardandoLiberacao;?></option>
				<option value="<?php echo $listaEspera;?>"
					<?php echo ($listaEspera == $inscritobean->getsituacao())?"selected":"";?>><?php echo $listaEspera;?></option>
		</select></TD>
	</TR>
	<TR>
		<TD>Data Pagamento</TD>
		<TD><INPUT id="dtpagamento" name="dtpagamento" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$inscritobean->getdtpagamento());?>">
		</TD>
	</TR>
<?php if(false){?>
	<TR>
		<TD>IP Criacao</TD>
		<TD><INPUT id="ipcriacao" name="ipcriacao" size="30" type="text"
			value="<?php echo $inscritobean->getipcriacao();?>"></TD>
	</TR>
	<TR>
		<TD>Grupo</TD>
		<TD><select id="grupo" name="grupo">
				<option value=""
					<?php echo ("" == $inscritobean->getgrupo())?"selected":"";?>>Sem grupo</option>
				<?php
				
				for($i = 0; $i < count ( $grupos ); $i ++) {
					$grupoBean = $grupos [$i];
					?>
				  <option
					<?php echo (Util::getIdObjeto($grupoBean)== Util::getIdObjeto($inscritobean->getgrupo() ))?"selected":"";?>
					value="<?php echo Util::getIdObjeto($grupoBean);?>">
				    <?php echo Util::getNomeObjeto($grupoBean)?></option>			    
				  <?php
				}
				?>
				</select></TD>
	</TR>
	<TR style="display: none;">
		<TD>Data abertura inscrição</TD>
		<TD><INPUT id="dtinscricao" name="dtinscricao" size="30" type="tel"
			value="<?php echo Util::timestamptostr('d/m/Y',$inscritobean->getdtinscricao());?>">
		</TD>
	</TR>
	<TR style="display: none;">
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
					<?php echo ("" == $inscritobean->gettamanhocamisa())?"selected":"";?>>Escolha
					um tamanho</option>
				<?php
				
				for($i = 0; $i < count ( $tamanhoCamisa ); $i ++) {
					?>
				  <option value="<?php echo $tamanhoCamisa[$i]?>"
					<?php echo ( $tamanhoCamisa[$i] == $inscritobean->gettamanhocamisa())?"selected":"";?>><?php echo $tamanhoCamisa[$i]?></option>			    
				  <?php
				}
				?>
				</select></TD>
	</TR>
	
	<TR style="display: none;">
		<TD>Pessoa</TD>
			<?php $idpessoa = Util::getIdObjeto($inscritobean->getpessoa());?>
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
					<?php echo ( $idpessoa > 0)?"selected":"";?>><?php echo $inscritobean->getpessoa()->getnome();?></option>
				  <?php }?>			    
				</select></TD>
	</TR>
	<?php }?>
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
