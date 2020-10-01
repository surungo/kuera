<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo PRJCHARSET;?>" />
<meta http-equiv="content-type" content="text/html;charset=" <?php echo PRJCHARSET;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo $sistemaBean->getnome()?></title>
<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/default.css" />

<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/menu.css" />
<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/jquery-ui.css" />
<?php //<link rel="stylesheet" href="<? php echo URLPUBCSS;? >/dataTables.bootstrap.css" /> ?>
<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/jquery.dataTables.css" />

<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/buttons.dataTables.min.css" />

<script language="JavaScript" src="<?php echo URLPUBJS;?>/jquery.js"></script>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo URLPUBJS;?>/excanvas.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo URLPUBJS;?>/jquery.jqplot.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URLPUBCSS;?>/jquery.jqplot.css" />
<script type="text/javascript" src="<?php echo URLPUBJS;?>/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="<?php echo URLPUBJS;?>/plugins/jqplot.logAxisRenderer.js"></script>
<script type="text/javascript" src="<?php echo URLPUBJS;?>/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="<?php echo URLPUBJS;?>/plugins/jqplot.canvasAxisTickRenderer.js"></script>
<script type="text/javascript" src="<?php echo URLPUBJS;?>/plugins/jqplot.highlighter.js"></script>

<script language="JavaScript" src="<?php echo URLPUBJS;?>/jquery-ui.js"></script>
<?php //<SCRIPT language="JavaScript" src="< ?php echo URLPUBJS;? >/dataTables.bootstrap.js"></SCRIPT> ?>
<script language="JavaScript" src="<?php echo URLPUBJS;?>/form.js"></script>
<script type="text/javascript" src="<?php echo URLPUBJS;?>/jquery.mask.min.js"></script>
<?php //<SCRIPT language="JavaScript" src="< ?php echo URLPUBJS;? >/jquery.maskedinput.1.3.js"></SCRIPT> ?>
<SCRIPT language="JavaScript" src="<?php echo URLPUBJS;?>/flip.js"></SCRIPT>
<SCRIPT language="JavaScript" src="<?php echo URLPUBJS;?>/jquery.dataTables.min.js"></SCRIPT>
<script src="<?php echo URLPUBJS;?>/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>



<?php //  dataTables excel requer?>
<SCRIPT language="JavaScript" src="<?php echo URLPUBJS;?>/jszip.js"></SCRIPT>
<SCRIPT language="JavaScript" src="<?php echo URLPUBJS;?>/dataTables.buttons.min.js"></SCRIPT>
<SCRIPT language="JavaScript" src="<?php echo URLPUBJS;?>/buttons.html5.min.js"></SCRIPT>

<script>
var tableGlobal;
var tableOptions = {
		  
	     "columnDefs": [ { "targets": 0, "orderable": false } ],
	     "order": [[ 1, "asc" ]],
	     "stateSave": true ,
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
	     "lengthMenu": [[ 15, 25, 50, -1], [ 15, 25, 50, "Todos"]]
	     //,dom: 'Bfrtip'
	     //,buttons: [
	     //   'excel'
	     //]
	     
	   };


$(document).ready(function() {
  /*
   var table = 
   $('.listTable').DataTable(
   {
  
     "columnDefs": [ { "targets": 0, "orderable": false } ],
     "order": [[ 1, "asc" ]],
     "stateSave": true ,
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
     dom: 'Bfrtip'

     ,buttons: [
         'excel'
     ]
     
   });
   */
   var table = $('.listTable').DataTable(tableOptions);  
   
   tableGlobal = table;
  
   
} );
</script>

</head>
<body>
<div id="Content">
<?php
$novo = $selbateria > 0;
include_once PATHPUBPHPINCLUDE . '/headerList.php';

