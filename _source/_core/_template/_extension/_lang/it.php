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

# mod_site.php - Page
site_title=Esempio di Estensione
site_heading_text=Questa pagina è stata iniettata dal modulo Esempio di Estensione!
site_no_permission=Non hai il permesso di visualizzare questa pagina.
site_has_access=Questa è la pagina dell'Esempio di Estensione.

# mod_setting.php - Settings
site_settings=Normalmente, qui vedresti le impostazioni dell'estensione. Tuttavia, questa pagina è inclusa solo come esempio per gli sviluppatori, quindi puoi ignorarla.

# mod_permission.php - Permissions
permission_name=Accesso
permission_descr=Permesso per visualizzare la pagina dei contenuti di questa estensione ed eseguire tutte le funzionalità disponibili.

# mod_nav.php - Navigation
nav_title=Esempio di Estensione

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Template: Modulo di Estensione
store_version_description=Esempio di modulo di estensione per il modulo Amministratore, soprattutto per gli sviluppatori. Puoi trovare ulteriori informazioni sui moduli di estensione nella documentazione di Suitefish e nei file Readme.md associati nel repository!
