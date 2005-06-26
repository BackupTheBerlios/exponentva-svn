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
 * $Id: _groupmanager.tpl,v 1.5 2005/03/20 17:57:52 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}
<br /><br />
To create a new group, use the <a class="mngmntlink administration_mngmntlink" href="{link action=gmgr_editprofile id=0}">New Group Account</a> form.
{/if}
</div>
{paginate name="groups" objects=$groups modulePrefix="administration" rowsPerPage=20}{literal}

	paginate.noRecords = "No groups exist.";

	function links(object) {
		var out = '';
		{/literal}
			{if $perm_level == 2}
			// Edit link
			out += '<a class="mngmntlink administration_mngmntlink" href="'+makeLink('module','administrationmodule','action','gmgr_editprofile','id',object.var_id) +'"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>';
			// Delete link
			out += '<a class="mngmntlink administration_mngmntlink" href="'+makeLink('module','administrationmodule','action','gmgr_delete','id',object.var_id) +'" onClick="return confirm(\'Are you sure you want to delete the group \\\'' + object.var_name + '\\\'?\');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>';
			{/if}
			// Members link
			out += '<a class="mngmntlink administration_mngmntlink" href="'+makeLink('module','administrationmodule','action','gmgr_membership','id',object.var_id) +'">Members</a>';
		{literal}
		return out;
	}
	
	function type(object) {
		if (object.var_inclusive == 1) return '<b>Default</b>';
		else return 'Normal';
	}
	
	function sortType(a,b) {
		return (a.var_inclusive > b.var_inclusive ? -1 : 1);
	}

	paginate.columns = new Array(
		new cColumn("Group Name","name",null,null),
		new cColumn("Signup Code","code",null,null),
		new cColumn("Type","",type,sortType),
		new cColumn("","",links,null)
	);
{/literal}{/paginate}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tbody id="dataTable">
	
	</tbody>
</table>
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
