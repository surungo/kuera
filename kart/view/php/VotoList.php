<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>

Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<option value="0">Todos</option>
	
  <?php
		for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
			$icampeonatobean = $cltCampeonatoCollection [$i];
			?>
    <option value="<?php echo $icampeonatobean->getid();?>"
		<?php echo ($icampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $icampeonatobean->getnome();?></option>
  <?php
		}
  ?>
</select>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
      	    <th class="headerlink">&nbsp;</th> 
    		<th class="header">Categoria/Grupo</th>
			<th class="header">Eleitor</th>
			<th class="header">Candidato</th>
			<th class="header">Data</th>
		</tr>
	</thead>

	<tbody>
	<?php
	
	$pessoaBusiness =  new PessoaBusiness();
	$categoriaGrupoBusiness =  new CategoriaGrupoBusiness();
	Util::echobr ( $dbg, 'VotoList count ( $collection )', count ( $collection ) );	
	for($i = 0; $i < count ( $collection ); $i ++) {
		$votoBeanItem = new VotoBean();
		$votoBeanItem = $collection [$i];
		Util::echobr ( $dbg, 'VotoList XXXitem $votoBeanItem', $votoBeanItem);
		
		$eleitorCategoriaGrupoBean = $votoBeanItem->getEleitorCategoriaGrupo();
		$eleitorBean = $eleitorCategoriaGrupoBean->geteleitor();
		$categoriaGrupoBean = $categoriaGrupoBusiness->findById(Util::getIdObjeto($eleitorCategoriaGrupoBean->getCategoriaGrupo()));
		Util::echobr ( $dbg, 'VotoList $Util::getIdObjeto($eleitorBean->getpessoa())', Util::getIdObjeto($eleitorBean->getpessoa()));
		$epessoaBean = $pessoaBusiness->findById(Util::getIdObjeto($eleitorBean->getpessoa()));
		$nmeleitor = Util::getNomeObjeto($epessoaBean); 
		
		$nmcandidato = "";
		$candidatoCategoriaGrupoBean = $votoBeanItem->getCandidatoCategoriaGrupo();
		if($candidatoCategoriaGrupoBean != null &&
			Util::getIdObjeto($candidatoCategoriaGrupoBean) > 0  && 
			gettype ( $candidatoCategoriaGrupoBean ) == "object" ){

			Util::echobr ( $dbg, 'VotoList $candidatoCategoriaGrupoBean', $candidatoCategoriaGrupoBean);
			$candidatoBean = $candidatoCategoriaGrupoBean->getcandidato();
			if($candidatoBean!= null &&
				Util::getIdObjeto($candidatoBean) > 0  && 
				gettype ( $candidatoBean ) == "object" ){
				
				$cpessoaBean = $pessoaBusiness->findById(Util::getIdObjeto($candidatoBean->getpessoa()));
				$nmcandidato = Util::getNomeObjeto($cpessoaBean);
			}
		}	
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		
		<td>
		<?php
		if ($editar == true) {
			echo $button->btEditar ( $votoBeanItem->getid (), $idurl );
			echo $button->btExcluirImagem ( $votoBeanItem->getid (), $idurl );
			
		}?>
		</td>     
		<td>
			<?php echo Util::getNomeObjeto($categoriaGrupoBean->getcategoria());?> / <?php echo Util::getNomeObjeto($categoriaGrupoBean->getgrupo());?>
		</td>
		<td>
			<?php echo $nmeleitor;?>
		</td>
		<td>
			<?php echo $nmcandidato;?>	
		</td>
				<td>
			<?php echo $votoBeanItem->getdtcriacao();?>	
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
