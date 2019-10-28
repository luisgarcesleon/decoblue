var currentPart = null;
var currentList = null;
var pmLoad = false;
var sddLoad = false;

function $(element)
{
	if (typeof(element) == "string")
		element = document.getElementById(element);
	
	return 	element;
}

/**
 * Funcion para sacar todos los elementos con un className especifico.
 *
 * @param mixed p = parent
 * @param string t = tag
 * @param string c = class
 */
function getElementsByClassName(p, t, c)
{
	var elems = Array();
	var parent = p ? $(p) : document.documentElement;
	var tag = t ? t : '*';
	var nodes = parent.getElementsByTagName(tag);
	var nLen = nodes.length;
	
	for (var i = 0; i < nLen; i++)
	{
		if (nodes[i].className && nodes[i].className.indexOf(c) >= 0)
			elems.push(nodes[i]);
	}
	
	return elems;
}

function reportPost(forum_id, topic_id, post_id)
{
	var popX = (screen.width - 500) / 2;
	var popY = (screen.height - 300) / 2;
	var reportPopup = window.open("/reportes/index/" + forum_id + "/" + topic_id + "/" + post_id, "reportWIndow", "width=500, height=300,left=" + popX + ",top=" + popY + ",scrollbars=no,location=no,menubar=no,resizable=no,toolbar=no");
	reportPopup.focus();
	
	return false;
}

function spoiler(sObj)
{
	var sRef = sObj.parentNode.nextSibling;
	if (sRef.nodeType != 1)
		sRef = sRef.nextSibling;
		
	if (sRef.className == "hide")
	{
		sObj.innerHTML = "Esconder";
		sRef.className = "s_top";
	}
	else
	{
		sObj.innerHTML = "Mostrar";
		sRef.className = "hide";
	}
}

function selectCode(cObj)
{
	// Get ID of code block
	var e = cObj.parentNode.nextSibling;
	if (e.nodeType != 1)
		e = e.nextSibling;

	// Not IE
	if (window.getSelection)
	{
		var s = window.getSelection();
		// Safari
		if (s.setBaseAndExtent)
		{
			s.setBaseAndExtent(e, 0, e, e.innerText.length - 1);
		}
		// Firefox and Opera
		else
		{
			var r = document.createRange();
			r.selectNodeContents(e);
			s.removeAllRanges();
			s.addRange(r);
		}
	}
	// Some older browsers
	else if (document.getSelection)
	{
		var s = document.getSelection();
		var r = document.createRange();
		r.selectNodeContents(e);
		s.removeAllRanges();
		s.addRange(r);
	}
	// IE
	else if (document.selection)
	{
		var r = document.body.createTextRange();
		r.moveToElementText(e);
		r.select();
	}
}

var minTxtHeight = 0;

function expandArea(refArea, full)
{
	var areaObj = $(refArea);
	
	if (minTxtHeight == 0)
		minTxtHeight = areaObj.clientHeight;
	
	if (!full)
	{
		var h = parseInt(areaObj.style.height);
		if (!h)
			h = areaObj.clientHeight;
		
		areaObj.style.height = h + 25 + "px";
	}
	else
	{
		if (areaObj.scrollHeight > areaObj.clientHeight)
		{
			var h = areaObj.scrollHeight;
			h = parseInt(h / 25);
			h = (h * 25) + 25;
			areaObj.style.height = h + "px";
		}
	}
}

function contractArea(refArea, full)
{
	var areaObj = $(refArea);
	
	if (minTxtHeight == 0)
		minTxtHeight = areaObj.clientHeight;
	
	if (!full)
	{
		var h = parseInt(areaObj.style.height);
		if (!h)
			h = areaObj.clientHeight;
		
		if (h > minTxtHeight)
			areaObj.style.height = h - 25 + "px";
	}
	else
	{
		areaObj.style.height = minTxtHeight + "px";
	}
}

function textareaKeyup(refArea, e)
{
	var areaObj = $(refArea);
	var key = ff ? e.which : window.event.keyCode;
	//var ctrlPressed = ff ? e.ctrlKey : event.ctrlKey;
	var altPressed = ff ? e.altKey : event.altKey;

	//if (ctrlPressed)
	if (altPressed)
	{
		switch (key)
		{
			case 107:
				expandArea(areaObj);
			break;

			case 109:
				contractArea(areaObj);
			break;
		}

		return false;
	}
	
	return true;
}

