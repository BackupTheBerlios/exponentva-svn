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
 * $Id: _view_form.tpl,v 1.4 2005/11/22 01:16:07 filetreefrog Exp $
 *}
 
 <div align="center"><center><b>{$_TR.form_title}</b><br>{$_TR.form_header}</center></div>
 <div style="border: 2px dashed lightgrey; padding: 1em;">
{$form_html}
</div>
<script language="JavaScript">
	function pickSource() {ldelim}
		window.open('{$pickerurl}','sourcePicker','title=no,toolbar=no,width=640,height=480,scrollbars=yes');
	 {rdelim}
</script>

<table cellpadding="5" cellspacing="0" border="0">
<tr>
<td>
	<form method="post" action="?">
	<input type="hidden" name="module" value="formbuilder" />
	<input type="hidden" name="action" value="edit_control" />
	<input type="hidden" name="form_id" value="{$form->id}" />
	{$_TR.add_a} <select name="control_type" onChange="this.form.submit()">
	{foreach from=$types key=value item=caption}
		<option value="{$value}">{$caption}</option>
	{/foreach}
	</select>
	</form>
</td>
<td>
	<a href="{$backlink}">{$_TR.done}</a>
</td>
<td>
	<a href="JavaScript: pickSource();">{$_TR.append_existing}</a>
</td>
</tr>
</table>