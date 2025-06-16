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

# mod_site.php - Pagina
site_title=Sito Web Esempio
site_heading_text=Questa pagina è stata iniettata dal modulo "Sito Web Esempio" "_site"!
site_no_permission=Non hai il permesso di visualizzare questa pagina.
site_has_access=Questa è la pagina dell'estensione Moduli del Sito Esempio.

# mod_setting.php - Impostazioni
site_settings=Normalmente, vedresti qui le impostazioni dell'estensione. Tuttavia, questa pagina è inclusa solo come esempio per gli sviluppatori, quindi puoi ignorarla.

# mod_permission.php - Permessi
permission_name=Accesso
permission_descr=Permesso di visualizzare la pagina dei contenuti di questa estensione ed eseguire tutte le funzionalità disponibili.

# mod_nav.php - Navigazione
nav_title=Sito Web Esempio

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Template: Modulo Sito Web  
store_version_description=Questo è un esempio di modulo sito web integrato! Questo tipo di moduli per siti web utilizzano suitefish-cms come piattaforma per consentire l'hosting multi-sito con un'unica istanza!  
