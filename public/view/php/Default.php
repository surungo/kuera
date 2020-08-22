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
     "lengthMenu": [[ 15, 25, 50, -1], [ 15, 25, 50, "Todos"]]
     //,dom: 'Bfrtip'
     //,buttons: [
     //   'excel'
     //]
     
   });
   
   
   tableGlobal = table;
  
   
} );
</script>

</head>
<body>
    <?php 
    Util::echobr ( $dbg, 'Default.php ', 'antes do form' ); 
    ?>
	<form name="formDefault" id="formDefault" method="post" action=""
		target="_top" enctype="multipart/form-data">
		<input type="hidden" id="keysession" name="keysession" size="32"
			value="<?php echo $keysession;?>"> <input type="hidden" id="idurl"
			name="idurl"
			value="<?php echo (ENCRIPT_LINK)?Cripto::encrypt($idurl):$idurl; ?>">
		<input type="hidden" id="idobj" name="idobj"> <input type="hidden"
			id="choice" name="choice"> <input type="hidden" id="choiceAnterior"
			name="choiceAnterior" value="<?php echo $choice;?>"> 
		<input
			type="hidden" id="idurlAnterior" name="idurlAnterior"
			value="<?php echo (ENCRIPT_LINK)?Cripto::encrypt($idurlAnterior):$idurlAnterior; ?>">
		<input type="hidden" id="action" name="action"
			value="<?php echo $action;?>"> 
		<input type="hidden" id="value" name="value"> 
		<input type="hidden" id="target" name="target"
			value="<?php echo $target;?>"> 
		<input type="hidden" id="token" name="token"
			value="<?php echo $token;?>"> 
		<input type="hidden" id="itemFK" name="itemFK"> 
			
						
		<table width="100%" border="0" id="headerpage" nowrap="nowrap" cellspacing="0" cellpadding="2">
			<tr id="headerPage">
				<td rowspan="2"><img style="clear: both;" id="btn_menu"
					src="<?php echo URLPUBIMG;?>/btn_menu.png" show="0"></td>
				<td rowspan="2" class="nome_sistema">

						[<?php echo $sistemaBean->getnome()?>]
						<?php echo ( 
								strrpos($_SERVER['HTTP_HOST'],'127.0.0.1') > -1 || 
								strrpos($_SERVER['HTTP_HOST'],'localhost') > -1
					)?" - <small>[Desenvolvimento]</small>":"";
					
					if(isset($_GET['XDEBUG_SESSION_START'])){
					    echo " - <small>[". PRJROOT ."]</small>";
					}
					
					
					?>
					</td>
				<td style="font-size: 10px;" align="right">
					<?php echo $nomeoperador; ?></td>
			</tr>
			<tr id="headerPage">
				<td style="font-size: 10px;" align="right"><?php echo Util::getNomeObjeto($beanPerfilAtual); ?></td>
			</tr>
			
		</table>
		<div id="Menu" style="display: none;">
					<?php if(file_exists($Mod_menu))include($Mod_menu);?>
			</div>
		<div id="Content">
					<?php if(file_exists($Mod_conteudo))include($Mod_conteudo);?>
			</div>


	</form>
</body>
</html>