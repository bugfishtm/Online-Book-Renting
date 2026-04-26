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
store_version_name=Шаблон: Модуль Docker
store_version_description=Пример модуля Docker для расширения Docker Server Manager в нашем административном модуле, особенно для разработчиков. Более подробную информацию о модулях Docker можно найти в документации Suitefish и связанных файлах Readme.md в репозитории!

##########################################################################################
## Substitution Explanation Translations
##########################################################################################
var_password=Укажите пароль, который будет создан при настройке контейнера для доступа к базе данных MySQL.
var_user=Укажите имя пользователя, которое будет создано при настройке контейнера для доступа к базе данных MySQL.
var_port=Укажите порт для экземпляра MySQL на хост-системе.
