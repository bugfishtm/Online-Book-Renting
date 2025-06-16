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
store_version_name=템플릿: Docker 모듈
store_version_description=관리자 모듈을 위한 Docker 서버 관리 확장용 Docker 모듈 예제입니다. 특히 개발자를 위해 설계되었습니다. Docker 모듈에 대한 자세한 정보는 Suitefish 문서와 리포지토리 내의 Readme.md 파일에서 확인할 수 있습니다.

##########################################################################################
## Substitution Explanation Translations
##########################################################################################
var_password=MySQL 데이터베이스 액세스를 위한 컨테이너 설정 중 생성할 비밀번호를 정의하십시오.
var_user=MySQL 데이터베이스 액세스를 위한 컨테이너 설정 중 생성할 사용자 이름을 정의하십시오.
var_port=호스트 시스템에서 MySQL 인스턴스의 포트를 정의하십시오.
