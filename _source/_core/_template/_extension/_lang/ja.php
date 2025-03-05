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
site_title=例の拡張機能
site_heading_text=このページは例の拡張機能モジュールによって挿入されました！
site_no_permission=このページを見る権限がありません。
site_has_access=これは例の拡張機能のページです。

# mod_setting.php - Settings
site_settings=通常、ここに拡張機能の設定が表示されます。しかし、このページは開発者向けの例としてのみ含まれているため、このページは無視して構いません。

# mod_permission.php - Permissions
permission_name=アクセス
permission_descr=この拡張機能のコンテンツページを見る権限と、すべての利用可能な機能を実行する権限。

# mod_nav.php - Navigation
nav_title=例の拡張機能

##########################################################################################
## Store Versioning Translations
##########################################################################################
store_version_name=テンプレート：拡張モジュール
store_version_description=管理者モジュール向けの拡張モジュールの例で、特に開発者向けです。拡張モジュールに関する詳細は、Suitefishのドキュメントやリポジトリ内の関連Readme.mdファイルで確認できます！
