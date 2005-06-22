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
# $Id: edit_post.php,v 1.4 2005/03/13 19:03:38 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");


$post = null;
$bb = null;
$ploc = null;
$bbloc = null;
if (isset($_GET['id'])) {
	$post = $db->selectObject("bb_post","id=".$_GET['id']);
	if ($post) {
		$bb = $db->selectObject("bb_board","id=".$post->board_id);
		$loc = unserialize($bb->location_data);
		$ploc = pathos_core_makeLocation($loc->mod,$loc->src,"p".$post->id);
	}
} else if (isset($_GET['bb'])) {
	$bb = $db->selectObject("bb_board","id=".$_GET['bb']);
} else if (isset($_GET['parent'])) {
	$parent = $db->selectObject("bb_post","id=".$_GET['parent']);
	if ($parent) {
		$bb = $db->selectObject("bb_board","id=".$parent->board_id);
		$loc = unserialize($bb->location_data);
		$post->parent = $parent->id;
	}
}

if ($bb && $user) {
	$loc = pathos_core_makeLocation($loc->mod,$loc->src,"b".$bb->id);
	
	if (	($post == null && pathos_permissions_check("create_thread",$loc)) ||
		(!isset($post->id) && pathos_permissions_check("reply",$loc)) ||
		(isset($post->id) && (pathos_permissions_check("edit_post",$loc) || $post->poster == $user->id))
	) {
		$post->board_id = $bb->id;
		
		$form = bb_post::form($post);
		$form->location($loc);
		$form->meta("action","save_post");
		
		$template = new template("bbmodule","_form_editPost",$loc);
		$template->assign("is_edit",(isset($post->id) ? 1 : 0));
		$template->assign("is_reply",(isset($post->parent) ? 1 : 0));
		
		if (isset($post->parent) || !isset($post->id)) {
			$form->registerBefore("submit","monitor","Notify me of future replies to this thread",new checkboxcontrol(true,true));
		}
		
		$template->assign("form_html",$form->toHTML());
		$template->output();
	}
	
} else {
	echo SITE_404_HTML;
}

?>