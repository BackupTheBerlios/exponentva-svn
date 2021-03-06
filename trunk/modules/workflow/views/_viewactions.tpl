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
 * $Id: _viewactions.tpl,v 1.4 2005/02/19 00:32:38 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">
{#i18n_header#}
</div>
<table cellpadding="0" cellspacing="4" width="100%" border="0">
{foreach from=$names item=name key=type}
{capture assign=linkend}&policy_id={$policy_id}&type={$type}{/capture}
<tr><td><br /><br /></td></tr>
<tr>
	<td colspan="4" style="border-top: 1px dashed lightgrey;">
		<h3>{$name}</h3>
	</td>
</tr>
{foreach name=a from=$actions[$type] item=action}
{math equation="x-2" x=$smarty.foreach.a.iteration assign=prev}
{math equation="x-1" x=$smarty.foreach.a.iteration assign=this}
{assign var=next value=$smarty.foreach.a.iteration}
{* Assign linkend *}
<tr>
	<td>
		{$action->method}
	</td>
	<td align="right">
		<a class="mngmntlink workflow_mngmntlink" href="{link action=action_edit id=$action->id}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"/>
		</a>
		<a class="mngmntlink workflow_mngmntlink" href="{link action=action_delete id=$action->id}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"/>
		</a>
	</td>
	<td width="16">
		<a class="mngmntlink workflow_mngmntlink" href="{link action=action_switch a=$this b=$prev policy_id=$policy_id type=$type}">
			{if $smarty.foreach.a.first == 0}
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0"/>
			{/if}
		</a>
	</td><td width="16">
		<a class="mngmntlink workflow_mngmntlink" href="{link action=action_switch a=$next b=$this policy_id=$policy_id type=$type}">
			{if $smarty.foreach.a.last == 0}
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0"/>
			{/if}
		</a>
	</td>
</tr>
{foreachelse}
<tr>
	<td colspan="4" align="center">
		<i>{#i18n_noitemsfound#}</i><br />
	</td>
</tr>
{/foreach}
<tr>
	<td colspan="4" align="center">
		<a class="mngmntlink workflow_mngmntlink" href="{link action=action_edit policy_id=$policy_id type=$type}">{#i18n_create#}</a>
	</td>
</tr>
{/foreach}
</table>