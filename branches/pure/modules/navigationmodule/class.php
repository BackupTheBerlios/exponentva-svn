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

$navigationmodule_cached_sections = null;

class navigationmodule {
	function name() { return pathos_lang_loadKey('modules/navigationmodule/class.php','module_name'); }
	function author() { return 'James Hunt'; }
	function description() { return pathos_lang_loadKey('modules/navigationmodule/class.php','module_description'); }
	
	function hasContent() { return false; }
	function hasSources() { return false; }
	function hasViews()   { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = '') {
		$i18n = pathos_lang_loadFile('modules/navigationmodule/class.php');
		
		return array(
			'view'=>$i18n['perm_view'],
			'manage'=>$i18n['perm_manage'],
		);
	}
	
	function show($view,$loc = null,$title = '') {
		$id = pathos_sessions_get('last_section');
		$current = null;
		$sections = navigationmodule::getHierarchy();
		foreach (array_keys($sections) as $sid) {
			if ($id == $sid) {
				$current = $sections[$sid];
				break;
			}
		}
		
		$template = new template('navigationmodule',$view,$loc);
		$template->assign('sections',$sections);
		$template->assign('current',$current);
		global $user;
		$template->assign('canManage',(($user && $user->is_acting_admin == 1) ? 1 : 0));
		$template->assign('moduletitle',$title);
		
		$template->output();
	}
	
	function deleteIn($loc) {
		// Do nothing, no content
	}
	
	function copyContent($fromloc,$toloc) {
		// Do nothing, no content
	}
	
	function spiderContent($item = null) {
		// Do nothing, no content
		return false;
	}
	
	/*
	 * Retrieve either the entire hierarchy, or a subset of the hierarchy, as an array suitable for use
	 * in a dropdowncontrol.  This is used primarily by the section datatype for moving and adding
	 * sections to specific parts of the site hierarchy.
	 *
	 * @param $parent The id of the subtree parent.  If passed as 0 (the default), the entire subtree is parsed.
	 * @param $ignore_ids a value-array of IDs to be ignored when generating the list.  This is used
	 * when moving a section, since a section cannot be made a subsection of itself or any of its subsections.
	 */
	function levelShowDropdown($parent,$depth=0,$default=0,$ignore_ids = array()) {
		$html = '';
		global $db;
		$nodes = $db->selectObjects('section','parent='.$parent);
		if (!defined('SYS_SORTING')) include_once(BASE.'subsystems/sorting.php');
		usort($nodes,'pathos_sorting_byRankAscending');
		foreach ($nodes as $node) {
			if (($node->public == 1 || pathos_permissions_check('view',pathos_core_makeLocation('navigationmodule','',$node->id))) && !in_array($node->id,$ignore_ids)) {
				$html .= '<option value="' . $node->id . '" ';
				if ($default == $node->id) $html .= 'selected';
				$html .= '>';
				if ($node->active == 1) {
					$html .= str_pad('',$depth*3,'.',STR_PAD_LEFT) . $node->name;
				} else {
					$html .= str_pad('',$depth*3,'.',STR_PAD_LEFT) . '('.$node->name.')';
				}
				$html .= '</option>';
				$html .= navigationmodule::levelShowDropdown($node->id,$depth+1,$default,$ignore_ids);
			}
		}
		return $options;
	}
	
	/*
	 * Returns a flat representation of the full site hierarchy.
	 */
	function levelDropDownControlArray($parent,$depth = 0,$ignore_ids = array(),$full=false) {
		$ar = array();
		if ($parent == 0 && $full) {
			$ar[0] = '&lt;Top of Hierarchy&gt;';
		}
		global $db;
		$nodes = $db->selectObjects('section','parent='.$parent);
		if (!defined('SYS_SORTING')) include_once(BASE.'subsystems/sorting.php');
		usort($nodes,'pathos_sorting_byRankAscending');
		foreach ($nodes as $node) {
			if (($node->public == 1 || pathos_permissions_check('view',pathos_core_makeLocation('navigationmodule','',$node->id))) && !in_array($node->id,$ignore_ids)) {
				if ($node->active == 1) {
					$text = str_pad('',($depth+($full?1:0))*3,'.',STR_PAD_LEFT) . $node->name;
				} else {
					$text = str_pad('',($depth+($full?1:0))*3,'.',STR_PAD_LEFT) . '('.$node->name.')';
				}
				$ar[$node->id] = $text;
				foreach (navigationmodule::levelDropdownControlArray($node->id,$depth+1,$ignore_ids,$full) as $id=>$text) {
					$ar[$id] = $text;
				}
			}
		}
		
		return $ar;
	}
	
