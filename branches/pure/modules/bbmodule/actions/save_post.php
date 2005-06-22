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
# $Id: save_post.php,v 1.6 2005/04/26 03:03:16 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$post = null;
$bb = null;
$ploc = null;
$bbloc = null;
$parent = null;
if (isset($_POST['id'])) {
	$post = $db->selectObject("bb_post","id=".$_POST['id']);
	if ($post) {
		$bb = $db->selectObject("bb_board","id=".$post->board_id);
		$loc = unserialize($bb->location_data);
		$ploc = pathos_core_makeLocation($loc->mod,$loc->src,"p".$post->id);
	}
} else if (isset($_POST['parent'])) {
	$parent = $db->selectObject("bb_post","id=".$_POST['parent']);
	if ($parent) {
		$bb = $db->selectObject("bb_board","id=".$parent->board_id);
		while ($parent && $parent->id != 0) {
			$post->parent = $parent->id;
			$parent = $db->selectObject("bb_post","id=".$parent->parent);
		}
		$parent = $db->selectObject("bb_post","id=".$post->parent);
	}
	
} else if (isset($_POST['bb'])) {
	$bb = $db->selectObject("bb_board","id=".$_POST['bb']);
}

if ($bb && $user) {
	$bbloc = pathos_core_makeLocation($loc->mod,$loc->src,"b".$bb->id);
	
	if (	($post == null && pathos_permissions_check("create_thread",$bbloc)) ||
		(!isset($post->id) && pathos_permissions_check("reply",$bbloc)) ||
		(isset($post->id) && (pathos_permissions_check("edit_post",$bbloc)) || $user->id == $post->poster)
	) {
		$post->board_id = $bb->id;
		$post = bb_post::update($_POST,$post);
		$post->updated = time();
		
		if (isset($post->id)) {
			$post->editor = $user->id;
			$post->editted = time();
			$db->updateObject($post,"bb_post");
		} else {
			$post->poster = $user->id;
			$post->posted = time();
			
			$config = $db->selectObject("bbmodule_config","location_data='".serialize($loc)."'");
			if (!isset($config->id)) {
				$config->email_title_thread = "Exponent Forum : New Thread Posted";
				$config->email_title_reply =  "Exponent Forum : New Reply Posted";
				
				$config->email_from_thread = "Forum Manager <forum@".HOSTNAME.">";
				$config->email_from_reply  = "Forum Manager <forum@".HOSTNAME.">";
				
				$config->email_address_thread = "forum@".HOSTNAME;
				$config->email_address_reply  = "forum@".HOSTNAME;
				
				$config->email_reply_thread = "forum@".HOSTNAME;
				$config->email_reply_reply  = "forum@".HOSTNAME;
				
				$config->email_showpost_thread = 0;
				$config->email_showpost_reply  = 0;
				
				$config->email_signature = "--\nThanks, Webmaster";
			}
			
			if ($parent == null) {
				$bb->num_topics++;
				// $bb will get updated later, on last post update
				
				$notifs = $db->selectObjects("bb_boardmonitor","board_id=".$bb->id);
			
				$template = new template("bbmodule","_email_newpost",$loc);
				$template->assign("is_reply",0);
				$template->assign("showpost",$config->email_showpost_thread);
				
				
				$title = $config->email_title_thread;
				$from_addr = $config->email_address_thread;
				$headers = array(
					"From"=>$from = $config->email_from_thread,
					"Reply-to"=>$reply = $config->email_reply_thread
				);
			} else {
				$parent->num_replies++;
				$parent->updated = time();
				// $parent will get updated later, on last post update
				
				$notifs = $db->selectObjects("bb_threadmonitor","thread_id=".$parent->id);
				
				$template = new template("bbmodule","_email_newreply",$loc);
				$template->assign("is_reply",1);
				$template->assign("showpost",$config->email_showpost_reply);
				$template->assign("parent",$parent);
				
				$title = $config->email_title_reply;
				$from_addr = $config->email_address_reply;
				$headers = array(
					"From"=>$config->email_from_reply,
					"Reply-to"=>$reply = $config->email_reply_reply
				);
			}
			$id = $db->insertObject($post,'bb_post');
			$post->id = $id;
			$template->assign('viewlink',URL_FULL.'index.php?module=bbmodule&action=view_thread&id='.$id);
			
			$bb->last_post_id = $id;
			
			if ($parent) $db->updateObject($parent,"bb_post");
			$db->updateObject($bb,"bb_board");
			
			$template->assign("signature",$config->email_signature);
			$post->body = chop(strip_tags(str_replace(array("<br />","<br>","br/>"),"\n",$post->body)));
			$template->assign("post",$post);
			if (!defined("SYS_USERS")) require_once(BASE."subsystems/users.php");
			$template->assign("poster",pathos_users_getUserById($post->poster));
			$template->assign("board",$bb);
			
			$msg = $template->render();
			
			// Saved.  do notifs
			$emails = array();
			if (!defined("SYS_USERS")) require_once(BASE."subsystems/users.php");
			foreach ($notifs as $n) {
				if ($n->user_id != $user->id) {
					$u = pathos_users_getUserById($n->user_id);
					if ($u->email != "") $emails[] = $u->email;
				}
			}
			
			if (!defined("SYS_SMTP")) require(BASE."subsystems/smtp.php");
			pathos_smtp_mail($emails,$from_addr,$title,$msg,$headers); 
		}
		
		// Save new monitors
		$thread_id = ($parent ? $parent->id : $post->id);
		if (isset($_POST['monitor'])) {
			if (!$db->selectObject("bb_threadmonitor","thread_id=".$parent." AND user_id=".$user->id)) {
				$mon = null;
				$mon->thread_id = $thread_id;
				$mon->user_id = $user->id;
				$db->insertObject($mon,"bb_threadmonitor");
			}
		} else {
			$db->delete("bb_threadmonitor","thread_id=".$thread_id." AND user_id=".$user->id);
		}
		pathos_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>