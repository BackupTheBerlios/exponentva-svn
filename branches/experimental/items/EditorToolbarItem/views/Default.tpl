{*
 * Copyright (c) 2006 Maxim Mueller
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
 
 <div class="WYSIWIGToolbarControl">
 	<script type="text/javascript">
	/* <![CDATA[ */
		// populate the Toolbar panel
		eXp.WYSIWYG.toolbar = {$dm->data};
	/* ]]> */									
	</script>
 	<script type="text/javascript" src="{$smarty.const.PATH_RELATIVE}subsytems/forms/controls/WYSIWYGEditorControls/js/{$dm->editor}_toolbox.js"></script>
 	{$dm->data}{IF $dm->active ==1} - Active{/IF}
 </div>