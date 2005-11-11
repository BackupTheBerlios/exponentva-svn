<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: ban_user.php,v 1.5 2005/11/10 06:56:40 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if ($user) {
	$template = new template("inboxmodule","_form_banUser",$loc);
	
	$form = inbox_contactbanned::form(null);
	if ($form == null) {
		$template->assign('error','nousers');
	} else {
		$form->meta("module","inboxmodule");
		$form->meta("action","ban");
		$template->assign("form_html",$form->toHTML());
	}
	$template->output();
}

?>