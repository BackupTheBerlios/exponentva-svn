<?php

##################################################
#
# Copyright (c) 2006 Maxim Mueller
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

class EditorToolbarItem extends ViewItem {
	public $datamodel;
	
	function __construct() {
	}
	
	//TODO: decide whether actions should be split into ui and non-ui,
	//or whether to leave the non-ui part to the datamodel layer
	
	//load actions as methods after checking for permissions
	//load extensions' actions -''-
}
?>