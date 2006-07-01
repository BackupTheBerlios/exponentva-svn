eXp.Forms.TimeControl.init = function(controlname) {
	myTimestamp = document.getElementById(controlname + "_timestamp");
	myHours = document.getElementById(controlname + "_hours");
	myMinutes = document.getElementById(controlname + "_minutes");
	myAmPm = document.getElementById(controlname + "_ampm");
	// timezone correction
	// php works with seconds, javascript with ms units
	myDate = new Date(myTimestamp.getAttribute("value") * 1000 + new Date().getTimezoneOffset() * 60 * 1000);
	
	//do we have to take care of the backwardish imperial system of time notation ?
	currHours = myDate.getHours();
	if(myAmPm){
		//am
		if (currHours <= 12) {
			myHours.setAttribute("value", currHours);
			myAmPm.selectedIndex = 0;
		//pm
		} else {
			myHours.setAttribute("value", currHours - 12);
			myAmPm.selectedIndex = 1;
		}	
	} else {
		myHours.setAttribute("value", currHours);
	}
	myMinutes.setAttribute("value", myDate.getMinutes());
}

eXp.Forms.TimeControl.updateTime = function(source, destination) {

	// please note that for some reason source.getAttribute("value")
	// and source.value give different return different values
	// source.value seems dynamically updated
	sourcetype = source.getAttribute("id").split("_").pop();
	controlname = source.getAttribute("id").split("_").shift();
	// timezone correction
	// php works with seconds, javascript with ms units
	myDate = new Date(destination.getAttribute("value") * 1000  + new Date().getTimezoneOffset() * 60 * 1000);
	
	switch(sourcetype) {
		case "hours":
			//do we have to take care of the backwardish imperial system of time notation ?
			myAmPm = document.getElementById(controlname + "_ampm");
			if(myAmPm){
				//if its pm
				if(myAmPm.selectedIndex == 1) {
					myDate.setHours(source.value + 12);
				} else {
					myDate.setHours(source.value);
				}
			} else {
				myDate.setHours(source.value);
			}
			break;
		case "minutes":
			myDate.setMinutes(source.value);
			break;
		case "ampm":
			myHours = document.getElementById(controlname + "_hours");
			if(source.selectedIndex == 1) {
				myDate.setHours(myHours.getAttribute("value") + 12);
			} else {
				myDate.setHours(myHours.getAttribute("value"));
			}
			break;
	}
	
	// convert back to GMT in seconds
	destination.setAttribute("value", parseInt(myDate.getTime() / 1000 - new Date().getTimezoneOffset() * 60));	
}