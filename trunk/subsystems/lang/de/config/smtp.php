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
# $Id: smtp.php,v 1.5 2005/03/11 15:18:38 filetreefrog Exp $
# $Id: smtp.php,v 1.6 2005/05/14 15:32:00 MaxxCorp Exp $
##################################################

define('TR_CONFIG_SMTP_TITLE',					'SMTP Server Einstellungen');

define('TR_CONFIG_SMTP_USE_PHP_MAIL',			'PHP mail() Funktion benutzen?');
define('TR_CONFIG_SMTP_USE_PHP_MAIL_DESC',		'Falls die Exponent SMTP Implementation nicht funtioniert, sei es durchServer- oder Hostingprobleme, aktivieren Sie bitte diese Option, um die Standard PHP mail() function zu verwenden.  Hinweis: Wenn aktiviert, werden alle SMTP Einstellungen ignoriert.');

define('TR_CONFIG_SMTP_SERVER',					'SMTP Server');
define('TR_CONFIG_SMTP_SERVER_DESC',			'Die IP Adresse oder Host-/Domainname des Servers welcher für den EMail-Versand via SMTP verwendet werden soll.');

define('TR_CONFIG_SMTP_PORT',					'SMTP Port');
define('TR_CONFIG_SMTP_PORT_DESC',				'Der Port, welcher vom SMTP Server benutzt wird. Falls nichts Anderes bekannt belassen Sie die Standardeinstellung 25.');

define('TR_CONFIG_SMTP_AUTHTYPE',				'Authentifizierungsmethode');
define('TR_CONFIG_SMTP_AUTHTYPE_DESC',			'Hier kann dier Typ der Authentifizierung des SMTP Servers eingetragen werden, falls benötigt. Bei Fragen wenden Sie sich bitte an Ihren Hosting Provider');

define('TR_CONFIG_SMTP_USERNAME',				'SMTP Benutzername');
define('TR_CONFIG_SMTP_USERNAME_DESC',			'Der Benutzername, der für die Authentifizierung des Benutzers am SMTP Server verwendet werden soll.');

define('TR_CONFIG_SMTP_PASSWORD',				'SMTP Passwort');
define('TR_CONFIG_SMTP_PASSWORD_DESC',			'Das Passwort, das für die Authentifizierung des Benutzers am SMTP Server verwendet werden soll.');

define('TR_CONFIG_SMTP_ADDRESS',				'Absender');
define('TR_CONFIG_SMTP_ADDRESS_DESC',			'Die EMail-Adresse des Absenders. Einige Internet Service Provider beschränken die Nutzung ihrer SMTP Server auf die bei Ihnen registrierten Adressen.');

?>