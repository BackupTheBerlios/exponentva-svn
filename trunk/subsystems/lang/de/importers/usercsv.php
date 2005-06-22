<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
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
# $Id: usercsv.php,v 1.4 2005/02/19 00:35:12 filetreefrog Exp $
##################################################

define('TR_IMPORTER_USERCSV_NAME',					'Benutzer CSV Import');
define('TR_IMPORTER_USERCSV_DESCRIPTION',				'Diese ist eine Erweiterung um Benutzerkonten aus einer csv (comma separated values) Datei zu importieren');

define('TR_IMPORTER_USERCSV_DEMILITER_ARRAY_COMMA_KEY',			'Komma');
define('TR_IMPORTER_USERCSV_DEMILITER_ARRAY_SEMICOLON_KEY',		'SemiKolon');
define('TR_IMPORTER_USERCSV_DEMILITER_ARRAY_COLON_KEY',			'Doppelpunkt');
define('TR_IMPORTER_USERCSV_DEMILITER_ARRAY_SPACE_KEY',			'Leertaste');

define('TR_IMPORTER_USERCSV_DEMILITER',					'Abtrennungszeichen');
define('TR_IMPORTER_USERCSV_UPLOAD',					'Hochzuladende CSV Datei');
define('TR_IMPORTER_USERCSV_ROWSTART',					'Lies ab Zeile Nummer');

define('TR_IMPORTER_USERCSV_SUBMIT',					'Abbschicken');
define('TR_IMPORTER_USERCSV_CANCEL',					'Abbruch');

define('TR_IMPORTER_USERCSV_FILN',					'Initial / Nachname');
define('TR_IMPORTER_USERCSV_FILNNUM',					'Initial / Nachname / Zufallszahl');
define('TR_IMPORTER_USERCSV_EMAIL',					'Email Addresse');
define('TR_IMPORTER_USERCSV_FNLN',					'Name / Nachname');
define('TR_IMPORTER_USERCSV_UNAMEINFILE',				'Benutzername in CSV Datei');

define('TR_IMPORTER_USERCSV_RAND',					'Generiere zufällige Passwörter');
define('TR_IMPORTER_USERCSV_DEFPASS',					'Benutze das Unten aufgeführte Standard-Passwort');
define('TR_IMPORTER_USERCSV_PWORDINFILE',				'Passwort in CSV Datei');

define('TR_IMPORTER_USERCSV_UNAMEOPTIONS',				'Einstellungen für die Generierung von Benutzernamen');
define('TR_IMPORTER_USERCSV_PWORDOPTIONS',				'Einstellungen für die Generierung von Passwörtern');
define('TR_IMPORTER_USERCSV_PWORDTEXT',					'Standard-Passwort');
define('TR_IMPORTER_USERCSV_UPDATE',					'Inder Datenbank bestehende Benutzer aktualisieren');

define('TR_IMPORTER_USERCSV_COLNAME_NONE',				'--Diese Spalte ignorieren--');
define('TR_IMPORTER_USERCSV_COLNAME_USERNAME',				'Benutzername');
define('TR_IMPORTER_USERCSV_COLNAME_PASSWORD',				'Passwort');
define('TR_IMPORTER_USERCSV_COLNAME_FIRSTNAME',				'Name');
define('TR_IMPORTER_USERCSV_COLNAME_LASTNAME',				'Nachname');
define('TR_IMPORTER_USERCSV_COLNAME_EMAIL',				'Email Adresse');

define('TR_IMPORTER_USERCSV_DELIMITER_ERROR',				'Diese Datei scheint nicht mit dem Abtrennungszeichen "%s" angelegt worden zu sein. <br>Bitte wählen Sie ein anderes Abtrennungszeichen.<br><br>');

?>