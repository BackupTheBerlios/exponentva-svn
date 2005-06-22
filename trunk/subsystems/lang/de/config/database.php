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
# $Id: database.php,v 1.5 2005/02/19 00:35:12 filetreefrog Exp $
# $Id: database.php,v 1.6 2005/05/14 15:22:00 MaxxCorp Exp $
##################################################

define('TR_CONFIG_DATABASE_ERROR_BADPREFIX',		'Ungültiger Tabellenpräfix. Der Tabellenpräfix darf nur alphanumerische Zeichen enthalten.');
define('TR_CONFIG_DATABASE_ERROR_CANTCONNECT',		'Verbindung mit dem Datenbankserver fehlgeschlagen. Stellen Sie sicher das die angegebene Datenbank existiert und das angegebene Benutzerkonto Zugriffsrechte darauf hat.');
define('TR_CONFIG_DATABASE_ERROR_PERMDENIED',		'%s Anweisungen nicht ausführbar.');

define('TR_CONFIG_DATABASE_TITLE',					'Datenbankeinstellungen');

define('TR_CONFIG_DATABASE_DB_ENGINE',				'Backend Software');
define('TR_CONFIG_DATABASE_DB_ENGINE_DESC',			'Die Datenbank Software');

define('TR_CONFIG_DATABASE_DB_NAME',				'Datenbankname');
define('TR_CONFIG_DATABASE_DB_NAME_DESC',			'Der Name der Datenbank in der die Tabellen der Website gespeichert werden sollen.');

define('TR_CONFIG_DATABASE_DB_USER',				'Benutzername');
define('TR_CONFIG_DATABASE_DB_USER_DESC',			'Der Name des Kontos des Datenbankbenutzers');

define('TR_CONFIG_DATABASE_DB_PASS',				'Passwort');
define('TR_CONFIG_DATABASE_DB_PASS_DESC',			'Passwort des oben genannten Benutzers.');

define('TR_CONFIG_DATABASE_DB_HOST',				'Server Adresse');
define('TR_CONFIG_DATABASE_DB_HOST_DESC',			'Der Domainname oder die IP Adresse des Datenbankservers.  Falls der Server lokal läuft, bitte "localhost" verwenden.');

define('TR_CONFIG_DATABASE_DB_PORT',				'Server Port');
define('TR_CONFIG_DATABASE_DB_PORT_DESC',			'The Port an dem der Datenbankserver läuft. Für MySQL ist das 3306.');

define('TR_CONFIG_DATABASE_DB_TABLE_PREFIX',		'Tabellenpräfix');
define('TR_CONFIG_DATABASE_DB_TABLE_PREFIX_DESC',	'Ein präfix der allen Tabellennamen vorangestellt wird.');


?>