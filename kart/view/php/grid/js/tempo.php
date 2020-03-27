var velocidade = 98;
		
var tempos = {
	mostraStart : 40 ,
	mostraAbrirQuadro : 5,
	
	mostratitulo : 5,
	mostrapausatitulo : 5,
	mostratituloFinal : 5,
	
	 
	mostraPausa : 5 , 
	mostraTexto1 : 5, 
	mostraTexto2 : 5, 
	
	pilotoRetiraCapa : 10,
	pilotoDeslisaCentro : 5,
	pilotoPausaFoto : 10,
	pilotoRetiraFoto : 5,
	
	gPositionColorChange : 3,
	gPositionHide : 3,
	
	
	ocultaNome : 3,
	mostraNome : 3,
	
	
	mostraFinal : 60
	};
	
	for (var prop in tempos) {
		tempos[prop ] = tempos[prop ] * velocidade; 
	}