	/**
	 * Retrieve the enitre hierarchy as a single-dimmensional array of Objects.
	 */
	function getHierarchy() {
		global $db, $cached_sections;
		
		// Here we check to see if we have a non-null cached_sections
		// variable (global).  At the end of the first call to getHierarchy(),
		// this variable is populated with the return value, so that we
		// can bypass going to the database on subsequent calls.
		//
		// (This assumes that the section hierarchy does not change
		// within the context of a single page rendering.)
		if ($cached_sections != null) {
			return $cached_sections;
		}
		
		// The most efficient way (speaking in terms of database efficiency)
		// to build the hierarchy is to retrieve all live sections in one query,
		// and then sort through them in memory.  The $blocks variable stores
		// the retrieved section objects according to their parent, which we use
		// later to quickly build the hierarchy array.
		$blocks = array();
		
		// Live sections (i.e. not standalone pages) must have a valid greater-than-zero
		// value for their parent attribute.  We also ORDER BY the rank, so that the $blocks
		// array is in the correct order for generating accurate hierarchy levels.
		foreach ($db->selectObjects('section','parent >= 0 ORDER BY rank ASC') as $section) {
			if (!isset($blocks[$section->parent])) {
				$blocks[$section->parent] = array();
			}
			$blocks[$section->parent][] = $section;
		}
		
		// This is the actual hierarchy that will be returned.
		$hier = array();
		
		// BEGIN HACK
		#navigationmodule::_appendChildren($hier,$blocks,0);
		
		$parent = 0;
		$parents = array(0);
		
		while (count($blocks)) {
			if (!isset($blocks[$parent][0])) {
				exit('Exiting prematurely');
			}
			// Grab the first section on the level we are currently dealing with.
			if (!is_array($blocks[$parent])) exit('$blocks['.$parent.'] is no longer an array...');
			$section = array_shift($blocks[$parent]);
			
			
			// Ensure that the section is either public, or the user has permissions to view it.
			if ($section->public == 1 || pathos_permissions_check('view',pathos_core_makeLocation('navigationmodule','',$section->id))) {
				// Set up some general metadata about the section and its
				// place in the hierarchy.   Caching it here makes it easier
				// to create navigation module views.
				$section->numChildren = count(@$blocks[$section->id]);
				$section->numParents = count($parents) - 1;
				$section->depth = $section->numParents; // GREP: Is this really necessary?
				$section->parents = array_slice($parents,1); // Should this include 0?
				$section->first = ($section->rank == 0 ? 1 : 0);
				// Default, to be changed later on in the execution
				$section->last = 0;
			
				// Generate the link attribute base on alias type.
				if ($section->alias_type == 1) {
					// External link.  Set the link to the configured website URL.
					// This is guaranteed to be a full URL because of the
					// section::updateExternalAlias() method in datatypes/section.php
					$section->link = $section->external_link;
				} else if ($section->alias_type == 2) {
					// Internal link.
					
					// Need to check and see if the internal_id is pointing at an external link.
					//
					// A DB call is not inefficient here, since we are looking up by PKey, and this
					// situation should not happen very often.
					$dest = $db->selectObject('section','id='.$section->internal_id);
					if ($dest->alias_type == 1) {
						// This internal alias is pointing at an external alias.
						// Use the external_link of the destination section for the link
						$section->link = $dest->external_link;
					} else {
						// Pointing at a regular section.  This is guaranteed to be
						// a regular section because aliases cannot be turned into sections,
						// (and vice-versa) and because the section::updateInternalLink
						// does 'alias to alias' dereferencing before the section is saved
						// (see datatypes/section.php)
						$section->link = pathos_core_makeLink(array('section'=>$section->internal_id));
					}
				} else {
					// Normal link.  Just create the URL from the section's id.
					$section->link = pathos_core_makeLink(array('section'=>$section->id));
				}
				
				// Now we need to do some housecleaning, and re-align our parent pointer.
				// Does the current section have children that need to be processed?
				if (isset($blocks[$section->id])) {
					// There are children underneath this section.
					$parents[] = $section->id;
					$parent = $section->id;
				} else if (!count($blocks[$section->parent])) {
					// There are no more sections on this level.  Back up the $parents array
					$section->last = 1;
					unset($blocks[$section->parent]);
					array_pop($parents);
					$parent = $parents[count($parents)-1];
				}
				
				// Now that we have determined first or last, we can append to the hierarchy
				$hier[] = $section;
				
			} // End permission / public check
			
			// If we are out of children, unset the parent
			// This contributes to our loop exit condition by whittling down the
			// $blocks array.
			if (!count($blocks[$parent])) {
				unset($blocks[$parent]);
			}
		}
		
		// END HACK
		
		// Cache the hierarchy for subsequent calls to this function.
		$cached_sections = $hier;
		
		return $hier;
	}
	
