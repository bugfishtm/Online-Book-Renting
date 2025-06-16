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

# mod_site.php - 页面
site_title=示例网站
site_heading_text=此页面由示例网站模块“_site”注入！
site_no_permission=您无权查看此页面。
site_has_access=这是示例站点模块扩展页面。

# mod_setting.php - 设置
site_settings=通常，您会在此处看到扩展设置。然而，此页面仅作为开发者的示例，因此您可以忽略此页面。

# mod_permission.php - 权限
permission_name=访问
permission_descr=查看此扩展功能的内容页面并执行所有可用功能的权限。

# mod_nav.php - 导航
nav_title=示例网站

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=模板: 网站模块  
store_version_description=这是一个集成网站模块示例！这种网站模块使用 suitefish-cms 作为平台，以允许单个实例进行多站点托管！  
