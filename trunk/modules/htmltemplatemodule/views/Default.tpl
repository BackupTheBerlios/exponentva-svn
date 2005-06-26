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
 * $Id: Default.tpl,v 1.6 2005/02/19 00:32:32 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
	<br />
{/if}
{/permissions}
{if $moduletitle != ""}<div class="moduletitle htmltemplate_moduletitle">{$moduletitle}</div>{/if}
{if $noupload == 1}
<div class="error">
{#i18n_operation_error#}<br />
{if $uploadError == $smarty.const.SYS_FILES_FOUNDFILE}{#i18n_operation_error1#}
{elseif $uploadError == $smarty.const.SYS_FILES_NOTWRITABLE}{#i18n_operation_error2#}
{else}{#i18n_operation_errordefault#}
{/if}
</div>
<br />
{else}
{#i18n_operation_success#}<br />
{/if}
{* Association manager currently not properly working
<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=manage_assocs}">{#i18n_association#} {#i18n_manager#}</a>
*}
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td class="header htmltemplate_header">{#i18n_name#}</td>
	<td class="header htmltemplate_header">&nbsp;</td>
</tr>
{foreach from=$templates item=t}
<tr>
	<td>
		<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=view id=$t->id}">
			{$t->title}
		</a>
	</td>
	<td>
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.edit == 1}
		<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=edit id=$t->id}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
		</a>
		{/if}
		{if $permissions.delete == 1}
		<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=delete id=$t->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
		</a>
		{/if}
		{/permissions}
	</td>
</tr>
{foreachelse}
<tr>
	<td align="center"><i>{#i18n_noitemsfound#}</i></td>
</tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create == 1}
<hr size="1" />
<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=edit}">{#i18n_create#}</a>
&nbsp;&nbsp;
<a class="mngmntlink htmltemplate_mngmntlink" href="{link action=upload}">{#i18n_upload#}</a>
<br />
{/if}
{/permissions}
