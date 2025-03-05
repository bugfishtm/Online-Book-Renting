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


## Error
be_404_2=错误 404
be_404_1=请求的内容不存在！
be_401_2=访问被拒
be_401_1=您没有访问此区域的权限！
b_permissions=权限

## Popups
be_edit_abort=点击此处中止操作！
be_list_h_exec_flush=此表格中的所有项目已被删除！
be_list_h_btn_flush_rly=您确定要刷新此表格吗？这将重新初始化此相关数据库表并删除其中的所有旧条目！
be_list_h_btn_flush=刷新表格
be_cbanner_1=本网站使用会话 cookies！
be_cbanner_2=我同意
be_pp_hide=您确定要在公共书单中隐藏此项吗？
be_pp_unhide=您确定要在公共书单中显示此项吗？
be_pp_delbook=您确定要删除此书籍吗？这将删除所有相关信息及其日志。
be_pp_errimage=请选择有效的jpg文件！
be_pp_errimage1=没有上传文件或上传过程中出错。
be_pp_errimage2=上传文件时出错。
be_pp_errimage3=文件类型无效。仅允许上传JPG文件。
be_pp_sapi=这将用从openLibrary获取的信息覆盖当前的书籍信息。封面图片也将被替换！
be_pp_sapierr=尝试与openLibrary API通信时出错！
be_pp_sr1=您确定要删除此书籍项目吗？
be_pp_sr2=这本书已重新上架并已归还吗？
be_pp_sr3=尝试与openLibrary API通信时出错！

## Permissions
be_tperm_page_deadlines=管理截止日期
be_dperm_page_deadlines=可以向用户租赁书籍并管理截止日期。
be_tperm_page_books=管理书籍
be_dperm_page_books=访问书籍页面及其功能，可以创建、编辑和删除书籍。
be_tperm_page_tag=管理标签
be_dperm_page_tag=访问书籍标签页面及其功能，可以创建、编辑和删除标签。
be_tperm_page_user=管理用户
be_dperm_page_user=访问用户页面及其功能，可以创建用户并查看/管理所有用户。
be_tperm_page_blacklist=管理黑名单
be_dperm_page_blacklist=访问IP黑名单页面及其功能。
be_tperm_page_logging=管理日志
be_dperm_page_logging=访问日志页面及其功能。
be_tperm_page_settings=管理设置
be_dperm_page_settings=访问设置页面及其功能。

## Events
be_list_exec_idel=项目已被删除！
be_list_exec_iedit=项目已被更改！
be_usr_ad_herem=您需要填写所需的数据！
be_usr_ad_hmailex=该邮件已被其他用户使用！请为此用户选择另一个邮件。
be_usr_ad_hmaok=用户已创建！
be_str_item_created=项目已创建！


############################################################################################################################################1

## List Headers
be_list_h_date=日期
be_list_h_id=ID
be_list_h_ttype=类型
be_list_h_ref=参考
be_list_h_detail=详细信息
be_list_h_ar=到货
be_list_h_url=网址
be_list_h_site=站点
be_list_h_err=错误
be_list_h_rece=接收者
be_list_h_content=内容
be_list_h_time=时间
be_list_h_ip=IP
be_list_h_fails=失败
be_list_h_delete=删除
be_user_area_adr=地址
be_user_area_mail=电子邮件
be_usr_ad_hmail=邮件

## Navigation
be_deadlines=截止日期
be_profile=个人资料
be_logout=登出
be_tag=标签
be_books=书籍
be_privacy=隐私
be_impressum=版权声明
be_settings=设置
be_blacklist=黑名单
be_logging=日志
be_user=用户
be_myprofile=我的资料
be_login=登录

## Tag Area
be_tag_raw=标签
be_tag_rawn=标签名称
be_tag_add=添加标签
be_tag_edit=编辑标签
be_tag_chdele=您确定要删除此标签吗？
be_tag_exp=在此处管理标签，标签可以分配给书籍。

## Blacklist Area
be_exp_blacklist=这里可以查看被屏蔽的IP。这些IP将无法登录到此网站或执行身份验证操作。

## Logging Area
be_exp_logging=在此处查看系统活动的日志。

############################################################################################################################################2

## Book Area
be_book_add=添加书籍
be_booked_isbn=ISBN
be_booked_title=书名
be_booked_autor=作者
be_booked_descr=描述
be_booked_lang=语言
be_booked_released=发布日期
be_booked_type=类型
be_booked_pub=出版社
be_vb_header_log=日志
be_vb_header_rentc=数量
be_vb_header_ima=封面
be_vb_header_det=详情

## Deadline Area
be_deadline_raw=截止日期
be_deadline_exp=在此处查看开放的截止日期和书籍归还日期。
be_table_header_book=书籍
be_table_header_barcode=条形码
be_table_header_duedate=到期日期

