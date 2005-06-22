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
# $Id: loginmodule.php,v 1.6 2005/02/19 00:35:12 filetreefrog Exp $
# $Id: loginmodule.php,v 1.7 2005/05/14 16:41:00 MaxxCorp Exp $
##################################################

// I18N constants for Login Module

define('TR_LOGINMODULE_OLDPASS',			'Altes Passwort');
define('TR_LOGINMODULE_NEWPASS',			'Neues Passwort');
define('TR_LOGINMODULE_CONFIRMPASS',			'Bestätigen');
define('TR_LOGINMODULE_CHANGEBTN',			'Ändern');
define('TR_LOGINMODULE_LOGINERR',			'Ungültiger Benutzername / Passwort');
define('TR_LOGINMODULE_RESETUSERNAME',			'Benutzernamename');
define('TR_LOGINMODULE_RESETPASSBTN',			'Passwort zurücksetzen');
define('TR_LOGINMODULE_RESETEMAILTITLE',		'Passwort Reset Benachrichtigung'); // Move into config?
define('TR_LOGINMODULE_UNMATCHEDPASSWORDS',		'Passwörter sind nicht identisch.');
define('TR_LOGINMODULE_OLDPASSWRONG',			'Ihr altes Passwort ist nicht korrekt.');
define('TR_LOGINMODULE_STRENGTHFAILED',			'Ihr Passwort ist nicht sicher genug : %s');
define('TR_LOGINMODULE_WRONGCAPTCHA',			'Verifikation fehlgeschlagen.  Bitte die Verifikation erneut eingeben (Bild)');
define('TR_LOGINMODULE_CAPTCHADESC',			'%s<br />Bitte geben Sie die Nummern (0-9) and Buchstaben (nur A-F) aus dem<br /> obrigen Bild ein, um Ihre Registrierung zu bestätigen.');

define('TR_LOGINMODULE_USERNAMETAKEN',			'Dieser Benutzername ist bereits vergeben.');

?>