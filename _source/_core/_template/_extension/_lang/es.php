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
site_title=Ejemplo de Extensión
site_heading_text=¡Esta página ha sido inyectada por el módulo Ejemplo de Extensión!
site_no_permission=No tienes permiso para ver esta página.
site_has_access=Esta es la página del Ejemplo de Extensión.

# mod_setting.php - Settings
site_settings=Normalmente, aquí verías la configuración de la extensión. Sin embargo, esta página solo está incluida como un ejemplo para los desarrolladores, por lo que puedes ignorarla.

# mod_permission.php - Permissions
permission_name=Acceso
permission_descr=Permiso para ver la página de contenido de esta extensión y ejecutar todas las funcionalidades disponibles.

# mod_nav.php - Navigation
nav_title=Ejemplo de Extensión

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Plantilla: Módulo de Extensión
store_version_description=Ejemplo de módulo de extensión para el módulo Administrador, especialmente para desarrolladores. ¡Puedes obtener más información sobre los módulos de extensión en la documentación de Suitefish y en los archivos Readme.md relacionados en el repositorio!
