<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td class="titulopagina" style="padding-left: 5px;">
		<?php echo ($urlC == LISTAR)?"Listagem de ":""?><?php echo $beanPaginaAtual->getnome(); ?>
		</td>
		
		<?php
		$novo = isset($novo)?$novo:false;
		if ($novo == true) {
			?>
		<td align="Right" style="padding-right: 5px; font-size: 12pt;">
			Criar novo 
			<?php
			echo $button->btNovoImagem ( $idurl );
			?>
		</td>
		<?php
		}
		?>	
	</tr>
	<?php if ((isset($atualizar)?$atualizar:true) == true) {?>
	<tr>
		<td align="Right" colspan="2"
			style="padding-right: 5px; font-size: 12pt;">Atualizar tela <?php echo $button->btRefreshLista($idurl); ?></td>
	</tr>
	<?php }?>
</table>
<input type="hidden" size="40" id="clsort_<?php echo $idurl;?>"
	name="clsort_<?php echo $idurl;?>" value="<?php echo $clsort;?>">
<?php if(false){//!isset($opc_print)||$opc_print){?>

<style>
	.opc_printableArea{
		background-color: white;
		display:none;
	}
</style>	
<style id="opc_style">	
	.opc_printableAreaConteudo{
		background-color: white;
		width: 100%;
		height: 100%;
	}

	.prntitulopagina{
		background-color: white;
	}
	.prnlistTable{
		border:1px solid black;
		background-color: white;
	}
	.prnlistTable td{
		border:1px solid black;
		background-color: white;
	}
	
	.quebrapagina {
	   page-break-before: always;
	}

</style>		
<script type="text/javascript">
	$(document).ready(function(){
		//impressao
	    $("#opc_printButton").click(function(){
	    	$("div.opc_printableAreaConteudo").html("<style>"+$("#opc_style").html()+"</style>");//copia conteudo
	    	$("div.opc_printableAreaConteudo").append("<div class='prntitulopagina'>"+$(".titulopagina").html()+"</div><br>");//copia conteudo
	    	$("div.opc_printableAreaConteudo").append("<table class='prnlistTable'>"+$(".dataTable").html()+"</table>");//copia conteudo
	    	if($("#DataTables_Table_0_info").html()!=undefined)
	    		$("div.opc_printableAreaConteudo").append("<div class='prntitulopagina'>"+$("#DataTables_Table_0_info").html()+"</div>");//total
			if($('.prnlistTable .group').length < 1 )	    		
	    		$('.prnlistTable tr').find('td:eq(0),th:eq(0)').remove();
    		
	    	
	        var mode = 'iframe'; //popup
	        var close = mode == "popup";
	        var options = { mode : mode, popClose : close};
	        $("div.opc_printableArea").printArea( options );
	    });

		//controle colunas
	    /*
	    alert($('.listTable thead').html());
	    $(".dataTables_length").append("&nbsp;&nbsp;&nbsp;<span class='selcolunas'><small>Colunas</small></span>");
	    $(".dataTables_length").append("<span class='listacolunas'><a class='toggle-vis' data-column='1'>Coluna1</a></span>");
	    	    

	    $('a.toggle-vis').on( 'click', function (e) {
		    e.preventDefault();
	        // Get the column API object
	        var column = tableGlobal.column( $(this).attr('data-column') );
	        // Toggle the visibility
	        column.visible( ! column.visible() );
	    } );
	    */
	});
	</script>
	
	<input style="float: right;" type="button" value="Imprimir"
	id="opc_printButton" />
	<div class="opc_printableArea"><div class="opc_printableAreaConteudo"></div></div>
<?php }?>

