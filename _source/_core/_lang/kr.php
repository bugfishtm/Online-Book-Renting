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
## Backend Default Language Overrides for Login Scripts
##########################################################################################

# Strings - General
string_email=이메일
string_password=비밀번호
string_login=로그인
string_register=회원가입
string_close=닫기
string_error=오류

# Page - Actions
hive_login_changelanguage=언어를 변경할 수 있습니다
hive_login_changelanguage_here=여기에서.
hive_login_lostpass=비밀번호를 잊으셨나요?
hive_login_notregistered=회원이 아니신가요?
hive_login_rememberme=쿠키를 사용하시겠습니까?
hive_login_recoveraccount=계정 복구
hive_login_haveaccount=계정이 이미 있으신가요?
hive_login_password_confirm=비밀번호 확인
hive_login_mc_change_mail=이메일 변경
hive_login_mc_backtohome=홈으로 돌아가기
hive_login_title_accactivation=계정 활성화
hive_cannotenterwhilenologin=로그인하지 않으면 이 페이지에 접근할 수 없습니다!
hive_cannotenterwhilelogin=로그인 상태에서는 이 페이지에 접근할 수 없습니다!
hive_cannotoperatesiteerror=사이트 모듈에 치명적인 오류가 발생하여 현재 작업을 실행할 수 없습니다!
hive_login_backtologin=로그인 화면으로 돌아가기
hive_login_change_Lang=언어 변경
hive_login_language_changed=언어가 변경되었습니다!

# Login Events - General
hive_login_msg_l_wrong=잘못된 비밀번호/이메일 조합입니다.
hive_login_msg_csrf=폼이 만료되었습니다. 다시 시도해주세요.
hive_login_msg_empty=필수 데이터를 입력해주세요!
hive_login_msg_ipban=현재 귀하의 IP가 차단되었습니다. 나중에 다시 시도해주세요.
hive_login_msg_logout=로그아웃되었습니다!
hive_login_msg_nomatchpass=입력한 비밀번호와 비밀번호 확인이 일치하지 않습니다.
hive_login_doremember=비밀번호를 기억하시겠습니까?

# Login Events - Login
hive_login_msg_l_ok=로그인 성공.
hive_login_msg_l_blocked=계정이 차단되어 로그인이 불가능합니다.
hive_login_msg_l_inactive=사용자 계정이 아직 활성화되지 않았습니다! 비밀번호를 복구하여 계정을 활성화하거나 받은 이메일의 URL을 클릭하세요!
hive_login_msg_l_blockedpwf=비밀번호를 너무 많이 잘못 입력하여 계정이 차단되었습니다!
hive_login_msg_l_disabled=사용자 계정이 비활성화되었습니다!
hive_login_mail_serror=이메일 전송 중 오류가 발생했습니다. 이는 내부 오류로, 웹사이트 담당자에게 보고해야 합니다.
hive_login_msg_register_ok=새 계정을 활성화하려면 이메일 받은편지함을 확인하세요!
hive_login_msg_passfiltererror=입력한 비밀번호가 비밀번호 규칙을 충족하지 않습니다!
hive_login_msg_mailexist=이미 존재하는 이메일로 계정을 등록하려고 하고 있습니다!
hive_login_password_rules=비밀번호 규칙
hive_login_password_sign=필수 문자:
hive_login_password_cap=필수 대문자:
hive_login_password_small=필수 소문자:
hive_login_password_special=필수 특수 문자:
hive_login_password_numeric=필수 숫자:

# Login Events - Mail Change
hive_login_msg_m_ok=새 이메일이 성공적으로 활성화되었습니다!
hive_login_msg_m_er=새 이메일 주소를 활성화하는 중 오류가 발생했습니다. 다시 시도해주세요.
hive_login_msg_m_exp=이메일 활성화 코드가 만료되었습니다! 이메일 변경을 다시 시도해주세요.
hive_login_msg_m_res=활성화하려는 이메일이 다른 계정에서 사용 중이어서 귀하의 계정과 연결할 수 없습니다!
hive_login_msg_m_block=귀하의 계정은 이메일 변경이 차단되었습니다!
hive_login_msg_m_noadr=요청이 실패했습니다. 나중에 다시 시도해주세요.
hive_login_mc_cmailtext=현재 이메일은 다음과 같습니다:
hive_login_msg_rec_ok=새 이메일 받은편지함을 확인하여 새 이메일 주소를 활성화하세요.
hive_login_msg_rec_err=이메일 주소 변경 중 오류가 발생했습니다.
hive_login_msg_rec_wait=이메일 변경 간 120분을 기다려야 합니다!
hive_login_msg_rec_exist=변경하려는 이메일이 이미 다른 사용자 계정에서 사용 중입니다!
hive_login_msg_rec_block=귀하의 계정은 이메일 변경이 차단되었습니다!
hive_login_msg_rec_disable=비활성화된 계정의 이메일은 변경할 수 없습니다!

