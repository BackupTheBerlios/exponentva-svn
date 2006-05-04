//GPL applies
// (c) 2005 Maxim Mueller
Exponent.Forms.switchControl = function (id,status) {
	myElem = document.getElementById(id);

	//TODO: disable form inputs with disabled="disabled"
	if (status) {
		myElem.parentNode.style.display = "block";
	} else {
		myElem.parentNode.style.display = "none";
	}
}

