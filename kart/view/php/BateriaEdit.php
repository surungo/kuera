<?php
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Campeonato</TD>
		<TD><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
			?>>
				<option value="">Selecione</option>
				  <?php
						$idcampeonatoselect = Util::getIdObjeto ( $bean->getetapa ()->getcampeonato () );
						for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
							?>
				    <option
					value="<?php echo $cltCampeonatoCollection[$i]->getid();?>"
					<?php echo ($cltCampeonatoCollection[$i]->getid()== $idcampeonatoselect)?"selected":"";?>><?php echo $cltCampeonatoCollection[$i]->getnome();?></option>
				  <?php
						}
						?>
				</select></TD>
	</TR>
	<TR>
		<TD>Etapa</TD>
		<TD>
				<?php
				if (count ( $cltEtapaCollection ) > 0) {
					?>
				<select class="css_select" id="etapa" name="etapa"
			<?php
					echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
					?>> 
				  <?php
					$idetapaselect = Util::getIdObjeto ( $bean->getetapa () );
					for($i = 0; $i < count ( $cltEtapaCollection ); $i ++) {
						?>
				    <option value="<?php echo $cltEtapaCollection[$i]->getid();?>"
					<?php echo ($cltEtapaCollection[$i]->getid()== $idetapaselect)?"selected":"";?>><?php echo $cltEtapaCollection[$i]->getnome();?></option>
				  <?php
					}
					?>
			</select>	
			<?php
				} else {
					?>	
				Este campeonato n&atilde;o tem etapas cadastrado.
			<?php }?>						
			</TD>
	</TR>
	<TR>
		<TD>Pista</TD>
		<TD>
				<?php
				if (count ( $cltPistaCollection ) > 0) {
					$idpistaselect = Util::getIdObjeto ( $bean->getpista () );
					?>
				<select class="css_select" id="pista" name="pista"
			<?php
					echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
					?>><option value="">Selecione</option> 
				  <?php
					for($i = 0; $i < count ( $cltPistaCollection ); $i ++) {
						$pistabean = new PistaBean ();
						$pistabean = $cltPistaCollection [$i];
						
						?>
				    <option value="<?php echo $pistabean->getid();?>"
					<?php echo ($pistabean->getid()== $idpistaselect)?"selected":"";?>><?php echo $pistabean->getnome();?></option>
				  <?php
					}
					?>
			</select>	
			<?php
				} else {
					?>	
				N&atilde;o tem pistas cadastradas.
			<?php
				}
				?>						
			</TD>
	</TR>
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
	<script>
		$(document).ready(function() {
		  $("#dtbateria").mask("99/99/9999 99:99:99");
		  
		});
		</script>
	<TR>
		<TD>Data</TD>
		<TD><INPUT id="dtbateria" name="dtbateria" size="30" type="text"
			value="<?php echo Util::timestamptostr('d/m/Y H:i:s',$bean->getdtbateria());?>">
		</TD>
	</TR>
	<TR>
		<TD>Categoria</TD>
		<TD>		
		<select id="categoria" name="categoria">
			<option value="">Obrigatorio</option>
			<?php
			for($i = 0; $i < count ( $categoriaclt ); $i ++) {
				$categoriabean = $categoriaclt [$i]; ?>
			<option value="<?php echo $categoriabean->getid();?>"
				<?php echo ($categoriabean->getid()== Util::getIdObjeto($bean->getcategoria()))?"selected":"";?>>
				<?php echo $categoriabean->getnome();?>
			</option>
			<?php
			}
			?>
		</select>
		</TD>
	</TR>
	<TR>
		<TD>Bateria Precedente</TD>
		<TD>		
		<?php
		if (count ( $cltEtapaCollection ) > 0) {
		?>
		<select  class="btn_select" id="etapaprecedente" name="etapaprecedente"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
			?>> 
			<option value="">Nenhum</option>
			<?php
			for($i = 0; $i < count ( $cltEtapaCollection ); $i ++) {
			?>
				<option value="<?php echo $cltEtapaCollection[$i]->getid();?>"
				<?php echo ($cltEtapaCollection[$i]->getid()== $idetapaPrecedenteselect)?"selected":"";?>><?php echo $cltEtapaCollection[$i]->getnome();?></option>
			<?php
			}
			?>
		</select>	
		<?php
		} else {
		?>	
			Este campeonato n&atilde;o tem etapas cadastrado.
		<?php }
		if (count ( $cltBateriaPrecedenteCollection ) > 0) {
		?>
		<select  class="css_select" id="bateriaprecedente" name="bateriaprecedente"
		<?php
				echo $button->atributos ( $idurl, $idobj, Choice::ABRIR, $target, $choice );
				?>>
				<option value="">Nenhum</option>
			  <?php

				for($i = 0; $i < count ( $cltBateriaPrecedenteCollection ); $i ++) {
					?>
			    <option value="<?php echo $cltBateriaPrecedenteCollection [$i]->getid();?>"
				<?php echo ($cltBateriaPrecedenteCollection [$i]->getid()== $idbateriaprecedenteselect)?"selected":"";?>><?php echo $cltBateriaPrecedenteCollection [$i]->getnome();?></option>
			  <?php
				}
				?>
		</select>	
		<?php } ?>		
		</TD>
	</TR>
	<TR>
		<TD>Esquema de Pontua&ccedil;&atilde;o</TD>
		<TD><select class="css_select" id="pontuacaoesquema"
			name="pontuacaoesquema">
								
					<?php
					$idpontuacaoesquemaselect = Util::getIdObjeto ( $bean->getpontuacaoesquema () );
					for($i = 0; $i < count ( $cltPontuacaoEsquemaSelecionar ); $i ++) {
						$beanPontuacaoEsquema = new PontuacaoEsquemaBean ();
						$beanPontuacaoEsquema = $cltPontuacaoEsquemaSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPontuacaoEsquema->getid();?>"
					<?php echo ($idpontuacaoesquemaselect==$beanPontuacaoEsquema->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPontuacaoEsquema->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Url Resultados</TD>
		<TD><INPUT id="urlresultados" name="urlresultados" size="30" type="text"
			value="<?php echo $bean->geturlresultados();?>"></TD>
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
