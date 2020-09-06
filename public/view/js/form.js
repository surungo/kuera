window.history.forward();
	function carrega_submet(item){
		var isSubmit = true;
		
		var itemFK= item.attr( 'itemFK' );
		itemFK= (itemFK!=undefined)?itemFK:"";
		$('#itemFK').val(itemFK);
		
		var value = item.attr( 'value' );
		value = (value!=undefined)?value:"";
		$('#value').val(value);
		
		var idurl = item.attr( 'idurl' );
		idurl = (idurl!=undefined)?idurl:"";
		$('#idurl').val(idurl);

		var idobj = item.attr( 'idobj' );
		idobj = (idobj!=undefined)?idobj:"";
		$('#idobj').val(idobj);
		
		var choice = item.attr( 'choice' );
		choice = (choice!=undefined)?choice:"";
		
		if(choice > 0) { 
			$('#choice').val(choice);
		}
		
		var action = item.attr( 'action' ); 
		action = (action!=undefined)?action:"";
		$('#action').val(action);
		
		var target = item.attr( 'target' );
		target = (target!=undefined)?target:"";
		$('#target').val(target);
						
		var keysession = $('#keysession').val();
		keysession = (keysession!=undefined)?keysession:"";
		
		var token = $('#token').val();
		token = (token!=undefined)?token:"";
		
		 var params = (action=="")?"":action;
	      params = params+((itemFK=="")?"":((itemFK=="")?"":"&") +'itemFK='+itemFK);
	      params = params+((value=="")?"":((value=="")?"":"&") +'value='+value);
	      params = params+((idurl=="")?"":((params=="")?"":"&") +'idurl='+idurl);
	      params = params+((idobj=="")?"":((params=="")?"":"&") +'idobj='+idobj);
	      params = params+((choice=="")?"":((params=="")?"":"&")+'choice='+choice);
	      params = params+((action=="")?"":((params=="")?"":"&")+'action='+action);
	      params = params+((target=="")?"":((params=="")?"":"&")+'target='+target);
	      params = params+((keysession=="")?"":((params=="")?"":"&")+'keysession='+keysession);
	      params = params+((token=="")?"":((params=="")?"":"&")+'token='+token);
				
	    if(item.attr( 'target' )=="3" ){
	      $("#formDefault").attr('target','_blank');
	      isSubmit = true;
	      
	     // window.open("?"+params,'_blank');
	     // isSubmit = false;
	     // return false;
	    }
	    if(item.attr( 'target' )=="5"){
		  $("#formDefault").attr('target','_blank');
		  isSubmit = true;
	    }
	    
		if(isSubmit){
			$("#formDefault").submit();
		}
		$("#formDefault").removeAttr('target');
		$('#action').val(action);
		return true; 
	}
	      
	$(document).ready(function(){

		$('.btn_link').mouseup('click',function(){
			carrega_submet( $(this) );

	   });
	   $('.btn_item_menu').mouseup('click',function(){
			carrega_submet( $(this) );

		});
		$('.btn_abrir').mouseup('click',function(){
		if($(this).val()=='Excluir' || $(this).val()=='Remover todos' ){
			if (!confirm('Quer excluir?')){
		    	return false;
		    }
		}
		carrega_submet( $(this) );
		
	});
	
	$('.btn_select').change(function(){
		if($(this).val()=='Excluir'){
			if (!confirm('Quer excluir?')){
		    	return false;
		    }
		}
		carrega_submet( $(this) );
		
	});
	
	var magicalTimeout=3000;
  	var timeout;

	$('.btn_change').keyup(function(){
		var form=$(this);
		var length = form.val().length;
		if($(this).attr('id')=='cpf'){
			clearTimeout(timeout);
			valorcpf=form.val();
			length_cpf=(valorcpf.indexOf(".")>-1)?14:11;
			if (length<length_cpf){
		    	return false;
		    }
			carrega_submet( $(this) );
		
		}else{
		
			clearTimeout(timeout);
			id_form = form.attr("id");
			
			//image loader
			src_timer = $("#timer_"+id_form).attr("src");
			src_timer = src_timer.split("?")[0];
			src_timer = src_timer+"?"+Math.random();
			$("#timer_"+id_form).attr("src",src_timer);
			$("#timer_"+id_form).hide();
			$("#timer_"+id_form).show();
			timeout=setTimeout(function(){
				carrega_submet( form );
    			},magicalTimeout);
		}
		
		
		
		//
		
	});
	
   $('#btn_menu').click(function (){
	  
	   if($('#Menu').is(':visible')){
		   $("#Menu").hide("slow");
	   }else{
		   $("#Menu").show("slow");
	   }
   });
   
   $('#btn_log').click(function (){
		  
	   if($('#log').is(':visible')){
		   $("#log").hide("slow");
	   }else{
		   $("#log").show("slow");
	   }
   });

	$('.cl_sort').mouseup('click',function(){
		var item =  $(this);
		if(item.attr( 'value' )!=undefined){
			var valor = item.attr( 'value' );
		}
		
		var aux = $('#'+valor).val();
		var auxa =	aux.split(",");
		var anterior = auxa[0];
		var atual = item.attr( 'clsort' );
		
		var anteriorA = anterior.replace(" desc","");
		var atualA  = atual.replace(" desc","");
		
		if( anteriorA == atualA ){
			if(anterior.indexOf(" desc")<0){
				atual = atual + " desc";
			}else{
				atual = atual.replace(" desc","");
			}
			
		}else{
			if(anterior !=""){
				atual = atual + ", "+anterior;
			}
		}
		$('#'+valor).val(atual);
		
		carrega_submet( item );

	});
/*
   $(".par").mouseenter(function() {
	   $(this).css("background-color","#cccccc");
   }).mouseleave(function() {
	   $(this).css("background-color","#f6f6e0");
   });
   
   $(".impar").mouseenter(function() {
	   $(this).css("background-color","#cccccc");
   }).mouseleave(function() {
	   $(this).css("background-color","#e0f6f6");
   });
   */
 
});

function sortUpdate(clsort){
	$('#clsort').val(clsort);
	
}


