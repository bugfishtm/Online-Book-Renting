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

## 오류
be_404_2=오류 404
be_404_1=요청한 콘텐츠가 존재하지 않습니다!
be_401_2=접근 거부됨
be_401_1=이 영역에 접근할 수 없습니다!
b_permissions=권한

## 팝업
be_edit_abort=작업을 중단하려면 여기를 클릭하세요!
be_list_h_exec_flush=이 테이블의 모든 항목이 삭제되었습니다!
be_list_h_btn_flush_rly=정말로 이 테이블을 초기화하시겠습니까? 관련 데이터베이스 테이블이 다시 초기화되며, 모든 이전 항목이 삭제됩니다!
be_list_h_btn_flush=테이블 초기화
be_cbanner_1=이 웹사이트는 세션 쿠키를 사용합니다!
be_cbanner_2=동의합니다
be_pp_hide=이 항목을 공개 도서 목록에서 숨기시겠습니까?
be_pp_unhide=이 항목을 공개 도서 목록에서 표시하시겠습니까?
be_pp_delbook=정말로 이 책을 삭제하시겠습니까? 이 작업은 모든 관련 정보와 해당 로그를 삭제합니다.
be_pp_errimage=유효한 JPG 파일을 선택하세요!
be_pp_errimage1=파일이 업로드되지 않았거나 업로드 중 오류가 발생했습니다.
be_pp_errimage2=업로드된 파일을 이동하는 중 오류가 발생했습니다.
be_pp_errimage3=잘못된 파일 형식입니다. JPG 파일만 허용됩니다.
be_pp_sapi=현재 도서 정보를 OpenLibrary에서 가져온 정보로 덮어씁니다. 표지 이미지도 교체됩니다!
be_pp_sapierr=OpenLibrary API와의 통신 중 오류가 발생했습니다!
be_pp_sr1=이 도서 항목을 정말 삭제하시겠습니까?
be_pp_sr2=이 책이 반납되어 다시 재고에 추가되었습니까?
be_pp_sr3=OpenLibrary API와의 통신 중 오류가 발생했습니다!

## 권한
be_tperm_page_deadlines=마감 기한 관리
be_dperm_page_deadlines=사용자에게 책을 대여하고 마감 기한을 관리할 수 있습니다.
be_tperm_page_books=도서 관리
be_dperm_page_books=도서 페이지 및 기능에 접근할 수 있으며, 도서를 생성, 편집 및 삭제할 수 있습니다.
be_tperm_page_tag=태그 관리
be_dperm_page_tag=도서 태그 페이지 및 기능에 접근할 수 있으며, 태그를 생성, 편집 및 삭제할 수 있습니다.
be_tperm_page_user=사용자 관리
be_dperm_page_user=사용자 페이지 및 기능에 접근할 수 있으며, 사용자를 생성하고 모든 사용자를 조회 및 관리할 수 있습니다.
be_tperm_page_blacklist=블랙리스트 관리
be_dperm_page_blacklist=IP 블랙리스트 페이지 및 기능에 접근할 수 있습니다.
be_tperm_page_logging=로그 관리
be_dperm_page_logging=로그 페이지 및 기능에 접근할 수 있습니다.
be_tperm_page_settings=설정 관리
be_dperm_page_settings=설정 페이지 및 기능에 접근할 수 있습니다.

## 이벤트
be_list_exec_idel=항목이 삭제되었습니다!
be_list_exec_iedit=항목이 변경되었습니다!
be_usr_ad_herem=필수 데이터를 입력해야 합니다!
be_usr_ad_hmailex=해당 이메일을 사용하는 다른 사용자가 이미 존재합니다! 다른 이메일을 선택하세요.
be_usr_ad_hmaok=사용자가 생성되었습니다!
be_str_item_created=항목이 생성되었습니다!

############################################################################################################################################1

## List Headers  
be_list_h_date=날짜  
be_list_h_id=ID  
be_list_h_ttype=유형  
be_list_h_ref=참조  
be_list_h_detail=세부정보  
be_list_h_ar=도착  
be_list_h_url=URL  
be_list_h_site=사이트  
be_list_h_err=오류  
be_list_h_rece=수신자  
be_list_h_content=내용  
be_list_h_time=시간  
be_list_h_ip=IP  
be_list_h_fails=실패  
be_list_h_delete=삭제  
be_user_area_adr=주소  
be_user_area_mail=이메일  
be_usr_ad_hmail=메일  

## Navigation  
be_deadlines=마감일  
be_profile=프로필  
be_logout=로그아웃  
be_tag=태그  
be_books=도서  
be_privacy=개인정보 보호  
be_impressum=출판 정보  
be_settings=설정  
be_blacklist=차단 목록  
be_logging=로그 기록  
be_user=사용자  
be_myprofile=내 프로필  
be_login=로그인  

