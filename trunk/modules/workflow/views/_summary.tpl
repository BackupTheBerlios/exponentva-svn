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
 * $Id: _summary.tpl,v 1.6 2005/02/19 00:32:38 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="4" cellspacing="0" border="0" width="100%">
{foreach from=$summaries item=summary}
{assign var=posterid value=$summary->state_data[0][0]}
	<tr>
		<td style="background-color: lightgrey">
			{$summary->real->title} v{$summary->current_major}.{$summary->current_minor}
			{if $permissions.manage_approval == 1}
			<a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype action=delete id=$summary->real_id major=$summary->current_major}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"/></a>
			{/if}
		</td>
		<td style="background-color: lightgrey" align="right">
			{if $summary->open_slots <= 0}{#i18n_closed#}{else}{#i18n_open#} ({$summary->open_slots} {#i18n_moreapprover#}{if $summary->open_slots > 1}{#i18n_pluralsuffix#}{/if}){/if}
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 35px;padding-right: 35px; border: 1px solid lightgrey">
			{#i18n_updated#}: {$summary->updated|format_date:$smarty.const.DISPLAY_DATE_FORMAT}
			<br />
			{#i18n_policy#}: <b>{$summary->policy->name}</b>
			<div class="workflow_comment">{#i18n_comment#}: <i>{$summary->revision->wf_comment}</i></div>
			<table width="100%" style="border-top: 1px dashed lightgrey; margin-top: 7px;">
				{assign var=involved value=0}
				{foreach from=$summary->involved item=person}
					{assign var=personid value=$person->id}
					<tr>
						<td style="padding-left: 20px; border-right: 1px dashed lightgrey;">{if $posterid == $personid}Poster:{else}{#i18n_approver#}:{/if}</td>
						<td style="padding-left: 20px; border-right: 1px dashed lightgrey;">{$summary->involved[$personid]->username}</td>
						<td style="padding-left: 20px;">{if $summary->state_data[1][$personid] == 1}{#i18n_approved#}{else}{#i18n_notapproved#}{/if}</td>
						<td>
						{if $personid == $user->id}
							{assign var=involved value=1}
							<a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype  action=preview_content id=$summary->real_id}">{#i18n_editapproval#}</a>
						{/if}
						</td>
					</tr>
				{/foreach}
				{if ($summary->open_slots > 0 and $involved == 0 and $permissions.approve == 1) || ($summary->open_slots <= 0 && $user->is_acting_admin)}
				<tr>
					<td colspan="3" align="center" style="border-top: 1px dashed lightgrey;">
						<a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype  action=preview_content id=$summary->real_id}">{#i18n_becomeapprover#}</a>
					</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
	
	<tr><td></td></tr>
{foreachelse}
	<tr><td>
	<i>{#i18n_noitemsfound#}</i>
	</td></tr>
{/foreach}
</table>