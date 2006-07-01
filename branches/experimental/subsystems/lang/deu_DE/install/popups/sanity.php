<?php

return array(
	'title'=>'Erkl�rung der Systemvoraussetzungen',
	'header'=>'Die �berpr�fungen werden durchgef�hrt, um Probleme mit Ihrer Serverkonfiguration zu verhindern. Diese Seite erkl�rt die einzelnen Tests und warum diese notwendig sind.<br /><br />Anmerkung: Bei den L�sungsvorschl�gen, <span class="var">WEBUSER</span> wird der Username des verwendeten Webservers, und <span class="var">EXPONENT</span> der volle Pfad zum Exponent-Verzeichnis benutzt.',
	
	'filedir_tests'=>'Datei- und Verzeichnistests f�r Berechtigungen',
	
	'rw_server'=>'M�ssen schreib- und lesebar durch den Webserver sein.',
	'unix_solution'=>'UNIX L�sung',
	
	'config.php'=>'In der conf/config.php Datei wird die Konfiguration f�r die aktuelle Site gespeichert. Dazu geh�rt auch die DB-Verbindung und das gew�hlte Thema.',
	
	'profiles'=>'Im conf/profiles Verzeichniss werden alle Konfigurationsangaben f�r die Site abgelegt.  Auch wenn Sie nur ein Profil benutzen, muss der Webserver die Rechte haben, um hier Dateien zu erstellen.',
	
	 'overrides.php'=>'Die overrides.php wird bei der Installation benutzt, um verschiedene Konstanten, die von System geliefert werden, darin festzuhalten. Diese Daten werden dann mit den realen Daten (�ndern des voreingestellten Installationspfad) �berschrieben. Nach der Instalation wird diese Datei nicht mehr ben�tigt.',
	
	 'install'=>'Das Install-Verzeichnis beinhaltet alle Dateien vom Exponent-Installationsassistent. Sobald der Assistent einmal ausgef�hrt wurde, wird das Verzeichnis automatisch gel�scht. Dazu werden Schreibrechte f�r dieses Verzeichnis ben�tigt.',
	
	'modules'=>'Exponent testet die mitgelieferten Module um sicherszustellen, da� alles korrekt installiert werden kann. Falls es dabei zu Problemem kommt, wenden Sie sich bitte an das Deutsche Portal (<a href="http://www.Exponentcms-portal.de/" target="_blank">http://www.Exponentcms-portal.de/</a>).',
	
	 'views_c'=>'Exponent verwendet Smarty, um die Daten von der Darstellung zu trennen. Smarty-Templates werden jedoch aus Geschwindigkeitsgr�nden in PHP compiliert, die erzeugten compilierten Templates werden im Verzeichnis views_c gespeichert. F�r dieses Verzeichnis muss der Webserver ebenfalls Schreibberechtigung haben.',
	
	 'extensionuploads'=>'Wenn Sie das Upload Extension Feature im Administrator Control Panel benutzen, werden die Dateien zuerst im Verzeichnis extensionuploads tempor�r gespeichert. Deshalb ben�tigt der Webserver vollen Zugriff auf dieses Verzeichnis.',
	
	 'files'=>'Alle hochgeladenen Content Dateien (resources, importierte Daten, Bilder, etc.) werden im Verzeichnis files/	gespeichert. Der Webserver braucht daf�r Schreib- und Leserechte.  Falls der Test negativ ausf�llt sollten Sie die Berechtigungen
	manuell �ndern.',
	
	'tmp'=>'Das Verzeichnis "tmp" wird von verschiedenene Exponent Komponenten zum vor�bergehenden Speichern benutzt.',
		'other_tests'=>'Weitere Tests',
	'db_backend'=>'Datenbank Backend',
	
	'db_backend_desc'=>'Exponent speichert den Content der Webseiten in einer relationalen Datenbank. Aus Portabilit�tsgr�nden wird ein Datenbankzugrifflayer daf�r benutzt. Momentan unterst�tzt diese API nur MySQL und PostGreSQL. Wenn der Test fehlschl�gt,  wurde keine PHP Unterst�tzung f�r diese Datenbank festgestellt.',
	
	 'gd'=>'GD Graphics Library',
	
	 'gd_desc'=>'Verschiedenen Komponenten von Exponent ben�tigen die GD Graphics Library f�r Bildermanipulationen. Exponent funktioniert aber auch ohne GD, leider funktioniert dann der Captcha Test und die automatische Bildvorschau
	nicht. Eine GD-Version die mit 2.0.x kompatibel ist, erstellt sch�rfere und bessere Bildvorschauen.',
	
	'php_desc'=>'Exponent ben�tigt f�r einige Funktionen zwingend eine PHP Version ab 4.0.6.',
	
	'zlib'=>'ZLib Support',
	
	'zlib_desc'=>'ZLib wird ben�tigt zum packen und entpacken der Tar- und Zip-
	Archive.',
	
	'xml'=>'XML (Expat Library)',
	
	'xml_desc'=>'Die Weberweiterung braucht die Expat Library. Fall Sie keine Webservices nutzen, k�nnen Sie die Warnungen ignorieren.',
	
	'safemode'=>'Safe Mode <b>Nicht aktiviert</b>',
	
	'safemode_desc'=>'Safe Mode ist der Versuch, Sicherheitsprobleme bei gemeinsam genutzten Servern zu l�sen. Bezogen auf die Systemarchitektur, ist es der falsche Ansatz, diese Probleme innerhalb der PHP-	Schicht l�sen zu wollen. Da es auf Ebene des Webservers bzw. des Betriebssystems keine praktischen Alternativen gibt, wird Safe Mode nunmehr von vielen Providern eingesetzt.<br /><br />Wenn Sie diese Warnung ignorieren, sollten Sie sicherstellen, das ALLE Dateien inklusive des Exponent-	 Pakets vom selben Systemuser verwaltet werden.',
	
	 'safemode_req'=>'Exponent funktioniert am besten, wenn der Safe Mode deaktiviert ist.',
	'basedir'=>'Open BaseDir deaktiviert.',
	
	'basedir_req'=>'Exponent funktioniert am besten, wenn Open BaseDir deaktiviert ist.',
	
	'basedir_desc'=>'open_basedir ist eine Beschr�nkung f�r alle PHP-eigenen Dateisystemfunktionen. Dabei kann es zu Problemem mit den Exponent Dateien in files\ Verzeichnis kommen. Das betrifft vor allem den Multi-Site-Manager. Sie k�nnen diese Meldung auf eigenes Risiko ignorieren.',
	'upload'=>'Datei Hochladen aktiviert',
	'upload_desc'=>'Server Administratoren k�nnen PHP-Uploads deaktivieren. Zus�tzlich k�nnen schlecht konfigurierte Server Probleme beim Verarbeiten der hochgeladenen Dateien verursachen. Ohne eine Uploadm�glichkeit wird jedoch nur ein kleiner Teil der F�higkeiten von Exponent benutzbar sein, weil es keine M�glichkeit gibt z.B. Bilder oder Dateien hochzuladen.',
	
	'tempfile'=>'Tempor�re Dateierstellung',
	
	'tempfile_desc'=>'Verschiedene Exponenterweiterungen m�ssen tempor�re Dateien erstellen. Normalerweise weist diese Fehlermeldung auf Probeme bei der Verzeichnisberechtigung f�r die "tmp/" Datei und das Verzeichnis hin.',
);

?>
