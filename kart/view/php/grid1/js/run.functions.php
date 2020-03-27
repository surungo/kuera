var PRIMEIRO = 0;
var SEGUNDO = 1;
var ESQUERDA = "l";
var DIREITA = "r";

var FIRST = DIREITA;

var continua = 1;
function animacao(){
	
	// ATENÇÃO
	// as function devem ser de objetos id "#nome", se usar class ".nome" ele roda para todos os objetos da classe
	
	listaSize = lista.length;
	filasSize = listaSize/2;
	
	var seq_inicio =  1; 
	var seq_primeiraFila = 2; // mostra primerios 2 pilotos
	var seq_semMovegridFilaInicio =  3; //3 
	var seq_semMovegridFilaFim =  6;  // mostra + 8 pilotos
	var seq_comMovegridFilaInicio =  7;
	
	var seq_comMovegridFilaFim =  filasSize+2;
    var seq_AposUltimaFila =  seq_comMovegridFilaFim+2;

	var mostrarGridPosicoesInicial = 10;
	
	///
	if(sequencia == seq_semMovegridFilaInicio +1){
		animacaoPatrocinios();
	}
	
	if(continua==0) sequencia = seq_AposUltimaFila;
	
	//  ABERTURA
	if(sequencia == seq_inicio ){
		$("#titulo").css(tituloInicio);	
		$("#titulo").show();
		$("#titulo").animate(tituloMeio,tempos["mostratitulo"],
			function (){
				$("#titulo")
					.delay()
					.animate(tituloFinal,tempos["mostratituloFinal"]
					,function (){
						sequencia++;
						animacao();
					});
			});
	}
	if(sequencia == seq_primeiraFila ){
		
		// CARREGA PILOTOS PRIMEIRA FILA
		continua = adicionarDados(linhaGrid);
		
		// ANIMACAO INICIAL QUADRO E 
		$("#quadro").css(quadroInicio)
		.animate(quadroFinal,tempos["mostraAbrirQuadro"],
		function(){
			$("#titulo").css(tituloFinal);
		});
		
		$(".fotos").show();
		$(".capaBurn").show();
		$(".equipeLogo").show();
		$(".fotos").css(fotos);
		$("#l1").css(l1Inicio);
		$("#r1").css(r1Inicio);
		$(".capaBurn").css(capaBurn);
		
		//equipe
		$(".equipeLogo").css(equipeLogo);
		$("#equipel").css(equipeL);
		$("#equiper").css(equipeR);
		
		// --- 1
		//////////
		mostraNumero(sequencia);
		
		///// foto
		$("#capal").fadeOut(tempos["pilotoRetiraCapa"]);
		$("#capar").fadeOut(tempos["pilotoRetiraCapa"],
		function (){
		
		// --- 2
		mostraGridPos(1,mostrarGridPosicoesInicial);
		$(".firstnome").css(firstnome);
		$(".sobrenome").css(sobrenome);
		
		$("#equipel").show( "clip", {}, tempos["mostraNome"]);
		$("#equiper").show( "clip", {}, tempos["mostraNome"]);
		$("#lt , #rt").slideDown(tempos["mostraNome"]);
		
		$("#l1").animate(l1Meio,tempos["pilotoDeslisaCentro"]);
		$("#r1").animate(r1Meio,tempos["pilotoDeslisaCentro"],
		function (){
		
		// --- 3
		
		$("#tela").animate(telaInicio,tempos["pilotoPausaFoto"],
		function(){	
		
		// --- 4
		mostraGridNomes(linhaGrid,linhaGrid+1);
		$("#equipel").hide( "clip", {}, tempos["mostraNome"]);
		$("#equiper").hide( "clip", {}, tempos["mostraNome"]);
		$("#lt , #rt").slideUp(tempos["ocultaNome"]);
		
		$("#l1").animate(l1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"]);
		$("#r1").animate(r1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"],
		function(){	
		
		// --- 5
		mostraGridNomes(linhaGrid,linhaGrid+1);
		sequencia++;
		linhaGrid++;
		linhaGrid++;
		
		
		animacao();
		
		// --- 5 passos 4 function()
		});
		});
		});
		});
	}
	
	

	
	// ANIMACAO DEMAIS PILOTOS
	if( sequencia >= seq_semMovegridFilaInicio && 
	    sequencia <= seq_semMovegridFilaFim ){
		
		// CARREGA PILOTOS PRIMEIRA FILA
		continua = adicionarDados(linhaGrid);
		
		$(".fotos").show();
		$(".capaBurn").show();
		$(".fotos").css(fotos);
		$("#l1").css(l1Inicio);
		$("#r1").css(r1Inicio);
		$(".capaBurn").css(capaBurn);
		
		// --- 1
		//////////
		mostraNumero(sequencia);
		
		//// foto
		$("#capal").fadeOut(tempos["pilotoRetiraCapa"]);
		$("#capar").fadeOut(tempos["pilotoRetiraCapa"],
		function (){
		
		// --- 2
		$(".firstnome").css(firstnome);
		$(".sobrenome").css(sobrenome);
		$("#equipel").show( "clip", {}, tempos["mostraNome"]);
		$("#equiper").show( "clip", {}, tempos["mostraNome"]);
		$("#lt , #rt").slideDown(tempos["mostraNome"]);
		
		$("#l1").animate(l1Meio,tempos["pilotoDeslisaCentro"]);
		$("#r1").animate(r1Meio,tempos["pilotoDeslisaCentro"],
		function (){
		
		// --- 3
		$("#tela").animate(telaInicio,tempos["pilotoPausaFoto"],
		function(){	
		
		// --- 4
		mostraGridNomes(linhaGrid,linhaGrid+1);
		$("#equipel").hide( "clip", {}, tempos["mostraNome"]);
		$("#equiper").hide( "clip", {}, tempos["mostraNome"]);
		$("#lt , #rt").slideUp(tempos["ocultaNome"]);
		$("#l1").animate(l1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"]);
		$("#r1").animate(r1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"],
		function(){	
		
		// --- 5
		sequencia++;
		linhaGrid++;
		linhaGrid++;
		animacao();
		
		// --- 5 passos 4 function()
		});
		});
		});
		});
	}

	// ANIMACAO DEMAIS PILOTOS
	if( sequencia >= seq_comMovegridFilaInicio &&
		sequencia <= seq_comMovegridFilaFim ){
		
		// CARREGA PILOTOS PRIMEIRA FILA
		continua = adicionarDados(linhaGrid);		
		
		$(".fotos").show();
		$(".capaBurn").show();
		$(".fotos").css(fotos);
		$("#l1").css(l1Inicio);
		$("#r1").css(r1Inicio);
		$(".capaBurn").css(capaBurn);
		
		// --- 1
		//////////
		mostraNumero(sequencia);
		
		//// foto
		$("#capal").fadeOut(tempos["pilotoRetiraCapa"]);
		$("#capar").fadeOut(tempos["pilotoRetiraCapa"],
		function (){
		
		// --- 2

		$(".firstnome").css(firstnome);
		$(".sobrenome").css(sobrenome);
		$("#equipel").show( "clip", {}, tempos["mostraNome"]);
		$("#equiper").show( "clip", {}, tempos["mostraNome"]);
		$("#lt , #rt").slideDown(tempos["mostraNome"]);
		
		$("#grid").animate(gridMove,tempos["pilotoDeslisaCentro"]);
		mostraGridPos(linhaGrid,linhaGrid+1);
		ocultaGridPos(linhaGrid-mostrarGridPosicoesInicial,
		linhaGrid-(mostrarGridPosicoesInicial-1));
		$("#l1").animate(l1Meio,tempos["pilotoDeslisaCentro"]);
		$("#r1").animate(r1Meio,tempos["pilotoDeslisaCentro"],
		function (){
		
		// --- 3
		$("#tela").animate(telaInicio,tempos["pilotoPausaFoto"],
		function(){	
		
		// --- 4
		mostraGridNomes(linhaGrid,linhaGrid+1);
		$("#lt , #rt").slideUp(tempos["ocultaNome"]);
		$("#equipel").hide( "clip", {}, tempos["mostraNome"]);
		$("#equiper").hide( "clip", {}, tempos["mostraNome"]);
		
		$("#l1").animate(l1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"]);
		$("#r1").animate(r1Final,tempos["pilotoRetiraFoto"]).fadeOut(tempos["pilotoRetiraFoto"],
		function(){	
		
		// --- 5
		
		sequencia++;
		linhaGrid++;
		linhaGrid++;
		animacao();
		
		// --- 5 passos 4 function()
		});
		});
		});
		});
	}
	if( sequencia >= seq_AposUltimaFila ){
		$(".gp").fadeOut(tempos["pilotoPausaFoto"]);
		$("#tela").animate(telaInicio,tempos["pilotoPausaFoto"],
		function(){
			$("#tabelagrid").fadeOut(tempos["pilotoPausaFoto"]);
			
		});		
	}
	
}

function mostraNumero(sequencia){
		
		///// numero
		$(".gp").css(gpinicial);
		$("#gpl").css(gpl);
		$("#gpr").css(gpr);
		$("#gplp").css(gpl);
		$("#gprp").css(gpr);
		if(sequencia%2 == 0){
			$(".gpI").css(gptop);
			$(".gpP").css(gpback);
			$("#gplp , #gprp" ).hide( "clip", {}, tempos["gPositionHide"]);
			$("#gpl , #gpr").show();
			$("#gpl , #gpr").animate(gpfinal, tempos["gPositionColorChange"]);
			
		}else{
			$(".gpI").css(gpback);
			$(".gpP").css(gptop);
			$("#gpl , #gpr" ).hide( "clip", {}, tempos["gPositionHide"]);
			$("#gplp , #gprp").show();
			$("#gplp , #gprp").animate(gpfinal, tempos["gPositionColorChange"]);
		}
}

function posicaoInicial(){
	
	carregagrid();
	
	positionTest = 1;
	adicionarDado(positionTest,ESQUERDA);
	adicionarDado(positionTest,DIREITA);
	
	$("body").css(body);
	$("#tela").css(telaInicio);
	$("#logo").css(logoInicio);
	$("#quadro").css(quadroInicio);
	$("#titulo").css(tituloInicio);
	//$("#titulo").css(tituloMeio);
	//$("#titulo").css(tituloFinal);
	$("#patrocinadores").css(patrocinadores);
	$(".pat").css(pat);
	
	$(".fotos").css(fotos);
	$("#l1").css(l1Inicio);
	$("#r1").css(r1Inicio);
	
	$(".capaBurn").css(capaBurn);
	
	// grid position, big number 
	$(".gp").css(gpinicial);
	$("#gpl").css(gpl);
	$("#gpr").css(gpr);
	$("#gplp").css(gpl);
	$("#gprp").css(gpr);
	
	// big name
	$(".nome").css(nome);
	
	$(".firstnome").css(firstnome);
	$(".sobrenome").css(sobrenome);
	$("#lt").css(lt);
	$("#rt").css(rt);
	
	//equipe
	$(".equipeLogo").css(equipeLogo);
	$("#equipel").css(equipeL);
	$("#equiper").css(equipeR);
	
	// grid geral
	$("#grid").css(grid);
	$(".nomegrid").css(nomegrid);
	$("#tabelagrid").css(tabelagrid);
	$("#tabelagrid td").css(tabelagridtd);
	
	$(".divmeio").css(divmeio);
	$(".divpos").css(divpos);
	$(".spanpos").css(spanpos);
	$(".divgd").css(divgd);
	
	
	
}

function ocultarObjetos(){
	//$("#titulo").hide();
	$(".fotos").hide();
	$(".capaBurn").hide();
	$(".gp").hide();
	$(".nome").hide();
	$(".equipeLogo").hide();
	ocultaGridNomes(1,lista.length);
	ocultaGridPos(1,lista.length);
}

for(var cPatro = 0; cPatro < patrocinios.length; cPatro++ ){
	$("#patrocinadores").append("<span id='pat_"+cPatro+"' class='pat' >"+patrocinios[cPatro]["nome"]+"</span>");
}

function animacaoPatrocinios(){
		
	$("#patrocinadores").animate({left : "-3000px"},53000,"linear");
}

function animacaoFirst(){
	adicionarDado(positionGrid,ESQUERDA);
	adicionarDado(positionGrid,DIREITA);
		
	animaQuadro();
	mostraGridPos(1,10);
	animaFotos();
}

function animacaoGeral(){
	
	if(positionGrid < lista.length){
				
		adicionarDado(positionGrid,ESQUERDA);
		adicionarDado(positionGrid,DIREITA);
		animaFotos();
	}
}

function animaPosicao(ladoTela){
	$(".gp").css(gpinicial);
	$("#gpl").css(gpl);
	$("#gpr").css(gpr);
	$("#gp"+ladoTela).show();
	$("#gp"+ladoTela).animate(gpfinal, tempos["gPositionColorChange"],
		function (){
			$( "#gp"+ladoTela )
			.delay(tempos["pilotoPausaFoto"])
			.hide( "clip", {}, tempos["gPositionHide"]);
		}
	);
	
}

function animaFotos(){
	$(".fotos").show();
	$(".capaBurn").show();
	$(".fotos").css(fotos);
	$("#l1").css(l1Inicio);
	$("#r1").css(r1Inicio);
	$(".capaBurn").css(capaBurn);
	
	$(".capaBurn").fadeOut(tempos["pilotoRetiraCapa"],
	function (){
	
		$("#l1").animate(l1Meio,tempos["pilotoDeslisaCentro"],
		function (){
			$(".firstnome").css(firstnome);
			$(".sobrenome").css(sobrenome);
				
			$("#lt , #rt").slideDown(tempos["mostraNome"]);
				
			$(".gp").css(gpinicial);
			$("#gpl").css(gpl);
			$("#gpr").css(gpr);
			$("#gpl , #gpr").show();
			$("#gpl , #gpr").animate(gpfinal, tempos["gPositionColorChange"])
			$("#tela").animate(tempos["pilotoPausaFoto"],
			function(){
				$("#l1").animate(l1Final,tempos["pilotoRetiraFoto"],
				function(){
					$("#lt , #rt").slideUp(tempos["ocultaNome"]);
					$( "#gpl , #gpr" ).hide( "clip", {}, tempos["gPositionHide"]);
					
				})
				.fadeOut(tempos["pilotoRetiraFoto"],
				function (){
					//mostraGridNomes(positionGrid,positionGrid+1);
					positionGrid+=2;
					animacaoGeral();
					
				});
			});
		});
		
		$("#r1").animate(r1Meio,tempos["pilotoDeslisaCentro"],
		function (){
			$("#tela").animate(tempos["pilotoPausaFoto"],
			function(){	
				$("#r1").animate(r1Final,tempos["pilotoRetiraFoto"])
					.fadeOut(tempos["pilotoRetiraFoto"]);
			});
		});
	});
}

function animaNome(ladoTela){
	$(".firstnome").css(firstnome);
	$(".sobrenome").css(sobrenome);
	$("#"+ladoTela+"t").slideDown(tempos["mostraNome"],
		function(){
			$("#"+ladoTela+"t")
				.delay(tempos["pilotoPausaFoto"])
				.slideUp(tempos["ocultaNome"]);
	});
}
	

function ocultaNome(ladoTela){
	$("#"+ladoTela+"t").slideUp(tempos["ocultaNome"]);
}

function mostraNome(ladoTela){
	$("#"+ladoTela+"t").slideDown(tempos["mostraNome"]);
}

function adicionarDados(linhaGrid){
	var r1 = adicionarDado(linhaGrid,ESQUERDA);
    var r2 = adicionarDado(linhaGrid,DIREITA);
	return (r1 == 0 || r2 == 0 )? 0 : 1 ;
}
 
function adicionarDado(count,ladoTela){
	var retorno = 1;
	count--;
	posicao = (
		(FIRST==DIREITA&&ladoTela==DIREITA)||
		(FIRST==ESQUERDA&&ladoTela==ESQUERDA)
		)?PRIMEIRO:SEGUNDO;
    	var idFoto     = "#"+ladoTela+"1";
	var idPosition = "#gp"+ladoTela;
	var idNome = "#"+ladoTela+"t";
	var idEquipe = "#equipe"+ladoTela;
	
	var nomex = "";
	var sobrenomex = "";
	
	try{
		nomePiloto = lista[count + posicao]["nome"];
		fotoPiloto = lista[count + posicao]["foto"];
		urlfoto = "<?php echo $urlgrid; ?>cards/"+encodeURIComponent(fotoPiloto );
		$(idFoto).css("background-image","url("+urlfoto+")");
		if(sequencia%2==0){
			$(idPosition).html( (count+posicao+1) + txposnum(count+posicao+1));
		}else{
			$(idPosition+"p").html( (count+posicao+1) + txposnum(count+posicao+1));
		}
		pilotoSPLIT = nomePiloto.split(" ");
		nomex = pilotoSPLIT[0];
		for(z=1;z<pilotoSPLIT.length; z++){
			sobrenomex += pilotoSPLIT[z]+" ";
		}	
		$("#capa"+ladoTela).attr("src",urlfoto);
		$(idEquipe).html(lista[count + posicao]["equipe"]);		
	}catch(e){
		retorno = 0;
		$(idPosition).html(""); 
		$(idPosition+"p").html("");
		$(idEquipe).html("");		
	}
	
	nomePilotoSpan =
  "<span id='firstnome"+count+"' class='firstnome'><br>"+nomex+"</span>"+
	"<span id='sobrenome"+count+"' class='sobrenome'><br>"+sobrenomex+"</span>";
	$(idNome).html(nomePilotoSpan);
	
	return retorno;
}


function carregagrid(){		
	$("#grid").html("<table id='tabelagrid' ></table>");
	
	for(i = 0; i <lista.length; i++){
		var pos = i+1;
		urlx = "<?php echo $urlgrid; ?>cards/"+encodeURIComponent(lista[i]["foto"]);
		$("#buffer").append("<img witdh='32px' src='"+urlx+"'>");

		$("#tabelagrid").append("<tr id='trl"+pos+"' ></tr>");
		if(FIRST==DIREITA){
			//$("#r1").append("<img id='foto"+pos+"' class='fotoim fotoimg fotoimgr' src='"+urlx+"'><img id='capar' class='fotoim capaBurn capaBurnr' src='"+urlx+"'/>");
			
			if(pos%2==0){
				$("#trl"+pos).append(addgridposicao(pos,lista[i]["apelido"]));
				$("#trl"+pos).append(addgridmeio(pos));
				$("#trl"+pos).append(addgridespaco(pos));
			}	
			if(pos%2==1){
				$("#trl"+pos).append(addgridespaco(pos));
				$("#trl"+pos).append(addgridmeio(pos));
				$("#trl"+pos).append(addgridposicao(pos,lista[i]["apelido"]));
			}
		}else{
			//$("#l1").append("<img id='foto"+pos+"' class='fotoim fotoimg fotoimgl' src='"+urlx+"'><img id='caparl class='fotoim capaBurn capaBurnl' src='"+urlx+"'/>");
			
			if(pos%2==0){
				$("#trl"+pos).append(addgridespaco(pos));
				$("#trl"+pos).append(addgridmeio(pos));
				$("#trl"+pos).append(addgridposicao(pos,lista[i]["apelido"]));
			}	
			if(pos%2==1){
				$("#trl"+pos).append(addgridposicao(pos,lista[i]["apelido"]));
				$("#trl"+pos).append(addgridmeio(pos));
				$("#trl"+pos).append(addgridespaco(pos));
			}
		}	

	}
}

// SUB FunctionS DE GRID ----
function ocultaGridNomes(inicio,fim){
	for(inicio;inicio<=fim;inicio++){
		$("#nomegrid"+inicio).hide();
	}	
}
function mostraGridNomes(inicio,fim){
	for(inicio;inicio<=fim;inicio++){
		$("#nomegrid"+inicio).fadeIn(tempos['mostraNome']);
	}	
}

function ocultaGridPos(inicio,fim){
	for(inicio;inicio<=fim;inicio++){
		$("#divp"+inicio).hide();
	}	
}

function mostraGridPos(inicio,fim){
	for(inicio;inicio<=fim;inicio++){
		$("#divp"+inicio).show();
	}	
}

function addgridposicao(pos,piloto){
	//pilotoSPLIT = piloto.split(" ");
	piloto =
  // MOSTRAR SOMENTE SOBRENOME 
  //pilotoSPLIT[0]+
  //+"<br>"
  "<b>"+piloto+"</b>"
  +"<br>"
  ;
	return 	"<td id='tdp"+pos+"' class='divgd'>"+
		"<div id='divp"+pos+"' class='divpos'>"+
			"<span id='spanp"+pos+"' class='spanpos'>"+pos+""+txposnum(pos)+
			"<br><span id='nomegrid"+pos+"' class='nomegrid'>"+piloto+"</span>"+
		"</div>"+
	"</td>";
}   



function addgridmeio(pos){
	return "<td id='tdf1"+pos+"' class='divmeio'>&nbsp;</td>";
} 
function addgridespaco(pos){
	return "<td id='tde1"+pos+"' class='divespaco'>&nbsp;</td>";
} 
// SUB FunctionS DE GRID  




function teste(){
	
	positionTest = 22;
	adicionarDado(positionTest,ESQUERDA);
	adicionarDado(positionTest,DIREITA);
	
	$("#quadro").css(quadroFinal);
	
	$(".fotos").show();
	$(".fotos").css(fotos);
	//$("#l1").css(l1Inicio);
	//$("#r1").css(r1Inicio);
	$("#l1").css(l1Meio);
	$("#r1").css(r1Meio);
	
	//$("#l1").css(l1Final);
	//$("#r1").css(r1Final);
	
	$(".nome").show();
	
	//$(".gp").show();
	animaPosicao(ESQUERDA);
	animaPosicao(DIREITA);
	ocultaGridPos(1,30);
	mostraGridPos(29,30);
	
	$(".equipeLogo").css(equipeLogo);
	$("#equipel").css(equipeL);
	$("#equiper").css(equipeR);
	
	$("#equipel , #equiper" ).show( "clip", {}, tempos["gPositionHide"]);
	
	$("#patrocinadores").css(patrocinadores);
	$(".pat").css(pat);
	animacaoPatrocinios();
	
/*	mostraNome(ESQUERDA);
	mostraNome(DIREITA);
	ocultaNome(ESQUERDA);
	ocultaNome(DIREITA);
	
	animaNome(ESQUERDA);
	animaNome(DIREITA);
	
	//position
	ocultaGridNomes(1,30);	
	mostraGridNomes(1,10);
	ocultaGridPos(11,30);
	mostraGridPos(11,12);
	
	animaTitulo();
	animaFotos();
	
	$(".nome").css(nome);
	$(".sobrenome0.hide9)").css(sobrenome);
	$("#lt").css(lt);
	$("#rt").css(rt);
	
	$("#grid").css(grid);
	$(".nomegrid").css(nomegrid);
	$("#tabelagrid").css(tabelagrid);
	$("#tabelagrid td").css(tabelagridtd);
	
	$(".divpos").css(divpos);
	$(".spanpos").css(spanpos);
	$(".divgd").css(divgd);*/
	
}
