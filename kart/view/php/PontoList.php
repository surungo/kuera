<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;
			
			</td> 
		<?php
		}
		?>    
		<!-- <th class="header" width="100px">Codigo</td> -->
			<th class="header">Posição
			
			</td>
			<th class="header" width="100px">Pontos
			
			</td>
			<th class="header" width="100px">Descartável
			
			</td>
			<th class="header">Campeonato
			
			</td>
			<th class="header" width="40px">Ativo
			
			</td>
		</tr>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$beanCampeonato = $campeonatoBusiness->findById ( $collection [$i]->getidcampeonato () );
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $collection [$i]->getid (), $idurl );
			echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td>
			<?php echo $collection[$i]->getposicao();?>
    </td>
			<td>
					<?php echo $collection[$i]->getvalor();?>
   	</td>
			<td>
					<?php echo ($collection[$i]->getdescartavel()=="1")?"Sim":"Não" ;?>
   	</td>
			<td>
			<?php
		
echo $beanCampeonato->getnome ();
		?>
		</td>
			<td>
			<?php echo ($collection[$i]->getativo()==1?"Sim":"Não");?>
		</td>
		</tr>
	<?php }?>


</table>
