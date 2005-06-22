{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * Exponent is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR
 * PURPOSE.  See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU
 * General Public License along with Exponent; if
 * not, write to:
 *
 * Free Software Foundation, Inc.,
 * 59 Temple Place,
 * Suite 330,
 * Boston, MA 02111-1307  USA
 *
 * $Id: Default.tpl,v 1.4 2005/02/24 20:14:35 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $moduletitle != ""}<div class="moduletitle imagegallery_moduletitle">{$moduletitle}</div>{/if}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{/permissions}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{foreach from=$galleries item=gallery}
	<div>
		<div class="imagegallery_itemtitle"><a href="{link action=view_gallery id=$gallery->id}">{$gallery->name}</a><br />
			{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.edit == 1}
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=edit_gallery id=$gallery->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
					</a>
				{/if}
				{if $permissions.delete == 1}
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=delete_gallery id=$gallery->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
					</a>
				{/if}
			{/permissions}
		</div>
		<div style="padding-left: 50px; padding-right: 50px;">{$gallery->description}</div>
	</div>
{foreachelse}
<div align="center"><i>{#i18n_noitemsfound#}</i></div>
{/foreach}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create == 1}
	<a class="mngmntlink imagegallery_mngmntlink" href="{link action=edit_gallery}">
		New Gallery
	</a>
{/if}
{/permissions}