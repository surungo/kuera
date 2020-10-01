<?php
include_once PATHPUBPHPINCLUDE . '/headerEdit.php';
?>
<TABLE>
	<TR>
		<TD>usuario</TD>
		<TD>
			<select id="usuario" name="usuario" 
				<option value="">Nenhum</option>
			  <?php
			  		
			  for($i = 0; $i < count ( $usuarioCollection ); $i ++) {
			  	$listusuariobean = $usuarioCollection [$i];
						?>
			    <option value="<?php echo $listusuariobean->getid();?>"
			    <?php echo ($listusuariobean->getid()==$bean->getusuario())?"selected":"";?>>
			    <?php echo $listusuariobean->getnome();?></option>
			  <?php
					}
					?>
			</select>
			</TD>
	</TR>
	<TR>
		<TD>bateria</TD>
		<TD>
			<select id="bateria" name="bateria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Nenhum</option>
			  <?php
			  		
			  for($i = 0; $i < count ( $bateriaCollection ); $i ++) {
			  	$listbateriabean = $bateriaCollection [$i];
						?>
			    <option value="<?php echo $listbateriabean->getid();?>"
			    <?php echo ($listbateriabean->getid()==$bean->getbateria())?"selected":"";?>>
			    <?php 
			    echo ((Util::getIdObjeto($bean->getcampeonato())>0)?"":Util::getNomeObjeto($listbateriabean->getetapa()->getcampeonato())." - ") . 
			    ((Util::getIdObjeto($bean->getetapa())>0)?"":Util::getNomeObjeto($listbateriabean->getetapa())." - ") .
			    $listbateriabean->getnome();?></option>
			  <?php
					}
					?>
			</select>
			</TD>
	</TR>
	<TR>
		<TD>etapa</TD>
		<TD>
			<select id="etapa" name="etapa" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Nenhum</option>
			  <?php
			  		
					for($i = 0; $i < count ( $etapaCollection ); $i ++) {
						$listetapabean = $etapaCollection [$i];
						?>
			    <option value="<?php echo $listetapabean->getid();?>"
			    <?php echo ($listetapabean->getid()==$bean->getetapa())?"selected":"";?>>
			    <?php echo ((Util::getIdObjeto($bean->getcampeonato())>0)?"":Util::getNomeObjeto($listetapabean->getcampeonato())." - ").$listetapabean->getnome();?></option>
			  <?php
					}
					?>
			</select>
			</TD>
	</TR>
	<TR>
		<TD>campeonato</TD>
		<TD><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Nenhum</option>
			  <?php
					for($i = 0; $i < count ( $campeonatoCollection ); $i ++) {
						$listcampeonatobean = $campeonatoCollection [$i];
						?>
			    <option value="<?php echo $listcampeonatobean->getid();?>"
			    <?php echo ($listcampeonatobean->getid()==$bean->getcampeonato())?"selected":"";?>><?php echo $listcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select>
			
			</TD>
	</TR>
	<TR>
		<TD>fase</TD>
		<TD><INPUT id="fase" name="fase	" size="30" type="text"
			value="<?php echo $bean->getfase();?>"></TD>
	</TR>
	<TR>
		<TD>taxaatualizacao</TD>
		<TD><INPUT id="taxaatualizacao" name="taxaatualizacao	" size="30"
			type="text" value="<?php echo $bean->gettaxaatualizacao();?>"></TD>
	</TR>
	<TR>
		<TD>col01</TD>
		<TD><INPUT id="col01" name="col01	" size="30" type="text"
			value="<?php echo $bean->getcol01();?>"></TD>
	</TR>
	<TR>
		<TD>col02</TD>
		<TD><INPUT id="col02" name="col02	" size="30" type="text"
			value="<?php echo $bean->getcol02();?>"></TD>
	</TR>
	<TR>
		<TD>col03</TD>
		<TD><INPUT id="col03" name="col03	" size="30" type="text"
			value="<?php echo $bean->getcol03();?>"></TD>
	</TR>
	<TR>
		<TD>col04</TD>
		<TD><INPUT id="col04" name="col04	" size="30" type="text"
			value="<?php echo $bean->getcol04();?>"></TD>
	</TR>
	<TR>
		<TD>col05</TD>
		<TD><INPUT id="col05" name="col05	" size="30" type="text"
			value="<?php echo $bean->getcol05();?>"></TD>
	</TR>
	<TR>
		<TD>col06</TD>
		<TD><INPUT id="col06" name="col06	" size="30" type="text"
			value="<?php echo $bean->getcol06();?>"></TD>
	</TR>
	<TR>
		<TD>col07</TD>
		<TD><INPUT id="col07" name="col07	" size="30" type="text"
			value="<?php echo $bean->getcol07();?>"></TD>
	</TR>
	<TR>
		<TD>col08</TD>
		<TD><INPUT id="col08" name="col08	" size="30" type="text"
			value="<?php echo $bean->getcol08();?>"></TD>
	</TR>
	<TR>
		<TD>col09</TD>
		<TD><INPUT id="col09" name="col09	" size="30" type="text"
			value="<?php echo $bean->getcol09();?>"></TD>
	</TR>
	<TR>
		<TD>col10</TD>
		<TD><INPUT id="col10" name="col10	" size="30" type="text"
			value="<?php echo $bean->getcol10();?>"></TD>
	</TR>
	<TR>
		<TD>col11</TD>
		<TD><INPUT id="col11" name="col11	" size="30" type="text"
			value="<?php echo $bean->getcol11();?>"></TD>
	</TR>
	<TR>
		<TD>col12</TD>
		<TD><INPUT id="col12" name="col12	" size="30" type="text"
			value="<?php echo $bean->getcol12();?>"></TD>
	</TR>
	<TR>
		<TD>col13</TD>
		<TD><INPUT id="col13" name="col13	" size="30" type="text"
			value="<?php echo $bean->getcol13();?>"></TD>
	</TR>
	<TR>
		<TD>col14</TD>
		<TD><INPUT id="col14" name="col14	" size="30" type="text"
			value="<?php echo $bean->getcol14();?>"></TD>
	</TR>
	<TR>
		<TD>col15</TD>
		<TD><INPUT id="col15" name="col15	" size="30" type="text"
			value="<?php echo $bean->getcol15();?>"></TD>
	</TR>
	<TR>
		<TD>col16</TD>
		<TD><INPUT id="col16" name="col16	" size="30" type="text"
			value="<?php echo $bean->getcol16();?>"></TD>
	</TR>
	<TR>
		<TD>col17</TD>
		<TD><INPUT id="col17" name="col17	" size="30" type="text"
			value="<?php echo $bean->getcol17();?>"></TD>
	</TR>
	<TR>
		<TD>col18</TD>
		<TD><INPUT id="col18" name="col18	" size="30" type="text"
			value="<?php echo $bean->getcol18();?>"></TD>
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
