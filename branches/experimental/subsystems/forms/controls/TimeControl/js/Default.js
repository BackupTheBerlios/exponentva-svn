// Copyright 2006 Maxim Mueller
// This File is Part of the Exponent CMS
// GPL applies

// initialize the subnamespace "TimeControl"
if(Exponent) {
	//dont overwrite preexisting stuff
	if(Exponent.Forms) {
		if(!Exponent.Forms.TimeControl) {
			Exponent.Forms.TimeControl = new Object();
		}
	}
}