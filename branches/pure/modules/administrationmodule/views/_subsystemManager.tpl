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
 * $Id: _subsystemManager.tpl,v 1.3 2005/11/22 01:16:04 filetreefrog Exp $
 *}
<div class="form_title">{$_TR.form_title}</div>
<div class="form_header">{$_TR.form_header}
<br /><br />
<a class="mngmntlink administration_mngmntlink" href="{link action=upload_extension}">{$_TR.upload_subsystem}</a></div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
{foreach from=$info key=subsys item=meta}
	<tr>
		<td style="background-color: lightgrey"><b>{$meta.name}</b> {$_TR.by} {$meta.author} {$_TR.version}{$meta.version}</td>
		<td style="background-color: lightgrey" align="right"><b>{$subsys}</td>
	</tr>
	<tr>
		<td colspan="3" style="padding-left: 10px; border: 1px solid lightgrey;">
			<a class="mngmntlink administration_mngmntlink" href="{link module=info action=showfiles type=$smarty.const.CORE_EXT_SUBSYSTEM name=$subsys}">
				{$_TR.view_files}
			</a>
			<hr size="1" />
			{$meta.description}
		</td>
	</tr>
	<tr><td></td></tr>
{/foreach}
</table>