## Tag Area  
be_tag_raw=태그  
be_tag_rawn=태그 이름  
be_tag_add=태그 추가  
be_tag_edit=태그 수정  
be_tag_chdele=정말로 이 태그를 삭제하시겠습니까?  
be_tag_exp=여기에서 태그를 관리할 수 있으며, 태그는 도서에 할당될 수 있습니다.  

## Blacklist Area  
be_exp_blacklist=차단된 IP를 여기에서 확인할 수 있습니다. 이 IP는 웹사이트에 로그인하거나 인증된 작업을 수행할 수 없습니다.  

## Logging Area  
be_exp_logging=이 시스템에서 수행된 활동의 기록을 확인할 수 있습니다.  

############################################################################################################################################2

## 도서 영역
be_book_add=도서 추가
be_booked_isbn=ISBN
be_booked_title=제목
be_booked_autor=저자
be_booked_descr=설명
be_booked_lang=언어
be_booked_released=출판일
be_booked_type=유형
be_booked_pub=출판사
be_vb_header_log=로그
be_vb_header_rentc=수량
be_vb_header_ima=표지
be_vb_header_det=세부 정보

## 마감 기한 영역
be_deadline_raw=마감 기한
be_deadline_exp=여기에서 대출 기한과 반납 기한을 확인할 수 있습니다.
be_table_header_book=도서
be_table_header_barcode=바코드
be_table_header_duedate=반납 기한

# 프로필 영역
b_prof_pwinfo=여기에서 로그인 비밀번호를 변경할 수 있습니다.
b_prof_mailinfo=여기에서 로그인 이메일을 변경할 수 있습니다.

## 사용자 영역
be_password_filter_setup=비밀번호는 다음 기준을 충족해야 합니다:<br />- 최소 10자 이상<br />- 최소 1개 이상의 대문자 포함<br />- 최소 1개 이상의 소문자 포함<br />- 최소 1개 이상의 숫자 포함

############################################################################################################################################3

## 일반
be_yes=예
be_no=아니요
b_in_time=정시
b_overdue=기한 초과
b_today_return=오늘 반납
b_view=보기
be_table_header_returndate=반납 날짜
b_active=활성
b_inactive=비활성
b_edit=수정
b_action=작업
b_delete=삭제
be_close=닫기
be_cancel=취소
b_description=설명
be_list=목록
be_none=없음
be_help=도움말
be_explanation=설명
b_nosslval=SSL 검증 없음
b_sslval=SSL 검증 강제
b_low=낮음
b_medium=중간
b_high=높음
b_apirequest=API와 동기화
b_barcode=바코드
b_add=추가
b_nolistcurrent=현재 목록에 항목이 없습니다!
b_backtolist=목록으로 돌아가기
b_hide=숨기기
b_unhide=숨김 해제
be_profile=프로필
b_creation=생성
b_lastmodification=마지막 수정
b_firstname=이름
b_lastname=성
b_street=거리
b_postcode=우편번호
b_country=국가
b_changeimage=이미지 변경
b_password=비밀번호
b_change_password=비밀번호 변경
b_email=이메일
b_change_email=이메일 변경
b_status=상태
b_id=ID
b_tags=태그
b_thisitemcurhiddenlist=이 항목은 현재 공개 목록에서 숨겨져 있습니다!
b_nobooktitlelist=알 수 없는 제목
b_hidden=숨김
b_lend=대여
b_return=반납
b_hardback=하드커버
b_paperback=페이퍼백
b_softcover=소프트커버
b_bookcurrentlyrented=이 책은 현재 다른 사용자에 의해 예약되었으며 곧 이용 가능합니다!
b_available=이용 가능
b_reserved=예약됨
b_user=사용자
b_until=까지
b_returndate=반납 날짜
b_note=메모
b_lendtouser=사용자에게 대여
b_changefavicon=파비콘 변경
b_settings_exp_string=이 페이지에서 웹사이트 기능을 제어할 수 있습니다.
b_tel=전화
be_pp_sr1ssd=책이 반납되었습니까?
be_error_booknoexists=조회하려는 책이 존재하지 않습니다!
be_error_usernoexists=조회하려는 사용자가 존재하지 않습니다!
be_puser_chdele3=사용자 활성화
b_prof_pwinfoadd=관리자는 인증 없이 사용자 이메일을 변경할 수 있습니다.

############################################################################################################################################4

