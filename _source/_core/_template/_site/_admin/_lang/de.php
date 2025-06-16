<?php if(isset($this)) { if(!is_object($this)) { Header("Location: ../"); exit(); } } else { Header("Location: ../"); exit(); }
#		 ____  __  __  ___  ____  ____  ___  _   _ 
#		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
#		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
#		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
#				 ___ _   _ ___ _____ ___ ___ ___ ___ _  _ 
#				/ __| | | |_ _|_   _| __| __|_ _/ __| || |
#				\__ \ |_| || |  | | | _|| _| | |\__ \ __ |
#				|___/\___/|___| |_| |___|_| |___|___/_||_|
#		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]
#
#		This program is free software: you can redistribute it and/or modify
#		it under the terms of the GNU General Public License as published by
#		the Free Software Foundation, either version 3 of the License, or
#		(at your option) any later version.
#
#		This program is distributed in the hope that it will be useful,
#		but WITHOUT ANY WARRANTY; without even the implied warranty of
#		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#		GNU General Public License for more details.
#
#		You should have received a copy of the GNU General Public License
#		along with this program.  If not, see <https://www.gnu.org/licenses/>. ?>
##########################################################################################
## Extension Related
##########################################################################################

# mod_site.php - Seite
site_title=Beispiel-Website
site_heading_text=Diese Seite wurde vom Modul „_site“ der Beispiel-Website eingefügt!
site_no_permission=Sie haben keine Berechtigung, diese Seite anzuzeigen.
site_has_access=Dies ist die Seite der Beispiel-Website-Module-Erweiterung.

# mod_setting.php - Einstellungen
site_settings=Normalerweise würden Sie hier Erweiterungseinstellungen sehen. Diese Seite ist jedoch nur als Beispiel für Entwickler enthalten, daher können Sie sie ignorieren.

# mod_permission.php - Berechtigungen
permission_name=Zugriff
permission_descr=Berechtigung, die Inhaltsseite dieser Erweiterung anzuzeigen und alle verfügbaren Funktionen auszuführen.

# mod_nav.php - Navigation
nav_title=Beispiel-Website

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Vorlage: Webseiten-Modul  
store_version_description=Dies ist ein Beispiel für ein integriertes Webseiten-Modul! Diese Art von Webseiten-Modulen nutzt das suitefish-cms als Plattform, um Multi-Site-Hosting mit einer einzigen Instanz zu ermöglichen!  
