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

class WYSIWYGToolbarModel extends DataModel {
	/*exdoc
	 * 
	 * the constructor method takes a key that uniquely identifies
	 * a piece of data in the database, if the key is NULL a new object is created
	 * from the datadescription in the xml schema.
	 * 
	 * if a site policy for this datamodel exists, use it to fill in the default values 
	 * 
	 * if a corresponding database object exists, map it's data as properites
	 * of the Datamodel
	 * 
	 * @param String $key identifies a piece of data in the database
	 */
	function __construct($key = NULL) {
		if ($key != NULL) {
			//access db for existing data
			//convert recordset into this object's properties
		} else {
			//convert the xml schema into into this object's properties
			//access db for site policy
			//if there is, update this object's properties from site policy
		}
			
	}
}
?>
