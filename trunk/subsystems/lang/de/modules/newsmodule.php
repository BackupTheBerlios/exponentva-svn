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
# $Id: newsmodule.php,v 1.5 2005/02/19 00:35:12 filetreefrog Exp $
# v 1.6 2005/06/11 MaxxCorp
##################################################

// I18N strings for the News Module

define('TR_NEWSMODULE_HEADLINE',				'�berschrift');
define('TR_NEWSMODULE_BODY',					'Nachricht');
define('TR_NEWSMODULE_PUBLISH',					'Ver�ffentlichen am');
define('TR_NEWSMODULE_UNPUBLISH',				'Archivieren am');
define('TR_NEWSMODULE_NOPUBLISH',				'Sofort ver�ffentlichen');
define('TR_NEWSMODULE_NOUNPUBLISH',				'Nicht archivieren');

define('TR_NEWSMODULE_POSTEDDATE',				'Erscheinungsdatum');
define('TR_NEWSMODULE_PUBDATE',					'Ver�ffentlichungsdatum');
define('TR_NEWSMODULE_ITEMLIMIT',				'Wie viele Eintr�ge?');
define('TR_NEWSMODULE_SORTORDER',				'Sortierrichtung');
define('TR_NEWSMODULE_SORTFIELD',				'Sortiere nach');

// Permissions
define('TR_NEWSMODULE_PERM_ADMIN',				'Administriere');
define('TR_NEWSMODULE_PERM_CONFIG',				'Konfiguriere');
define('TR_NEWSMODULE_PERM_POST',				'Erstelle');
define('TR_NEWSMODULE_PERM_DELETE',				'L�sche');
define('TR_NEWSMODULE_PERM_EDIT',				'Bearbeite');
define('TR_NEWSMODULE_PERM_VIEWUNPUB',				'Archiv');
define('TR_NEWSMODULE_PERM_APPROVE',				'Approval');
define('TR_NEWSMODULE_PERM_MANAGEAP',				'Approval konfigurieren');

define('TR_NEWSMODULE_PERM_EDITONE',			TR_NEWSMODULE_PERM_EDIT);
define('TR_NEWSMODULE_PERM_DELETEONE',			TR_NEWSMODULE_PERM_DELETE);

?>