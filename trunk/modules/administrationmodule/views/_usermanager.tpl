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
 * $Id: _usermanager.tpl,v 1.9 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">Manage User Accounts</div>
<div class="form_header">From here, you can create, modify and remove normal user accounts.  You will not be able to create, modify or remove administrator accounts (these options will be disabled).
<br /><br />
{if $smarty.const.SITE_ALLOW_REGISTRATION == 0}
<i>Note: Since user registration has been disallowed in the global site configuration, this is the only way to create new user accounts.</i>
<br /><br />
{/if}
To create a new user account, use the <a class="mngmntlink administration_mngmntlink" href="{link action=umgr_editprofile id=0}">New User Account</a> form.
</div>
 
 {paginate objects=$users paginateName="useradmin" modulePrefix="administration" rowsPerPage=20}{literal}
	function links(object) {
		var out = '';
		if (object.var_is_admin == 0) {
		{/literal}
			out = '<a class="mngmntlink administration_mngmntlink" href="'+makeLink('module','administrationmodule','action','umgr_edit','id',object.var_id) +'"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>'+
			  '<a class="mngmntlink administration_mngmntlink" href="'+makeLink('module','administrationmodule','action','umgr_delete','id',object.var_id) +'" onClick="return confirm(\'Are you sure you want to delete the user \\\'' + object.var_firstname + ' ' + object.var_lastname + ' ('+object.var_username+')\\\'?\');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>';
			if (object.var_is_locked == 1) {ldelim}
			   out += '<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}lock.png" />';
			{rdelim}
		{literal}
		} else {
		{/literal}
			out = '<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" />' +
				'<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" />';
		{literal}
		}
		return out;
	}

	function realName(object) {
		return object.var_firstname + ' ' + object.var_lastname;
	}
	
	function sortRealname(a,b) {
		return (a.var_firstname.toLowerCase() + ", " + a.var_lastname.toLowerCase() > b.var_firstname.toLowerCase() + ", " + b.var_lastname.toLowerCase() ? -1 : 1);
	}
	
	
	paginate.columns = new Array(
		new cColumn("Real Name","",realName,sortRealname),
		new cColumn("Username","username",null,null),
		new cColumn("Email","email",null,null),
		new cColumn("","",links,null)
	);

	function hideAdmins(object) {
		if (object.var_is_admin == 0) return true;
		else return false;
	}
	
	function hideNullEmails(object) {
		if (object.var_email.length == 0) return false;
		else return true;
	}
	
	paginate.filters = new Array(
		new cFilter("Hide Administrators",hideAdmins),
		new cFilter("Hide Empty Emails",hideNullEmails)
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
<hr size="1" />
<div style="font-weight: bold">Filtering</div>
<script language="JavaScript">
	document.write( paginate.drawFilterForm());
	paginate.drawTable();
</script>
