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
 * $Id: Default.tpl,v 1.6 2005/03/21 17:15:48 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=edit}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}

<script language="javascript">
{literal}
function FlashInstalled()
{
	result = false;

	if (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"])
	{
		result = navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin;
	}
	else if (document.all && (navigator.appVersion.indexOf("Mac")==-1))
	{
		// IE Windows only -- check for ActiveX control, have to hide code in eval from Netscape (doesn't like try)
		eval ('try {var xObj = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");if (xObj) result = true; xObj = null;	} catch (e) {}');
	}
	//alert(result);
	return result;
}
{/literal}
</script>

{if $noupload == 1}
<div class="error">
{#i18n_operation_error#}<br />
{if $uploadError == $smarty.const.SYS_FILES_FOUNDFILE}{#i18n_operation_error1#}
{elseif $uploadError == $smarty.const.SYS_FILES_NOTWRITABLE}{#i18n_operation_error2#}
{else}{#i18n_operation_errordefault#}
{/if}
</div>
{/if}

<table cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td align='{$data->_align}'>
		{if $data->_noflash == 1}
			{#i18n_noflashfile#}
		{else}
		<script language="javascript">
			var flash_url = "{$data->_flashurl}";
			if (FlashInstalled() && flash_url != "") {ldelim}
				var temp;
				temp='<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
				temp+=' codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" ';
				temp+='  WIDTH="{$data->width}" HEIGHT="{$data->height}">';
				temp+=' <PARAM NAME="movie" VALUE="{$data->_flashurl}"> <PARAM NAME="quality" VALUE="high"> <PARAM NAME="wmode" VALUE="transparent">  '; 
				temp+=' <PARAM NAME="loop" VALUE="{if $data->loop == 1}true{else}false{/if}">';
				temp+=' <EMBED src="{$data->_flashurl}" quality="high" bgcolor="{$data->bgcolor}" loop="{if $data->loop == 1}true{else}false{/if}" ';
				temp+=' swLiveConnect="FALSE" WIDTH="{$data->width}" HEIGHT="{$data->height}"';
				temp+=' TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">';
				temp+=' </EMBED></OBJECT>';
				document.write(temp);
			 {rdelim}
			 else {ldelim}
				var temp;
				temp='<img src="{$data->_noflashurl}" width="{$data->width}" height="{$data->height}">';
				document.write(temp);
			 {rdelim}
		</script>
		{/if}
		</td>
	<tr>
</table>