?>
<table border="0">
	<tr>
		<td>Campeonato:</td>
		<td><select id="campeonato" name="campeonato" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todos</option>
			  <?php
					
					for($i = 0; $i < count ( $selcampeonatoCollection ); $i ++) {
						$selcampeonatobean = $selcampeonatoCollection [$i];
						?>
			    <option value="<?php echo $selcampeonatobean->getid();?>"
					<?php echo ($selcampeonatobean->getid()==$selcampeonato)?"selected":"";?>><?php echo $selcampeonatobean->getnome();?></option>
			  <?php
					}
					?>
			</select></td>
	</tr>
	<tr>
		<td>Etapa:</td>
		<td  style="display: <?php echo ($selcampeonato>0)?"block":"none"?>;">
			<select id="etapa" name="etapa" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
				  <?php
						echo count ( $seletapaCollection );
						for($i = 0; $i < count ( $seletapaCollection ); $i ++) {
							$seletapabean = $seletapaCollection [$i];
							?>
				    <option value="<?php echo $seletapabean->getid();?>"
					<?php echo ($seletapabean->getid()==$seletapa)?"selected":"";?>><?php echo $seletapabean->getnome();?></option>
				  <?php
						}
						?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Bateria:</td>
		<td style="display: <?php echo ($seletapa>0)?"block":"none"?>;"><select
			id="bateria" name="bateria" class="btn_select"
			<?php
			echo $button->atributos ( $idurl, $idobj, Choice::LISTAR, $target, $choice );
			?>>
				<option value="">Todas</option>
					  <?php
							echo count ( $selbateriaCollection );
							for($i = 0; $i < count ( $selbateriaCollection ); $i ++) {
								$selbateriabean = $selbateriaCollection [$i];
								?>
					    <option value="<?php echo $selbateriabean->getid();?>"
					<?php echo ($selbateriabean->getid()==$selbateria)?"selected":"";?>><?php echo $selbateriabean->getnome();?></option>
					  <?php
							}
							?>
			</select></td>
	</tr>
</table>
<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr><?php
		if ($editar == true) {
			?> 
		<th class="headerlink">&nbsp;</th> 
		<?php
		}
		?>    
		 <th class="header">&nbsp;</th>
			<th class="header">Nr.</th>
			<th class="header">Piloto</th>
			<th class="header">Etapa</th>
			<th class="header">Bateria</th>
			<th class="header">Pres</th>
			<th class="header">Pena</th>
			<th class="header">Volta</th>
			<th class="header">*Grd(FB)</th>
			<th class="header">*Grd(LG)</th>
			<th class="header">*Chg(VP)</th>
			<th class="header">*Chg(EC)</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
for($i = 0; $i < count ( $collection ); $i ++) {
		$pilotoBateriaBeanList = $collection [$i];
		$pilotoBeanList = new PilotoBateriaBean();
		$pilotoBeanList = $pilotoBateriaBeanList->getpiloto ();
		$bateriaBeanList = $pilotoBateriaBeanList->getbateria ();
		$etapaBeanList = $bateriaBeanList->getetapa ();
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>
	<tr class="<?php echo $corlinha;?>">
		<?php
		if ($editar == true) {
			?> 
		<td>
			<?php
			echo $button->btEditar ( $pilotoBateriaBeanList->getid (), $idurl );
			echo $button->btExcluirImagem ( $pilotoBateriaBeanList->getid (), $idurl );
			?>
		</td>     
		<?php
		}
		?>
		<td><img border="0" width="60"
				src="<?php echo $pilotoBeanList->getfotoFilePNG("round");?>"></td>
			<td>
			<?php echo $pilotoBeanList->getnrpiloto();?>
		
		</td>
			<td> 
      <?php
		echo $pilotoBeanList->getapelido ();
		?>
    </td>
		<td>
			<?php echo $etapaBeanList->getnome(); ?>
		</td>
		<td>
			<?php echo $bateriaBeanList->getnome(); ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpresente(); ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpenalizacao() ; ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getvolta() ; ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getpregridlargada();  ?>
		</td>
		<td>
			<?php echo $pilotoBateriaBeanList->getgridlargada();  ?>
		</td>
		<td>
			<?php echo  Util::getNomeObjeto($pilotoBateriaBeanList->getposicao());?>
		</td>
		<td>
			<?php echo  Util::getNomeObjeto($pilotoBateriaBeanList->getposicaooficial());?>
		</td>
		</tr>
	<?php }?>
  </tbody>
</table>
*Grid(FB)(LG) - Grid FaceBook / Grid LarGada
<br>
*Chegada(VP)(EC) - Chegada VeloPark / Chegada EngeCar
</body>
</html>
