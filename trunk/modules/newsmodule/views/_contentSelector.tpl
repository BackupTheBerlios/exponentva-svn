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
 * $Id: _contentSelector.tpl,v 1.4 2005/04/07 23:20:08 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $channel->is_open}
<form method="post" action="">
<input type="hidden" name="action" value="channel_pull" />
<input type="hidden" name="module" value="common" />
<input type="hidden" name="channel_id" value="{$smarty.get.channel_id}" />
{foreach from=$news item=newsitem}{assign var=id value=$newsitem->id}
	<div>
		<div class="itemtitle news_itemtitle"><input type="checkbox" name="item[newsitem][]" value="{$newsitem->id}" {if $existing_items[$id]}disabled checked {/if}/>{$newsitem->title}</div>
		<div style="padding-left: 15px;">
		{$newsitem->body}
		</div>
	</div>
	<br /><br />
{foreachelse}
	<div style="margin-left: auto; margin-right: auto; font-style: italic;">{#i18n_noitemsfound#}</div>
{/foreach}
{if $haveNews == 1}
<input type="submit" value="{#i18n_submit#}" onClick="{literal}if (isOneSelected('item[newsitem')) return true; else { alert('You must select something.'); return false; }{/literal}" />
{/if}
</form>
{else}
This module is not currently sharing its content.
{/if}