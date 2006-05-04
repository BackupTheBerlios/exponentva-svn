function validate(frm) {

	if (frm.title.value == "") {
		frm.title.focus();
		alert("You must enter a title");
		return false;
	}

	// Validate dates/times

	
	//alert("This is an event.  Testing date/time stuff");
	
	var startDate = new Date(frm.eventstart_timestamp.value * 1000);
	var endDate = new Date(frm.eventend_timestamp.value * 1000);
	
	if (startDate.getTime() > endDate.getTime()) {
		alert("Specified Event Start Date is after the Event's End Date");
		return false;
	}
	
	//if (startDate.getDate() == endDate.getDate() && startDate.getMonth() == endDate.getMonth() && startDate.getYear() == endDate.getYear()) {
		// dates match
	//} else {
	//	alert("The Event Dates you entered do not match.  Events that span multiple days are not supported.");
	//	return false;
	//}	
	return true;
}