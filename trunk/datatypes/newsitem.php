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
# $Id: newsitem.php,v 1.7 2005/04/18 15:47:45 filetreefrog Exp $
##################################################

class newsitem {
	function form($object) {
		pathos_lang_loadDictionary('standard','core');
		pathos_lang_loadDictionary('modules','newsmodule');
	
		global $user;
	
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->title = '';
			$object->internal_name = '';
			$object->body = '';
			$object->publish = null;
			$object->unpublish = null;
		} else {
			$form->meta('id',$object->id);
			if ($object->publish == 0) $object->publish = null;
			if ($object->unpublish == 0) $object->unpublish = null;
		}
		
		$form->register('title',TR_NEWSMODULE_HEADLINE,new textcontrol($object->title));
		$form->register('internal_name','Internal Name',new textcontrol($object->internal_name));
		$form->register('body',TR_NEWSMODULE_BODY,new htmleditorcontrol($object->body));
		$form->register('publish',TR_NEWSMODULE_PUBLISH,new popupdatetimecontrol($object->publish,TR_NEWSMODULE_NOPUBLISH));
		$form->register('unpublish',TR_NEWSMODULE_UNPUBLISH,new popupdatetimecontrol($object->unpublish,TR_NEWSMODULE_NOUNPUBLISH));
		
		$form->register('submit','',new buttongroupcontrol(TR_CORE_SAVE,'',TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values,$object) {
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$object->title = $values['title'];
		$object->internal_name = preg_replace('/--+/','-',preg_replace('/[^A-Za-z0-9_]/','-',$values['internal_name']));
		$object->body = $values['body'];
		$object->publish = popupdatetimecontrol::parseData('publish',$values);
		$object->unpublish = popupdatetimecontrol::parseData('unpublish',$values);
		
		return $object;
	}
	
	function onWorkflowPost($object,$is_new,$channels) {
		global $db;
		// $userdata is a list of channel ids that we need to post to.
		
		$channel_item = null;
		$channel_item->tablename = 'newsitem';
		$channel_item->titlefield = 'title';
		$channel_item->viewlink = 'http://oicgroup.net';
		$channel_item->item_id = $object->id; // ID of extra-modular item
		
		foreach ($channels as $channel_id) {
			$channel_item->channel_id = $channel_id;
		
			$channel = $db->selectObject('channel','id='.$channel_id);
			$loc = unserialize($channel->location_data);
			
			if (pathos_permissions_check('manage_channel',$loc)) {
				echo 'Can manage channel.  Trying to post as real item<br />';
				// The poster has manage_channel in the channel destination.
				// Need to shoot this through sans-approval.
				unset($object->id);
				$object->location_data = serialize($loc);
				$channel_item->published_id = $db->insertObject($object,'newsitem');
				$channel_item->status = 0;
				$db->insertObject($channel_item,'channelitem');
			} else {
				$channel_item->status = 1; // Flag this as a new post.
				$channel_item->published_id = 0; // Set to zero, since we haven't published it yet.
				$db->insertObject($channel_item,'channelitem');
			}
		}
		if (!$is_new) {
			$updateObject = null;
			$updateObject->status = 2; // Edit
			$db->updateObject($updateObject,'channelitem',"tablename='newsitem' AND item_id=".$object->id);
		}
	}
}

?>