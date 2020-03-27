<?php
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Bateria</TD>
		<TD><input type="hidden" id="campeonato" name="campeonato"
			value="<?php echo $selcampeonato;?>"> <input type="hidden" id="etapa"
			name="etapa" value="<?php echo $seletapa;?>"> <select
			class="css_select" id="bateria" name="bateria">
				<?php
				for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
					$beanBateria = new BateriaBean ();
					$beanBateria = $selbateriaCollection [$i];
					?>
			    		<option value="<?php echo $beanBateria->getid();?>"
					<?php echo (Util::getIdObjeto($bean->getbateria())==$beanBateria->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanBateria->getnome()." - ".$beanBateria->getetapa()->getnome()." - ".$beanBateria->getetapa()->getcampeonato()->getnome();?>
						</option>
				<?php
				}
				?>
				</select></TD>
	</TR>
	<TR>
		<TD>Piloto</TD>
		<TD><input type="hidden" id="piloto" name="piloto"
			value="<?php echo Util::getIdObjeto($bean->getpiloto());?>">
	       		<?php
										if (Util::getIdObjeto ( $bean->getpiloto () ) > 0) {
											echo Util::getNomeObjeto ( $bean->getpiloto () );
											echo "<br><small><small>Trocar Piloto </small></small>";
										} else {
											echo "<br><small><small>Adicionar piloto </small></small>";
										}
										
										?>
	       		
	       		<?php echo ButtonClass::btCustomImagem($idobj,$idurl,Choice::ADICIONAR,"mvc/public/view/images/add.png");?>
			</TD>
	</TR>
	<TR>
		<TD>Pre Grid (Divulgado dias antes da corrida)</TD>
		<TD><?php
		
		$idpregridlargada = gettype ( $bean->getpregridlargada () ) == "object" ? $bean->getpregridlargada ()->getid () : $bean->getpregridlargada ();
		?>
			
				<select class="css_select" id="pregridlargada" name="pregridlargada">
				<option value=""></option>			
								
					<?php
					for($i = 0; $i < count ( $cltPosicaoSelecionar ); $i ++) {
						$beanPreGridPosicao = new PosicaoBean ();
						$beanPreGridPosicao = $cltPosicaoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPreGridPosicao->getid();?>"
					<?php echo ($idpregridlargada==$beanPreGridPosicao->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPreGridPosicao->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Grid (real de largada)</TD>
		<TD><?php
		
		$idgridlargada = gettype ( $bean->getgridlargada () ) == "object" ? $bean->getgridlargada ()->getid () : $bean->getgridlargada ();
		?>
			
				<select class="css_select" id="gridlargada" name="gridlargada">
				<option value=""></option>			
								
					<?php
					for($i = 0; $i < count ( $cltPosicaoSelecionar ); $i ++) {
						$beanPosicao = new PosicaoBean ();
						$beanPosicao = $cltPosicaoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPosicao->getid();?>"
					<?php echo ($idgridlargada==$beanPosicao->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPosicao->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Presente</TD>
		<TD><select class="css_select" id="presente" name="presente">
				<option value="S"
					<?php echo ($bean->getpresente()=="S")?"selected='selected'":""; ?>>Presente</option>
				<option value="N"
					<?php echo ($bean->getpresente()=="N")?"selected='selected'":""; ?>>Ausente</option>
		</select></TD>
	</TR>
	<TR>
		<TD>Chegada (Real da corrida)
		
		<TD><?php
		
		$idposicao = Util::getIdObjeto($bean->getposicao());
		?>
			
				<select class="css_select" id="posicao" name="posicao">
				<option value=""></option>			
								
					<?php
					for($i = 0; $i < count ( $cltPosicaoSelecionar ); $i ++) {
						$beanPosicao = new PosicaoBean ();
						$beanPosicao = $cltPosicaoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPosicao->getid();?>"
					<?php echo ($idposicao==$beanPosicao->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPosicao->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Chegada Oficial (depois dos ajuste de desqualificações e
			convidados)</TD>
		<TD><?php
		
		$idposicaooficial = gettype ( $bean->getposicaooficial () ) == "object" ? $bean->getposicaooficial ()->getid () : $bean->getposicaooficial ();
		?>
			
				<select class="css_select" id="posicaooficial" name="posicaooficial">
				<option value=""></option>			
					<?php
					for($i = 0; $i < count ( $cltPosicaoSelecionar ); $i ++) {
						$beanposicaooficial = new PosicaoBean ();
						$beanposicaooficial = $cltPosicaoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanposicaooficial->getid();?>"
					<?php echo ($idposicaooficial==$beanposicaooficial->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanposicaooficial->getnome();?>
						</option>
				<?php
					}
					?>
				</select></TD>
	</TR>
	<TR>
		<TD>Kart largada</TD>
		<TD><INPUT id="kartlargada" name="kartlargada" size="30" type="text"
			value="<?php echo $bean->getkartlargada();?>"></TD>
	</TR>
	<TR>
		<TD>Kart chegada</TD>
		<TD><INPUT id="kart" name="kart" size="30" type="text"
			value="<?php echo $bean->getkart();?>"></TD>
	</TR>

	<script>
$(document).ready(function() {
	  $("#volta").mask("99:99:99,999");
});
</script>
	<TR>
		<TD>Tempo de prova</TD>
		<TD><INPUT id="tempo" name="tempo" size="30" type="text"
			value="<?php echo $bean->gettempo();?>"></TD>
	</TR>

	<TR>
		<TD>Volta mais rapida</TD>
		<TD><INPUT id="volta" name="volta" size="30" type="text"
			value="<?php echo $bean->getvolta();?>"></TD>
	</TR>

	<TR>
		<TD>Nr volta mais rapida</TD>
		<TD><INPUT id="na" name="na" size="30" type="text"
			value="<?php echo $bean->getna();?>"></TD>
	</TR>

	<TR>
		<TD>Peso Piloto</TD>
		<TD><INPUT id="peso" name="peso" size="30" type="text"
			value="<?php echo $bean->getpeso();?>"></TD>
	</TR>

	<TR>
		<TD>Penalizacao</TD>
		<TD>		<INPUT id="penalizacao" name="penalizacao" size="30" type="text"			value="<?php echo $bean->getpenalizacao();?>">		</TD>
	</TR>

	<TR>
		<TD>Convidado</TD>
		<TD><select class="css_select" id="convidado" name="convidado">
				<option value="">N&atilde;o</option>
				<option value="S"
					<?php echo ("S"==$bean->getconvidado())?"selected='selected'":""; ?>>Sim</option>
		</select></TD>
	</TR>


	<TR>
		<TD>Informa&ccedil;&otilde;es do relacionada ao piloto na prova.</TD>
		<TD><textarea id="informacao" name="informacao"><?php echo $bean->getinformacao();?></textarea>
		</TD>
	</TR>


	<TR>
		<TD>Observa&ccedil;&otilde;es para uso interno</TD>
		<TD><textarea id="observacao" name="observacao"><?php echo $bean->getobservacao();?></textarea>
		</TD>
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
		<TD></TD>
	</TR>
</TABLE>
