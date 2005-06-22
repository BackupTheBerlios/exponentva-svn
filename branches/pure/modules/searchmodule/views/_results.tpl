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
 *}
<b>Search Results</b>
<br />
Your search for "{' '|join:$good_terms}" returned {$num_results} result{if $num_results != 1}s{/if}<br />
{if $have_excluded_terms != 0}
<i>The following search terms were ignored: {', '|join:$excluded_terms}<br />
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