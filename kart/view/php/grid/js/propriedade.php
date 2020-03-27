	var widthT = 1280;
	var heightT = 720;
	
	
	var body = {
		//fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		//color : "white",
		//backgroundImage : "url('img/f1.png')",
		backgroundImage : "url('<?php echo $urlgrid;?>img/Fundo.jpg')",
		backgroundSize : widthT+"px "+heightT+"px",
		backgroundRepeat : "no-repeat"
	};
	
	var telaInicio = {
		position : "absolute",
		left : "0px",
		top : "0px",
		width : widthT+"px",
		height : heightT+"px",
		//border : "1px solid black",
		//backgroundColor : "red",
		textAlign : "center"
	};
	
	var telaFinal = {
		position : "absolute",
		left : "0px"
	};

	var logoInicio = {
		position : "absolute",
		left : "53px",
		top : "10px",
	    width : "360px"
	};
	
	var colorBackground = "rgba(10,10,10,0.5)";
	
	var quadroInicio = {
		borderTop : "3px solid white",
		position : "absolute",
		top : "390px",
		left : "20px",
		width : "1240px",
		height : "0px",
		//backgroundColor : "rgba(10,23,55,0.5)",
		backgroundColor : colorBackground,
		borderRadius : "50px 0px 50px 50px"
	};
	
	var quadroFinal = {
		borderTop : "3px solid white",
		position : "absolute",
		top : '90px',
		left : '20px',
		height : '540px',
		opacity  : '90%'
	};
	
	var tituloInicio = { 
		position : "absolute",
		top : '412px', 
		left : '246px', 
		width : '800px',
		height : "64px",
		fontSize : '12px',
		fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		textAlign : "center",
		color : "white",		
		//border : "1px solid white",
		borderRadius : "15px 50px 0px 0px",
		backgroundColor : quadroInicio["backgroundColor"]
	};
	
	var tituloMeio = { 
		position : "absolute",
		top : '12px', 
		left : '446px', 
		width : '800px',
		height : "64px",
		fontSize : '26px',
		fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		color : "white",
		textAlign : "center",			
		//border : "1px solid white",
		borderRadius : "15px 50px 0px 0px",
		backgroundColor : quadroInicio["backgroundColor"]
	};

	var tituloFinal = { 	
		position : "absolute",
		top : '12px', 
		left : '446px', 
		width : '800px',
		height : "64px",
		fontSize : '26px',
		fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		textAlign : "center",
		color : "white",		
		//border : "1px solid white",
		borderRadius : "15px 50px 0px 0px",
		backgroundColor : quadroInicio["backgroundColor"]
	};
	
	var patrocinadoreswidth = "4500";
	var patrocinadoresleft = 1280;//(widthT-patrocinadoreswidth)/2;
	var patrocinadores = {
		position : "absolute",
		left : patrocinadoresleft+"px",
		top : "650px",
		width : patrocinadoreswidth+"px",
		fontSize : '26px',
		//fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		fontFamily : "'Oswald',  Arial, Helvetica, sans-serif",
		//fontFamily : "'Orbitron',  Arial, Helvetica, sans-serif",
		//fontFamily : "'Economica',  Arial, Helvetica, sans-serif",
		//fontFamily : "'Press+Start+2P',  Arial, Helvetica, sans-serif",
		
		
		textShadow : "2px 2px 2px black, 2px 2px 2px black",
		color : "#EEE"
		
	};
	
	var pat = {
		padding : "3px 10px 3px 10px",
		margin : "10px",
		border : "3px outset white",
		backgroundColor : "rgba(10,23,88,0.5)",
		borderRadius : "15px 15px 15px 15px"
	};
	
	var fotowidth = 295;//(640 * 1.4);
	var fotoheight = (360 * 1.4);
	
	var fotos = {
		position : "absolute",
		top : '120px',
		//width : fotowidth+'px',
		//height : fotoheight+'px',
		//border : "1px solid black",
		backgroundSize : "100% 100%",
		backgroundRepeat : "no-repeat"
	};

	
	var fotoFator = ((widthT/2)-(fotowidth))/2;
	//  FOTO PILOTO INICIO
	var fotoAlinhaInicio = 0;
	var l1DiffInicio = (fotoFator-0)+fotoAlinhaInicio;
	var l1Inicio = {
		left : l1DiffInicio+"px",
		opacity  : '1'
	};
	var r1DiffInicio = (widthT/2)+fotoFator-fotoAlinhaInicio;
	var r1Inicio	= {
		opacity  : '1',
	    left : r1DiffInicio+"px"
	};
	//  FOTO PILOTO MEIO
	var fotoAlinhaMeio = 0;
	var l1DiffMeio = (fotoFator-0)+fotoAlinhaMeio;
	var l1Meio = {
		left : l1DiffMeio+"px"
	};
	var r1DiffMeio = (widthT/2)+fotoFator-fotoAlinhaMeio;
	var r1Meio = {
	    left : r1DiffMeio+"px"
	};
	//  FOTO PILOTO FINAL
	var fotoAlinhaFinal = -5;
	var l1DiffFinal = (fotoFator-0)+fotoAlinhaFinal;
	var l1Final = {
		left : l1DiffFinal+"px",
		opacity  : '0.1'
	};
	var r1DiffFinal = (widthT/2)+fotoFator-fotoAlinhaFinal;
	var r1Final = {
	    left : r1DiffFinal+"px",
		opacity  : '0.1'
	};
	
	
	var capaBurn = {
		//width : fotowidth+'px',
		//height : fotoheight+'px',
		filter : "grayscale(80%) brightness(30%) contrast(180%) drop-shadow(8px 8px 10px black) saturate(7)"
	};

	//////  numero
	var gpwidth = 640
	var gpinicial = { 
		position : "absolute",
		top : "280px",
		fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		//fontFamily: "'Advent Pro', sans-serif",
		//fontFamily : "'Press+Start+2P',  Arial, Helvetica, sans-serif",
		textShadow : "2px 2px 2px white, 2px 2px 2px white",
		fontSize : "72px",
		color : "white",
		textAlign: "center",
		//fontStyle : "italic",
		//border : "1px solid white",
		width : gpwidth+"px"
	};
	
	var gplDiff = -190;
	
	var gptop = {
		zIndex : "2"
	};
	var gpback = {
		zIndex : "1"
	};
	
	var gpl = {
		left : gplDiff+"px"
	};
	
	var gprDiff = (widthT/2)-gplDiff;
	var gpr = {
		left : gprDiff+"px"
	};
	
	var gpfinal = {
		color : "red"
	};
	
	
	////// nome
	
	var nome = {
		position : "absolute",
	    top : "70px",
	    width : "340px",
	    fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
	    fontColor : "white",
	    textShadow : "2px 2px black",
	    color : "#eee",
		textAlign: "center",
	   // border : "2px outset white",
	   // borderRadius : "25px",
	   // backgroundColor : "rgba(10,23,55,0.5)",
		width : "640px",
	    padding : "5px"
	};
	
	var firstnome = {
		fontSize : "22px",
	}
	
	var sobrenome = {
		fontSize : "32px",
		fontStyle : "bold"
	};
	
	var nomelDiff = -120;	
	var lt = {
	    left : nomelDiff+"px"
	    
	};
	var nomerDiff = (widthT/2)-nomelDiff;
	var rt = {
	    left : nomerDiff+"px"
	};
	
	//////equipe
	var equipewidth = 300;
	var equipeheight = 300;
	var equipeTop = 550;
	var equipeAlinhaHoriz = -100;
	
	
	var equipeLogo = {
		position : "absolute",
	    top : equipeTop+"px",
	    width : equipewidth+"px",
		height : equipeheight+"px",
		fontFamily : "'Audiowide',  Arial, Helvetica, sans-serif",
		color : "yellow",
		textShadow : "2px 2px black",
		fontSize : "32px",
		textAlign : "center",
		verticalAlign : "center"
	}
	
	var equipeFator = ((widthT/2)-(equipewidth))/2;
	//  FOTO PILOTO INICIO
	var equipeLDiff = (equipeFator-0)+equipeAlinhaHoriz;
	var equipeL = {
		left : equipeLDiff+"px"
	};
	var equipeRDiff = (widthT/2)+equipeFator-equipeAlinhaHoriz;
	var equipeR	= {
		left : equipeRDiff+"px"
	};
	
	//////////////////////////////
	var coluna = 110;
	var meio = 50;
	var gridwidth = (coluna*2)+meio;
	var gridleft = (widthT/2)-(gridwidth/2);
	var gridheight = 50;
	var gridmoveDiff = 0;
	var gridLineHeight = 20;
	var gridLinewidth =  coluna-10;
	var gridLineheight = gridheight;
	var gridEspacamentoPosicoesVertical = 0;
	var gridMarginTop = 0;
	
	var grid = {
		position : "absolute",
		textAlign : "center",
		width : gridwidth+"px",
		top : "100px",
		color : "white",		
		//border : "1px solid blue",
		left : gridleft+"px"
	};
	
	var  nomegrid = {
		fontFamily: "'Oswald', sans-serif",
		color : "white",
		fontSize : "16px"
	};
	
	var tabelagrid = {
		borderCollapse : "collapse",
		borderSpacing : "0px",
		margin : "0px"
		
	};
	var tabelagridtd = {
		textAlign : "center",
		height : gridheight+'px',
		//border : "1px solid white",
		padding : "0px",
		margin : "0px"
	};
	var divmeio = {
		width : meio+"px"
	};
	var divpos = {
		backgroundImage : "url('<?php echo $urlgrid;?>img/grid.png')",
		backgroundSize : gridLinewidth+"px "+gridLineheight+"px",
		backgroundRepeat : "no-repeat",
		backgroundPosition: "center center",
		height : gridheight+'px',
		width : coluna+"px",
		lineHeight : gridLineHeight+"px",
		//border : "1px solid white",
		verticalAlign : "top"			
	};
	
	var spanpos = {
		//textShadow : "1px 1px white",
		fontFamily: "'Oswald', sans-serif",
		color : "white",
		fontSize : "14px"
	};
	
	var divgd = {
		paddingTop : gridEspacamentoPosicoesVertical+"px"		
	};
	
	var gridMove = {
		top : "-="+(gridmoveDiff+(gridheight*2))+"px"
	};

