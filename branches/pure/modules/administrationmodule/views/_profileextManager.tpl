{*
 * Copyright (c) 2004-2006 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
<div class="form_title">{$_TR.form_title}</div>
<div class="form_header">{$_TR.form_header}</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header administration_header">{$_TR.extension_name}</td>
	<td class="header administration_header">&nbsp;</td>
</tr>
{foreach name=e from=$extensions item=extension}
{math equation="x+1" x=$extension->rank assign=nextrank}
{math equation="x-1" x=$extension->rank assign=prevrank}
	<tr class="row {cycle values='odd,even'}_row">
		<td>{$extension->name}</td>
		<td>
			<a class="mngmntlink administration_mngmntlink" href="{link action=profileext_delete id=$extension->id}" onClick="return confirm('{$_TR.deactivate_confirm}');">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
			</a>
			{if $smarty.foreach.e.first != 1}
			<a class="mngmntlink administration_mngmntlink" href="{link action=profileext_order a=$extension->rank b=$prevrank}">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0" />
			</a>
			{else}
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0" />
			{/if}
			{if $smarty.foreach.e.last != 1}
			<a class="mngmntlink administration_mngmntlink" href="{link action=profileext_order a=$extension->rank b=$nextrank}">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0" />
			</a>
			{else}
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0" />
			{/if}
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="2" align="center">
			<i>{$_TR.no_active}</i>
		</td>
	</tr>
{/foreach}
</table>
<br /><br />
<hr size="1" />
<div class="form_title">{$_TR.form_title_inactive}</div>
<div class="form_header">{$_TR.form_header_inactive}</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header administration_header">{$_TR.extension_name}</td>
	<td class="header administration_header">&nbsp;</td>
</tr>
{foreach from=$unused key=extclass item=extension}
<tr class="row {cycle values='odd,even'}_row">
	<td>{$extension->name}</td>
	<td>
		<a class="mngmntlink administration_mngmntlink" href="{link action=profileext_save ext=$extclass}">{$_TR.activate}</a>
		{if $extension->hasData == 1}
		<a class="mngmntlink administration_mngmntlink" href="{link action=profileext_clear ext=$extclass}">{$_TR.clear_data}</a>
		{else}
		{/if}
	</td>
</tr>
{foreachelse}
	<tr>
		<td colspan="2" align="center">
			<i>{$_TR.no_inactive}</i>
		</td>
	</tr>
{/foreach}
</table>