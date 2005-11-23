{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
 * All Changes as of 6/1/05 Copyright 2005 James Hunt
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
 * $Id: _usercsv_display_users.tpl,v 1.4 2005/11/22 01:16:09 filetreefrog Exp $
 *}
<div class="form_title">{$_TR.form_title}</div>
<div class="form_header">{$_TR.form_header}</div>
<table cellspacing="0" cellpadding="2" border="0" width="100%">
	<tr>
		<td class="header importer_header">{$_TR.status}</td>
		<td class="header importer_header">{$_TR.user_id}</td>
		<td class="header importer_header">{$_TR.username}</td>
		<td class="header importer_header">{$_TR.password}</td>
		<td class="header importer_header">{$_TR.first_name}</td>
		<td class="header importer_header">{$_TR.last_name}</td>
		<td class="header importer_header">{$_TR.email}</td>
	</tr>
{foreach from=$userarray item=user}
<tr class="row {cycle values=even_row,odd_row}">
	<td style="background-color:inherit;">
		{if $user->changed == 1}<span style="color:green;">{$_TR.changed}</span>
		{elseif $user->changed == "skipped"}<span style="color:red;">{$_TR.skipped|sprintf:$user->linenum})</span>
		{else}<span style="color:black;">{$_TR.success}</span>
		{/if}
	</td>
	<td>{$user->id}</td>
	<td>{$user->username}</td>
	<td>{$user->clearpassword}</td>
	<td>{$user->firstname}</td>
	<td>{$user->lastname}</td>
	<td>{$user->email}</td>
</tr>
{/foreach}
</table>