# Profile Area
b_prof_pwinfo=在此处可以更改登录密码。
b_prof_mailinfo=在此处可以更改登录电子邮件。

## User Area
be_password_filter_setup=密码必须满足以下条件：<br />- 至少10个字符<br />- 至少1个大写字母<br />- 至少1个小写字母<br />- 至少1个数字



############################################################################################################################################3

be_yes=是
be_no=否
b_in_time=按时
b_overdue=超时
b_today_return=今天归还
b_view=查看
be_table_header_returndate=归还日期
b_active=激活
b_inactive=非激活
b_edit=编辑
b_action=操作
b_delete=删除
be_close=关闭
be_cancel=取消
b_description=描述
be_list=列表
be_none=无
be_help=帮助
be_explanation=说明
b_nosslval=无SSL验证
b_sslval=强制SSL验证
b_low=低
b_medium=中
b_high=高
b_apirequest=与API同步
b_barcode=条形码
b_add=添加
b_nolistcurrent=当前列表中没有项目！
b_backtolist=返回列表
b_hide=隐藏
b_unhide=取消隐藏
be_profile=个人资料
b_creation=创建
b_lastmodification=最后修改
b_firstname=名
b_lastname=姓
b_street=街道
b_postcode=邮政编码
b_country=国家
b_changeimage=更改图片
b_password=密码
b_change_password=更改密码
b_email=电子邮件
b_change_email=更改电子邮件
b_status=状态
b_id=ID
b_tags=标签
b_thisitemcurhiddenlist=此项目前在公共列表中隐藏！
b_nobooktitlelist=未知标题
b_hidden=已隐藏
b_lend=借出
b_return=归还
b_hardback=精装
b_paperback=平装
b_softcover=软皮
b_bookcurrentlyrented=此书目前已被另一用户预定，稍后会可用！
b_available=可用
b_reserved=已预定
b_user=用户
b_until=直到
b_returndate=归还日期
b_note=备注
b_lendtouser=借给用户
b_changefavicon=更改网站图标
b_settings_exp_string=在此页面，您可以控制网站功能。
b_tel=电话
be_pp_sr1ssd=此书是否已归还？
be_error_booknoexists=您尝试查看的书籍不存在！
be_error_usernoexists=您尝试查看的用户不存在！
be_puser_chdele3=启用用户
b_prof_pwinfoadd=作为管理员，您可以在无需激活的情况下更改用户邮件。


############################################################################################################################################4

be_about_core_info=CMS版本
be_about_fw_info=框架版本
be_about_site_info=模块版本
be_set_header_general=常规设置
be_set_header_mail=电子邮件设置
be_set_header_trans=翻译设置
be_set_header_about=系统信息
be_string_key=键
be_string_language=语言
be_string_translation=翻译
be_trans_current_active=默认翻译
be_trans_current_ovr=翻译覆盖
be_trans_button_create=创建翻译
be_trans_button_edit=编辑翻译
be_trans_dlrly=您确定要删除此翻译吗？
be_eexps_hivetitle=此网站的标题。
be_eexps_imp=您的印记文本
be_eexps_pry=您的隐私文本
be_eexps_expiretoken=电子邮件令牌将在特定时间后过期。
be_eexps_expireip=IP失败限制，超过此限制将被列入黑名单。
be_eexps_expirecsrf=CSRF密钥在过期前有效的秒数。
be_eexps_expireact=用户需要等待的时间（分钟），以便进行密码恢复或邮件更改请求。
be_eexps_upgc=通过访问代码保护网站更新器。
be_eexps_actmc=允许用户更改其电子邮件。
be_eexps_actrec=允许用户恢复其密码。
be_eexps_actreg=允许访客在此网站上注册。
be_eexps_actdeflang=如果访客没有设置自己的语言，则使用默认语言。
be_eexps_trapage=在此部分，您可以查看默认翻译并在需要时进行覆盖。
be_eexpm_user=电子邮件服务器用户名
be_eexpm_pass=电子邮件服务器密码
be_eexpm_host=SMTP主机名
be_eexpm_port=SMTP端口
be_eexpm_auth=SMTP认证方法
be_eexpm_sm=发送邮件的发件人邮箱
be_eexpm_sn=发送邮件的发件人姓名
be_eexpm_mh=默认邮件标题
be_eexpm_debug=如果发送邮件时出现问题，您可以在此启用调试。在这种情况下，每次发送操作都会在屏幕上显示调试信息，即使成功发送。
be_eexpm_ins=允许不安全的SMTP连接
be_eexpm_mf=默认邮件页脚
obr_inp_title=书名
obr_inp_autor=作者
obr_inp_publisher=出版商
obr_inp_isbn=ISBN
obr_inp_lang=语言
obr_inp_tags=标签
be_obr_li_id=书籍ID
be_obr_li_book_title=书名
be_obr_li_book_autor=作者
be_obr_li_book_type=书籍类型
be_obr_li_book_publisher=出版商
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=语言
be_obr_li_book_tag_array=关联类别
be_obr_li_book_creation=创建日期
be_obr_li_book_modification=修改日期
be_obr_update_book=通过ISBN获取书籍数据
be_obr_delete_book=删除书籍
be_obr_add_stock=可租用项目
obr_book_item_list=可租用项目列表
be_op_usr_622=用户已被编辑。


