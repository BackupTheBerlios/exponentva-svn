<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Copyright (c) 2006 Maxim Mueller
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################
//GREP:HARDCODEDTEXT
//GREP:VIEWIFY
//GREP:REIMPLEMENT

// Part of the HTMLArea category

if (!defined("EXPONENT")) exit("");

if (exponent_permissions_check('htmlarea',exponent_core_makeLocation('AdministrationModule'))) {
	$config = $db->selectObject('toolbar_' . SITE_WYSIWYG_EDITOR, "id=".intval($_GET['id']));

?>
<style type="text/css">
	.htmleditor_toolboxbutton:hover {
		border : 2px red solid;
	}
	.htmleditor_toolboxbutton_selected {
		background-color : grey;
	}
</style>
	
<script type="text/javascript">
//imported htmlarea control, because file is lost during reorg
//##################################################
//#
//# Copyright (c) 2004-2006 OIC Group, Inc.
//# Copyright (c) 2006 Maxim Mueller
//# Written and Designed by James Hunt
//#
//# This file is part of Exponent
//#
//# Exponent is free software; you can redistribute
//# it and/or modify it under the terms of the GNU
//# General Public License as published by the Free
//# Software Foundation; either version 2 of the
//# License, or (at your option) any later version.
//#
//# GPL: http://www.gnu.org/licenses/gpl.txt
//#
//##################################################

//initialize namespace
eXp.WYSIWYG = new Object();	

var used = new Array();
var rows = new Array();
var rowlens = new Array();


var g_row = 0;
var g_pos = 0;
var g_maxRowLength = 0;

var removeIcon = eXp.ICON_RELATIVE+"delete.gif";
var removeDisabledIcon = eXp.ICON_RELATIVE+"delete.disabled.gif";
var lastTd = null;
var imageSuffix = ".gif";

function newRow() {
	rows.push(new Array());
	rowlens.push(0);
	g_pos = 0;
	g_row = rows.length - 1;
	regenerateTable();
}

function recurseClear(elem) {
	while (elem.childNodes.length) {
		recurseClear(elem.childNodes[0]);
		elem.removeChild(elem.childNodes[0]);
	}
}

function regenerateTable() {
	maxRowLength();

	var tbody = document.getElementById("toolbar_workspace");
	recurseClear(tbody);
	
	for (rownum in rows) {
		var tr = document.createElement("tr");
		tr.setAttribute("id","row"+rownum);
		
		tr.appendChild(addLinkTd(rownum,0));
		for (itemkey in rows[rownum]) {
			tr.appendChild(iconTd(rows[rownum][itemkey],rownum,parseInt(itemkey)));
			tr.appendChild(addLinkTd(rownum,parseInt(itemkey)+1));
		}
		
		for (i = rowlens[rownum]; i < g_maxRowLength; i++) {
			tr.appendChild(blankTd());
			tr.appendChild(blankTd());
		}
		
		tr.appendChild(delRowLinkTd(rownum));
		
		tbody.appendChild(tr);
	}
	
}

function addLinkTd(rownum,pos) {
	var td = document.createElement("td");
	if (document.all) {
		td.attachEvent('onclick',function() {
			clickedTd(event.srcElement,rownum,pos);
		});

		td.attachEvent('onmouseover',function() {
			event.srcElement.style.backgroundColor = '#CCCCCC';
		});

		td.attachEvent('onmouseout',function() {
			unColorLink(event.srcElement,rownum,pos);
		});

		td.width = 2;
		td.height = 20;
		td.style.border = "1px dashed #CCCCCC";
	} else {
		td.setAttribute("onClick","clickedTd(this,"+rownum+","+pos+"); return false;");
		td.setAttribute("onmouseover","this.style.background='grey'");
		td.setAttribute("onmouseout","unColorLink(this,"+rownum+","+pos+")");
		td.setAttribute("width","2");
		td.setAttribute("height","20");
	}
	if (pos == g_pos && rownum == g_row) {
		if (document.all) {
			td.style.backgroundColor = '#0000FF';
			td.style.cursor = 'pointer';
		} else {
			td.setAttribute("style","background-color: blue; cursor: pointer;");
		}
		lastTd = td;
	} else {
		if (document.all) {
			td.style.cursor = 'pointer';
		} else {
			td.setAttribute("style","cursor: pointer;");
		}
	}
	return td;
}

function unColorLink(td,rownum, pos) { 
	if ((g_pos != pos) || (g_row != rownum)) {
		if (document.all) {
			td.style.backgroundColor = 'transparent';
		} else {
			td.style.background = 'transparent';
		}
	}
	else {
		if (document.all) {
			td.style.backgroundColor = '#0000FF';
		} else {
			td.style.background = "blue";
		}
	}
}

function delRowLinkTd(rownum) {
	var td = document.createElement("td");
	
	var img = document.createElement("img");
	if (rows.length == 1 && rows[0].length == 0) {
		img.setAttribute("src",removeDisabledIcon);
	} else {
		img.setAttribute("src",removeIcon);
	}
	img.setAttribute("style","cursor: pointer;");
	if (document.all) {
		img.attachEvent('onclick',function() {
			delRow(rownum);
		});
	} else {
		img.setAttribute("onclick","delRow("+rownum+")");
	}
	
	td.appendChild(img);
	
	return td;
}

function iconTd(icon,rownum, pos) {
	var td = document.createElement("td");
	if (document.all) {
		td.attachEvent('onclick',function() { 
			deleteIconTd(this,rownum,pos);
		});

		td.attachEvent('onmouseover',function() {
			event.srcElement.style.backgroundColor = '#FF0000';
		});
		
		td.attachEvent('onmouseout',function() {
			event.srcElement.style.backgroundColor = 'transparent';
		});
		
		td.style['cursor'] = 'pointer';
		td.style['background-color'] = 'inherit';
		td.style.border = "1px dashed #CCCCCC";
		td.colspan = (toolbarIconSpan(icon)-1)*2+1;
	} else {
		td.setAttribute("onclick","deleteIconTd(this,"+rownum+","+pos+"); return false;");
		td.setAttribute("class", 'htmleditor_toolboxbutton');
		td.setAttribute("style","cursor: pointer;");
		td.setAttribute("colspan",(toolbarIconSpan(icon)-1)*2+1);
	}
	var img = document.createElement("img");
	img.setAttribute("src",eXp.WYSIWYG.toolbox[icon][1]);
	
	td.appendChild(img);
	
	return td;
}

function deleteIconTd(td,rownum,pos) {
	if (confirm("Are you sure you want to remove this?")) {
		enableToolbox(rownum, rows[rownum][pos])
		rowlens[rownum] -= toolbarIconSpan(rows[rownum][pos]);
		rows[rownum].splice(pos,1);
		regenerateTable();
	}
}

function blankTd() {
	var td = document.createElement("td");
	if (document.all) {
		td.style['backgroundColor'] = '#CCCCCC';
		td.colspan = 1;
	} else {
		td.setAttribute("colspan","1");
		td.setAttribute("style","background-color: lightgrey;");
	}
	
	td.appendChild(document.createTextNode(" "));
	
	return td;
}

function clickedTd(td,new_row,new_pos) {
	g_pos = new_pos;
	g_row = new_row;
	if (lastTd) {
		if (document.all) {
			lastTd.style.backgroundColor = 'transparent';
		} else {
			lastTd.style.background="inherit";
		}
	}
	if (document.all) {
		td.style.backgroundColor = '#0000FF';
	} else {
		td.style.background = "blue";
	}
	lastTd = td;
}

function maxRowLength() {
	g_maxRowLength = 0;
	for (key in rowlens) {
		if (rowlens[key] > g_maxRowLength) g_maxRowLength = rowlens[key];
	}
}

function register(icon) {
	rows[g_row].splice(g_pos,0,icon);
	rowlens[g_row] += (toolbarIconSpan(icon));
	maxRowLength();
	g_pos++;
	regenerateTable();
	disableToolbox(icon);
}

function toolbarIconSpan(icon) {
	var tb_td = document.getElementById("td_"+icon);
	return parseInt(tb_td.getAttribute("colspan"));
}

function enableToolbox(rownum, key) {
	//for (key in rows[rownum]) {
		// clear used
		for (key2 in used) {
			if (used[key2] == key) {
				var td = document.getElementById("td_"+used[key2]);
				var a = document.getElementById("a_"+used[key2]);
				
				td.removeAttribute("style");
				if (document.all) {
					td.onmouseover = ie_highlight;
					td.onmouseout = ie_unhighlight;
					a.onclick = ie_register;
					a.holding = used[key2];
				} else {
					td.setAttribute("class", 'htmleditor_toolboxbutton');
					a.setAttribute("onclick","register('"+used[key2]+"')");
				}
				used.splice(key2,1);
			}
		}
	//}	
}

function disableToolbox(icon) {
	if (icon != "space" && icon != "separator") {
		used.push(icon);		

		var td = document.getElementById("td_"+icon);
		var a = document.getElementById("a_"+icon);
		if (document.all) {
			td.style.backgroundColor = '#CCCCCC';
			td.onmouseover = function() { return false; };
			td.onmouseout = function() { return false; };
			a.onclick = function() { return false; };
		} else {
			td.setAttribute("class", 'htmleditor_toolboxbutton_selected');
			
			a.removeAttribute("onclick");
		}
	}
}

function delRow(rownum) {
	for (key in rows[rownum]) {
		for (key2 in used) {
			if (used[key2] == rows[rownum][key]) {
				var td = document.getElementById("td_"+used[key2]);
				var a = document.getElementById("a_"+used[key2]);
				
				td.removeAttribute("style");
				if (document.all) {
					td.attachEvent('onmouseover',ie_highlight);
					td.attachEvent('onmouseout',ie_unhighlight);
					a.attachEvent('onclick',ie_register);
					a.holding = used[key2];
				} else {
					td.setAttribute("class", 'htmleditor_toolboxbutton');
					a.setAttribute("onclick","register('"+used[key2]+"')");
				}
				used.splice(key2,1);
			}
		}
	}
	rows.splice(rownum,1);
	rowlens.splice(rownum,1);
	if (rows.length == 0) {
		rows.push(new Array());
		rowlens.push(0);
	}
	g_pos = 0;
	g_row = 0;
	regenerateTable();
}

//serialize into JS linear array notation
function save(frm) {
	var saveStr = "[";
	for (i = 0; i < rows.length; i++) {
		if (typeof(rows[i][0]) != "undefined") {
			saveStr += "['";
			for (j = 0; j < rows[i].length; j++) {
				saveStr += rows[i][j];
				if (j != rows[i].length-1) {
					saveStr+="', '";
				}
			}
			saveStr += "']";
			if (i != rows.length - 1) {
				saveStr += ", ";
			}
		}
	}
	saveStr += "]";
	
	input = document.getElementById("config_htmlarea");
	input.setAttribute("value", saveStr);
	frm.submit();
}


// Stupid IE event interface functions

function ie_highlight() {
	event.srcElement.style.backgroundColor = '#FF0000';
}

function ie_unhighlight() {
	event.srcElement.style.backgroundColor = 'transparent';
}

function ie_register() {
	register(event.srcElement.holding);
}

// used to build a toolbox of available buttons, the array eXp.WYSIWYG_toolbar in /external/editors/<currenteditor>_toolbar.js has to be maintened manually(for now)
function exponentJSbuildHTMLEditorButtonSelector(Buttons) {
	myButtonPanel = document.getElementById("htmleditor_toolbox");
	
	for (currButton in Buttons) {
		myButton_img  = document.createElement("img");
		myButton_a  = document.createElement("a");
		myButton_td  = document.createElement("td");
		
		// difference between internal name and displayed name is possible because of i18n 
		myButton_img.setAttribute("src", Buttons[currButton][1]);
		myButton_img.setAttribute("title", Buttons[currButton][0]);
		myButton_img.setAttribute("alt", currButton);
		myButton_img.setAttribute("id", "img_" + currButton);
		
		myButton_a.setAttribute("id", "a_" + currButton);
		myButton_a.setAttribute("onclick","register('" + currButton + "')");
		
		myButton_td.setAttribute("id", "td_" + currButton);
		myButton_td.setAttribute('class' , 'htmleditor_toolboxbutton');
		
		myButton_a.appendChild(myButton_img);
		myButton_td.appendChild(myButton_a);
		myButtonPanel.appendChild(myButton_td);
		
	}
}	
</script>

<script type="text/javascript" src="<?php echo PATH_RELATIVE; ?>subsytems/forms/controls/WYSIWYGEditorControls/js/<?php echo SITE_WYSIWYG_EDITOR; ?>_toolbox.js"></script>
	

<table cellspacing="0" cellpadding="2" border="0">
	<tbody>
		<tr id="htmleditor_toolbox" />
		<tr>
			<td colspan="<?php echo $perrow; ?>" style="font-size: 12px; font-style: italic;" id="msgTD"></td>
		</tr>
	</tbody>
</table>
<hr size="1" />
<a class="mngmntlink administration_mngmntlink" href="#" onclick="newRow(); return false">New Row</a>
<hr size="1" />
<table cellpadding="2" cellspacing="2" rules="all" border="0">
	<tbody id="toolbar_workspace" />
</table>

<script type="text/javascript">
	var imagePrefix = "";
	// populate the button panel
	exponentJSbuildHTMLEditorButtonSelector(eXp.WYSIWYG.toolbox);
		
<?php
	
if ($config == null) {
?>
	// one initial row.
	rows.push(new Array());
	rowlens.push(0);
<?php
} else {
?>	

	eXp.WYSIWYG.toolbar = <?php echo $config->data; ?>;
	
	for(currRow = 0; currRow < eXp.WYSIWYG.toolbar.length; currRow++) {
		rows.push(new Array());
		rowlens.push(0);
		
		for(currButton = 0; currButton < eXp.WYSIWYG.toolbar[currRow].length; currButton++) {
			//TODO: decide whether to disallow empty rows altoghether -> htmlareatoolbarbuilder.js->save()
			if (eXp.WYSIWYG.toolbar[currRow][currButton] != "") {
				rows[currRow].push(eXpt.WYSIWYG.toolbar[currRow][currButton]);
				disableToolbox(eXp.WYSIWYG.toolbar[currRow][currButton]);
			}
		}
	}
<?php
}
?>

	regenerateTable();
</script>
<br />
<hr size="1" />
<form method="post">
<input type="hidden" name="module" value="AdministrationModule"/>
<input type="hidden" name="action" value="run"/>
<input type="hidden" name="m" value="AdministrationModule"/>
<input type="hidden" name="a" value="htmlarea_saveconfig"/>
<?php if ($config->id) { ?><input type="hidden" name="id" value="<?php echo $config->id; ?>"/><?php } ?>
<input type="hidden" name="config" value="" id="config_htmlarea" />
Configuration Name:<br /><input type="text" name="config_name" value="<?php echo $config->name ?>" /><br />
<input type="checkbox" name="config_activate" <?php echo ($config->active == 1 ? 'checked="checked" ' : '');?>/> Activate?<br />

<input type="submit" value="Save" onclick="save(this.form); return false">
</form>

	<?php

} else {
	echo SITE_403_HTML;
}

?>
