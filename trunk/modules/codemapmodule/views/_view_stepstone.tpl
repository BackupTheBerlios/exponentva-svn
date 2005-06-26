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
 * $Id: _view_stepstone.tpl,v 1.4 2005/02/23 23:51:34 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<b>{$stepstone->name}</b>

{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage_steps == 1}
<br />
<a href="{link action=stepstone_edit id=$stepstone->id}" class="mngmntlink codemap_mngmntlink">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"/>
</a>
<a href="{link action=stepstone_delete id=$stepstone->id}" class="mngmntlink codemap_mngmntlink">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"/>
</a>
{/if}
{/permissions}

<table cellpadding="2" cellspacing="0" border="1" rules="all">
<tr>
	<td>Developer</td>
	<td>
		{if $stepstone->developer == ""}
			{#i18n_noitemsfound#}
			{if $stepstone->contact != ""}<a href="{link action=contact id=$stepstone->id}">{#i18n_volunteer#}</a>{/if}
		{else}
			{if $stepstone->contact != ""}<a href="{link action=contact id=$stepstone->id}">{$stepstone->developer}</a>
			{else}{$stepstone->developer}
			{/if}	
		{/if}
	</td>
</tr>
<tr>
	<td>{#i18n_targetmilestone#}</td>
	<td><a class="mngmntlink codemap_mngmntlink" href="{link action=milestone_view id=$stepstone->milestone_id}">
	{$stepstone->milestone->name}
	</a></td>
</tr>
<tr>
	<td>{#i18n_status#}</td>
	<td>{if $stepstone->status == 0}{#i18n_notcomplete#}{elseif $stepstone->status == 1}{#i18n_inprogress#}{else}{#i18n_complete#}{/if}</td>
</tr>
</table>

<hr size='1' />
{$stepstone->description|nl2br}
<hr size='1' />