	/*
	function _appendChildren(&$master,&$blocks,$parent,$depth = 0, $parents = array()) {
		global $db;
		$nodes = array();
		$kids = $db->selectObjects('section','parent='.$parent);
		if (!defined('SYS_SORTING')) include_once(BASE.'subsystems/sorting.php');
		usort($kids,'pathos_sorting_byRankAscending');
		for ($i = 0; $i < count($kids); $i++) {
			$child = $kids[$i];
			//foreach ($kids as $child) {
			if ($child->public == 1 || pathos_permissions_check('view',pathos_core_makeLocation('navigationmodule','',$child->id))) {
				$child->numParents = count($parents);
				$child->numChildren = 0;
				$child->depth = $depth;
				$child->first = ($i == 0 ? 1 : 0);
				$child->last = ($i == count($blocks[$parent])-1 ? 1 : 0);
				$child->parents = $parents;
				
				// Generate the link attribute base on alias type.
				if ($child->alias_type == 1) {
					// External link.  Set the link to the configured website URL.
					// This is guaranteed to be a full URL because of the
					// section::updateExternalAlias() method in datatypes/section.php
					$child->link = $child->external_link;
				} else if ($child->alias_type == 2) {
					// Internal link.
					
					// Need to check and see if the internal_id is pointing at an external link.
					$dest = $db->selectObject('section','id='.$child->internal_id);
					if ($dest->alias_type == 1) {
						// This internal alias is pointing at an external alias.
						// Use the external_link of the destination section for the link
						$child->link = $dest->external_link;
					} else {
						// Pointing at a regular section.  This is guaranteed to be
						// a regular section because aliases cannot be turned into sections,
						// (and vice-versa) and because the section::updateInternalLink
						// does 'alias to alias' dereferencing before the section is saved
						// (see datatypes/section.php)
						$child->link = pathos_core_makeLink(array('section'=>$child->internal_id));
					}
				} else {
					// Normal link.  Just create the URL from the section's id.
					$child->link = pathos_core_makeLink(array('section'=>$child->id));
				}
				$child->numChildren = $db->countObjects('section','parent='.$child->id);
				$nodes[] = $child;
				//$nodes = array_merge($nodes,navigationmodule::levelTemplate($child->id,$depth+1,$parents));
			}
		}
	}
	*/
	
	function getTemplateHierarchyFlat($parent,$depth = 1) {
		global $db;
		
		$arr = array();
		$kids = $db->selectObjects('section_template','parent='.$parent);
		if (!defined('SYS_SORTING')) include_once(BASE.'subsystems/sorting.php');
		usort($kids,'pathos_sorting_byRankAscending');
		
		for ($i = 0; $i < count($kids); $i++) {
			$page = $kids[$i];
			
			$page->depth = $depth;
			$page->first = ($i == 0 ? 1 : 0);
			$page->last = ($i == count($kids)-1 ? 1 : 0);
			$arr[] = $page;
			$arr = array_merge($arr,navigationmodule::getTemplateHierarchyFlat($page->id,$depth + 1));
		}
		return $arr;
	}
	