## 설정 영역  
be_about_core_info=CMS 버전  
be_about_fw_info=프레임워크 버전  
be_about_site_info=모듈 버전  
be_set_header_general=일반 설정  
be_set_header_mail=이메일 설정  
be_set_header_trans=번역 설정  
be_set_header_about=시스템 정보  
be_string_key=키  
be_string_language=언어  
be_string_translation=번역  
be_trans_current_active=기본 번역  
be_trans_current_ovr=번역 재정의  
be_trans_button_create=번역 생성  
be_trans_button_edit=번역 수정  
be_trans_dlrly=정말로 이 번역을 삭제하시겠습니까?  
be_eexps_hivetitle=이 웹사이트의 제목입니다.  
be_eexps_imp=귀하의 인쇄물 정보  
be_eexps_pry=개인정보 보호 정책  
be_eexps_expiretoken=이메일 토큰이 만료되는 시간(분).  
be_eexps_expireip=블랙리스트에 추가되기 전 허용되는 IP 실패 횟수.  
be_eexps_expirecsrf=CSRF 키가 만료되기 전까지 유효한 시간(초).  
be_eexps_expireact=사용자가 비밀번호 복구/이메일 변경 요청을 다시 시도하기까지 기다려야 하는 시간(분).  
be_eexps_upgc=온사이트 업데이터를 액세스 코드로 보호.  
be_eexps_actmc=사용자가 이메일을 변경할 수 있도록 허용.  
be_eexps_actrec=사용자가 비밀번호를 복구할 수 있도록 허용.  
be_eexps_actreg=게스트가 이 웹사이트에 등록할 수 있도록 허용.  
be_eexps_actdeflang=사용자가 기본 언어를 설정하지 않은 경우, 기본적으로 제공할 언어.  
be_eexps_trapage=이 섹션에서는 기본 번역을 확인하고 필요하면 재정의할 수 있습니다.  
be_eexpm_user=이메일 서버 사용자 이름  
be_eexpm_pass=이메일 서버 비밀번호  
be_eexpm_host=SMTP 호스트 이름  
be_eexpm_port=SMTP 포트  
be_eexpm_auth=SMTP 인증 방식  
be_eexpm_sm=발신 이메일 주소  
be_eexpm_sn=발신자 이름  
be_eexpm_mh=기본 이메일 헤더  
be_eexpm_debug=이메일 전송 중 문제가 발생하면 디버깅을 활성화할 수 있습니다. 활성화하면 전송 성공 여부와 관계없이 화면에 디버그 정보가 표시됩니다.  
be_eexpm_ins=안전하지 않은 SMTP 연결 허용  
be_eexpm_mf=기본 이메일 푸터  

## 도서 정보 입력  
obr_inp_title=제목  
obr_inp_autor=저자  
obr_inp_publisher=출판사  
obr_inp_isbn=ISBN  
obr_inp_lang=언어  
obr_inp_tags=태그  

## 도서 목록  
be_obr_li_id=도서 ID  
be_obr_li_book_title=제목  
be_obr_li_book_autor=저자  
be_obr_li_book_type=도서 유형  
be_obr_li_book_publisher=출판사  
be_obr_li_book_isbn=ISBN  
be_obr_li_book_lang=언어  
be_obr_li_book_tag_array=연결된 카테고리  
be_obr_li_book_creation=생성 날짜  
be_obr_li_book_modification=수정 날짜  

## 도서 관리  
be_obr_update_book=ISBN으로 도서 데이터 가져오기  
be_obr_delete_book=도서 삭제  
be_obr_add_stock=대여 가능 항목  
obr_book_item_list=대여 가능 항목 목록  

## 사용자 관리  
be_op_usr_622=사용자 정보가 수정되었습니다.  

############################################################################################################################################5

