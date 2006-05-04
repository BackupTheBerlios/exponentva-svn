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
<div class="TimeControl" id="{$name}_TimeControl">
	<script type="text/javascript">
		// convert the timestamp into hours, minutes and if needed am/pm and set the input controls
		Exponent.register('Exponent.Forms.TimeControl.init("{$name}")');
		Exponent.register('Exponent.Forms.switchControl("{$name}_TimeControl", {$showcontrol})');
	</script>
		
	<input type="hidden" id="{$name}_timestamp" name="{$name}_timestamp" value="{$timestamp}"/>

	<input onchange="Exponent.Forms.TimeControl.updateTime(this, document.getElementById('{$name}_timestamp'))" type="text" id="{$name}_hours" name="{$name}_hours" />
	:
	<input onchange="Exponent.Forms.TimeControl.updateTime(this, document.getElementById('{$name}_timestamp'))" type="text" id="{$name}_minutes" name="{$name}_minutes" />
{if $hourformat == 12}
	<select onchange="Exponent.Forms.TimeControl.updateTime(this, document.getElementById('{$name}_timestamp'))" id="{$name}_ampm" name="{$name}_ampm">
		<option value="am">am</option>
		<option value="pm">pm</option>
	</select>
{/if}
</div>