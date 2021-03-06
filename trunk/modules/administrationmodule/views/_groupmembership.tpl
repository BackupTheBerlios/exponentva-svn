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
 * $Id: _groupmembership.tpl,v 1.4 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}  '{$group->name}'</div>


{paginate objects=$users}
	{literal}
	
	function serializeData() {
		elem = document.getElementById("membdata");
		arr = new Array();
		for (i = 0; i < paginate.allData.length; i++) {
			if (paginate.allData[i].var_is_member == 1) {
				str = paginate.allData[i].var_id;
				if (paginate.allData[i].var_is_admin == 1) {
					str += ':1';
				} else {
					str += ':0';
				}
				arr.push(str);
			}
		}
		elem.value = arr.join(",");
	}
	
	function makeMember(id,checked) {
		paginate.allData[id].var_is_member = (checked ? 1 : 0);
		if (!checked && paginate.allData[id].var_is_admin == 1) {
			makeAdmin(id,false);
			paginate.drawTable();
		}
	}
	
	function makeAdmin(id,checked) {
		paginate.allData[id].var_is_admin = (checked ? 1 : 0);
		if (checked && paginate.allData[id].var_is_member == 0) {
			makeMember(id,true);
			paginate.drawTable();
		}
	}
	
	function changeAll(checked) {
		for (i = 0; i < paginate.allData.length; i++) {
			{/literal}
			{if $perm_level != 2}
			if (paginate.allData[i].var_is_admin == 1) continue;
			{/if}
			{literal}
			paginate.allData[i].var_is_member = ( checked ? 1 : 0 );
		}
		paginate.drawTable();
	}
	
	function isMember(object) {
		html = '<input type="checkbox" ';
		if (object.var_is_member == 1) {
			html += 'checked ';
		}
		{/literal}
		{if $perm_level != 2}
		if (object.var_is_admin == 1) html += 'disabled ';
		{/if}
		{literal}
		
		html += 'onClick="makeMember('+object.__ID+',this.checked)" />';
		return html;
	}
	
	function isAdmin(object) {
		html = '<input type="checkbox" ';
		if (object.var_is_admin == 1) {
			html += 'checked ';
		}
		{/literal}
		{if $perm_level != 2}
		html += 'disabled ';
		{/if}
		{literal}
		html += 'onClick="makeAdmin('+object.__ID+',this.checked)" />';
		return html;
	}
	
	function sortMember(a,b) {
		return (a.var_is_member > b.var_is_member ? -1 : 1);
	}
	
	function sortAdmin(a,b) {
		return (a.var_is_admin > b.var_is_admin ? -1 : 1);
	}
{/literal}	
	paginate.columns = new Array(
		new cColumn("{#i18n_username#}","username",null,null),
		new cColumn("{#i18n_member#}?","",isMember,sortMember),
		new cColumn("Group Admin","",isAdmin,sortAdmin)
	);
	
	
{/paginate}

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
<br />
<form method="post">
<input type="hidden" name="module" value="administrationmodule" />
<input type="hidden" name="action" value="gmgr_savemembers" />
<input type="hidden" name="id" value="{$group->id}"/>
<input type="hidden" id="membdata" name="membdata" value="" />
<input type="submit" value="{#i18n_submit#}" onClick="serializeData(); return true;" />
<input type="button" value="{#i18n_cancel#}" onClick="document.location.href = '{$__redirect}';" />
</form>
<br />

<a class="mngmntlink administration_mngmntlink" href="#" onClick="changeAll(true); return false;">{#i18n_selectall#}</a>
&nbsp;&nbsp;|&nbsp;&nbsp;
<a class="mngmntlink administration_mngmntlink" href="#" onClick="changeAll(false); return false;">{#i18n_unselectall#}</a>
