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
 * $Id: _cat_viewCategories.tpl,v 1.4 2005/02/19 00:32:30 filetreefrog Exp $
 *}
<div class="form_title">Event Categories</div>
<table cellspacing="0" cellpadding="2" border="0">
{foreach from=$categories item=category}
	<td>{$category->name}</td>
	<td>
		<div style="width: 32px; height: 16px; background-color: {$category->color}">&nbsp;</div>
	</td>
</tr>
{foreachelse}
<tr>
	<td colspan="2" align="center"><i>No Categories</i></td>
</tr>
{/foreach}
</table>