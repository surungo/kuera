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
&nbsp;<br>
<select id="ativos" name="ativos" class="btn_select"
<?php
echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
?>>
	<option value="A" <?php echo ($ativos == "A")?"selected":""; ?>>Ativos</option>
	<option value="T" <?php echo ($ativos == "T")?"selected":""; ?>>Todas</option>
		  
</select>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
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
			<th class="header">Nr Inscrito</th>
			<th class="header">Nome</th>
			<th class="header">CodAcesso</th>
			<th class="header">Situacao</th>
			<th class="header">Valor</th>
			<th class="header">Categoria</th>
			<th class="header">Lider</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		
		$equipeBean = new EquipeBean ();
		$equipeBean = $collection [$i];
		if($equipeBean->isvalidade() || "T" == $ativos){
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
			?>
		<tr class="<?php echo $corlinha;?>">
			<?php
			if ($editar == true) {
				?> 
			<td>
				<?php
				echo $button->btEditar ( $equipeBean->getid (), $idurl );
				if($equipeBean->isvalidade()){
					echo $button->btDesativar( $equipeBean->getid (), $idurl );
				}else{
					echo $button->btValidar( $equipeBean->getid (), $idurl );
				}
				if(false){
					echo $button->btExcluirImagem ( $equipeBean->getid (), $idurl );
				}
				?>
			</td>     
			<?php
			}
			?>    
			<td>
				<?php echo $equipeBean->getnrinscrito();?>
	    	</td>
				<td>
				<?php echo $equipeBean->getnome();?>
		    </td>
				<td>
				<?php echo $equipeBean->getcodigoacesso();?>
		    </td>
				<td>
				<?php
			echo $equipeBean->getsituacao ();
			// echo Util::timestamptostr('d/m/Y H:i:s',$collection[$i]->getdtinscricao());
			?>
				
			</td>
			<td>
				<?php echo $equipeBean->getvalorDecimal();?>
			</td>
			<td>
				<?php 
				$categoriaBusiness = new CategoriaBusiness ();
				$categoriaBean = new CategoriaBean ();
				$categoriaBean->setId($equipeBean->getcategoria());
				$equipeBean->setcategoria($categoriaBusiness->findById($categoriaBean));
				echo Util::getNomeObjeto($equipeBean->getcategoria());?>
			</td>
						<td>
				<?php
			$idInscritoLider = Util::getIdObjeto($equipeBean->getinscritolider());
			if ($idInscritoLider != "") {
				$inscritoBean = new InscritoBean ();
				$inscritoBusiness = new InscritoBusiness ();
				$inscritoBean = $inscritoBusiness->findById ( $idInscritoLider );
				$inscritoEquipeBusiness = new InscritoEquipeBusiness ();
				$totalinscritos = $inscritoEquipeBusiness->totalInscritos ( Util::getIdObjeto($equipeBean));
				$pesoMax = $inscritoEquipeBusiness->pesoMaxInscrito ( $equipeBean->getid () );
				$pesoMin = $inscritoEquipeBusiness->pesoMinInscrito ( $equipeBean->getid () );
				
				echo "<small><small><nobr>" . $inscritoBean->getapelido () . "</nobr><br>" . "<nobr>" . $inscritoBean->gettelefone () . "</nobr><br>" . "<nobr>Total integrantes: " . $totalinscritos . "</nobr><br>" . "<nobr>Peso entre " . $pesoMin . " e " . $pesoMax . "</nobr>" . "</small></small>";
			}
			?>
			</td>
			</tr>
	<?php }
	}?>
  </tbody>
</table>
