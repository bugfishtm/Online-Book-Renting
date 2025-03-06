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
## Store Versioning Translations
##########################################################################################
store_version_name=Modèle : Module Docker
store_version_description=Exemple de module Docker pour l'extension Docker Server Manager de notre module administrateur, particulièrement pour les développeurs. Vous pouvez obtenir plus d'informations sur les modules Docker dans la documentation Suitefish et les fichiers Readme.md associés dans le dépôt.

##########################################################################################
## Substitution Explanation Translations
##########################################################################################
var_password=Définissez un mot de passe à créer lors de la configuration du conteneur pour l'accès à la base de données MySQL.
var_user=Définissez un nom d'utilisateur à créer lors de la configuration du conteneur pour l'accès à la base de données MySQL.
var_port=Définissez un port pour l'instance MySQL sur le système hôte.
