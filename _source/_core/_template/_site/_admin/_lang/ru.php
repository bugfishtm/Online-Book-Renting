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
site_title=Пример веб-сайта
site_heading_text=Эта страница была вставлена модулем Example Website "_site"!
site_no_permission=У вас нет прав для просмотра этой страницы.
site_has_access=Это страница расширения Example Site Modules.

# mod_setting.php - Settings
site_settings=Обычно здесь отображаются настройки расширений. Однако эта страница включена только как пример для разработчиков, поэтому вы можете проигнорировать её.

# mod_permission.php - Permissions
permission_name=Доступ
permission_descr=Разрешение на просмотр страницы содержимого этого расширения и выполнение всех доступных функций.

# mod_nav.php - Navigation
nav_title=Пример веб-сайта

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Шаблон: Модуль веб-сайта  
store_version_description=Это пример интегрированного модуля веб-сайта! Такой тип модулей использует suitefish-cms как платформу, позволяя размещать несколько сайтов в одном экземпляре!  
