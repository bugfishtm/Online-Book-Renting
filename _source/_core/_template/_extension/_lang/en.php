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
site_title=Example Extension
site_heading_text=This page has been injected by the Example Extension module!
site_no_permission=You do not have permission to view this page.
site_has_access=This is the Example Extension page.

# mod_setting.php - Settings
site_settings=Normally, you would see extension settings here. However, this page is only included as an example for developers, so you can disregard this page.

# mod_permission.php - Permissions
permission_name=Access
permission_descr=Permission to view the content page of this extension and to execute all available functionalities.

# mod_nav.php - Navigation
nav_title=Example Extension

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Template: Extension Module
store_version_description=Extension Module Example for the Administrator module, especially for Developers. You can get more Information about Extension Modules inside the Suitefish Documentation and related Readme.md Files in the repository!