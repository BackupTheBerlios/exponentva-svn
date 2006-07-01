// Copyright 2006 Maxim Mueller
// This File is Part of the Exponent CMS
// GPL applies

// initialize the subnamespace "TimeControl"
if(eXp) {
	//dont overwrite preexisting stuff
	if(eXp.Forms) {
		if(!eXp.Forms.TimeControl) {
			eXp.Forms.TimeControl = new Object();
		}
	}
}