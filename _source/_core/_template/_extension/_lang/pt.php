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
site_title=Extensão de Exemplo
site_heading_text=Esta página foi injetada pelo módulo de Extensão de Exemplo!
site_no_permission=Você não tem permissão para visualizar esta página.
site_has_access=Esta é a página de Extensão de Exemplo.

# mod_setting.php - Settings
site_settings=Normalmente, você veria as configurações da extensão aqui. No entanto, esta página está incluída apenas como um exemplo para desenvolvedores, então você pode desconsiderar esta página.

# mod_permission.php - Permissions
permission_name=Acesso
permission_descr=Permissão para visualizar a página de conteúdo desta extensão e executar todas as funcionalidades disponíveis.

# mod_nav.php - Navigation
nav_title=Extensão de Exemplo

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Template: Módulo de Extensão
store_version_description=Exemplo de módulo de extensão para o módulo de Administrador, especialmente para desenvolvedores. Você pode obter mais informações sobre módulos de extensão na documentação do Suitefish e nos arquivos Readme.md relacionados no repositório!
