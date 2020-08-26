<table cellspacing="0" cellpadding="0" class="cardTb">
	<tr class="texto_Apelido_back">
		<td colspan="4" align="center">
		    	<?php echo $apelido;?>
        </td>
	</tr>
	<tr>
		<td colspan="4" valign="top" align="center">
			<table cellspacing="1" cellpadding="1" class="listTbGeral">
				<tr class="texto_header_geral">
					<td align="center">Etapa</td>
					<td align="center">Bateria</td>
					<td align="center">Posição</td>
					<td align="center">Pontos</td>
					<td align="center">Melhor volta</td>
				</tr>
	<?php
	
	$i = 0;
	$melhorPosicao = 1000;
	$melhorPosicaoBean = new PilotoBateriaBean ();
	
	$melhorVolta = "99:99.999";
	$melhorVoltaBean = new PilotoBateriaBean ();
	
	$melhorVoltaPista = "";
	
	$pilotoBateriaBean = new PilotoBateriaBean ();
	
	foreach ( $cltPilotoBateria as $k => $pilotoBateriaBean ) {
		
		$posicaoChegada = "";
		$pontuacaoChegada = "";
		$pontuacaoChegadaBean = new PontuacaoBean ();
		$posicaoChegadaBean = new PontoBean ();
		if ($pilotoBateriaBean->getposicao () != null) {
			$posicaoChegadaBean = $pilotoBateriaBean->getposicao ();
			if ($posicaoChegadaBean->getnome () != null) {
				// melhor posicao
				if ($melhorPosicao > $posicaoChegadaBean->getnome ()) {
					$melhorPosicao = $posicaoChegadaBean->getnome ();
					$melhorPosicaoBean = $pilotoBateriaBean;
				}
				
				$posicaoChegada = $posicaoChegadaBean->getnome () . "ª";
				
				if ($posicaoChegadaBean->getpontuacao () != null) {
					$pontuacaoChegadaBean = $posicaoChegadaBean->getpontuacao ();
					if ($pontuacaoChegadaBean->getvalor () != null) {
						$pontuacaoChegada = $pontuacaoChegadaBean->getvalor ();
					}
				}
			}
		}
		
		$bateria = "";
		$etapa = "";
		$bateriaBean = new BateriaBean ();
		$etapaBean = new EtapaBean ();
		if ($pilotoBateriaBean->getbateria () != null) {
			$bateriaBean = $pilotoBateriaBean->getbateria ();
			if ($bateriaBean != null && $bateriaBean->getnome () != null) {
				$bateria = $bateriaBean->getnome ();
			}
			if ($bateriaBean != null && $bateriaBean->getetapa () != null) {
				$etapaBean = $bateriaBean->getetapa ();
				if ($etapaBean->getnumero () != null) {
					$i ++;
					while ( $i <= $etapaBean->getnumero () - 1 ) {
						?>
				    <tr
					class="texto_linha_geral cor_<?php echo ($i%2?"par":"impar");?>">
					<td align="center">
							<?php echo $i;?>ª
				      	</td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
					<?php
						$i ++;
					}
					$i = $etapaBean->getnumero ();
					$etapa = $etapaBean->getnumero () . "ª";
				}
			}
		}
		
		$volta = "";
		if ($pilotoBateriaBean->getvolta () != null) {
			$volta = substr ( $pilotoBateriaBean->getvolta (), 3 );
			// melhor volta
			if ($melhorVolta > $volta) {
				$melhorVolta = $volta;
				$melhorVoltaBean = $pilotoBateriaBean;
				$pistaBean = $bateriaBean->getpista ();
				if ($pistaBean != null && $pistaBean->getnome () != null) {
					$melhorVoltaPista = $pistaBean->getnome ();
				}
			}
		}
		
		$donoVolta = "";
		$donoVolta = ($pilotoBateriaBean->getdonovolta () == 1) ? "<img src='" . $fast . "' width='16px' >" : "";
		
		?>
    <tr class="texto_linha_geral cor_<?php echo ($i%2?"par":"impar");?>">
					<td align="center">
      		<?php echo $etapa;?>
      	</td>
					<td align="center">
      		<?php echo $bateria;?>
      	</td>
					<td align="center">
      		<?php echo $posicaoChegada;?>
		</td>
					<td align="center">
      		<?php echo $pontuacaoChegada;?>
      	</td>
					<td align="center">
      		<?php echo $volta." ".$donoVolta;?>	
      	</td>
				</tr>
	<?php
	
}
	$i ++;
	for(; $i < 11; $i ++) {
		?>
    <tr class="texto_linha_geral cor_<?php echo ($i%2?"par":"impar");?>">
					<td align="center">
			<?php echo $i;?>ª
      	</td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
	<?php
	}
	?>
	</table>
		</td>
	</tr>
	<tr class="bottonInfo">
		<td colspan="4">
		<?php
		$melhorPosicao = (1000 == $melhorPosicao) ? "" : $melhorPosicao . "ª";
		$melhorVolta = ("99:99.999" == $melhorVolta) ? "" : $melhorVolta;
		
		?>
&nbsp;Ranking: <span class="bottonInfoTx"><?php echo $posicaoRanking;?>ª</span>
			&nbsp;Total de pontos: <span class="bottonInfoTx"><?php echo $pontuacao?> Pontos </span><br>
			&nbsp;Melhor posição: <span class="bottonInfoTx"><?php echo $melhorPosicao;?></span><br>
			&nbsp;Melhor volta: <span class="bottonInfoTx"><?php echo $melhorVolta;?> na <?php echo $melhorVoltaPista;?></span><br>
			&nbsp; <span class="bottonInfoTxP">Media harmonica ponderada para desempate <?php echo $desempate;?></span>
		</td>
	</tr>
</table>
