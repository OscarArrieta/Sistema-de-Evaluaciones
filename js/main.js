
// This is the part where I set up the three adapters.
// Please choose the one you need and discard others.
// I did this because I observed that in some frameworks (especially ExtJS),
// using the standard DOM modifiers breaks up the framework's inner workings.

OFC = {};

OFC.jquery = {
	name: "jQuery",
	version: function (src) {
		return $('#' + src)[0].get_version();
	},
	rasterize: function (src, dst) {
		$('#' + dst).replaceWith(Control.OFC.image(src));
	},
	image: function (src) {
		return "<img src='data:image/png;base64," + $('#' + src)[0].get_img_binary() + "' />";
	},
	popup: function (src) {
		var img_win = window.open('', 'Exportar');
		with (img_win.document) {
			write('<html><head><title>Exportar<\/title><\/head><body>' + Control.OFC.image(src) + '<\/body><\/html>');
		}
	}
};

if (typeof (Control === "undefined")) {
	var Control = {
		OFC: OFC.jquery
	};
}

// By default, right-clicking on OFC and choosing "save image locally" calls this function.
// You are free to change the code in OFC and call my wrapper (Control.OFC.your_favorite_save_method)
function save_image(img) {
	OFC.jquery.popup(img);
}


function backAdmin(dominio) {
	if (confirm("Realmente desea volver al rol Administrador?")) {
		window.location = dominio + '/index.php?ctrol=dashboard&page=dashboard&backAdmin=true';
	}
}


function ismaxlength(obj) {
	var mlength = obj.getAttribute ? parseInt(obj.getAttribute("maxlength")) : "";
	if (obj.getAttribute && obj.value.length > mlength) {
		obj.value = obj.value.substring(0, mlength);
	}
}


function MM_jumpMenu(targ, selObj, restore) {
	if (selObj.options[selObj.selectedIndex].value != 0) {
		eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
		if (restore) {
			selObj.selectedIndex = 0;
		}
	}
}

function openFancybox(url, w, h) {
	$.fancybox({
		width: w,
		height: h,
		autoSize: false,
		type: "iframe",
		href: url
	});
}

function openFancyboxAuto(url) {
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de && de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de && de.clientHeight) || document.body.clientHeight;
	w = w - 90;
	h = h - 90;
	openFancybox(url, w, h);
}

function redirect(URL) {
	window.location.href = URL;

}

function runToggle(idDiv, idImg, path) {

	var options = {};

	if ($("#" + idImg).attr('src') == path + 'pic/toggle_minus.png') {
		$("#" + idDiv).fadeOut(500);
		$("#" + idImg).attr('src', path + 'pic/toggle_plus.png');
	} else {
		$("#" + idDiv).fadeIn(500);
		$("#" + idImg).attr('src', path + 'pic/toggle_minus.png');
	}
}

function SoloNumeros(caja)
{
	var cajaBien = "";
	if (caja)
	{
		for (var i = 0; i < caja.length; i++)
			if (isNaN(caja.charAt(i)) == false)
				cajaBien = cajaBien + caja.charAt(i);
	}
	return cajaBien;
}

function SoloNumerosFloat(campo) {
	var cajaBien = "";
	var caja = campo.value;
	if (caja) {
		for (var i = 0; i < caja.length; i++) {
			if (isNaN(caja.charAt(i)) == false || caja.charAt(i) == '.' || caja.charAt(i) == ',') {
				cajaBien = cajaBien + caja.charAt(i);
			}
		}
	}
	campo.value = cajaBien;
}


function unformatNumber(num) {
	if (num != "") {
		num = num.toString();
		return num.replace(/([^0-9\.\-])/g, '') * 1;
	} else {
		return '';
	}
}

function UpdateAjax(campo, valor, tabla, where, nivel, tipo, ctrol, page) {
	if (tipo == 'num') {
		valor = unformatNumber(valor);
	}

	if (campo != '' && tabla != '' && where != '') {
		var retorna = $.ajax({
			type: "POST",
			url: nivel + "controller/ctrol_js/ctrol_update.php",
			data: {
				"valor": valor,
				"tabla": tabla,
				"where": where,
				"campo": campo,
				"ctrol": ctrol,
				"page": page
			},
			async: false
		});
		return retorna.responseText;
	} else {
		return false;
	}
}

