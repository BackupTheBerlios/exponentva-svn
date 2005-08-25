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
# $Id: site.php,v 1.5 2005/04/08 23:13:34 filetreefrog Exp $
# $Id: site.php,v 1.6 2005/05/14 15:30:00 MaxxCorp Exp $
##################################################

define('TR_CONFIG_SITE_TITLE',						'Globale Konfiguration der Website ');

define('TR_CONFIG_SITE_SITE_TITLE',					'Titel der Website');
define('TR_CONFIG_SITE_SITE_TITLE_DESC',			'Der Titel der Website.');

define('TR_CONFIG_SITE_USE_LANG',					'Sprache');
define('TR_CONFIG_SITE_USE_LANG_DESC',				'In welcher Sprache soll Exponent angezeigt werden ?');

define('TR_CONFIG_SITE_ALLOW_REGISTRATION',			'Registrierung  erlauben?');
define('TR_CONFIG_SITE_ALLOW_REGISTRATION_DESC',	'Legt fest, ob es neuen Benutzern gestattet sein soll sich selbstst�ndig zu registrieren.');

define('TR_CONFIG_SITE_USE_CAPTCHA',				'CAPTCHA Test benutzen?');
define('TR_CONFIG_SITE_USE_CAPTCHA_DESC',			'Ein CAPTCHA (Computer Automated Public Turing Test to Tell Computers and Humans Apart) ist eine Methode automatisierte missbr�uchliche Massenregistrierung zu verhindern.  Bei der Registration wird der Benutzer gebeten eine alphanumerische Zeichenkette aus einem Bild einzugeben. Die  h�lt bot-scripte davon ab massenhaft Accounts zu registrieren um damit die Funktion der Website lahmzulegen.');
define('TR_CONFIG_SITE_USE_CAPTCHA_NOSUPPORT',		'<div class="error">Ihre Webserver Konfiguration und/oder die PHP Konfiguration enthalten keine Unterst�tzung der GD Erweiterung, dies verhindert den Einsatz des CAPTCHA Tests.</div>');

define('TR_CONFIG_SITE_KEYWORDS',					'Schl�sselworte');
define('TR_CONFIG_SITE_KEYWORDS_DESC',				'Schl�sselworte f�r Suchmaschinen.');

define('TR_CONFIG_SITE_DESCRIPTION',				'Beschreibung');
define('TR_CONFIG_SITE_DESCRIPTION_DESC',			'Eine Beschreibung worum es auf Ihrer Website geht.');

define('TR_CONFIG_SITE_404',						'Fehlertext f�r "Seite nicht gefunden" ');
define('TR_CONFIG_SITE_404_DESC',					'HTML Text der dem User angezeigt werden soll, wenn dieser versucht auf eine nicht (mehr) vorhandene Ressource (bspw. ein gel�schter Eintrag, Sektion usw.) zuzugreifen.');

define('TR_CONFIG_SITE_403',						'Fehler Text f�r "Zugriff verweigert"');
define('TR_CONFIG_SITE_403_DESC',					'HTML Text der dem User angezeigt werden soll, wenn dieser versucht eine Aktion auszuf�hren, f�r die er keine Freigabe hat.');

define('TR_CONFIG_SITE_DEFAULT_SECTION',			'Standard Sektion');
define('TR_CONFIG_SITE_DEFAULT_SECTION_DESC',		'Die Standard Sektion.');

define('TR_CONFIG_SITE_WYSIWYG_EDITOR','WYSIWYG Editor');
define('TR_CONFIG_SITE_WYSIWYG_EDITOR_DESC',"Der zu verwendende Texteditor.");

define('TR_CONFIG_SITE_SESSION_TIMEOUT',			'Zeitlimit f�r Sitzungen');
define('TR_CONFIG_SITE_SESSION_TIMEOUT_DESC',		'Legt die Zeit fest, nach der ein inaktiver Benutzer automatisch ausgeloggt wird.');

define('TR_CONFIG_SITE_TIMEOUT_ERROR',				'Fehlertext f�r "Sitzung abgelaufen"');
define('TR_CONFIG_SITE_TIMEOUT_ERROR_DESC',			'HTML Text der dem User angezeigt werden soll, wenn dieser, nachdem er nach einer Zeit�berschreitung automatisch ausgeloggt wurde, versucht eine Aktion auszuf�hren, f�r die er eingeloggt sein muss.');

define('TR_CONFIG_SITE_FILEPERMS',					'Standard Dateizugriffsrechte');
define('TR_CONFIG_SITE_FILEPERMS_DESC',				'Die Schreib-/Leserechte hochgeladener Dateien, welche f�r alle Benutzer au�er dem Webserver gelten.');

define('TR_CONFIG_SITE_DIRPERMS',					'Standard Ordnerzugriffsrechte');
define('TR_CONFIG_SITE_DIRPERMS_DESC',				'Die Schreib-/Leserechte erstellter Ordner, welche f�r alle Benutzer au�er dem Webserver gelten.');

define('TR_CONFIG_SITE_ENABLE_SSL',					'SSL Unterst�tzung aktivieren');
define('TR_CONFIG_SITE_ENABLE_SSL_DESC',			'Legt fest, ob sicheres Linken �ber SSL aktiviert werden soll.');

define('TR_CONFIG_SITE_NONSSL_URL',					'Nicht-SSL URL Base');
define('TR_CONFIG_SITE_NONSSL_URL_DESC',			'Die volle URL der Website ohne SSL Unterst�tzung (beginnt �blicherweise mit "http://")');

define('TR_CONFIG_SITE_SSL_URL',					'SSL URL Base');
define('TR_CONFIG_SITE_SSL_URL_DESC',				'Die volle URL der Website mit SSL Unterst�tzung (beginnt �blicherweise mit "https://")');

?>