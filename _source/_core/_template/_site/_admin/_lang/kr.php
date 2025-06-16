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
site_title=예시 웹사이트
site_heading_text=이 페이지는 예시 웹사이트 모듈 "_site"에 의해 삽입되었습니다!
site_no_permission=이 페이지를 볼 권한이 없습니다.
site_has_access=이 페이지는 예시 사이트 모듈 확장 페이지입니다.

# mod_setting.php - Settings
site_settings=보통 이곳에서 확장 설정을 볼 수 있습니다. 그러나 이 페이지는 개발자를 위한 예시로만 포함되었으므로 이 페이지는 무시하셔도 됩니다.

# mod_permission.php - Permissions
permission_name=액세스
permission_descr=이 확장의 콘텐츠 페이지를 보고 모든 사용 가능한 기능을 실행할 수 있는 권한.

# mod_nav.php - Navigation
nav_title=예시 웹사이트

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=템플릿: 웹사이트 모듈  
store_version_description=이것은 통합된 웹사이트 모듈 예제입니다! 이러한 유형의 웹사이트 모듈은 suitefish-cms를 플랫폼으로 사용하여 하나의 인스턴스로 다중 사이트 호스팅을 제공합니다!  
