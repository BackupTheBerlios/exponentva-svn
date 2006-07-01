<?php

return array(
	'subtitle'=>'Datenbank Konfiguration',
	
	'in_doubt'=>'Keine Ahnung? Bitte fragen Sie jemand der sich damit auskennt: Freunde, Ihren Hoster oder das Deutsche Exponent Portal.',
	'more_info'=>'Weitere Informationen',
	
	'server_info'=>'Server Informationen',
	'backend'=>'Backend',
	'backend_desc'=>'W�hlen Sie Ihren Datenbankserver aus. Sollte Ihr verwendeter nicht dabei sein, wird er von Exponent (noch) nicht unterst�tzt.',

	'address'=>'Adresse',
	'address_desc'=>'Falls Ihr Datenbankserver und Webserver verschiedene IP-Adressen haben, geben Sie bitte hier die IP des Datenbankservers ein. Sie k�nnen eine IP-Addresse (z.B. 123.231.213.4) oder eine Internetdomain wie (exponent-portal.de) eingeben.<br /><br />Wenn sich Ihre Datenbank und der Webserver auf dem gleichen Rechner befinden, reicht die Auswahl von "localhost".',
	
	'port'=>'Port',
	'port_desc'=>'Wenn Sie einen Datenbankserver mit TCP oder einem anderen Netzwerkprotoll benutzen, und Datenbankserver und Webserver laufen auf verschiedenen Rechnern, m�ssen Sie den connection port eingeben.<br /><br />Fall Sie jedoch bereits "localhost" bei der Adresse eingegeben haben, lassen Sie dies als Voreinstellung.',
	
	'database_info'=>'Datenbank Informationen',
	'dbname'=>'Datenbank Name',
	'dbname_desc'=>'Geben Sie den tats�chlichen Namen der Datenbank an. Fall Sie diesen nicht wissen, sollten Sie bei Ihrem Hoster nachfragen. Ansonsten verwenden Sie phpMyAdmin um den Namen der DB herauszufinden.',
	
	'username'=>'Benutzername',
	'username_desc'=>'Datenbankserver verlangen eine Authentifizierung. Geben Sie hier den Usernamen f�r die Datenbank ein.',
	'username_desc2'=>'Stellen Sie sicher, da� der User �ber die notwendigen Rechte verf�gt.',
	
	'password'=>'Passwort',
	'password_desc'=>'Zum User geh�rt ein Passwort, das Sie bitte hier eingeben. Das Passwort wird <b>nicht</b> verdeckt, weil es ohnehin in die Konfigurationsdatei geschrieben wird. Als Exponent Entwickler bitten wir Sie, ein komplett neues Passwort zu vergeben - eines das Sie bislang noch nie verwendet haben.',
	
	'prefix'=>'Tabellen Vorzeichen',
	'prefix_desc'=>'Datenbanken k�nnen sehr viele Tabellen verwalten. So ist es durchaus m�glich, da� unterschiedliche Webauftritte oder Exponentinstallationen in einer DB gespeichert werden. Wenn Sie Tabellenvorzeichen vergeben,  kann Exponent mehrere Installationen verwalten und auf die jeweils richtigen Tabellen zugreifen.',
	'prefix_note'=>'<b>Anmerkung:</b> Verwenden Sie f�r Tabellenvorzeichen keine Sonderzeichen, sondern nur Ziffern und Buchstaben. Exponent f�gt den von Ihnen eingebenen Tabellenvorzeichen noch einen Unterstrich (_) hinzu.',
	
	'default_content'=>'Beispiel Webauftritt',
	'install'=>'Installieren einer kompletten Website',
	'install_desc'=>'Was man sehen kann versteht man am schnellsten. Deshalb k�nnen Sie ein komplettes Beispiel eines Webauftritts, der zugleich auch Dokumentation ist, installieren. Bitte tun Sie das auf alle F�lle, wenn Exponent Neuland f�r Sie ist.',
	
	'verify'=>'�berpr�fe Konfiguration',
	'verify_desc'=>'Nach der Eingabe aller Daten klicken Sie einfach auf den "Teste die Einstellungen" Schalter. Der Exponent-
	Installationsassistent f�hrt nun verschiedene Test durch, um die Eingaben zu verifizieren.',
	'test_settings'=>'Teste die Einstellungen',
);

?>
