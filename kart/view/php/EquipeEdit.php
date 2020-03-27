<?php
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<script>
		$(document).ready(function() {
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
		<TD>Nr Inscrito (S&oacute; altere se tiver certeza) deixe em branco</TD>
		<TD><INPUT id="nrinscrito" name="nrinscrito" size="30" type="text"
			value="<?php echo $bean->getnrinscrito();?>"></TD>
	</TR>

	<TR>
		<TD>C&oacute;digo Acesso (S&oacute; altere se tiver certeza) deixe em branco</TD>
		<TD><INPUT id="codigoacesso" name="codigoacesso" size="30" type="text"
			value="<?php echo $bean->getcodigoacesso();?>"></TD>
	</TR>
	<TR>
		<TD>Valor (So altere se tiver certeza) deixe em branco</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalorDecimal();?>"></TD>
	</TR>
	<TR>
		<TD>IdInscritolider</TD>
		<TD><INPUT id="inscritolider" name="inscritolider" size="30"
			type="text" value="<?php echo $bean->getinscritolider();?>"></TD>
	</TR>
	<TR>
		<TD>Categoria</TD>
		<TD><select id="categoria" name="categoria">
				<option value="">Selecione</option>
				<?php
					for($i = 0; $i < count ( $selCategoriaCollection ); $i ++) {
						$beanCategoria = new CategoriaBean ();
						$beanCategoria = $selCategoriaCollection [$i];
						?>
			    		<option value="<?php echo $beanCategoria->getid();?>"
					<?php echo (Util::getIdObjeto($bean->getcategoria())==Util::getIdObjeto($beanCategoria))?"selected='selected'":""; ?>>
							<?php echo  $beanCategoria->getnome();?>
						</option>
				<?php
					}
				?>
				</select>
		</TD>
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
		<TD>Data Pagamento</TD>
		<TD><INPUT id="dtpagamento" name="dtpagamento" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y',$bean->getdtpagamento());?>">
		</TD>
	</TR>

	<TR>
		<TD>Campo auxiliar</TD>
		<TD><INPUT id="campoaux" name="campoaux" size="30" type="text"
			value="<?php echo $bean->getcampoaux();?>"></TD>
	</TR>
	<TR>
		<TD>Campeonato</TD>
		<TD><select class="css_select" id="campeonato" name="campeonato">
								
					<?php
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$beanCampeonato = new CampeonatoBean ();
						$beanCampeonato = $selcampeonatoCollection [$i];
						?>
			    		<option value="<?php echo $beanCampeonato->getid();?>"
					<?php echo ( Util::getIdObjeto($bean->getcampeonato())==Util::getIdObjeto($beanCampeonato) )?"selected='selected'":""; ?>>
							<?php echo  $beanCampeonato->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
			 </TD>
	</TR>

	<TR>
		<TD>
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
		<TD></TD>
	</TR>
</TABLE>
