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
		for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
			$icampeonatobean = $selcampeonatoCollection [$i];
			?>
    <option value="<?php echo $icampeonatobean->getid();?>"
		<?php echo ($icampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $icampeonatobean->getnome();?></option>
  <?php
		}
  ?>
</select>
  <?php
	$colunas =  array (
			"nr" =>
			array (
					"id" =>  -1,
					"nome" => "Nr Inscrito",
					"mostrar" => true,
					"ativo" => true
			),
			"cpf" =>
			array (
					"id" =>  -1,
					"nome" => "CPF",
					"mostrar" => true,
					"ativo" => true
			),
			"nome" =>
			array (
					"id" =>  -1,
					"nome" => "Nome",
					"mostrar" => true,
					"ativo" => true
			),
			"categoria" =>
			array (
					"id" =>  -1,
					"nome" => "Categoria",
					"mostrar" => true,
					"ativo" => true
			),
			"ncarro" =>
			array (
					"id" =>  -1,
					"nome" => "Nr.",
					"mostrar" => true,
					"ativo" => true
			),
			"carro" =>
			array (
					"id" =>  -1,
					"nome" => "Carro",
					"mostrar" => true,
					"ativo" => true
			),
			"peso" =>
			array (
					"id" =>  -1,
					"nome" => "Peso",
					"mostrar" => false,
					"ativo" => false
			),
			"idade" =>
			array (
					"id" =>  -1,
					"nome" => "Idade",
					"mostrar" => false,
					"ativo" => true
			),
			"equipe" =>
			array (
					"id" =>  -1,
					"nome" => "Equipe",
					"mostrar" => false,
					"ativo" => true
			),
			"grupo" =>
			array (
					"id" =>  -1,
					"nome" => "Grupo",
					"mostrar" => false,
					"ativo" => false
			),
			"situacao" =>
			array (
					"id" =>  -1,
					"nome" => "Situação",
					"mostrar" => true,
					"ativo" => true
			),
			"valor" =>
			array (
					"id" =>  -1,
					"nome" => "Valor Total",
					"mostrar" => true,
					"ativo" => true	
			),
			"nomeequipe" =>
			array (
					"id" =>  -1,
					"nome" => "Equipe",
					"mostrar" => false,
					"ativo" => true
			),
			"email" =>
			array (
					"id" =>  -1,
					"nome" => "Email",
					"mostrar" => false,
					"ativo" => true
			),
			"telefone" =>
			array (
					"id" =>  -1,
					"nome" => "Telefone",
					"mostrar" => false,
					"ativo" => true
			),
			"cep" =>
			array (
					"id" =>  -1,
					"nome" => "CEP",
					"mostrar" => false,
					"ativo" => true
			),
			"endereco" =>
			array (
					"id" =>  -1,
					"nome" => "Endere&ccedil;o",
					"mostrar" => false,
					"ativo" => true
			),
			"numero" =>
			array (
					"id" =>  -1,
					"nome" => "N&uacute;mero",
					"mostrar" => false,
					"ativo" => true
			),
			"complemento" =>
			array (
					"id" =>  -1,
					"nome" => "Complemento",
					"mostrar" => false,
					"ativo" => true
			),
			"bairro" =>
			array (
					"id" =>  -1,
					"nome" => "Bairro",
					"mostrar" => false,
					"ativo" => true
			),
			"cidade" =>
			array (
					"id" => -1,
					"nome" => "Cidade",
					"mostrar" => false,
					"ativo" => true
			),
			"uf" =>
			array (
					"id" => -1,
					"nome" => "UF",
					"mostrar" => false,
					"ativo" => true
			),
			"nrcba" =>
			array (
					"id" => -1,
					"nome" => "Nr.CBA",
					"mostrar" => false,
					"ativo" => true
			)	
	);
	
	if( 0 < count ( $collection )){
	?>				
&nbsp;&nbsp;
<?php echo $button->btBotao("Contratos Pagos", "", $selcampeonato, 
					"ContratoVP", Target::PDFRELATORIO, Choice::RELATORIOPAGOS, URLPUBIMG."/ico_pdf.gif","132px","24px");?>
	&nbsp;&nbsp;
<?php echo $button->btBotao("Todos Contratos", "", $selcampeonato, 
					"ContratoVP", Target::PDFRELATORIO, Choice::RELATORIOTODOS, URLPUBIMG."/ico_pdf.gif","132px","24px");?>
<?php }?>&nbsp;&nbsp;
<table class="listTable" id="categoriaInscritoTb" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<?php
			if ($editar == true) {
				?> 
			<th class="headerlink">&nbsp;
			
			</td> 
			<?php
			}
			?>    
			<!-- <th class="header" width="100px">Codigo</td> -->
