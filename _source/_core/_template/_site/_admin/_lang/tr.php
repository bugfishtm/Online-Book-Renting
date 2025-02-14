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
site_title=Örnek Web Sitesi
site_heading_text=Bu sayfa Example Website modülü "_site" tarafından eklenmiştir!
site_no_permission=Bu sayfayı görüntüleme izniniz yok.
site_has_access=Bu, Example Site Modülleri Uzantısı sayfasıdır.

# mod_setting.php - Settings
site_settings=Normalde burada uzantı ayarlarını görmelisiniz. Ancak bu sayfa yalnızca geliştiriciler için bir örnek olarak dahil edilmiştir, bu yüzden bu sayfayı göz ardı edebilirsiniz.

# mod_permission.php - Permissions
permission_name=Erişim
permission_descr=Bu uzantının içerik sayfasını görüntüleme ve tüm mevcut işlevleri çalıştırma izni.

# mod_nav.php - Navigation
nav_title=Örnek Web Sitesi

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=Şablon: Web Sitesi Modülü  
store_version_description=Bu, entegre bir web sitesi modülü örneğidir! Bu tür web sitesi modülleri, tek bir örnek ile çoklu site barındırmaya izin vermek için suitefish-cms platformunu kullanır!  
