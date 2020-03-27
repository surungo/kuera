<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
echo  $button->btCustom ( $idurl, 0, 'Voltar', null, null ); ?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    		<th class="header">&nbsp;</th>
			<th class="header">Eleitores</th>
			<th class="header">Opções Votadas</th>
			<th class="header">Opções de Votos</th>
			<th class="header">Falta votar no(s) grupo(s)</th>
						
		</tr>
	</thead>

	<tbody>
	<?php
	$totalVotosGeral = 0;
	$totalEleitorGeral = 0;
for($i = 0; $i < count ( $resultadoVotos ); $i ++) {
		$candidatoItem =$resultadoVotos[$i];
		$nome = $candidatoItem['eleitor'];
		$opcoesVotos = $candidatoItem['opcoes'];
		$votadavotos = $candidatoItem['votado'];
		$ideleitor = $candidatoItem['ideleitor'];
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<td>
		&nbsp;
		</td>
		<td>
			<?php echo $nome;?>
		</td>
		<td>
			<?php echo $votadavotos;?>
			
		</td>
		<td>
			<?php echo $opcoesVotos;?>
		</td>
		<td>
			<?php 
			$cltVotosGrupo = $votoBusiness->findGruposFaltaVotarByEleitor($ideleitor);
			Util::echobr (0, 'relatorioEleitorGrupoReport $cltVotosGrupo', $cltVotosGrupo );
				
			for($o = 0; $o < count ( $cltVotosGrupo ); $o ++) {
				$votoBean = $cltVotosGrupo[$o];
				Util::echobr (0, 'relatorioEleitorGrupoReport $votoBean', $votoBean );
					
				$eleitorCategoriaGrupoBean =  $votoBean->geteleitorcategoriagrupo();
				$categoriagrupobean = $eleitorCategoriaGrupoBean->getcategoriagrupo();
				echo Util::getNomeObjeto($categoriagrupobean->getcategoria());?>&nbsp;-&nbsp;
				<?php echo Util::getNomeObjeto($categoriagrupobean->getgrupo());?><br><?php 
			}?>
		</td>
	</tr>
<?php }?>
  </tbody>
</table>
  