# Login Mails
hive_login_mail_pre_change=새 이메일을 활성화하려면 여기로 이동하세요: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=새 이메일 활성화
hive_login_mail_title_register=새 계정 활성화
hive_login_mail_pre_register=계정을 활성화하려면 다음 링크를 클릭하세요: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=계정 복구
hive_login_mail_pre_rec=계정 비밀번호를 복구하려면 다음 링크를 클릭하세요: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=계정이 성공적으로 활성화되었습니다! 이 웹사이트의 로그인 페이지에서 로그인할 수 있습니다.
hive_login_msg_a_er=사용자 계정을 활성화하는 중 오류가 발생했습니다. 계정 비밀번호를 복구하거나 새 계정을 등록하세요.
hive_login_msg_a_exp=활성화 토큰이 유효하지 않습니다. 계정을 활성화하려면 로그인 페이지에서 계정을 복구하세요!
hive_login_msg_a_block=계정 활성화가 비활성화되었습니다. 나중에 다시 시도해주세요!

# Login - Recover Request
hive_login_msg_rr_recnewunk=제공된 이메일이 등록되어 있지 않습니다.
hive_login_msg_rr_recnope=계정에 비밀번호 복구 권한이 없습니다!
hive_login_msg_rr_recnopede=계정이 비활성화되어 새 요청을 만들 수 없습니다!
hive_login_msg_rr_recwait=새 복구 요청을 시작하기 전에 120분을 기다려야 합니다!
hive_login_msg_rr_recnok=비밀번호 재설정 이메일을 확인하세요. 이 이메일에는 비밀번호를 복구하는 링크가 포함되어 있습니다.
hive_login_msg_recfr_ok=비밀번호 복구 링크를 받으려면 이메일 받은편지함을 확인하세요!

