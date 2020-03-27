<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>
Partida: 
	<select id="partida" name="partida" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
		<option value="0">Mostrar todos</option>
	<?php foreach ($cltpartidas as &$partida) {?>
		<option value="<?php echo $partida->getid(); ?>" <?php echo ($slpartida==$partida->getid())?"selected":";"?>
		><?php echo Util::timestamptostr('d/m/Y H:i:s',$partida->getdtpartida());?> - <?php echo $partida->getnome(); ?></option>
	<?php }?>
	
	</select> 
	<?php if($slpartida>0){ ?>
	Placar:
	<?php echo $partidabean->getplacar1();?> x <?php echo $partidabean->getplacar2();?>  
	Peso:
	<?php echo $partidabean->getpeso();?>  
	<br>
<?php }?>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="headerlink">&nbsp;</th> 
			<th class="header">Nome</th>
			<th class="header">Pl1</th>
			<th class="header">Pl2</th>
			<th class="header">Pts</th>
			<th class="header">TA</th>
			<?php if($slpartida==0){ ?>
			<th class="header">Jogo</th>
			<th class="header">Data</th>
			<?php }?>
		</tr>
	</thead>

	<tbody>
	<?php
	for($i = 0; $i < count ( $collection ); $i ++) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		$partidaBean = $collection[$i]->getpartida();
		?>
		<tr class="<?php echo $corlinha;?>">
    		<td>
    		<?php
    		  if ($editar == true) {
    		      echo $button->btEditar ( $collection [$i]->getid (), $idurl );
                  echo $button->btExcluirImagem ( $collection [$i]->getid (), $idurl );
    		  }
    	     ?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getnome();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getplacar1();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getplacar2();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->getpontos();?>
    		</td>
    		<td>
    			<?php echo $collection[$i]->gettipoacerto();?>
    		</td>
    		<?php if($slpartida==0){ ?>
			<td>
    			<?php echo $partidaBean->getnome();?>
    		</td>
    		<td>
    			<?php echo Util::timestamptostr('d/m/Y H:i:s',$partidaBean->getdtpartida());?>
    		</td>
    		
			<?php }?>
		</tr>
	<?php }?>
  </tbody>
</table>
