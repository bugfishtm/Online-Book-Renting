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

# mod_site.php - ページ
site_title=例のウェブサイト
site_heading_text=このページは、モジュール「_site」によって注入されました！
site_no_permission=このページを表示する権限がありません。
site_has_access=これは「Example Site Modules」拡張機能のページです。

# mod_setting.php - 設定
site_settings=通常、ここに拡張設定が表示されます。ただし、このページは開発者向けの例としてのみ含まれているため、無視してください。

# mod_permission.php - 権限
permission_name=アクセス
permission_descr=この拡張機能のコンテンツページを表示し、利用可能なすべての機能を実行する権限。

# mod_nav.php - ナビゲーション
nav_title=例のウェブサイト

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=テンプレート: ウェブサイトモジュール  
store_version_description=これは統合されたウェブサイトモジュールの例です！この種類のウェブサイトモジュールは、suitefish-cmsをプラットフォームとして使用し、1つのインスタンスでマルチサイトホスティングを可能にします！  
