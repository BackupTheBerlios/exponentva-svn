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
 * $Id: _confirmpolicydelete.tpl,v 1.3 2005/02/19 00:32:37 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div>
{#i18n_header#}
<br /><hr size="1" /><br />

<table cellpadding="4" cellspacing="1" width="100%" border="0">
	<tr>
		<td class="header workflow_header">{#i18n_title#}</td>
		<td class="header workflow_header">{#i18n_version#}</td>
		<td class="header workflow_header">{#i18n_module#}</td>
		<td class="header workflow_header">{#i18n_source#}</td>
	</tr>
{foreach from=$affected key=type item=posts}
{foreach from=$posts item=post}
	<tr>
		<td>{$post->title}</td>
		<td>{$post->current_major}.{$post->current_minor}</td>
		<td>{$post->module}</td>
		<td>{$post->source}</td>
	</tr>
{/foreach}
{foreachelse}
There is no content under the authority of this approval policies.  It should be safe to delete it.
{/foreach}
</table>
<br /><hr size="1" />
If you are sure you want to delete this policy, and the above unapproved content, click <a class="mngmntlink workflow_mngmntlink" href="{link action=admin_deletepolicy id=$policy->id}">here</a>.
</div>