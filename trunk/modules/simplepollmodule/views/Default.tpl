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
 * $Id: Default.tpl,v 1.1 2005/04/10 23:24:02 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}

{if $moduletitle != ''}<div class="moduletitle">{$moduletitle}</div>{/if}

{if $have_answers != 0}
<form method="post">
	<input type="hidden" name="module" value="simplepollmodule" />
	<input type="hidden" name="action" value="vote" />
	<b>{$question->question}</b><br />
	{foreach from=$answers item=answer}
	<input type="radio" name="choice" value="{$answer->id}" />{$answer->answer}<br />
	{/foreach}
	
	{if $question->open_voting}
	<input type="submit" value="{#i18n_submit#}" />
	{else}
	{#i18n_votingclosed_info#}<br />
	<input type="submit" value="{#i18n_submit#}" disabled="disabled" />
	{/if}
	<br />
	{if $question->open_results}
	<a href="{link action=results id=$question->id}">{#i18n_results#}</a>
	{/if}
</form>
{/if}

{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage_question == 1 || $permissions.manage_answer == 1}
<a href="{link action=manage_questions}">{#i18n_manage#}</a>
{/if}
{/permissions}