	
var linhaGrid = 1;
var sequencia = 1;
$(document).ready(function() {

	viewtimer();
	posicaoInicial();
	//teste();
			
	ocultarObjetos();
	$("#tela").animate(telaInicio,500,
	function(){
		animacao();
	});


} );