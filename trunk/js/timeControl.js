//GPL applies
// (c) 2005 Maxim Mueller
function pathos_forms_switch_time(id,form,status) {
	myElem = document.getElementById(id+"_timestamp");

	if (status) {
		myElem.removeAttribute("disabled");
		myElem.parentNode.style.display = "block";
	} else {
		myElem.setAttribute("disabled","disabled");
		myElem.parentNode.style.display = "none";
	}
}

