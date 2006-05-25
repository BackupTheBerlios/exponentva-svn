{*
 * Copyright (c) 2004-2005 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
{if $editMode == 1}
<img src="{$smarty.const.ICON_RELATIVE}expmode.png" align="absmiddle" alt="Sitetree" border="0">&nbsp;<a class="mngmntlink preview_mngmntlink" href="{link action=preview}"><strong>{$_TR.preview}</strong></a>
{/if}
{if $previewMode == 1}
<img src="{$smarty.const.ICON_RELATIVE}expmode.png" align="absmiddle" alt="Sitetree" border="0">&nbsp;<a class="mngmntlink preview_mngmntlink" href="{link action=normal}"><strong>{$_TR.edit_mode}</strong></a>
{/if}