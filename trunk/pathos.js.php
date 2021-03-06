<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.,Maxim Mueller
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: pathos.js.php,v 1.12 2005/04/06 18:52:14 filetreefrog Exp $
# MaxxCorp
##################################################

//Initialize Pathos Framework
include_once("pathos.php");
?>
// Pathos Javascript Support Systems

var onLoadInits = new Array(); // array of functions

var openWindows = new Array(); // array of window references.

function pathosJSIncludeOnce(id, file) {
		// do we even have to do something ?
		if (!document.getElementById(id)){
		
			//TODO: check for html spelling, right now we assume XHTML
			// get the head element 
			myHeadElem = document.getElementsByTagName("head").item(0);
		
			myNewElem = document.createElement("script");
			myNewElem.setAttribute("id",id);
			myNewElem.setAttribute("type","text/javascript");
			myNewElem.setAttribute("defer","false");
			myNewElem.setAttribute("src",file);
			myHeadElem.appendChild(myNewElem);
		} else {
			//TODO: write handling for overiding of scripts, e.g. by themes.
		};	
};

function pathosJSinitialize() {
	for (i = 0; i < onLoadInits.length; i++) {
		onLoadInits[i]();
	}
}

function pathosJSregister(func) {
	onLoadInits.push(func);
}

var PATH_RELATIVE = "<?php echo PATH_RELATIVE; ?>";
var THEME_RELATIVE = "<?php echo THEME_RELATIVE; ?>";
var ICON_RELATIVE = "<?php echo ICON_RELATIVE; ?>";

function pathosGetCookie(name) {
	cookiestr = document.cookie;
	var nameIndex = cookiestr.indexOf(name);
	if (nameIndex != -1) { // found the named cookie
		var startOffset = nameIndex+name.length+1;
		var endOffset = cookiestr.indexOf(";",startOffset);
		if (endOffset == -1) endOffset = cookiestr.length;
		return cookiestr.substring(startOffset,endOffset);
	}
	return "";
}

function makeLink() {
	var link = "";
	var link = "";
	var args = makeLink.arguments;
	link = PATH_RELATIVE + "index.php?";
	for (var i = 0; i < args.length; i+=2) {
		var v = args[i+1];
		if (v != null && v != "") {
			link += escape(args[i]) + "=" + escape(args[i+1]) + "&";
		}
	}
	return link.substr(0,link.length - 1);
}

function openWindow(url,name,options) {
	for (key in openWindows) {
		if (key == name) {
			if (openWindows[key].focus()) {
				return;
			} else {
				break;
			}
		}
	}
	openWindows[name] = window.open(url,name,options);
}

function openSelector(mod,dest,vmod,vview) {
	var url = PATH_RELATIVE+"source_selector.php?showmodules="+mod+"&dest="+escape(dest)+"&vmod="+vmod+"&vview="+vview;
	openWindow(url,'sourcePicker','title=no,toolbar=no,width=640,height=480,scrollbars=yes');
}

function openContentSelector(mod,dest,view) {
	var url = PATH_RELATIVE+"content_selector.php?showmodules="+mod+"&dest="+escape(dest)+"&vmod=containermodule&vview="+view;
	openWindow(url,'contentPicker','title=no,toolbar=no,width=640,height=480,scrollbars=yes');
}

function sourceSelected(hidden,showPreview,src,desc) {
	var hidden = document.getElementById(hidden);
	hidden.value = src;
	if (showPreview){
	showPreviewCall();
	}
}

function selectAll(prefix,checked) {
	elems = document.getElementsByTagName("input");
	for (var key in elems) {
		if (elems[key].type == "checkbox" && elems[key].name.substr(0,prefix.length) == prefix) {
			elems[key].checked = checked;
		}
	}
}

function isOneSelected(prefix,enabledOnly) {
	if (typeof enabledOnly == "undefined") {
		enabledOnly = true;
	}
	elems = document.getElementsByTagName("input");
	for (var key in elems) {
		if (elems[key].type == "checkbox" && elems[key].name.substr(0,prefix.length) == prefix) {
			if (enabledOnly && elems[key].checked && !elems[key].disabled) return true;
			if (!enabledOnly && elems[key].checked) return true;
		}
	}
	return false;
}


// Patch the String object, to make string parsing a little easier in Pathos
String.prototype.isValid = function (alpha,numeric,others) {
	for (var i = 0; i < this.length; i++) {
		if (alpha && this.isAlpha(i)) continue;
		if (numeric && this.isNumeric(i)) continue;
		var isGood = false;
		for (var j = 0; j < others.length; j++) {
			if (others[j] == this.charAt(i)) {
				isGood = true;
				continue;
			}
		}
		if (!isGood) return false;
	}
	return true;
}

String.prototype.isNumeric = function(index) {
	var charcode = this.charCodeAt(index);
	return (
		(charcode >= 48 && charcode < 48+10)
	);
}

String.prototype.isAlpha = function(index) {	
	var charcode = this.charCodeAt(index);
	return (
		(charcode >= 65 && charcode < 65+26) ||
		(charcode >= 97 && charcode < 97+26)
	);
}

String.prototype.trim = function() {
	str = this;
	while (1) {
		if (str.substring(str.length - 1, str.length) != " ") break;
		str = str.substr(0,str.length - 1);
	}
	while (1 && str.length > 0) {
		if (str.substring(0,1) != " ") break;
		str = str.substr(1,str.length - 1);
	}
	return str;
}