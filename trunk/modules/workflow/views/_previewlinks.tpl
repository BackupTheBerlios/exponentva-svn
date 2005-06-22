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
 * $Id: _previewlinks.tpl,v 1.2 2005/02/19 00:32:38 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<br /><hr size='1' />
<b>Approval Actions:&nbsp;&nbsp;&nbsp;&nbsp;</b>
[ <a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype mod=$mod id=$id action=cancel}">{#i18n_cancel#}</a> ]
&nbsp;&nbsp;&nbsp;
[ <a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype mod=$mod id=$id action=approve}">{#i18n_approveasis#}</a> ]
&nbsp;&nbsp;&nbsp;
[ <a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype mod=$mod id=$id action=edit}">{#i18n_edit#}</a> ]
&nbsp;&nbsp;&nbsp;
[ <a class="mngmntlink workflow_mngmntlink" href="{link datatype=$datatype mod=$mod id=$id action=deny_comment}">{#i18n_denyapproval#}</a> ]