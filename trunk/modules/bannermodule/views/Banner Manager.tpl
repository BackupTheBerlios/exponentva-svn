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
 * $Id: Banner\040Manager.tpl,v 1.7 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="2" cellspacing="0" width="100%" border="0">
<tr>
	<td class="header banner_header">{#i18n_banner#}</td>
	<td class="header banner_header">{#i18n_affiliate#}</td>
	<td class="header banner_header">&nbsp;</td>
</tr>
{foreach from=$banners item=banner}
{assign var=aid value=$banner->affiliate_id}
{assign var=fid value=$banner->file_id}
<tr>
	<td valign="top">
		{$banner->name}<br />
		<img class="mngmnt_icon" src="{$smarty.const.PATH_RELATIVE}{$files[$fid]->directory}/{$files[$fid]->filename}" />
	</td>
	<td valign="top">{$affiliates[$aid]}</td>
	<td valign="top">
		<a class="mngmntlink banner_mngmntlink" href="{link action=ad_edit id=$banner->id}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
		</a>
		<a class="mngmntlink banner_mngmntlink" href="{link action=ad_delete id=$banner->id}" onClick="return confirm('{#i18n_delete_confirm#} \'{$banner->name}\'');">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
		</a>
	</td>
</tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage == 1 && $noupload != 1}
<a class="mngmntlink banner_mngmntlink" href="{link action=ad_edit}">{#i18n_create#}</a>
{/if}
{/permissions}

{if $noupload == 1}
<div class="error">
{#i18n_operation_error#}<br />
{if $uploadError == $smarty.const.SYS_FILES_FOUNDFILE}{#i18n_operation_error1#}
{elseif $uploadError == $smarty.const.SYS_FILES_NOTWRITABLE}{#i18n_operation_error2#}
{else}{#i18n_operation_errordefault#}
{/if}
</div>
{/if}
