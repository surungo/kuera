<?php
include_once PATHAPP . '/mvc/public/model/business/PaginaBusiness.php';
include_once PATHAPP . '/mvc/public/model/bean/PaginaBean.php';

include_once PATHPUBPHPINCLUDE . '/headerList.php';

Util::echobr ( 0, "InscritoPilotoList $ selcampeonatoBean", $selcampeonatoBean );

$equipeMostraList = true;

$colunas =  array (
			"nr" =>
			array (
				"id" => "0",
				"nome" => "Nr Inscrito",
				"mostrar" => true
			),
			"cpf" =>
			array (
				"id" => "1",
				"nome" => "CPF",
				"mostrar" => true
			),
			"nome" =>
			array (
				"id" => "2",
				"nome" => "Nome",
				"mostrar" => true
			),
			"email" =>
			array (
				"id" => "21",
				"nome" => "Email",
				"mostrar" => true
			),
			"carro" =>
			array (
				"id" => "3",
				"nome" => "Carro",
				"mostrar" => (
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::ARRANCADA
							  )?
							  true:false
			),
			"peso" =>
			array (
				"id" => "4",
				"nome" => "Peso",
				"mostrar" => (
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::CAMPEONATO||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::ENDURANCE||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::LIGA||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::MILHAO
							  )?
							  true:false
			),
			"idade" =>
			array (
				"id" => "5",
				"nome" => "Idade",
				"mostrar" => (
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::CAMPEONATO||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::ENDURANCE||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::LIGA||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::MILHAO
							  )?
							  true:false
			),
			"equipe" =>
			array (
				"id" => "6",
				"nome" => "Equipe",
				"mostrar" => false
			),
			"grupo" =>
			array (
				"id" => "7",
				"nome" => "Grupo",
			    "mostrar" =>  ( $selcampeonatoBean->gettipoevento()==TipoEventoEnum::LIGA)
			),
			"categorias" =>
			array (
				"id" => "8",
				"nome" => "Categoria",
				"mostrar" =>  (
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::CAMPEONATO||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::ENDURANCE||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::LIGA||
							  $selcampeonatoBean->gettipoevento()==TipoEventoEnum::MILHAO
							  )?
							  true:false
			),
			"situacao" =>
			array (
				"id" => "9",
				"nome" => "Situação",
				"mostrar" => true
			),
			"valor" =>
			array (
				"id" => "10",
				"nome" => "Valor",
			    "mostrar" => ( $selcampeonatoBean->gettipoevento()!=TipoEventoEnum::LIGA)
			)
			,
			"telefone" =>
			array (
					"id" => "11",
					"nome" => "Telefone",
					"mostrar" => false
			)
			,
			"telefonen" =>
			array (
					"id" => "11",
					"nome" => "TelefoneN",
					"mostrar" => false
			)

			,
			"telefonel" =>
			array (
					"id" => "12",
					"nome" => "TelefoneLN",
					"mostrar" => false
			)
			,
			"camisa" =>
			array (
					"id" => "13",
					"nome" => "Camisa",
			    "mostrar" => ( $selcampeonatoBean->gettipoevento()!=TipoEventoEnum::LIGA)
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
		<?php
		if ($editar == true) {
			?>
		<td>
		<?php
			echo $button->btEditar ( $inscritoBeanLista->getid (), $idurl );
			echo $button->btExcluirImagem ( $inscritoBeanLista->getid (), $idurl );
			?>
		</td>
		<?php
		}
		?>
		<?php if($colunas["nr"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnrinscrito();?>
    	</td>
    	<?php } if($colunas["cpf"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getcpf();?></nobr>
		</td>
		<?php } if($colunas["nome"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnome();?>
		</td>
		<?php } if($colunas["email"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getemail();?>
		</td>
		<?php } if($colunas["carro"]["mostrar"]){?>
		<td>
			<small>
			<?php echo $inscritoBeanLista->getnrcarro();?> -
			<?php echo $inscritoBeanLista->getcarro();?>
			</small>
		</td>
		<?php } if($colunas["peso"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getpeso();?>
		</td>
		<?php } if($colunas["idade"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getidade();?>
		</td>
		<?php } if($colunas["equipe"]["mostrar"]){?>
		<td><small><small>
			<?php
			Util::echobr ( 0, "InscritoList findByCampeonatoInscrito", " Buscar Equipes" );
			$inscritoEquipeBean = new InscritoEquipeBean ();
			$inscritoEquipeBean->setinscrito ( $inscritoBeanLista );
			$inscritoEquipeBusiness = new InscritoEquipeBusiness ();
			$inscritoEquipeClt = $inscritoEquipeBusiness->findByCampeonatoInscrito ( $inscritoEquipeBean );
			for($iz = 0; $iz < count ( $inscritoEquipeClt ); $iz ++) {
				$inscritoEquipeBean = new InscritoEquipeBean ();
				$inscritoEquipeBean = $inscritoEquipeClt [$iz];
				echo ($iz > 0) ? "<br>" : "";
				echo "<nobr>" . Util::getNomeObjeto ( $inscritoEquipeBean->getequipe () ) . "";
			}
			?>
			</small></small></td>
		<?php } if($colunas["grupo"]["mostrar"]){?>
		<td>
			<?php echo Util::getNomeObjeto($inscritoBeanLista->getGrupo());?>
		</td>
		<?php } if($colunas["categorias"]["mostrar"]){?>
		<td>
			<?php echo $categoria;?>
		</td>
		<?php } if($colunas["situacao"]["mostrar"]){?>
		<td>
			<?php echo $inscritoBeanLista->getsituacao();?>
		</td>
		<?php } if($colunas["valor"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getvalorDecimal();?></nobr>
		</td>
		<?php } if($colunas["telefone"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->gettelefoneFormatI();?></nobr>
		</td>
		<?php } if($colunas["telefonen"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->gettelefone();?></nobr>
		</td>
		<?php } if($colunas["telefonel"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->gettelefonelength();?></nobr>
		</td>
		<?php } if($colunas["camisa"]["mostrar"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->gettamanhocamisa();?></nobr>
		</td>
		<?php } ?>
		</tr>
	<?php }?>
  </tbody>
</table>
