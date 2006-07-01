// Copyright 2005-2006 Maxim Mueller
// This File is Part of the Exponent CMS
// GPL applies
eXp.Forms.switchControl = function (id,status) {
	myElem = document.getElementById(id);

	//TODO: disable form inputs with disabled="disabled"
	if (status) {
		myElem.parentNode.style.display = "block";
	} else {
		myElem.parentNode.style.display = "none";
	}
}