############################################################################################################################################5

string_add=添加
be_exp_usrlst=在这里您可以管理和创建用户。
be_user_area_usrname=姓名
be_opok=您正在查看此网站，因为您已请求激活。<br/>请查看右上角的事件框以获取详细信息。
be_operr=错误
be_str_item_createderr=无法创建API令牌，通常这是因为该令牌已存在于相关站点模块中！
be_mail_template_edit=编辑邮件模板
be_mail_exp_recover=用于恢复注册用户的邮件模板。用户通过“忘记密码”功能请求新密码时会发送此模板。设置了替代项以提供用户链接。使用简单替代 _ACTION_URL_。
be_mail_exp_mchange=用于更改注册用户电子邮件的邮件模板。当用户更改其主电子邮件或电子邮件一般更改时，发送此模板。设置了替代项以提供用户一个链接来激活和确认新的邮件。使用简单替代 _ACTION_URL_ 作为激活链接。
be_mail_exp_acti=用于激活注册用户的邮件模板。当用户或公司员工被创建时发送此模板。设置了替代项以提供用户链接。使用简单替代 _ACTION_URL_ 激活新帐户。用户也可以通过恢复密码来激活帐户。
be_se_key_mch=邮件激活密钥
b_permission=权限
be_user_area_name=用户管理
be_user_area_create=添加用户
be_usr_ad_errgm=用户已创建，但尝试发送激活邮件时出错！
be_noti_user_crea=请注意，如果用户尚未确认其帐户，且另一个用户尝试使用相同的邮件注册，则最初未确认的用户可能会被删除。这可能导致数据丢失。因此，如果您不希望系统删除用户，请确保始终使用已确认的用户。切勿使用取消用户确认的功能，因为这也可能导致数据丢失。
be_usr_ad_errg=创建用户时出错。
be_usr_ad_hpasserem=选择的密码不符合建议！
be_usr_ad_hpass=密码
be_usr_ad_h=激活程序
be_usr_ad_rec=请求邮件激活并让用户设置自己的密码
be_usr_ad_act=仅请求通过邮件激活
be_usr_ad_ok=无需任何激活程序即可激活此用户
be_puser_noview=此用户不存在！
be_puser_cpass=更改密码
be_puser_cpass1=确认密码
be_puser_cpass2=新密码
be_puser_cper=更改权限
be_puser_chmm=更改用户邮件
be_puser_chmm1=新邮件
be_puser_chdele=删除用户
be_puser_chdele1=用户操作
be_puser_chdele7=此用户当前未通过邮件确认！
be_puser_chdele8=此用户当前已被阻止！
be_puser_chdele9=此用户当前已被禁用！
be_puser_chdele10=这是初始的超级管理员帐户！它始终拥有对该管理面板的完全访问权限！
be_puser_chdele11=此配置文件属于另一个用户！在更改设置时要小心，因为更改将影响该用户的体验！
be_puser_chdele12=等待新的邮件激活：
be_puser_chdele13=点击此处取消操作。
be_puser_chdele14=邮件不能为空！
be_puser_chdele15=未知错误
be_puser_chdele16=此用户的更改邮件功能当前已禁用！
be_puser_chdele17=不允许更改此用户的邮件。
be_puser_chdele18=已有一个活跃用户使用该邮件！用户的邮件不能重复。
be_puser_chdele19=您需要在邮件更改请求之间等待特定时间：
be_puser_chdele20=分钟
be_puser_chdele21=请检查您的新邮件收件箱以激活新邮件！
be_puser_chdele22=发送激活邮件时出错！
be_puser_chdele23=邮件更改请求已被取消！
be_op_usr_1=密码需要包含一个数字、一个小写字母和一个大写字母！至少需要10个字符。
be_op_usr_2=密码不能为空！
be_op_usr_3=密码不匹配！
be_op_usr_4=密码已更改！
be_op_usr_6=用户权限已更改！
be_op_usr_11=用户已确认并现在可以登录！
be_op_usr_12=用户已删除！
be_book_area_create=创建书籍