<?php $idCol=1;?>	
		
<?php if($colunas["nr"]["ativo"]){?><th class="header"><?php echo $colunas["nr"]["nome"];$colunas["nr"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["cpf"]["ativo"]){?><th class="header"><?php echo $colunas["cpf"]["nome"];$colunas["cpf"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["nome"]["ativo"]){?><th class="header"><?php echo $colunas["nome"]["nome"];$colunas["nome"]["id"]=$idCol++;?></th><?php }?>

<?php if($colunas["nomeequipe"]["ativo"]){?><th class="header"><?php echo $colunas["nomeequipe"]["nome"];$colunas["nomeequipe"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["email"]["ativo"]){?><th class="header"><?php echo $colunas["email"]["nome"];$colunas["email"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["telefone"]["ativo"]){?><th class="header"><?php echo $colunas["telefone"]["nome"];$colunas["telefone"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["cep"]["ativo"]){?><th class="header"><?php echo $colunas["cep"]["nome"];$colunas["cep"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["endereco"]["ativo"]){?><th class="header"><?php echo $colunas["endereco"]["nome"];$colunas["endereco"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["numero"]["ativo"]){?><th class="header"><?php echo $colunas["numero"]["nome"];$colunas["numero"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["complemento"]["ativo"]){?><th class="header"><?php echo $colunas["complemento"]["nome"];$colunas["complemento"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["bairro"]["ativo"]){?><th class="header"><?php echo $colunas["bairro"]["nome"];$colunas["bairro"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["cidade"]["ativo"]){?><th class="header"><?php echo $colunas["cidade"]["nome"];$colunas["cidade"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["uf"]["ativo"]){?><th class="header"><?php echo $colunas["uf"]["nome"];$colunas["uf"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["nrcba"]["ativo"]){?><th class="header"><?php echo $colunas["nrcba"]["nome"];$colunas["nrcba"]["id"]=$idCol++;?></th><?php }?>

<?php if($colunas["carro"]["ativo"]){?><th class="header"><?php echo $colunas["carro"]["nome"];$colunas["carro"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["ncarro"]["ativo"]){?><th class="header"><?php echo $colunas["ncarro"]["nome"];$colunas["ncarro"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["categoria"]["ativo"]){?><th class="header"><?php echo $colunas["categoria"]["nome"];$colunas["categoria"]["id"]=$idCol++;?></th><?php }?>

<?php if($colunas["peso"]["ativo"]){?><th class="header"><?php echo $colunas["peso"]["nome"];$colunas["peso"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["idade"]["ativo"]){?><th class="header"><?php echo $colunas["idade"]["nome"];$colunas["idade"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["equipe"]["ativo"]){?><th class="header"><?php echo $colunas["equipe"]["nome"];$colunas["equipe"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["grupo"]["ativo"]){?><th class="header"><?php echo $colunas["grupo"]["nome"];$colunas["grupo"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["situacao"]["ativo"]){?><th class="header"><?php echo $colunas["situacao"]["nome"];$colunas["situacao"]["id"]=$idCol++;?></th><?php }?>
<?php if($colunas["valor"]["ativo"]){?><th class="header"><?php echo $colunas["valor"]["nome"];$colunas["valor"]["id"]=$idCol++;?></th><?php } ?>
<?php if( 12 != Util::getIdObjeto($usuarioLoginBean->getperfil()) ){?><th class="header">Validade</th><?php } ?>
<th class="header">Chefe</th>
					</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		
		$categoriaInscritoBean = new CategoriaInscritoBean();
		$categoriaInscritoBean = $collection [$i];
		$categoriaBean = $categoriaInscritoBean->getcategoria();
		$inscritoBeanLista = $categoriaInscritoBean->getinscrito();
		
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $categoriaInscritoBean->getid (), $idurl );
			echo $button->btImagem("", "", $categoriaInscritoBean->getid (), 
					"ContratoVP", Target::PDFRELATORIO, Choice::RELATORIO, URLPUBIMG."/ico_pdf.gif","24px","24px");
			echo $button->btDesativar( $categoriaInscritoBean->getid (), $idurl );
			
			?>
		</td>     
		<?php
		}
		?>    
		<?php if($colunas["nr"]["ativo"]){?>   
		<td>
			<?php echo $inscritoBeanLista->getnrinscrito();?>
    	</td>
    	<?php }  if($colunas["cpf"]["ativo"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getcpf();?></nobr>
		</td>
		<?php } if($colunas["nome"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnome();?>
		</td>
		<?php } if($colunas["nomeequipe"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getevento();?>
		</td>
		<?php }if($colunas["email"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getemail();?>
		</td>
		<?php }if($colunas["telefone"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->gettelefone();?>
		</td>
		<?php }if($colunas["cep"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getcep();?>
		</td>
		<?php }if($colunas["endereco"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getendereco();?>
		</td>
		<?php }if($colunas["numero"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnumero();?>
		</td>
		<?php }if($colunas["complemento"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getcomplemento();?>
		</td>
		<?php }if($colunas["bairro"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getbairro();?>
		</td>
		<?php }if($colunas["cidade"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getcidade();?>
		</td>
		<?php }if($colunas["uf"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getuf();?>
		</td>
		<?php }if($colunas["nrcba"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getnrcbalpad5();?>
		</td>
		
		
		<?php } if($colunas["carro"]["ativo"]){?>
		<td>
			<?php echo $categoriaInscritoBean->getnome();?>
		</td>
		<?php } if($colunas["ncarro"]["ativo"]){?>
		<td>
			<?php echo $categoriaInscritoBean->getvalor();?>
		</td>
		<?php } if($colunas["categoria"]["ativo"]){?>
		<td>
			<?php echo $categoriaBean->getnome();?>
		</td>
		<?php } if($colunas["peso"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getpeso();?>
		</td>
		<?php } if($colunas["idade"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getidade();?>
		</td>
		<?php } if($colunas["equipe"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getevento();?>
		</td>
		<?php } if($colunas["grupo"]["ativo"]){?>
		<td>
			<?php echo Util::getNomeObjeto($inscritoBeanLista->getGrupo());?>
		</td>
		<?php } if($colunas["situacao"]["ativo"]){?>
		<td>
			<?php echo $inscritoBeanLista->getsituacao();?>
		</td>
		<?php } if($colunas["valor"]["ativo"]){?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getvalorDecimal();?></nobr>
		</td>
		<?php } ?>
		<?php if( 12 != Util::getIdObjeto($usuarioLoginBean->getperfil()) ){?><th class="header"><?php echo $categoriaInscritoBean->getdtvalidade(); ?></th><?php } ?>
		<td>
			<nobr><?php echo $inscritoBeanLista->getchefeequipe();?></nobr>
		</td>
	</tr>
	<?php }?>
  </tbody>
</table>
<?php Util::echobr(0,"",$colunas);?>
	


<script>
	
	function fnShowHide( iCol )
	{
	    // Get the DataTables object again - this is not a recreation, just a get of the object 
	    var oTable = $('#categoriaInscritoTb').dataTable();
	     
	    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	    oTable.fnSetColumnVis( iCol, bVis ? false : true );
	}

	function fnHide( iCol )
	{
	    // Get the DataTables object again - this is not a recreation, just a get of the object 
	    var oTable = $('#categoriaInscritoTb').dataTable();
	     
	    oTable.fnSetColumnVis( iCol, false );
	}

	function fnShow( iCol )
	{
	    // Get the DataTables object again - this is not a recreation, just a get of the object 
	    var oTable = $('#categoriaInscritoTb').dataTable();
	     
	    oTable.fnSetColumnVis( iCol, true );
	}
		
$(document).ready(function() {
<?php
	$colX = $colunas;
	while(count($colX)>0){
		$colXo = array_shift($colX);
		if( !$colXo['mostrar'] && $colXo["id"]!=-1 ){
			echo "//não mostrar".$colXo["nome"]."\n";
	?>
		fnHide( <?php echo $colXo["id"];?> );
	<?php
		}
	} ?>

	
	});
	
	</script>


	