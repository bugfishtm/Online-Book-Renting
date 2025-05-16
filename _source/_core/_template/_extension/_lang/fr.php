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
site_title=Exemple d'Extension
site_heading_text=Cet page a été injectée par le module Exemple d'Extension !
site_no_permission=Vous n'avez pas la permission de voir cette page.
site_has_access=C'est la page Exemple d'Extension.

# mod_setting.php - Settings
site_settings=Normalement, vous verriez les paramètres de l'extension ici. Cependant, cette page est incluse uniquement à titre d'exemple pour les développeurs, vous pouvez donc ignorer cette page.

# mod_permission.php - Permissions
permission_name=Accès
permission_descr=Permission de voir la page de contenu de cette extension et d'exécuter toutes les fonctionnalités disponibles.

# mod_nav.php - Navigation
nav_title=Exemple d'Extension

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Template : Module d'Extension
store_version_description=Exemple de module d'extension pour le module Administrateur, spécialement pour les développeurs. Vous pouvez obtenir plus d'informations sur les modules d'extension dans la documentation Suitefish et les fichiers Readme.md associés dans le référentiel !