# Login - Recover Execute
hive_login_msg_pwtexpire=비밀번호 복구 토큰이 만료되었습니다! 계정 복구를 다시 시도해주세요.
hive_login_msg_recexecerror=비밀번호를 복구하는 중 오류가 발생했습니다. 계정 복구를 다시 시도해주세요.
hive_login_msg_recexecok=비밀번호를 성공적으로 복구했습니다. 이제 새 비밀번호로 로그인할 수 있습니다.

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=테마: 동적 테마 색상에 대한 기본 색상
hive_var_exp_2=테마: 유효한 테마의 직렬화된 배열
hive_var_exp_3=테마: 기본 사용 테마
hive_var_exp_4=언어: 유효한 언어의 직렬화된 배열
hive_var_exp_5=언어: 기본 언어 배열
hive_var_exp_6=액션: 일반 등록 양식 활성화? (1=켜짐/0=꺼짐)
hive_var_exp_7=설명 없음
hive_var_exp_8=액션: 일반 복구 양식 활성화? (1=켜짐/0=꺼짐)
hive_var_exp_9=액션: 일반 활성화 양식 활성화? (1=켜짐/0=꺼짐)
hive_var_exp_10=일반 로그인 양식 활성화? (1=켜짐/0=꺼짐)
hive_var_exp_11=TinyMCE: 플러그인 구성 문자열
hive_var_exp_12=TinyMCE: 메뉴 바 구성 문자열
hive_var_exp_13=TinyMCE: 툴 바 구성 문자열
hive_var_exp_14=사용자 구성: 세션/쿠키가 유효한 최대 일수
hive_var_exp_15=사용자 구성: 활성화 메일의 유효한 토큰 시간 (분)
hive_var_exp_16=사용자 구성: X회 로그인 실패 후 사용자 차단 (0이면 비활성화)
hive_var_exp_17=사용자 구성: 요청 간 사용자 대기 시간 (분 단위, 플러드 방지)
hive_var_exp_18=사용자 구성: 오래된 세션 기록? (로그인, 복구, 활성화, 메일 변경) (1=켜짐/0=꺼짐)
hive_var_exp_19=사용자 구성: 데이터베이스에 사용자 IP 기록 (1=켜짐/0=꺼짐)
hive_var_exp_20=사용자 구성: 1 - 사용자 로그인 후 복구 키 삭제 | 0 - 키 보존
hive_var_exp_21=사용자 구성: 1 - 다중 로그인 허용 | 0 - 다중 로그인 비활성화
hive_var_exp_22=비밀번호 필터: 최소 문자 수
hive_var_exp_23=비밀번호 필터: 최소 대문자 수
hive_var_exp_24=비밀번호 필터: 최소 소문자 수
hive_var_exp_25=비밀번호 필터: 최소 특수 문자 수
hive_var_exp_26=비밀번호 필터: 최소 숫자 수
hive_var_exp_27=초기 생성된 사용자 이름
hive_var_exp_28=초기 생성된 사용자 비밀번호
hive_var_exp_29=캡차: 이미지 높이
hive_var_exp_30=캡차: 이미지 너비
hive_var_exp_31=캡차: 캡차 색상 (선택 사항, 0일 수 있음)
hive_var_exp_32=캡차: 폰트 (0이면 기본 폰트 사용)
hive_var_exp_33=Redis: 활성화됨? 1/0
hive_var_exp_34=Redis: 호스트
hive_var_exp_35=Redis: 포트
hive_var_exp_36=업데이트: 이 사이트의 업데이트 제목
hive_var_exp_37=업데이트: 업데이트에 필요한 코드? (0이면 비활성화)
hive_var_exp_38=설정: CURL 클래스 요청 기록? (1/0)
hive_var_exp_39=설정: X회 실패 후 IP 차단 (0이면 비활성화)
hive_var_exp_40=설정: 리퍼러 기록? (1/0)
hive_var_exp_41=설정: 기본 CSRF 코드 유효 시간 (초)
hive_var_exp_42=설정: 1 - 명령줄에서만 크론 작업 실행 | 0 - 브라우저에서 크론 작업 실행 허용
hive_var_exp_43=설정: 자바스크립트 디버깅 오류 로그 활성화 (1/0)
hive_var_exp_44=설정: 웹사이트 탭 및 기타 제목
hive_var_exp_45=설정: 브라우저 탭의 제목 구분자
hive_var_exp_46=설정: 웹사이트에서 PHP 오류 표시? (1/0)
hive_var_exp_47=설정: 필요한 PHP 모듈이 있는 직렬화된 배열, 없으면 오류 표시 (예: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=설정: 페이지에서 MySQL 오류를 멈추고 표시할까요? (항상 x_log_mysql 테이블에 기록됨) (1/0)
hive_var_exp_49=설정: 1 - SEO URL 사용 | 0 - SEO URL 사용 안 함
hive_var_exp_50=설정: _HIVE_URL_SEO_ == false일 경우에만 필요 [직렬화된 배열에서 위치 변수 이름]
hive_var_exp_51=메일 설정: SMTP 비밀번호
hive_var_exp_52=메일 설정: SMTP 사용자 이름
hive_var_exp_53=메일 설정: SMTP 인증 (ssl/tls/false)
hive_var_exp_54=메일 설정: SMTP 포트
hive_var_exp_55=메일 설정: SMTP 호스트
hive_var_exp_56=메일 설정: 메일 디버그 모드 (0, 1, 2, 3) - 프로덕션에서는 0을 사용하세요. 디버그 출력이 사이트에 표시됩니다!
hive_var_exp_57=메일 설정: 불안전한 SSL 연결 허용? (1/0)
hive_var_exp_58=메일 설정: 모든 메일을 HTML로 보내기? (1/0)
hive_var_exp_59=메일 설정: 기본 발신자 메일 이름
hive_var_exp_60=메일 설정: 기본 발신자 메일 주소
hive_var_exp_61=메일 설정: 기본 메일 바닥글
hive_var_exp_62=메일 설정: 기본 메일 머리글
