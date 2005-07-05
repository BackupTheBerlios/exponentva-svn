<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc., Maxim M�ller
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
define('TR_CALENDARMODULE_ISALLDAY',			'Ganzt�giger Termin');
define('TR_CALENDARMODULE_EVENTSTART',			'Beginn');
define('TR_CALENDARMODULE_EVENTEND',			'Ende');
define('TR_CALENDARMODULE_RECURRENCE',			'Wiederholung');

define('TR_CALENDARMODULE_CATEGORIES',			'Kategorie');
define('TR_CALENDARMODULE_NOFEEDBACK',			'Feedback deaktivieren');
define('TR_CALENDARMODULE_FEEDBACKFORM',		'Feedback Formular');
define('TR_CALENDARMODULE_FEEDBACKEMAIL',		'Feedback Email');

define('TR_CALENDARMODULE_ENABLECATEGORIES',	'Kategorien aktivieren?');
define('TR_CALENDARMODULE_ENABLEFEEDBACK',		'Feedback aktivieren?');

define('TR_CALENDARMODULE_RECURRENCEWARNING',	'Dieser Termin wiederholt sich and den untenstehenden Tagen.  Bitte w�hlen Sie die Tage aus auf die Sich Ihre �nderungen beziehen.');

// Permissions
define('TR_CALENDARMODULE_PERM_ADMIN',			'Administrieren');
define('TR_CALENDARMODULE_PERM_CONFIG',			'Konfigurieren');
define('TR_CALENDARMODULE_PERM_POST',			'Erstellen');
define('TR_CALENDARMODULE_PERM_EDIT',			'Bearbeiten');
define('TR_CALENDARMODULE_PERM_DELETE',			'L�schen');
define('TR_CALENDARMODULE_PERM_APPROVE',		'Pr�fen');
define('TR_CALENDARMODULE_PERM_MANAGEAP',		'Pr�fung verwalten');
define('TR_CALENDARMODULE_PERM_MANAGECAT',		'Kategorien verwalten');

define('TR_CALENDARMODULE_PERM_EDITONE',		TR_CALENDARMODULE_PERM_EDIT);
define('TR_CALENDARMODULE_PERM_DELETEONE',		TR_CALENDARMODULE_PERM_DELETE);

define('TR_CALENDARMODULE_RECURMOVEWARNING',	'Warnung: Wenn Sie den unten stehenden Termin bearbeiten, so wird sich diese �nderung nur auf Diesen auswirken.  Alle anderen �nderungen konnen sowohl auf diesen als auch auf andere Termine angewendet werden.');

?>