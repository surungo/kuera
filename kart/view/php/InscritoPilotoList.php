<?php
include_once PATHAPP . '/mvc/public/model/business/PaginaBusiness.php';
include_once PATHAPP . '/mvc/public/model/bean/PaginaBean.php';

include_once PATHPUBPHPINCLUDE . '/headerList.php';

Util::echobr ( 0, "InscritoPilotoList $ selcampeonatoBean", $selcampeonatoBean );

$equipeMostraList = true;

$colunas =  array (
			"pessoa" =>
			array (
				"id" => "60",
				"nome" => "Pessoa",
				"mostrar" => true
			),
			"piloto" =>
			array (
				"id" => "70",
				"nome" => "Piloto",
				"mostrar" => true
			),
			"campeonato" =>
			array (
				"id" => "80",
				"nome" => "Campeonato",
				"mostrar" => true
			),
			"nr" =>
			array (
				"id" => "110",
				"nome" => "Nr Inscrito",
				"mostrar" => true
			),
			"cpf" =>
			array (
				"id" => "138",
				"nome" => "CPF",
				"mostrar" => true
			),
			"nome" =>
			array (
				"id" => "141",
				"nome" => "Nome",
				"mostrar" => true
			),
			"categorias" =>
			array (
				"id" => "182",
				"nome" => "Categoria",
				"mostrar" => true
			),
			"situacao" =>
			array (
				"id" => "194",
				"nome" => "Situação",
				"mostrar" => true
			)
			
			);


?>

<br>
<!-- EventCombo -->
<?php 
$var = PATHAPPVER."/$sistemaCodigo/view/php/parts/EventCombo.php";
include $var;
?>

<table class="littleTable" style="float: right;" cellspacing="0"
	cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="littleTableTh">Descrição</th>
			<th class="littleTableTh">Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="littleTableTd">Total pago</td>
			<td class="littleTableTd">
			<?php echo $totalPago;?>
    	</td>
		</tr>
		<tr>
			<td class="littleTableTd">Total não pago</td>
			<td class="littleTableTd">
			<?php echo $totalNPago;?>
    	</td>
		</tr>
		<tr>
			<td class="littleTableTd">Total com data pago</td>
			<td class="littleTableTd">
			<?php echo $totalDtPago;?>
    	</td>
		</tr>
		<tr>
			<td class="littleTableTd">Total sem data pago</td>
			<td class="littleTableTd">
			<?php echo $totalNDtPago;?>
    	</td>
		</tr>
	</tbody>
