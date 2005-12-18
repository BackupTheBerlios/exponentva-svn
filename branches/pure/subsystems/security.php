<?php

##################################################
#
# Copyright (c) 2004-2005 OIC Group, Inc.
# Written and Designed by James Hunt
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

/* exdoc
 * @state <b>UNDOCUMENTED</b>
 * @node Undocumented
 */
define('SYS_SECURITY',1);

/* exdoc
 * @state <b>UNDOCUMENTED</b>
 * @node Undocumented
 */
function pathos_security_checkPasswordStrength($username,$password) {

	$i18n = pathos_lang_loadFile('subsystems/security.php');
// Return blank string on success, error message on failure.
// The error message should let the user know why their password is wrong.
	if (strcasecmp($username,$password) == 0) {
		return $i18n['not_username'];
	}
	# For example purposes, the next line forces passwords to be over 8 characters long.
	if (strlen($password) < 8) {
		return $i18n['pass_len'];
	}
	
	return ""; // by default, accept any passwords
}

?>
