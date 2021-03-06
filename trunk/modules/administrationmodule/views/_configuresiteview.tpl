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
 * $Id: _configuresiteview.tpl,v 1.2 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">
{#i18n_header#}
</div>
{$form_html}
{if $smarty.const.CURRENTCONFIGNAME == $configname}
	[ Activate ]
	[Delete]
{else}
	{if $canactivate == 1}
	[ <a class="mngmntlink administration_mngmntlink" href="{link action=run m=administrationmodule a=config_activate configname=$configname}">Activate</a> ]
	{elseif $configname != ""}
		<i>(You cannot activate this profile - the active configuration file is unwritable.)</i><br />
	{/if}
	{if $candelete == 1}
		[ <a class="mngmntlink administration_mngmntlink" href="{link action=run m=administrationmodule action=config_delete configname=$configname}">{#i18n_delete#}</a> ]
	{elseif $configname != ""}
		<i>(You cannot delete this profile - the profile configuration file is unwritable.)</i><br />
	{/if}
{/if}
{if $canedit == 1}
	[ <a class="mngmntlink administration_mngmntlink" href="{link action=run m=administrationmodule action=config_configuresite configname=$configname}">{#i18n_edit#}</a> ]
{elseif $configname != ""}
	<i>(You cannot edit or delete this profile - the profile's configuration file is unwritable.)</i>
{/if}
<table cellpadding="4" cellspacing="0" border="0" width="100%">
{foreach from=$configuration key=category item=opts}
	<tr><td colspan="2"><hr size='1' /><h3>{$category}</h3></td></tr>
	{foreach from=$opts key=directive item=option}
	<tr>
		<td>{$option.title}</td>
		<td>{$option.value}</td>
	</tr>
	{/foreach}
{/foreach}
</table>