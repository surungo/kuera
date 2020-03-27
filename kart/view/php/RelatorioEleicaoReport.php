<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';

$porcentagemGeral = ($totalEleitorGeral==0)?0:round( ($totalVotosGeral*100) /$totalEleitorGeral );
$porcentagemEleitoresGeral = ($totalEleitoresVotaramGeral==0)?0:round( ($totalEleitoresVotaramGeral*100) /$totalEleitoresGeral );

/*
if($tresgrpsT == 1){
	$cvoto = 0; 
}*/

?>
Campeonato:
<select id="campeonato" name="campeonato" class="btn_select"
	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>>
	<?php if(Util::getIdObjeto($usuarioLoginBean->getperfil())==1){ // desenv ?>
	<option value="0">Todos</option>
	
  <?php
		}	
		for($i = 0; $i < count ( $cltCampeonatoCollection ); $i ++) {
			$icampeonatobean = $cltCampeonatoCollection [$i];
			?>
    <option value="<?php echo $icampeonatobean->getid();?>"
		<?php echo ($icampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $icampeonatobean->getnome();?></option>
  <?php
		}
  ?>
</select>

<table class="littleTable">
	<thead>
		<tr>
    		<th class="header" align="center">Porcentagem Votos</th>
	 		<th class="header" align="center">Total Votos</th>
			<th class="header" align="center">Total Votos Possíveis</th>
	</tr>
	</thead>
	<tr>
		<td align="center">
			<?php echo $porcentagemGeral;?>%
		</td>
		<td align="center">
			<?php echo $totalVotosGeral;?>
		</td>
		<td align="center">
			<?php echo $totalEleitorGeral;?>
		</td>
	</tr>
	<thead>
		<th class="header" align="center">Porcentagem Eleitores</th>
	 		<th class="header" align="center">Total Eleitores Votaram</th>
			<th class="header" align="center">Total Eleitores Geral</th>
		</tr>
	</thead>
	<tr>
		<td align="center">
			<?php echo $porcentagemEleitoresGeral;?>%
		</td>
		<td align="center">
			<?php echo $totalEleitoresVotaramGeral;?>
		</td>
		<td align="center">
			<?php echo $totalEleitoresGeral;?>
		</td>
		
	</tr>
</table>
<small>
  Mostrar canditados sem votos <input type="checkbox" id="cvoto" name="cvoto" 
  	<?php
  	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
  	?>
  	class="btn_select" <?php echo ($cvoto==1)?"checked='checked'":"";?> value="1" >
 / Desagrupar grupos <input type="checkbox" id="agrupar" name="agrupar" 
 	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
 	?>
 	class="btn_select" <?php echo ($agrupar==1)?"checked='checked'":"";?> value="1" >
 / Não mostrar totais de grupos <input type="checkbox" id="totalgrps" name="totalgrps"
 	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>
	class="btn_select" <?php echo ($totalgrps==1)?"checked='checked'":"";?> value="1" >
 / Só os três primeiros de cada grupos <input type="checkbox" id="tresgrps" name="tresgrps"
 	<?php
	echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
	?>
	class="btn_select" <?php echo ($tresgrps==1)?"checked='checked'":"";?> value="1" >
  
</small>
<table <?php echo ($agrupar!=1)?" class='list' id='example' ":"class='listTable' id='example' ";?> cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    		<th class="header">&nbsp;</th>
			<th class="header">Grupo</th>
			<th class="header">Candidato</th>
			<th class="header">Total Votos</th>
			<th class="header">Porcentagem Votos</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$totalVotosGeral = 0;
	$totalEleitorGeral = 0;
	$tresgrpsT = 0;
	$gp="";
	$gpant="";
for($i = 0; $i < count ( $resultadoVotos ); $i ++) {
	$resultadoVoto = $resultadoVotos [$i];
	$votosgrp = "";
	if($totalgrps!=1 && $resultadoVoto['idgrupo']>0){
		
		$totalVotos = $votoBusiness->totalVotosByGrupo($resultadoVoto['idgrupo']);
		$totalEleitor = $eleitoBusiness->totalByGrupo($resultadoVoto['idgrupo']);
		$porcentagemgrp = ($totalVotos>0)?($totalVotos*100)/$totalEleitor:0;
		
		$votosgrp = " <small><small><small><small>".
		"Votos ".$totalVotos." de ".$totalEleitor." Porcentagem concluída: ".round($porcentagemgrp,1)."%".
		"</small></small></small></small>";
	}
	$gp=$resultadoVoto['idgrupo'];
	if($gp!=$gpant||$tresgrps != 1){
		$tresgrpsT = 0;
		$gpant=$gp;
	}
	$tresgrpsT++;
	if(($resultadoVoto['total'] > 0 || $cvoto == 1) && $tresgrpsT < 4) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<td>
		&nbsp;
		</td>
		<td>
			<?php echo $resultadoVoto['grupo'].$votosgrp;?>
		</td>
		<td>
			<?php echo $resultadoVoto['candidato'];?>
		</td>
		<td>
			<?php echo $resultadoVoto['total'];?>
		</td>
		<td>
			<?php echo ($resultadoVoto['total']>0)?round(($resultadoVoto['total']*100)/$resultadoVoto['possiveisGrupo'],1):"0";?>%
		</td>
	</tr>
	<?php }
	}
	?>
	  </tbody>
</table>
<?php  if($agrupar!=1){?>
<script>
$(document).ready(function() {
	
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "order": [[ 1, 'asc' ]],
        "oLanguage": {
            "sLengthMenu": "Linhas: _MENU_",
            "sZeroRecords": "Nenhum item encontrado",
            "sInfo": " Mostrando _START_ - _END_ de _TOTAL_ itens",
            "sInfoEmtpy": " Mostrando 0 - 0 de 0 itens",
            "sInfoFiltered": " ( pesquisado entre _MAX_ itens )",
            "sSearch": "Pesquisa: ",
            "oPaginate": {
                   "sFirst": " < ",
                   "sLast": " > ",
                   "sPrevious": "<< ",
                   "sNext": " >> "
            }
      },
 		"lengthMenu": [[ 15, 25, 50, -1], [ 15, 25, 50, "Todos"]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 1, 'desc' ] ).draw();
        }
        else {
            table.order( [ 1, 'asc' ] ).draw();
        }
    } );
} );
</script>
<?php  }?>

	