function DeleteAjaxFull(tabla, where, nivel) {
	if (confirm("Realmente desea eliminar este registro?") == true) {
		if (tabla != '' && where != '') {
			var retorna = $.ajax({
				type: "POST",
				url: nivel + "controller/ctrol_js/ctrol_delete_full.php",
				data: {
					"ctrol": "js",
					"page": "delete_full",
					"tabla": tabla,
					"where": where
				},
				async: false
			});
			return retorna.responseText;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function DeleteAjax(tabla, where, nivel) {
	if (tabla != '' && where != '') {
		var retorna = $.ajax({
			type: "POST",
			url: nivel + "controller/ctrol_js/ctrol_delete_full.php",
			data: {
				"ctrol": "js",
				"page": "delete_full",
				"tabla": tabla,
				"where": where
			},
			async: false
		});
		return retorna.responseText;
	} else {
		return false;
	}
}


function removeRowAjax(tablaDB, where, nivel, idFila, tabla) {
	var elimino = 0;
	elimino = DeleteAjaxFull(tablaDB, where, nivel);
	if (elimino == 1) {
		document.getElementById(tabla).deleteRow(idFila);
	}
	return elimino;
}

function findAjax(campo, tabla, where, nivel, tipo) {
	if (campo != '' && tabla != '' && where != '') {
		if (tipo == "") {
			tipo = "findSimple";
		}
		var retorna = $.ajax({
			type: "POST",
			url: nivel + "controller/ctrol_js/ctrol_find.php",
			data: {
				"tipo": tipo,
				"campo": campo,
				"tabla": tabla,
				"where": where
			},
			async: false
		});
		if (tipo == "param") {
			if (retorna.responseText != '' && retorna.responseText != null) {
				return jQuery.parseJSON(retorna.responseText);
			} else {
				return null;
			}
		} else {
			return retorna.responseText;
		}
	} else {
		return false;
	}
}

function checkSession(dominio) {
	var retorna = $.ajax({
		type: "POST",
		url: dominio + "/index.php?ctrol=js&page=checkSession",
		async: false
	});

	var estadoSession = jQuery.parseJSON(retorna.responseText);

	if (estadoSession.estado == 0) {
		redirect(dominio + '/index.php?');
	}
}

function removeRow(tabla, idFila, tipo) {
	switch (tipo) {
		case 1:
			if (confirm("Realmente desea eliminar este registro?") == true) {
				document.getElementById(tabla).deleteRow(idFila);
				return true;
			} else {
				return false;
			}
			break;
		case 2:
			if (idFila != null) {
				document.getElementById(tabla).deleteRow(idFila);
			}
			break;
	}
}

function includeCSS(p_file) {
	var v_css = document.createElement('link');
	v_css.rel = 'stylesheet';
	v_css.type = 'text/css';
	v_css.href = p_file;
	document.getElementsByTagName('head')[0].appendChild(v_css);
}

function addFile(campo, tabla_id, noFiles, extensiones) {
	var con = 0;
	var str_permitidas = 'array(';
	var validacion = true;
	$('input[name^="' + campo + '[]"]').each(function () {
		con++;
	});
	$('input[name^="file[' + campo + '][]"]').each(function () {
		con++;
	});

	$.each(extensiones, function (item, extension) {
		str_permitidas += "'" + extension + "',";
	});
	str_permitidas = str_permitidas.substring(0, (str_permitidas.length - 1)) + ')';

	if (con >= noFiles) {
		validacion = false;
		alert("No puede exceder el máximo de archivos permitidos(" + (noFiles) + ")");
	}
	if (validacion) {
		new_file = '<tr>';
		new_file += '<td width="50%" align="left"><input onchange="validarExtensionFile(' + str_permitidas + ',\'file_' + con + '\',\'El archivo debe estar dentro de las extesiones permitidas\')" type="file" size="30"  name="file_' + campo + '[]" id="file_' + con + '"/></td>';
		new_file += '<td width="40%" align="center"><input type="text" size="30"  name="' + campo + '[descripcion][]"/></td>';
		new_file += '<td width="10%" align="center"><img class="Cursor" src="' + (window.dhx_globalImgPathFileType ? dhx_globalPath : "") + 'pic/22x22/list-remove.png" onclick="removeRow(\'' + tabla_id + '\',this.parentNode.parentNode.rowIndex,1)" /></td>';
		new_file += '</tr>';
		$("#" + tabla_id).append(new_file);
	}
}

function validarExtensionFile(permitidas, IdObj, textError) {
	var nombreArchivo = $("#" + IdObj).val();
	if (nombreArchivo != '') {
		var array_nombre = explode(".", nombreArchivo);
		if (!in_array(array_nombre[array_nombre.length - 1], permitidas)) {
			$("#" + IdObj).val("");
			showDialog("Alerta", textError, "warning");
		}
	}
}

function InsertAjaxFull(campos, valores, tabla, nivel) {
	if (campos !== '' && valores !== '') {
		var retorna = $.ajax({
			type: "POST",
			url: nivel + "controller/ctrol_js/ctrol_insert.php",
			data: {
				"valores": valores,
				"tabla": tabla,
				"campos": campos
			},
			async: false
		});
		return retorna.responseText;
	} else {
		return false;
	}
}

jQuery.validarExtensionFile = function (permitidas, IdObj, textError) {
	var nombreArchivo = $("#" + IdObj).val();
	if (nombreArchivo !== '') {
		var array_nombre = explode(".", nombreArchivo);
		var extension = strtolower(array_nombre[array_nombre.length - 1]);
		if (!in_array(extension, permitidas)) {
			$("#" + IdObj).val("");
			alert(textError);
		}
	}
};

function redirect(URL) {
	window.location.href = URL;
}
