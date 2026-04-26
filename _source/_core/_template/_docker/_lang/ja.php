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
store_version_name=テンプレート: Dockerモジュール
store_version_description=管理者モジュールのためのDockerサーバーマネージャー拡張用のDockerモジュール例、特に開発者向けです。Dockerモジュールに関する詳細情報は、Suitefishドキュメントおよびリポジトリ内のReadme.mdファイルで確認できます。

##########################################################################################
## Substitution Explanation Translations
##########################################################################################
var_password=MySQLデータベースアクセスのためのコンテナセットアップ時に作成するパスワードを定義します。
var_user=MySQLデータベースアクセスのためのコンテナセットアップ時に作成するユーザー名を定義します。
var_port=ホストシステム上のMySQLインスタンスのポートを定義します。
