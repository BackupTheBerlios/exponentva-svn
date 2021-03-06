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
# $Id: class.php,v 1.9 2005/03/21 17:15:29 filetreefrog Exp $
##################################################
class inboxmodule {
	function name() { return "Private Message Center"; }
	function description() { return "Allows user to send and receive private messages, to and from other users on the site."; }
	function author() { return "James Hunt"; }
	
	function hasSources() { return false; }
	function hasContent() { return false; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = '') {
		pathos_lang_loadDictionary('modules','inboxmodule');
		return array(
			'administrate'=>TR_INBOXMODULE_PERM_ADMIN,
			'contact_all'=>TR_INBOXMODULE_PERM_CONTACTALL
		);
	}
	
	function deleteIn($loc) {
		// Nothing to delete, since there are no sources, and doing
		// so would be quite dangerous
	}
	
	function copyContent($from_loc,$to_loc) {
		// No content to copy, since there are not sources
	}
	
	function show($view,$loc,$title) {
		global $db, $user;
		if ($user) {
			$template = new template('inboxmodule',$view,$loc);
			
			$read = $db->countObjects('privatemessage','recipient='.$user->id.' AND unread=0');
			$unread = $db->countObjects('privatemessage','recipient='.$user->id.' AND unread=1');
			
			$template->assign('readMessages',$read);
			$template->assign('unreadMessages',$unread);
			$template->assign('totalMessages',$unread+$read);
			$template->assign('user',$user);
			$template->assign('moduletitle',$title);
			$template->register_permissions('administrate',$loc);
			$template->output();
		}
	}
	
	function spiderContent($item = null) {
		// Do nothing, no content
		return false;
	}
	
}

?>