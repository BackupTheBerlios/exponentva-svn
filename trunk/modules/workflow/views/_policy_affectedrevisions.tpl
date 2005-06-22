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
 * $Id: _policy_affectedrevisions.tpl,v 1.2 2005/02/19 00:32:38 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{#i18n_header#}<br />
<br />
<form method="post">
<input type="hidden" name="policy" value='{$newpolicy_serial}' />
<input type="hidden" name="module" value="workflow" />
<input type="hidden" name="action" value="admin_savenormalize" />
<table cellpadding="4" cellspacing="1" width="100%" border="0">
	<tr>
		<td class="header workflow_header">{#i18n_title#}</td>
		<td class="header workflow_header">{#i18n_version#}</td>
		<td class="header workflow_header">{#i18n_module#}</td>
		<td class="header workflow_header">{#i18n_source#}</td>
		<td class="header workflow_header" colspan="1"></td>
		<td class="header workflow_header" align="center">{#i18n_reevaluate#}</td>
		<td class="header workflow_header" align="center">{#i18n_restart#}</td>
	</tr>
{foreach from=$affected key=type item=posts}
{foreach from=$posts item=post}
	<tr>
		<td>{$post->title}</td>
		<td>{$post->current_major}.{$post->current_minor}</td>
		<td>{$post->module}</td>
		<td>{$post->source}</td>
		<td>
			{if $post->approvals >= $newpolicy->required_approvals}
				<span style="color: green; font-weight: bold;">{#i18n_approved#}</span>
			{else}
				{#i18n_nochange#}
			{/if}
		</td>
		<td align="center">
			<input type="radio" name="selection[{$type}][{$post->real_id}]" value="eval" {if $post->approvals < $newpolicy->required_approvals}checked{/if}/>
		</td>
		<td align="center">
			<input type="radio" name="selection[{$type}][{$post->real_id}]" value="restart" {if $post->approvals >= $newpolicy->required_approvals}checked{/if} />
		</td>
	</tr>
{/foreach}
{/foreach}
	<tr>
		<td colspan="6" align="center">
			<input type="submit" value="{#i18n_submit#}" />
		</td>
	</tr>
</table>
</form>