</table>
<?php
if(isset($totalPilotosGrupos)){
?>
<table class="littleTable" style="float: right;" cellspacing="0"
	cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="littleTableTh">Grupo</th>
			<th class="littleTableTh">Total</th>
		</tr>
	</thead>
	<tbody>
    <?php
    for($i = 0; $i < count ( $totalPilotosGrupos ); $i ++) {
    	$grupobean = $totalPilotosGrupos [$i];
    ?>
      	<tr>
    		<td class="littleTableTd">
    			<?php echo Util::getNomeObjeto($grupobean);?>
        	</td>
    		<td class="littleTableTd">
    			<?php echo $grupobean->getTotal()?>
        	</td>
    	</tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php
}
?>
<style>
.classSpan{
	font-size: 11px;
}
</style>
<br><?php echo $button->btCustom($idurl,$idobj,"Adicionar idpessoa em todos os inscritos",$target,Choice::PASSO_5 );?>
<br><?php echo $button->btCustom($idurl,$idobj,"Adicionar idpessoa em todos os pilotos",$target,Choice::PASSO_6 );?>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    <?php
				if ($editar == true) {
					?>
      <th class="headerlink">&nbsp;</th>
		<?php
				}

				foreach ($colunas as $key => $coluna) {
					if($coluna["mostrar"]){?><th class="header"><?php echo $coluna["nome"]?></th><?php }
				}

		?>

</tr>
	</thead>

	<tbody>
	<?php
	$pessoaBusiness = new PessoaBusiness();
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$inscritoBeanLista = new InscritoBean ();
		$inscritoBeanLista = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		$categoria="";
		$categoriaInscritoBusiness = new CategoriaInscritoBusiness();
		$catClt = $categoriaInscritoBusiness->findByInscrito($inscritoBeanLista);
		$catCltSize = count ( $catClt );
		
		for($izc = 0; $izc < $catCltSize ; $izc ++) {
			$catInscBean = new CategoriaInscritoBean ();				
			$catInscBean = $catClt[$izc];
			$catBean = $catInscBean->getCategoria();
			$categoria = $categoria . ( ($izc>0)?"<br>":"" ) . Util::getNomeObjeto ( $catBean );
		}	
		if(count($catClt )>1){
			$categoria = "<small>".$categoria."</small>";
		}
		?>
	<tr class="<?php echo $corlinha;?>">	
		<td>
		<?php
			echo $button->btEditar ( $inscritoBeanLista->getid (), $idurl );
			echo $button->btExcluirImagem ( $inscritoBeanLista->getid (), $idurl );
			?>
		</td>
	    	<?php if($colunas["pessoa"]["mostrar"]){?>
		<td>
			<?php 
			$cpfPessoa = "";
			$cpfPiloto ="";
			$pessoaBean = new PessoaBean();
			$idpessoa = Util::getIdObjeto($inscritoBeanLista->getPessoa());
			if($idpessoa==0){
			
				$pessoaBean = $pessoaBusiness->findByCPF($inscritoBeanLista->getcpf());
				if( Util::getIdObjeto($pessoaBean)!=0){
					$imagem = URLAPPVER."/public/view/images/add.png";
					$idobj = Util::getIdObjeto($inscritoBeanLista);
					$itemFK = Util::getIdObjeto($pessoaBean );
					$w = "20"."px";
					$h = $w;
					$choice = Choice::PASSO_1 ;
						$cpfPessoa = "<nobr>".$button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h).
					"pessoa por CPF";
				}
				?>
				<span class="classSpan"><?php echo $cpfPessoa ;?></span></nobr>
				<?php		
			}else{
				$pessoaBean = $pessoaBusiness->findById($idpessoa);
				$cpfPessoa = "pessoa ok";
			?>
				<nobr><span class="classSpan"><?php echo $cpfPessoa ;?></span></nobr>
			</td>
		    	<?php } if($colunas["piloto"]["mostrar"]){?>
			<td>

			<?php	

				$pilotoBean = $pilotoBusiness->findByPessoa($idpessoa);
				$cpfPiloto = "";
				if( Util::getIdObjeto($pilotoBean)!=0){
					$cpfPiloto = "piloto ok";
				}else{
					$pilotoBean = $pilotoBusiness->findByCPF($pessoaBean->getcpf());
					if(Util::getIdObjeto($pilotoBean)>0){
						$cpfPiloto ="piloto por CPF";					
					
						$imagem = URLAPPVER."/public/view/images/add.png";
						$idobj = Util::getIdObjeto($inscritoBeanLista);
						$itemFK = Util::getIdObjeto($pilotoBean);
						$w = "20"."px";
						$h = $w;
						$choice = Choice::PASSO_2 ;
		
						$cpfPiloto = $button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h). 
							$cpfPiloto;
					}else{
						$cpfPiloto ="piloto cadastrar";					
					
						$imagem = URLAPPVER."/public/view/images/add.png";
						$idobj = Util::getIdObjeto($inscritoBeanLista);
						$itemFK = Util::getIdObjeto($pessoaBean);
						$w = "20"."px";
						$h = $w;
						$choice = Choice::PASSO_3 ;
		
						$cpfPiloto = $button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h). 
							$cpfPiloto;
					}
				}
			?>	
			<nobr><span class="classSpan"><?php echo $cpfPiloto ;?></span></nobr>
			
			</td>
		    	<?php } if($colunas["campeonato"]["mostrar"]){?>
			<td>

			<?php
				$pilotoCampeonato = "";
 				$pilotoBean = $pilotoBusiness->findByPessoa($idpessoa);
				if(Util::getIdObjeto($pilotoBean)>0){
					$pilotoCampeonatoBusiness = new PilotoCampeonatoBusiness();
					$pilotoCampeonatoBean = new PilotoCampeonatoBean();
					$pilotoCampeonatoBean->setpiloto($pilotoBean);
					$pilotoCampeonatoBean->setcampeonato($selcampeonatoBean);
					$pilotoCampeonatoBean = $pilotoCampeonatoBusiness->findByCampeonatoPiloto($pilotoCampeonatoBean);
					if(Util::getIdObjeto($pilotoCampeonatoBean )>0){
						$pilotoCampeonato = "piloto cadastrado no campeonato";
					}else{
						$pilotoCampeonato = "cadastrar piloto no campeonato";
						$imagem = URLAPPVER."/public/view/images/add.png";
						$idobj = Util::getIdObjeto($inscritoBeanLista);
						$itemFK = Util::getIdObjeto($pilotoBean);
						$w = "20"."px";
						$h = $w;
						$choice = Choice::PASSO_4 ;
						
						$pilotoCampeonato = $button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h). 
							$pilotoCampeonato ;
		
					}
					
					
					
					
				?>	
					<nobr><span class="classSpan"><?php echo $pilotoCampeonato ;?></span></nobr>
				<?php

				}
			
			} 
			?>
		</td>
		<?php } if($colunas["nr"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getnrinscrito();?></nobr>
		</td>
		<?php } if($colunas["cpf"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getcpf();?></nobr>
		</td>
		<?php } if($colunas["nome"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnome();?>
		</td>
		<?php } if($colunas["categorias"]["mostrar"]){?>
		<td>
			<?php echo $categoria;?>
		</td>
		<?php } if($colunas["situacao"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getsituacao();?>
		</td>
		<?php } ?>
		</tr>
	<?php }?>
  </tbody>
</table>
