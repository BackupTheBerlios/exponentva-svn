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
<table cellpadding="2" cellspacing="0" width="100%" border="0">
<tr>
	<td class="Header administration_header">Table Name</td>
	<td class="Header administration_header">Status</td>
</tr>
{foreach from=$status key=table item=statusnum}
<tr class="row {cycle values='odd,even'}_row"><td>
{$table}
</td><td>
{if $statusnum == $smarty.const.TMP_TABLE_EXISTED}
<div style="color: blue; font-weight: bold">{$_TR.table_exists}</div>
{elseif $statusnum == $smarty.const.TMP_TABLE_INSTALLED}
<div style="color: green; font-weight: bold">{$_TR.succeeded}</div>
{elseif $statusnum == $smarty.const.TMP_TABLE_FAILED}
<div style="color: red; font-weight: bold">{$_TR.failed}</div>
{elseif $statusnum == $smarty.const.TMP_TABLE_ALTERED}
<div style="color: green; font-weight: bold">{$_TR.altered_existing}</div>
{/if}
</td></tr>
{/foreach}
</table>