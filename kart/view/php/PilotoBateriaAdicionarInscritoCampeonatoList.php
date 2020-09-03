
<div id="pilotocampeonato" style="float: left; width: <?php echo $divLargura;?>; background-color: silver;">
<?php echo $listaOpcoesMostrar[$consulta_adicao];?><br>
<?php 
if(count ( $cltInscritos ) < 1 ){
?>
&nbsp;&nbsp;<small>Não tem mais inscrito disponível</small>
<?php
} else {
?>
	<table class="listTable" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr>
				<th class="headerlink">&nbsp;</th> 
				<th class="header">N&uacute;mero inscrição</th>
				<?php if($mostrarCPF){?><th class="header">CPF</th><?php } ?>
				<th class="header">Inscrito</th>
				<th class="header">Categoria</th>
			</tr>
		</thead>
		<tbody>
	<?php
	
	$imagemADD = URLAPPVER."/public/view/images/add.png";
	for($i = 0; $i < count ( $cltInscritos ); $i ++) {
	    $inscritoBeanLista = new InscritoBean ();
	    $inscritoBeanLista = $cltInscritos [$i];
	    $cpf = $inscritoBeanLista->getcpf();
	    $pilotoTesteBean = $pilotoBateriaBusiness->findPilotoCPF( $cpf, $selbateria );
	    if(Util::getIdObjeto($pilotoTesteBean)==0){
	    
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
    				$imagem = URLAPPVER."/public/view/images/add.png";
    				$idobj = Util::getIdObjeto($inscritoBeanLista ); 
    				$itemFK = $selbateria;
    				$w = "20"."px";
    				$h = $w;
    				$choice = Choice::ADICIONAR_INSCRITO;
    				$dbg=0;
    				Util::echobr($dbg,'PilotoBateriaAdicionarList idobj', $idobj);
    				echo $button->btImagemIfk($itemFK, $value, $idurl, $idobj, $action, $target, $choice, $imagem, $w, $h);
    				?>
    			</td>     
    			<td>
    				<small><?php echo $inscritoBeanLista->getnrinscrito();?></small>
    			
    			</td>
    			<?php if($mostrarCPF){?>
    			<td>
    				<?php echo $inscritoBeanLista->getcpf();?>
    			
    			</td>
    			<?php }?>
    			<td>
    				<?php echo $inscritoBeanLista->getnome();?>
    			
    			</td>
    			<td> 
    			<?php
    				if($containCategoria){
    					echo $categoria;
    				}
    			?>
    			</td>
    		</tr>
    		<?php 
    			}
	   }
		?>
	  </tbody>
	</table>
<?php }?>
</div>
