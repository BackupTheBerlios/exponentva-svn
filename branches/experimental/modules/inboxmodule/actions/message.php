<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
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

if (!defined('EXPONENT')) exit('');

if ($user) {
	$msg = $db->selectObject('privatemessage','id='.intval($_GET['id']));
	
	if ($msg) {
		if ($msg->recipient == $user->id) { // OR check for mng perms.
			$template = new template('InboxModule','_viewmessage',$loc);
			
			$template->assign('message',$msg);
			
			$template->output();
			
			$msg->unread = 0;
			$db->updateObject($msg,'privatemessage');
		}
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>