function searchPanel()
{
	$("search_panel").className = "show";
}

//-------------------------------------------------------------------

/**
* Function to open the goto page form
**/
function open_goto(obj)
{
    var gotoForm = obj.nextSibling;
    
    while (gotoForm.nodeType != 1)
        gotoForm = gotoForm.nextSibling;

    if (gotoForm.style.display == 'none')
    {
        gotoForm.style.display = 'block';
        gotoForm.page.focus();
    }
    else
        gotoForm.style.display = 'none';
}

//-------------------------------------------------------------------

function goto_page(obj)
{
	var gotoForm = obj;
	var p = gotoForm.page.value;
	
	if (p == '' || !p.match(/[0-9]+/) || p <= 0)
	{
		alert('Porfavor introduzca un numero mayor que 0.');
		return false;
	}
	
	var pages = $("pages");
	var links = pages.getElementsByTagName("a");
	var lastLink = links.length - 1;
	
	var spans = pages.getElementsByTagName("span");
	var spansLength = spans.length;
	
	for (var i = 0; i < spansLength; i++)
	{
		if (spans[i].className == "current")
		{
			var c = parseInt(spans[i].childNodes[0].nodeValue);
			break;
		}
	}
	
	if (p == c)
	{
		alert('Porfavor introduzca una pagina diferente a la actual.');
		return false;
	}
	
	if (links[lastLink].className == "next")
		lastLink -= 1;
	
	var l = parseInt(links[lastLink].childNodes[0].nodeValue);
	
	if (p > l)
	{
		alert('Esa pagina no existe.');
		return false;
	}
	
	var start = (p - 1) * 15;
	var cURL = $('c_topic').href;
	
	window.location = cURL.replace(/(.*start=)[0-9]+/, '$1' + start);
	
	return false;
}

//-------------------------------------------------------------------

function pageJump(obj)
{
    var pageBox = obj.parentNode;
    var pages = pageBox.getElementsByTagName('a');
    
    if (pages.length > 0)
    {
        var url = pages[0].href.match(/(.+\/)[1-9][0-9]*\/?$/i)[1];
        var currentPage = getElementsByClassName(pageBox, 'span', 'current')[0].innerHTML;
        var maxPage = pages[pages.length - 1].innerHTML;
        var gotoPage = obj.getElementsByTagName('input')[0].value;
        
        if (gotoPage.match(/[1-9][0-9]*/) && gotoPage <= maxPage && gotoPage != currentPage)
        {
            location.href = url + gotoPage;
        }
    }
    
    return false;
}

//-------------------------------------------------------------------

function switchSearch(sObj, where)
{
	sObj = sObj.childNodes[0];
	
	$("search_icon").src = sObj.src;
	$("searchfilter").value = where;
	$("search_panel").className = "hide";
	$("stext").focus();
}

function stopBubbling(e)
{
	if (!e) var e = window.event;
	e.cancelBubble = true;
	if (e.stopPropagation) e.stopPropagation();
}

function showLists(refObj, listName)
{
	var listObj = $(listName + "_lists");
	
	if (listObj)
	{
		var listClass = 'user_lists';
		
		if (currentList)
			currentList.className = listClass + ' hide';
		
		if (currentList !== listObj)
		{
			var ml = refObj.offsetLeft;
			listObj.style.left = ml + "px";
			listObj.className = listClass;
			
			currentList = listObj;
		}
		else
		{
			currentList = null;
		}
	}
	
	return false;
}

function processOnclick(e)
{
	var element = e ? e.target : window.event.srcElement;
	
	if (element.id != 'search_drop' && $('search_panel').className == 'show')
	{
		for (var i = 0; i < 2; i++)
		{
			if (element.id != 'search_panel')
				element = element.parentNode;
		}
		
		if (element.id != 'search_panel')
			$('search_panel').className = 'hide';
	}
	
	if ($('search_results') && element.id != 'search_results' && $('search_results').className == 'loaded')
	{
		$('search_results').className = 'hide';
	}
}

function showHelp(element)
{
	var element = $(element);
	var box = $(element.id + "_text");
	
	box.style.display = "block";
	box.style.marginTop = "-" + box.offsetHeight + "px";
}

function hideHelp(element)
{
	var element = $(element);
	$(element.id + "_text").style.display = "none";
}

//-----------------------------------------

