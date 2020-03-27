	//vars
	var FormErrors=false;
	var tabsCount;
	var navCount;
	var tabIndex = [];
	var inputCount = 0;
	// current tab
	var currentTab 	= 1;
	var prevTab 	= 1;
	
	var left = 0;


$(document).ready(function(){
	
	   //verifica se o navegador � Internet Explorer vers�o 6 ou anterior 
	  var browser = navigator.appName; 
	  var ver = navigator.appVersion; 
	  var thestart = parseFloat(ver.indexOf("MSIE"))+1; 
	  var brow_ver = parseFloat(ver.substring(thestart+4,thestart+7)); 
	  if ((browser=="Microsoft Internet Explorer") && (brow_ver < 7)) { 
	    //se for redireciona para a p�gina escolhida window.location="http://www.seusite.com.br/index_ie6.php"; 
	    alert("Por voce estar usando Internet Explorer 6.\nEste site podera nao funcionar corretamente.");
	  } 
	    
	  

	$(".container .ContentFrame .AllTabs").css("left",left + "px");
	
	
    
	//Initialize

	//number of tabs
	tabsCount = $('#formElem').children().length;
	navCount = $('#navigation').children().length;
	if(tabsCount!=navCount){
		alert('O quantidade e abas e bot�es esta diferente');
	}
	var name = "";
	var count = 0;
	for(var count = 1; count < tabsCount+1; ++count){
		name = jQuery.trim($('#navigation').children(':nth-child('+ parseInt(count) +')').text());
		tabIndex[name] = count ;
		tabIndex[count] = name;
	}
	//verifica tab de nomes iguais
	for(var verificada = 1; verificada < tabsCount+1; ++verificada){
		for(var verificando = 1; verificando < tabsCount+1; ++verificando){
			
			if(verificada!=verificando&&tabIndex[verificada]==tabIndex[verificando]){
				alert('As abas devem ter titulos diferente');
			}
		}
	}
	var ContentFrameSize = parseInt($(".container").css("width"));
	var TabLeftSlide = ContentFrameSize;
	
	var SpanMenuSize = (ContentFrameSize-(tabsCount*20))/tabsCount;
	$(".container .TabMenu span").css("width",(SpanMenuSize)+"px");
	
	
	var TabContentMarginLeft = parseInt($(".container .ContentFrame .AllTabs .TabContent").css("margin-left"));
	var TabContentPaddingLeft = parseInt($(".container .ContentFrame .AllTabs .TabContent").css("padding-left"));
	
	$(".container .ContentFrame .AllTabs .TabContent").css("margin-left",TabContentMarginLeft+"px");
	$(".container .ContentFrame .AllTabs .TabContent").css("margin-right",TabContentMarginLeft+"px");
	
	$(".container .ContentFrame .AllTabs .TabContent").css("padding-left",TabContentPaddingLeft+"px");
	$(".container .ContentFrame .AllTabs .TabContent").css("padding-right",TabContentPaddingLeft+"px");
	
	var TabContentSize = ContentFrameSize-(TabContentMarginLeft*2)-(TabContentPaddingLeft*2)-2;
	$(".container .ContentFrame .AllTabs .TabContent").css("width",TabContentSize+"px");
	var AllTabsSize = (ContentFrameSize+(tabsCount*20))*tabsCount;
	$(".container .ContentFrame .AllTabs").css("width",AllTabsSize+"px");
	
	
  
	//  first fields focus
//	$('#formElem').children(':first').find(':input:first').focus();	

	
	//Set the selector in the first tab
	$(".container .TabMenu span:first").addClass("selector");
	
	$('.container .ContentFrame .AllTabs #formElem').find(':input').each(function(){
		var $this = $(this);
		$this.addClass("idlefocus");
		inputCount++;
	});
	
	
	//Basic hover action
	$(".container .TabMenu span").mouseover(function(){
		$(this).addClass("hovering");
	});
	$(".container .TabMenu span").mouseout(function(){
		$(this).removeClass("hovering");
	});	
	
//trava tab
	$(".container .ContentFrame .AllTabs #formElem").bind('keydown',function(e){
		if (e.which == 9 && tabsCount > 1){
			e.preventDefault();
		}
	});
	
	// focus fields
	$('select').addClass("idlefocus");
	$('select').change(function() {
		$(this).removeClass("idlefocus").addClass("focus");
		$(this).removeClass("errorfield").addClass("focus");
	});
	$('select').blur(function() {
		$(this).removeClass("focus").addClass("idlefocus");
	});

	
	$('input[type="text"]').addClass("idlefocus");
	$('input[type="text"]').focus(function() {
		$(this).removeClass("idlefocus").addClass("focus");
		$(this).removeClass("errorfield").addClass("focus");
		$(this).select();

		/*
		var $form = $(this).parent("p").parent(".TabContent").parent("form");
		var formname = $form.attr("id");
		
		
		var $TabContent = $(this).parent("p").parent(".TabContent");
		var tabname = $TabContent.attr("id");
		
		var tabIndex = $('#'+formname+' div').index($TabContent);
		//$('#navigation span:nth-child(' + (parseInt(tabIndex)) + ') ').click();
		var newLeft = -1 * tabIndex * TabLeftSlide;
		$(".container .ContentFrame .AllTabs").animate({left: + newLeft + "px"},1000);*/
	});
	
	$('input[type="text"]').blur(function() {
		$(this).removeClass("focus").addClass("idlefocus");
	});
	
	$('input[type="password"]').addClass("idlefocus");
	$('input[type="password"]').focus(function() {
		$(this).removeClass("idlefocus").addClass("focus");
		$(this).removeClass("errorfield").addClass("focus");
		$(this).select();
		
	});
	
	$('input[type="password"]').blur(function() {
		$(this).removeClass("focus").addClass("idlefocus");
	});

	$('textarea').addClass("idlefocus");
	$('textarea').focus(function() {
		$(this).removeClass("idlefocus").addClass("focus");
		$(this).removeClass("errorfield").addClass("focus");
		$(this).select();

	});
	
	$('textarea').blur(function() {
		$(this).removeClass("focus").addClass("idlefocus");
	});
	
	
	//mascaraAjax
	var  msg = $('#mensagem').html();
	if(msg != null && msg.length > 0){
		$('#mascaraAjax').attr('alt','erro');
		$('#loader').hide();
		showmascara()
	}

	// masks

	$.mask.masks.year = {mask: '9999'};
	$.mask.masks.number = {mask: '9', type:'repeat'};
	$.mask.masks.siu_rg = {mask: '*', type:'repeat', 'maxLength': 25};
	$.mask.masks.phone = {mask : '(99) 9999-9999 99999'};
	$.mask.masks.phone_autoTab_false = {mask : '(99) 9999-9999 99999',  'autoTab': false};
	$.mask.masks.data_autoTab_false = {mask : '39/19/9999',  'autoTab': false};
	$.mask.masks.datatime = {mask : '39/19/9999 29:59:59' };
	
	
	$('input:text').setMask();
	
	/*
	if there are errors don't allow the user to submit
	*/
	$('.btn_submit').bind('click',function(){
		submeter($(this));
	});
	
	$('#registerButton').bind('click',function(){
		submeter($(this));
	});
	//mascaraAjax
	$('#mascaraAjax').click(function(){
		if($('#mascaraAjax').attr('alt')=='erro'){
			$('#mascaraAjax').fadeOut('slow');
		}
	});
		
	//Add click action to tab menu
	$(".container .TabMenu span").click(function(){
		//Remove the exist selector
		$(".selector").removeClass("selector");
		//Add the selector class to the sender
		$(this).addClass("selector");
		
		//Find the width of a tab
		var TabWidth = TabLeftSlide;//$(".TabContent:first").width();
		
		var spanIndex = $(".container .TabMenu span").index(this);
		//But wait, how far we slide to? Let find out
		var newLeft = -1 * spanIndex * TabWidth;
		
		  //Verify tabs
      	
		
		prevTab	= currentTab;
        currentTab = spanIndex+1 ;
		
        $(".container .ContentFrame .AllTabs #formElem").children(':nth-child('+ parseInt(spanIndex)+1 +')').find(':input:first').focus();
		
		//Ok, now slide
		var left = parseInt($(".container .ContentFrame .AllTabs").css("left"));
		$(".container .ContentFrame .AllTabs").animate({left: + newLeft + "px"},1000);
		
		left = parseInt($(".container .ContentFrame .AllTabs").css("left"));
		
		var valid = $('#formElem').attr( 'valid' ); 
		if (valid == undefined){
			if(currentTab == tabsCount){
				validateSteps();
			}else{
				validateStep(prevTab);
			}
		}
	});	
	
});
	
	

	
	

	
	/*
	validates errors on all the tabs
	records if the Form has errors in $('#formElem').data()
	*/
	
	function validateSteps(){
		FormErrors = false;
		
		for(var i = 1; i <=tabsCount; ++i){
			var error = validateStep(i);
			if(error == -1)
				FormErrors = true;
		}
		$('#formElem').data('errors',FormErrors);
	}
	
	/*
	validates one tab
	and returns -1 if errors found, or 1 if not
	*/
	function validateStep(step){
		/*if(step == tabsCount) return;*/
	
		var error = 1;
		var hasError = false;
		$('#formElem').children(':nth-child('+ parseInt(step) +')').find(':input:not(button)').each(function(){
			var $this 		= $(this);
			var valid = $this.attr( 'valid' );
			var nulo = false;
			if (valid != null && valid.length > 0){
				if(valid.substr(valid.length-4,valid.length)=="null"){
					nulo = true;
					valid = valid.substr(0,valid.length-4);
				}
				 var valueLength = jQuery.trim($this.val()).length;
				 if(valueLength == ''){
					 if(!nulo){
						 hasError = true;
						 $this.removeClass("idlefocus").addClass("errorfield");
					 }
				}else{
					$this.removeClass("errorfield").addClass("idlefocus");

					//valid email
					if (valid == 'email') {
						  var regmail = /^[\w!#\\$%\&'*+\/=?^`{|}~-]+(\.[\w!#\\$%\&'*+\/=?^`{|}~-]+)*@(([\w-]+\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
						  if (!regmail.test($this.val())) {
							   hasError = true;
							   $this.removeClass("idlefocus").addClass("errorfield");
						  }
					 }
					 //valid email
					//valid cep
					if (valid == 'cep') {
						  var objER = /^[0-9]{2}\.[0-9]{3}-[0-9]{3}$/;

						  if (!objER.test($this.val())) {
							   hasError = true;
							   $this.removeClass("idlefocus").addClass("errorfield");
						  }
					 }
					 //valid cep
					//valid number
					if (valid == 'number') {
						  var objER = /^\d+$/;
						  if (!objER.test($this.val())) {
							   hasError = true;
							   $this.removeClass("idlefocus").addClass("errorfield");
						  }
					 }
					 //valid number

					//valid date
					if (valid == 'date') {
						  var objER = /^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30\/(0[13-9]|1[0-2])|31\/(0[13578]|1[02]))\/\d{4}$/;
						  if (!objER.test($this.val())) {
							   hasError = true;
							   $this.removeClass("idlefocus").addClass("errorfield");
						  }
					 }
					 //valid date

				}
			}
		});
		var $link = $('#navigation span:nth-child(' + parseInt(step) + ')');
		
		$link.removeClass("checked");
		$link.removeClass("error");
		
		var valclass = 'checked';
		if(hasError){
			error = -1;
			valclass = 'error';
		}
		
		$link.addClass(valclass);
		
		return error;
	}

  

	function submeter(este){	
		var $this 		= este;//$(this);
		var event = $this.attr( 'alt' );
		if(event != null && event.length > 0){
			$('#event_html').attr('value',event);
		}
		var teste = $('#navigation TabSeletor selector').attr('alt');
		
		var action = $this.attr( 'action' );
		if(action != null && action.length > 0){
			$("#formElem").attr( 'action' , action );
		}		
		
		var idOpen = $this.attr( 'idOpen' );
		if(idOpen != null && idOpen.length > 0){
			setIds(idOpen);
		}	
		
		
		var valid = $this.attr( 'valid' );
		if(valid != null && valid == "no"){
			FormErrors = false;
		}else{
			validateSteps();
			
		}
		if(FormErrors){
			$('#mensagem').text("Os erros est�o marcados em vermelho.");
			$('#mascaraAjax').attr('alt','erro');
			$('#loader').hide();
			showmascara()
			return false;		    	
		}
	
		
		$('#mascaraAjax').attr('alt','');
		$('#mensagem').text("Aguarde...");
		$('#loader').show();
		showmascara()
		$("#formElem").submit();
		return true;
	}
	
	function setIds(idOpen){
		//idOpen = idOpen.replace("\"","");
		var campos = idOpen.split(",");
		var valor = "";
		var nome = "";
		for(var i=0;campos.length>i;i++){
			nome =  campos[0];
			i++;
			valor  =  campos[1];
			$('#formElem').append("<input type='text' id='"+nome+"' name='"+nome+"'>");
			$('#'+nome).attr('value',valor);
		}
			
	}
	function showmascara(){
		$('#mascaraAjax').animate({ height: 'toggle' }, 400, 0);
	}
	
	
	
	
	
	
