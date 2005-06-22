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
 * $Id: _form_af_edit.tpl,v 1.3 2005/02/19 00:32:29 filetreefrog Exp $
 *}
<div class="form_title">{if $is_edit == 1}Edit Affiliate{else}Create an Affiliate{/if}</div>
<div class="form_header">
Every banner in a Banner Manager is tied to an affiliate.  Normal web visitors will never see any of the affiliate information - it is strictly for the management of banners and clicks.
</div>
{$form_html}