function closeAgeWarning()
{
    var date = new Date();
    date.setTime(date.getTime()+(24*60*60*1000));

    $('ageWarning').className = 'hide';
    document.cookie = 'ageWarning=1;expires=' + date.toGMTString(); + ';path=/;domain=mcanime12.com';
}

//-----------------------------------------

function validateUsername()
{
	var ajax = new XHConn();
	ajax.connect("../../components/sign_up/search_username.php?nick=" + $("username_reg").value + "&token=" + $("token").value, "post", "", resultsUsername);
	ajax = null;
}

//-----------------------------------------

var resultsUsername = function (oXML)
{
	var errorTag = $("username_reg_error");
	var confirmTag = $("username_reg_confirm");

	if (oXML.responseText == "")
	{
		errorTag.className = errorTag.className.replace("show", "hide");
		confirmTag.className = confirmTag.className.replace("hide", "show");
	}
	else
	{
		errorTag.innerHTML = oXML.responseText;
		confirmTag.className = confirmTag.className.replace("show", "hide");
		errorTag.className = errorTag.className.replace("hide", "show");
	}
}

function validateForm()
{
	var reg = document.sign_up;
	var errors = 0;
	var regxs = Array();
	regxs["username_reg"] = RegExp("^[a-z0-9_\-]{3,25}$", "i");
	regxs["password_reg"] = RegExp("^[^ \t\n\r]{4,32}$", "i");
	regxs["email"] = RegExp("^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,4}$", "i");
	var minLength = Array()
	minLength["username_reg"] = 3;
	minLength["password_reg"] = 4;
	var empty = Array("username_reg", "password_reg", "confirm_password", "email");

	for (var i in empty)
	{
		var field = empty[i];
		var errorTag = $(empty[i] + "_error");
		
		if (reg[field].value == "")
		{
			errors++;
			errorTag.innerHTML = "No puedes dejar el campo en blanco.";
			errorTag.className = errorTag.className.replace("hide", "show");
		}
		else if (minLength[field] && reg[field].value.length < minLength[field])
		{
			errors++;
			errorTag.innerHTML = "El m&iacute;nimo de car&aacute;cteres es de " + minLength[field] + ".";
			errorTag.className = errorTag.className.replace("hide", "show");
		}
		else if (regxs[field] && !regxs[field].test(reg[field].value))
		{
			errors++;
			errorTag.innerHTML = "Contiene caracteres inv&aacute;lidos.";
			errorTag.className = errorTag.className.replace("hide", "show");
		}
		else
		{
			errorTag.className = errorTag.className.replace("show", "hide");
		}
	}
	
	if (reg["password_reg"].value != reg["confirm_password"].value && reg["password_reg"].value != "")
	{
		errors++;
		var errorTag = $("confirm_password_error");
		errorTag.innerHTML = "Contrase&ntilde;a de verificaci&oacute;n no coincide.";
		errorTag.className = errorTag.className.replace("hide", "show");
	}
	else if (reg["confirm_password"].value != "")
	{
		var errorTag = $("confirm_password_error");
		errorTag.className = errorTag.className.replace("show", "hide");
	}
	
	if (reg["Day"].selectedIndex != 0 || reg["Month"].selectedIndex != 0 || reg["Year"].selectedIndex != 0)
	{
		var dateRegx = RegExp("[0-9]{2}-[0-9]{2}-[0-9]{4}");
		var day = reg["Day"];
		var month = reg["Month"];
		var year = reg["Year"];
		var date =  day[day.selectedIndex].value + "-" + month[month.selectedIndex].value + "-" + year[year.selectedIndex].value;
		
		var errorTag = $("date_error");
		if (!dateRegx.test(date))
		{
			errors++;
			errorTag.className = errorTag.className.replace("hide", "show");
		}
		else
		{
			errorTag.className = errorTag.className.replace("show", "hide");
		}
	}

	return !errors;
}

//-----------------------------------------

function getSelectValue(selRef)
{
    var selObj = $(selRef);
    
    return selObj[selObj.selectedIndex].value;
}

//-----------------------------------------

/*var reportForm =
{
	id: null,
	form: null,
	
	init: function (fileId)
	{
		this.id = fileId;
		this.form = $("report_form_" + this.id);

		return;
	},
	
	open: function (fileId)
	{
		if (!form)
			this.init(fileId)
		
		//if (this.form.className.indexOf)
	},

	close: function ()
	{
		
	}
}*/

//-----------------------------------------

document.onclick = processOnclick;// JavaScript Document