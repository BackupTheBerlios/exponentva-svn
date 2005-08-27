{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc., Maxim Mueller
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
 * $Id: Mini_Calendar.tpl,v 1.6 2005/02/19 00:32:30 filetreefrog Exp $
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
		<a href="{link action=configure _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}" /></a>
	{/if}
{/permissions}
<style type="text/css">
	@import url("{$smarty.const.PATH_RELATIVE}modules/{$__loc->mod}/css/{$__view}.css");
	@import url("{$smarty.const.THEME_RELATIVE}modules/{$__loc->mod}/css/{$__view}.css");
</style>

<div class="calendar_Mini_Calendar" id='jscalendar{$__loc->src|replace:"@":"_"}'>
	<div class="Mini_Calendar_header">{if $moduletitle != ""}{$moduletitle} {/if}{$now|format_date:"%B,%Y"}</div>
	<script type="text/javascript">
		pathosJSIncludeOnce("jscalendar1", "{$smarty.const.PATH_RELATIVE}external/jscalendar/calendar.js");
		pathosJSIncludeOnce("jscalendar2", "{$smarty.const.PATH_RELATIVE}external/jscalendar/lang/calendar-{$smarty.const.LANG}.js");
		pathosJSIncludeOnce("jscalendar3", "{$smarty.const.PATH_RELATIVE}external/jscalendar/calendar-setup.js");
			
	{literal}	
		//callback from jscalendar
		function markEvents{/literal}{$__loc->src|replace:"@":"_"}{literal}(date, y, m, d) {
			datesWithEvents = new Array();
			datesWithEvents.push({/literal}{$datesWithEvents}{literal});
			
			hasEvents = false;
			
			for (var currIndex in datesWithEvents) {
				if (d == datesWithEvents[currIndex] ){
					hasEvents = true;
					break;
				};
			};
			
			if (hasEvents == true ){
				//this is the name of the css class that is assigned to that day
				return "hasEvents";
			} else {
				//do nothing, setting this to true disables the date
				return false;
			};
			
		};
	
		//callback from jscalendar
		function dateChanged{/literal}{$__loc->src|replace:"@":"_"}{literal}(calendar) {
			// Beware that this function is called even if the end-user only
			// changed the month/year.  In order to determine if a date was
			// clicked you can use the dateClicked property of the calendar:
			if (calendar.dateClicked) {
				// OK, a date was clicked, redirect to /yyyy/mm/dd/index.php
				var y = calendar.date.getFullYear();
				var m = calendar.date.getMonth();     // integer, 0..11
				// i don't know why i have to add 1 to d instead of m, but it works
				var d = calendar.date.getDate() + 1;      // integer, 1..31
	
				oDate = new Date(y,m,d);
				nDate = Math.round(oDate.getTime() / 1000); // Date operates in ms, whereas php mktime is in seconds
				
				// redirect...
				//TODO: Investigate SSL/NONSSL connections, make this call a complete replacement of the "link" smarty plugin
				//TODO: look into pathos.js.php's makeLink()
				window.location.href = "{/literal}{$smarty.const.SCRIPT_RELATIVE}{$smarty.const.SCRIPT_FILENAME}?time=" + nDate + "&action=viewday&module={$__loc->mod}&src={$__loc->src}"{literal};
			};
		};
	
		pathosJSregister(initMini_Calendar{/literal}{$__loc->src|replace:"@":"_"}{literal});
		
		function initMini_Calendar{/literal}{$__loc->src|replace:"@":"_"}{literal} (){
			Calendar.setup({
				{/literal}
					flat			: 'jscalendar{$__loc->src|replace:"@":"_"}', // unique ID of the calendars parent
					firstDay		: {$smarty.const.DISPLAY_WEEKS_STARTON},
					date			: new Date(),
					weekNumbers		: false,
					flatCallback	: dateChanged{$__loc->src|replace:"@":"_"},			// our callback function
					dateStatusFunc	: markEvents{$__loc->src|replace:"@":"_"}				// our callback function
				{literal}
			});
		};
	{/literal}
	</script>
	
</div>
<div class="calendar_Mini_Calendar">
	<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth}" title="{#i18n_viewmonthof#} {$now|format_date:"%B"}" alt="{#i18n_viewmonthof#} {$now|format_date:"%B"}">{#i18n_viewmonth#}</a>
	<br />
	{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.post == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link action=edit}" title="{#i18n_create_desc#}" alt="{#i18n_create_desc#}">{#i18n_create#}</a><br />
		{/if}
		{if $in_approval != 0 && $canview_approval_link == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=summary}" title="{#i18n_viewapprovals_desc#}" alt="{#i18n_viewapprovals_desc#}">{#i18n_viewapprovals#}</a><br />
		{/if}
	{/permissions}
	<br />
	
	{if $modconfig->enable_categories == 1}
		<a href="{link module=categories m=calendarmodule action=manage}" class="mngmntlink calendar_mngmntlink">{#i18n_managecategories#}</a>
	{/if}
</div>