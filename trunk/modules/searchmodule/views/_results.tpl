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
 * $Id: _results.tpl,v 1.4 2005/02/19 00:32:36 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<b>{#i18n_formtitle#}</b>
<br />
{#i18n_youroperation#} "{' '|join:$good_terms}" {#i18n_returned#} {$num_results} {#i18n_result#}{if $num_results != 1}{#i18n_pluralsuffix#}{/if}<br />
{if $have_excluded_terms != 0}
<i>{#i18n_searchtermsignored#}: {', '|join:$excluded_terms}<br />
{/if}
{if $config->is_categorized == 0}{* not categorized, we just have a list of crap *}
{foreach from=$results item=result}
<hr size="1" />
<a href="{$result->view_link}">{$result->title}</a><br />{$result->sum}<br />
{/foreach}
{else}{* categorized, list of crap is two levels deep *}
{foreach from=$results key=category item=subresults}
	<hr size='1' />
	<hr size='1' />
	<b>{$category}</b>
	{foreach from=$subresults item=result}
		<hr size="1" />
		<a href="{$result->view_link}">{$result->title}</a><br />{$result->sum}<br />
	{/foreach}
{/foreach}
{/if}