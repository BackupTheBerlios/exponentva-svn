<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc., Maxim Müller
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: calendarmodule.php,v 1.9 2005/02/19 00:35:12 filetreefrog Exp $
# $Id: calendarmodule.php,v 2.0 2005/05/14 20:11:00 MaxxCorp Exp $
##################################################

// I18N strings for the Calendar Module

define('TR_CALENDARMODULE_TITLE',				'Titel');
define('TR_CALENDARMODULE_BODY',				'Body');
define('TR_CALENDARMODULE_EVENTDATE',			'Datum');
define('TR_CALENDARMODULE_ISALLDAY',			'Ganztägiger Termin');
define('TR_CALENDARMODULE_EVENTSTART',			'Beginn');
define('TR_CALENDARMODULE_EVENTEND',			'Ende');
define('TR_CALENDARMODULE_RECURRENCE',			'Wiederholung');

define('TR_CALENDARMODULE_CATEGORIES',			'Kategorie');
define('TR_CALENDARMODULE_NOFEEDBACK',			'Feedback deaktivieren');
define('TR_CALENDARMODULE_FEEDBACKFORM',		'Feedback Formular');
define('TR_CALENDARMODULE_FEEDBACKEMAIL',		'Feedback Email');

define('TR_CALENDARMODULE_ENABLECATEGORIES',	'Kategorien aktivieren?');
define('TR_CALENDARMODULE_ENABLEFEEDBACK',		'Feedback aktivieren?');

define('TR_CALENDARMODULE_RECURRENCEWARNING',	'Dieser Termin wiederholt sich and den untenstehenden Tagen.  Bitte wählen Sie die Tage aus auf die Sich Ihre Änderungen beziehen.');

// Permissions
define('TR_CALENDARMODULE_PERM_ADMIN',			'Administrieren');
define('TR_CALENDARMODULE_PERM_CONFIG',			'Konfigurieren');
define('TR_CALENDARMODULE_PERM_POST',			'Erstellen');
define('TR_CALENDARMODULE_PERM_EDIT',			'Bearbeiten');
define('TR_CALENDARMODULE_PERM_DELETE',			'Löschen');
define('TR_CALENDARMODULE_PERM_APPROVE',		'Prüfen');
define('TR_CALENDARMODULE_PERM_MANAGEAP',		'Prüfung verwalten');

define('TR_CALENDARMODULE_PERM_EDITONE',		TR_CALENDARMODULE_PERM_EDIT);
define('TR_CALENDARMODULE_PERM_DELETEONE',		TR_CALENDARMODULE_PERM_DELETE);

define('TR_CALENDARMODULE_RECURMOVEWARNING',	'Warnung: Wenn Sie den unten stehenden Termin bearbeiten, so wird sich diese Änderung nur auf Diesen auswirken.  Alle anderen Änderungen konnen sowohl auf diesen als auch auf andere Termine angewendet werden.');

//view constants definitions
//Default.tpl

define('TR_CALENDARMODULE_LISTVIEW',			'als Liste');
define('TR_CALENDARMODULE_CALENDARVIEW',		'als Kalender');

define('TR_CALENDARMODULE_SUNDAY',				'Sonntag');
define('TR_CALENDARMODULE_MONDAY',				'Montag');
define('TR_CALENDARMODULE_TUESDAY',				'Dienstag');
define('TR_CALENDARMODULE_WENDSDAY',			'Mittwoch');
define('TR_CALENDARMODULE_THURSDAY',			'Donnerstag');
define('TR_CALENDARMODULE_FRIDAY',				'Freitag');
define('TR_CALENDARMODULE_SATURDAY',			'Sonnabend');
//difficult to auto-generate for e.g. asian languages
define('TR_CALENDARMODULE_SUNDAYSHORT',			'S');
define('TR_CALENDARMODULE_MONDAYSHORT',			'M');
define('TR_CALENDARMODULE_TUESDAYSHORT',		'D');
define('TR_CALENDARMODULE_WENDSDAYSHORT',		'M');
define('TR_CALENDARMODULE_THURSDAYSHORT',		'D');
define('TR_CALENDARMODULE_FRIDAYSHORT',			'F');
define('TR_CALENDARMODULE_SATURDAYSHORT',		'S');

define('TR_CALENDARMODULE_MONTHOF',				'Monat');
define('TR_CALENDARMODULE_NOEVENTS',			'keine Termine');
define('TR_CALENDARMODULE_PRINTERFRIENDLY',		'Druckansicht');
define('TR_CALENDARMODULE_VIEWWHOLEMONTH',		'Monatsübersicht');
define('TR_CALENDARMODULE_CREATEEVENT',			'Neuer Termin');
define('TR_CALENDARMODULE_VIEWAPPROVAL',		'Prüfstatus');
define('TR_CALENDARMODULE_MANAGECATEGORIES',	'Kategorien verwalten');
		

?>