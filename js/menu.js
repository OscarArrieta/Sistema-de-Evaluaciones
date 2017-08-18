$(document).ready(function(){
	var menu = $("ul#dropline li.dropline-item");
	menu.mouseover(function(){  
		displayOptions($(this).find("ul"));  
	});  
	menu.mouseout(function(){  
		hideOptions($(this).find("ul"));  
	});  
});

//funcion que MUESTRA todos los elementos del menu  
function displayOptions(e){  
	e.show();  
}  
//funcion que OCULTA los elementos del menu  
function hideOptions(e){  
	e.hide();  
	
} 