string_add=추가
be_exp_usrlst=여기에서 사용자를 관리하고 생성할 수 있습니다.
be_user_area_usrname=이름
be_opok=이 사이트를 보고 있는 이유는 활성화를 요청했기 때문입니다.<br/>세부 사항은 오른쪽 상단의 이벤트 상자를 확인하세요.
be_operr=오류
be_str_item_createderr=API 토큰을 생성할 수 없습니다. 일반적으로 이 토큰이 이미 관련 사이트 모듈에 존재하는 경우 발생합니다!
be_mail_template_edit=메일 템플릿 수정
be_mail_exp_recover=등록된 사용자의 비밀번호 복구를 위한 이메일 템플릿입니다. 이 템플릿은 사용자가 '비밀번호 찾기' 기능을 통해 새 비밀번호를 요청할 때 전송됩니다. 사용자가 링크를 받을 수 있도록 _ACTION_URL_을 포함한 대체 변수가 설정됩니다.
be_mail_exp_mchange=등록된 사용자 이메일 변경을 위한 이메일 템플릿입니다. 이 템플릿은 사용자가 기본 이메일을 변경하거나 시스템에서 이메일이 변경될 때 전송됩니다. 새로운 이메일을 활성화하고 확인할 수 있도록 _ACTION_URL_을 포함한 대체 변수가 설정됩니다.
be_mail_exp_acti=등록된 사용자의 계정을 활성화하기 위한 이메일 템플릿입니다. 이 템플릿은 사용자가 생성될 때 또는 기업 직원이 추가될 때 전송됩니다. 사용자가 새 계정을 활성화할 수 있도록 _ACTION_URL_을 포함한 대체 변수가 설정됩니다. 사용자는 비밀번호 복구 기능을 통해 계정을 활성화할 수도 있습니다.
be_se_key_mch=메일 활성화 키
b_permission=권한
be_user_area_name=사용자 관리
be_user_area_create=사용자 추가
be_usr_ad_errgm=사용자가 생성되었지만 활성화 이메일을 보내는 중 오류가 발생했습니다!
be_noti_user_crea=사용자가 계정을 확인하지 않았고, 다른 사용자가 동일한 이메일로 가입하려고 하면 초기 미확인 사용자가 삭제될 수 있습니다. 이는 데이터 손실로 이어질 수 있으므로 확인된 사용자와만 작업하는 것이 중요합니다. 사용자를 미확인 상태로 변경하는 기능을 사용하지 마십시오. 데이터 손실이 발생할 수 있습니다.
be_usr_ad_errg=사용자 생성 중 오류가 발생했습니다.
be_usr_ad_hpasserem=선택한 비밀번호가 보안 권장 사항을 충족하지 않습니다!
be_usr_ad_hpass=비밀번호
be_usr_ad_h=활성화 절차
be_usr_ad_rec=메일 활성화를 요청하고 사용자가 직접 비밀번호 설정
be_usr_ad_act=메일을 통한 활성화만 요청
be_usr_ad_ok=별도의 활성화 절차 없이 이 사용자 활성화
be_puser_noview=해당 사용자가 존재하지 않습니다!
be_puser_cpass=비밀번호 변경
be_puser_cpass1=비밀번호 확인
be_puser_cpass2=새 비밀번호
be_puser_cper=권한 변경
be_puser_chmm=이메일 변경
be_puser_chmm1=새 이메일
be_puser_chdele=사용자 삭제
be_puser_chdele1=사용자 작업
be_puser_chdele7=이 사용자는 현재 이메일로 확인되지 않았습니다!
be_puser_chdele8=이 사용자는 현재 차단되었습니다!
be_puser_chdele9=이 사용자는 현재 비활성화되었습니다!
be_puser_chdele10=이 계정은 초기 슈퍼 관리자 계정입니다! 항상 관리 패널에 대한 전체 액세스 권한을 가집니다!
be_puser_chdele11=이 프로필은 다른 사용자에게 속해 있습니다! 설정을 변경할 때 주의하세요. 변경 사항이 사용자 경험에 영향을 미칠 수 있습니다.
be_puser_chdele12=새 이메일 활성화를 기다리는 중:
be_puser_chdele13=작업을 취소하려면 여기를 클릭하세요.
be_puser_chdele14=이메일을 비울 수 없습니다!
be_puser_chdele15=알 수 없는 오류
be_puser_chdele16=이 사용자는 현재 이메일 변경 기능이 비활성화되어 있습니다!
be_puser_chdele17=이 사용자의 이메일을 변경하는 것은 허용되지 않습니다.
be_puser_chdele18=이미 해당 이메일을 사용하는 활성 사용자가 있습니다! 사용자 간 이메일 중복은 불가능합니다.
be_puser_chdele19=이메일 변경 요청 간 일정 시간이 필요합니다: 
be_puser_chdele20=분
be_puser_chdele21=새 이메일을 활성화하려면 받은 편지함을 확인하세요!
be_puser_chdele22=활성화 이메일을 보내는 중 오류가 발생했습니다!
be_puser_chdele23=이메일 변경 요청이 취소되었습니다!
be_op_usr_1=비밀번호는 숫자 하나, 소문자 하나, 대문자 하나를 포함해야 합니다! 최소 10자 이상이어야 합니다.
be_op_usr_2=비밀번호는 비워둘 수 없습니다!
be_op_usr_3=비밀번호가 일치하지 않습니다!
be_op_usr_4=비밀번호가 변경되었습니다!
be_op_usr_6=사용자 권한이 변경되었습니다!
be_op_usr_11=사용자가 확인되었으며 이제 로그인할 수 있습니다!
be_op_usr_12=사용자가 삭제되었습니다!
be_book_area_create=도서 추가
