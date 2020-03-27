<table cellspacing="0" cellpadding="0" class="cardTb">
	<tr>
		<td class="tdfoto"><img class="foto" src="<?php echo $fotourl;?>" /></td>
		<td class="texto_pontos" colspan="3">
			<?php echo $posicaoRanking;?>ª
      		<br> <span class="labelPontos">
      		<?php echo $pontuacao?> Pontos
      		</span>

		</td>
	</tr>
	<tr>
		<td colspan="4" class="texto_Apelido">
		   <?php echo $apelido;?>
 		</td>
	
	
	<tr>
		<!--  		<td colspan="3" align="center"> -->

		<!--			<img src="<?php echo $p1W;?>" width="32px" > <img src="<?php echo $fastW;?>" width="32px" >-->
		<!--  		</td>	 -->
		<td class="tdFacebook">&nbsp;
		<?php
		
		if ($facebook != "") {
			?><a href="<?php echo $facebook;?>" target="_blank"> <img
				class="imgFace" src="<?php echo $btnFacebook;?>" />
		</a>	
		 <?php
		} else {
			?>
     	<img class="imgFace" src="<?php echo $btnFacebookNot;?>" />
     <?php
		}
		?>
		</td>
	</tr>
	<tr>
		<td colspan="4" class="texto_x">
			<div><?php echo $nome;?></div>
			<div>
				<b>Idade:</b> <?php echo $idade;?> Anos</div>
			<div>
				<b>Peso médio:</b> <?php echo $peso;?> Kilos</div>
		</td>
	</tr>
</table>