	function process_section($section,$template) {
		global $db;
		if (!is_object($template)) {
			$template = $db->selectObject('section_template','id='.$template);
			$section->subtheme = $template->subtheme;
			$db->updateObject($section,'section');
		}
		$prefix = '@st'.$template->id;
		$refs = $db->selectObjects('locationref',"source LIKE '$prefix%'");
		
		// Copy all modules and content for this section
		foreach ($refs as $ref) {
			$src = substr($ref->source,strlen($prefix)) . $section->id;
			
			if (call_user_func(array($ref->module,'hasContent'))) {
				$oloc = pathos_core_makeLocation($ref->module,$ref->source);
				$nloc = pathos_core_makeLocation($ref->module,$src);
				
				call_user_func(array($ref->module,'copyContent'),$oloc,$nloc);
			}
		}
		
		// Grab sub pages
		foreach ($db->selectObjects('section_template','parent='.$template->id) as $t) {
			navigationmodule::process_subsections($section,$t);
		}
		
	}
	
	function process_subsections($parent_section,$subtpl) {
		global $db;
		
		$section = null;
		$section->parent = $parent_section->id;
		$section->name = $subtpl->name;
		$section->subtheme = $subtpl->subtheme;
		$section->active = $subtpl->active;
		$section->public = $subtpl->public;
		$section->rank = $subtpl->rank;
		$section->page_title = $subtpl->page_title;
		$section->keywords = $subtpl->keywords;
		$section->description = $subtpl->description;
		
		$section->id = $db->insertObject($section,'section');
		
		navigationmodule::process_section($section,$subtpl);
	}
	
	function deleteLevel($parent) {
		global $db;
		$kids = $db->selectObjects('section','parent='.$parent);
		foreach ($kids as $kid) {
			navigationmodule::deleteLevel($kid->id);
		}
		$secrefs = $db->selectObjects('sectionref','section='.$parent);
		foreach ($secrefs as $secref) {
			$loc = pathos_core_makeLocation($secref->module,$secref->source,$secref->internal);
			pathos_core_decrementLocationReference($loc,$parent);
			
			foreach ($db->selectObjects('locationref',"module='".$secref->module."' AND source='".$secref->source."' AND internal='".$secref->internal."' AND refcount = 0") as $locref) {
				if (class_exists($locref->module)) {
					$modclass = $locref->module;
					$mod = new $modclass();
					$mod->deleteIn(pathos_core_makeLocation($locref->module,$locref->source,$locref->internal));
				}
			}
			$db->delete('locationref',"module='".$secref->module."' AND source='".$secref->source."' AND internal='".$secref->internal."' AND refcount = 0");
		}
		$db->delete('sectionref','section='.$parent);
		$db->delete('section','parent='.$parent);
	}
	
	function removeLevel($parent) {
		global $db;
		$kids = $db->selectObjects('section','parent='.$parent);
		foreach ($kids as $kid) {
			$kid->parent = -1;
			$db->updateObject($kid,'section');
			navigationmodule::removeLevel($kid->id);
		}
	}
	
	function canView($section) {
		global $db;
		if ($section->public == 0) {
			// Not a public section.  Check permissions.
			return pathos_permissions_check('view',pathos_core_makeLocation('navigationmodule','',$section->id));
		} else { // Is public.  check parents.
			if ($section->parent <= 0) {
				// Out of parents, and since we are still checking, we haven't hit a private section.
				return true;
			} else {
				$s = $db->selectObject('section','id='.$section->parent);
				return navigationmodule::canView($s);
			}
		}
	}
	
	function isPublic($section) {
		$hier = navigationmodule::getHierarchy();
		
		while (true) {
			if ($section->public == 0) {
				// Not a public section.  Check permissions.
				return false;
			} else { // Is public.  check parents.
				if ($section->parent <= 0) {
					// Out of parents, and since we are still checking, we haven't hit a private section.
					return true;
				} else {
					$section = $hier[$section->parent];
				}
			}
		}
	}
}

?>