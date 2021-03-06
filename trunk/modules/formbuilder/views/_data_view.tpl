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
 * $Id: _data_view.tpl,v 1.5 2005/02/19 00:32:32 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{paginate objects=$items paginateName="dataView" modulePrefix="data" rowsPerPage=20}

function links(object) {literal}{{/literal}
	out = '<a href="{link action=view_record module=formbuilder}&id=' + object.var_id + '&form_id={$f->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}view.png" /></a>'; 
	out += '{if $permissions.editdata == 1}<a href="{link action=edit_record module=formbuilder}&id=' + object.var_id + '&form_id={$f->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>{/if}'; 
	out += '{if $permissions.deletedata == 1}<a href="{link action=delete_record module=formbuilder}&id=' + object.var_id + '&form_id={$f->id}" onClick="return confirm(\'Are you sure you want to delete this record?\');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>{/if}'; 
	
	return out;
{literal}}{/literal}


{$sortfuncs}


{$columdef}

{/paginate}
<table cellspacing="0" cellpadding="2" border="0" width="100%">
	<tbody id="dataTable">
	</tbody>
</table>
<br>
<table width="100%">
<tr><td align="left" valign="bottom">
<script language="JavaScript">document.write(paginate.drawPageStats(""));</script>
</td><td align="right" valign="bottom">
<script language="Javascript">document.write(paginate.drawPageTextPicker(3));</script>
</td></tr>
</table>
<script language="JavaScript">
	paginate.drawTable();
</script>
<a href="{$backlink}">Back</a>