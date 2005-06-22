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
 * $Id: Default.tpl,v 1.6 2005/05/05 19:14:02 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>&nbsp;
	<a class="poermlink" href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstoitem_desc#}" alt="{#i18n_assigngrouppermissionstoitem_desc#}" /></a>
	<br />
{/if}
{/permissions}
{if $moduletitle != ""}<div class="moduletitle text_moduletitle">{$moduletitle}</div>{/if}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.edit == 1}
	{if $textitem->approved != 1}
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" border="0" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />&nbsp;
	{else}
		<a class="mngmntlink text_mngmntlink" href="{link action=edit id=$textitem->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>
	{/if}
{/if}
{if $textitem->approved != 1 && ($permissions.approve == 1 || $permissions.manage_approval == 1 || $permissions.edit == 1)}
<a class="mngmntlink news_mngmntlink" href="{link module=workflow datatype=textitem m=textmodule s=$__loc->src action=summary}">{#i18n_viewapprovals#}</a>
{/if}
{if $permissions.manage_approval == 1 && ($textitem->id != 0 && $textitem->approved != 0)}
	&nbsp;&nbsp;&nbsp;<a class="mngmntlink text_mngmntlink" href="{link module=workflow datatype=textitem m=textmodule s=$__loc->src action=revisions_view id=$textitem->id}">
		{#i18n_revisions#}
	</a>
{/if}
{/permissions}
<div>
{if $textitem->approved != 0}
	{$textitem->text}
{/if}
</div>