<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';

Util::echobr ( $dbg, 'PessoaTechspeedControl $beanPaginaAtual',  $beanPaginaAtual );
$dbg=0;
Util::echobr ( $dbg, 'PessoaTechspeedControl $beanPaginaAtual->getordem()',  $beanPaginaAtual->getordem() );
$contrato= "ContratoTech";
if($beanPaginaAtual->getordem() == '5015'){
   $contrato= "ContratoTechPro";
  ?>  
  <style>
    .tableheader, .dataTables_wrapper {
      	background-color: #004C6C;
        color: white;
    }
    label{
        color: white;
    }
    .listTable {
        color: black;
    }
  </style>
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
				?> 
    		<th class="header">CPF</th>
			<th class="header">Nome</th>
			<? if(false) { ?>
			<th class="header">Peso</th>
			<th class="header">Idade</th>
			<? } ?>
		</tr>
	</thead>

	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$pessoaBeanItem = new PessoaBean ();
		$pessoaBeanItem = $collection [$i];
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
		<?php
			echo $button->btEditar ( $pessoaBeanItem->getid (), $idurl );
			echo $button->btImagem("", "", $pessoaBeanItem->getid (), $contrato, Target::PDFRELATORIO, Choice::RELATORIO, URLPUBIMG."/ico_pdf.gif","24px","24px");
			//echo $button->btExcluirImagem ( $pessoaBeanItem->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>    
		<td><nobr><?php echo $pessoaBeanItem->getcpf();?></nobr></td>
		<td>
			<?php echo $pessoaBeanItem->getnome();?>
		</td>
		<? if(false) { ?>
		<td>
			<?php echo $pessoaBeanItem->getpeso();?>
		</td>
		<td>
			<?php echo $pessoaBeanItem->getidade();?>
		</td>
	    <? } ?>
	</tr>
	<?php }?>
  </tbody>
</table>

