<?php
include_once PATHAPP . '/mvc/kart/model/bean/CampeonatoBean.php';
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<input type="hidden" id="campeonato" 	name="campeonato" 	value="<?php echo $selcampeonato; ?>" /> 
<input type="hidden" id="etapa" 	name="etapa" 		value="<?php echo $seletapa; ?>" /> 
<input type="hidden" id="bateria" 	name="bateria"	 	value="<?php echo $selbateria; ?>" /> 
<table border="0">
	<tr>
		<td>Campeonato:</td>
		<td><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$listcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $listcampeonatobean->getid();?>"
					<?php echo ($listcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $listcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
			<select id="etapa" name="etapa" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
				  <?php
						//echo count ( $seletapaCollection );
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$listetapabean = $seletapaCollection [$i];
							?>
				    <option value="<?php echo $listetapabean->getid();?>"
					<?php echo ($listetapabean->getid()==$seletapa)?"selected":"";?>><?php echo $listetapabean->getnome();?></option>
				  <?php
						}
						?>
			</select>
		</td>
		<td>Bateria:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;"><select
			id="bateria" name="bateria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
					  <?php
							//echo count ( $selbateriaCollection );
							for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
								$listbateriabean = $selbateriaCollection [$i];
								?>
					    <option value="<?php echo $listbateriabean->getid();?>"
					<?php echo ($listbateriabean->getid()==$selbateria)?"selected":"";?>><?php echo $listbateriabean->getnome();?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
	<TR>
		<TD>Url Resultados</TD>
		<TD colspan="5"><INPUT id="urlresultados" name="urlresultados" size="100" type="text"
			value="<?php echo $selbateriabean->geturlresultados();?>"></TD>
	</TR>
</table>
<TABLE>
	<TR>
		<TD colspan="2">
			<?php 
			$action = "Ler URL";
			echo $button->btCustom($idurl, $idobj, $action, $target, Choice::LER);
			$action = "Validar";
			echo $button->btCustom($idurl, $idobj, $action, $target, Choice::VALIDAR);
			echo $button->btSV($idobj, $idurl); ?>
			
		</TD>
	</TR>
	<TR>
		<TD colspan="2">
			<?php echo isset($mensagem)?$mensagem:''; ?>
		</TD>
	</TR>
	<TR>
		<TD>
		pos	kart	nome	volta
		<br>
			<textarea id="entrada" name="entrada" rows="40" cols="80"><?php echo $entrada; ?></textarea>
		</TD>
		<TD valign="top">
			<br>
			<table border="1">
			<?php 
			$linhac=0;
			foreach ($saida as &$lin){
				$header= "";
				$linha = "";
				foreach ($lin as $key => &$coluna){	
					$header .="<td><small>". $key."</small></td>";			
					$linha .="<td><small>".$coluna."</small></td>";
				}
				if($linhac==0){
				?>
				<tr>
				<?php
				echo $header;
				?>
				</tr>
				<?php
				}
				?>
				<tr>
				<?php
				echo $linha;
				?>
				</tr>
				<?php
				$linhac++;
			}
			
			?>
			</table>
		</TD>
	</TR>	
	

	
	
</TABLE>
