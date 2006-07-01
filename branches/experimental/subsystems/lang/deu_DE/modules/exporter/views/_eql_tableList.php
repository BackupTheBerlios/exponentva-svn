<?php

return array(
	'form_title'=>'Aktuelle Datenbank sichern',
	'form_header'=>'Nachfolgend finden Sie eine Liste aller in Ihrer DBenthaltenen Tabellen. Wählen Sie die zu exportierenden aus und klicken auf "Datei Export". Danach wird eine EQL-Datei (welche Siesichern sollten) erstellt, in der die Daten der von Ihnen ausgewählten Tabvellen enthalten sind. Mit dieser EQL-Datei können Sie später die gesicherten Daten in Ihre DB reimportieren.',
	
	'at_least_one'=>'Sie müssen zumindest eine Tabelle auswählen.',
	
	'select_all'=>'Alles auswählen',
	'deselect_all'=>'Alles abwählen',
	
	'file_template'=>'File Name Template:',
	'template_description'=>'Verwenden Sie __DOMAIN__ für die Domain dieser Website, __DB__ für den Namen der Datenbank, und Angaben zum Zeitpunkt der Sicherung. Die EQL-Dateierweiterung wird automatisch angefügt. Jeder weitere Text bleibt erhalten.',
	
	'export_data'=>'Exportiere Daten',
);

?>
