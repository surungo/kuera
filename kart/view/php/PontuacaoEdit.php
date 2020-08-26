<?php
include_once PATHAPP . '/mvc/kart/model/bean/PosicaoBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PontuacaoEsquemaBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>Valor</TD>
		<TD><INPUT id="valor" name="valor" size="30" type="text"
			value="<?php echo $bean->getvalor();?>"></TD>
	</TR>
	<TR>
		<TD>Posicao</TD>
		<TD>
			 <?php
				
				$idposicao = gettype ( $bean->getposicao () ) == "object" ? $bean->getposicao ()->getid () : $bean->getposicao ();
				?>
			
				<select class="css_select" id="posicao" name="posicao">
								
					<?php
					for($i = 0; $i < count ( $cltPosicaoSelecionar ); $i ++) {
						$beanPosicao = new PontoBean ();
						$beanPosicao = $cltPosicaoSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPosicao->getid();?>"
					<?php echo ($idposicao==$beanPosicao->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPosicao->getnome();?>
						</option>
				<?php
					}
					?>
				</select>
		</TD>
	</TR>
	<TR>
    		 <?php
							$idpontuacaoesquema = gettype ( $bean->getpontuacaoesquema () ) == "object" ? $bean->getpontuacaoesquema ()->getid () : $bean->getpontuacaoesquema ();
							?>
			<TD>Esquema de Pontuação</TD>
		<TD><select class="css_select" id="pontuacaoesquema"
			name="pontuacaoesquema">
					<?php
					for($i = 0; $i < count ( $cltPontuacaoEsquemaSelecionar ); $i ++) {
						$beanPontuacaoEsquema = new PontuacaoEsquemaBean ();
						$beanPontuacaoEsquema = $cltPontuacaoEsquemaSelecionar [$i];
						?>
			    		<option value="<?php echo $beanPontuacaoEsquema->getid();?>"
					<?php echo ($idpontuacaoesquema==$beanPontuacaoEsquema->getid())?"selected='selected'":""; ?>>
							<?php echo  $beanPontuacaoEsquema->getnome();?>
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
		<TD colspan="2">
				<?php echo $button->btSEV($idobj,$idurl); ?>
			</TD>
		<TD></TD>
	</TR>
</TABLE>
