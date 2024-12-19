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
string_email=电子邮件
string_password=密码
string_login=登录
string_register=注册
string_close=关闭
string_error=错误

# Page - Actions
hive_login_changelanguage=您可以更改语言
hive_login_changelanguage_here=这里。
hive_login_lostpass=忘记密码？
hive_login_notregistered=尚未注册？
hive_login_rememberme=使用 Cookies？
hive_login_recoveraccount=恢复账户
hive_login_haveaccount=已有账户？
hive_login_password_confirm=确认密码
hive_login_mc_change_mail=更改电子邮件
hive_login_mc_backtohome=返回主页
hive_login_title_accactivation=账户激活
hive_cannotenterwhilenologin=您未登录，无法进入此页面！
hive_cannotenterwhilelogin=您已登录，无法进入此页面！
hive_cannotoperatesiteerror=站点模块存在严重错误，您当前无法执行任何操作！
hive_login_backtologin=返回登录
hive_login_change_Lang=更改语言
hive_login_language_changed=语言已更改！

# Login Events - General
hive_login_msg_l_wrong=密码/电子邮件组合错误。
hive_login_msg_csrf=表单已过期，请重试。
hive_login_msg_empty=请输入必填数据！
hive_login_msg_ipban=您的 IP 当前被阻止；请稍后再试。
hive_login_msg_logout=您已成功登出！
hive_login_msg_nomatchpass=密码确认与输入的密码不匹配。
hive_login_doremember=是否记住密码？

# Login Events - Login
hive_login_msg_l_ok=登录成功。
hive_login_msg_l_blocked=您的账户被阻止，无法登录。
hive_login_msg_l_inactive=您的用户账户尚未激活！请通过找回密码激活账户或点击收到的激活邮件中的链接！
hive_login_msg_l_blockedpwf=您多次输入错误密码，账户已被阻止！
hive_login_msg_l_disabled=您的用户账户已被禁用！
hive_login_mail_serror=尝试发送电子邮件时出错。这是一个需要调查的内部错误，请报告给我们的网站工作人员。
hive_login_msg_register_ok=请检查您的电子邮件收件箱以激活您的新账户！
hive_login_msg_passfiltererror=输入的密码不符合密码规则！
hive_login_msg_mailexist=您尝试使用已存在的电子邮件注册账户！
hive_login_password_rules=密码规则
hive_login_password_sign=必须包含的字符：
hive_login_password_cap=必须包含的大写字母：
hive_login_password_small=必须包含的小写字母：
hive_login_password_special=必须包含的特殊字符：
hive_login_password_numeric=必须包含的数字字符：

# Login Events - Mail Change
hive_login_msg_m_ok=您已成功激活新的电子邮件！
hive_login_msg_m_er=尝试激活新电子邮件地址时出错，请重试。
hive_login_msg_m_exp=电子邮件激活码已过期！请重新尝试更改电子邮件！
hive_login_msg_m_res=您尝试激活的电子邮件已被另一个账户使用，无法与您的账户关联！
hive_login_msg_m_block=您的账户被禁止更改电子邮件！
hive_login_msg_m_noadr=请求失败，请稍后再试。
hive_login_mc_cmailtext=您当前的电子邮件是：
hive_login_msg_rec_ok=请检查新的电子邮件收件箱以激活新的电子邮件地址。
hive_login_msg_rec_err=尝试更改电子邮件地址时出错。
hive_login_msg_rec_wait=您需要等待 120 分钟后才能再次更改电子邮件！
hive_login_msg_rec_exist=您尝试更改的电子邮件已被其他用户账户使用！
hive_login_msg_rec_block=您的账户被禁止更改电子邮件！
hive_login_msg_rec_disable=您无法更改已禁用账户的电子邮件！

# Login Mails
hive_login_mail_pre_change=在此激活您的新电子邮件： <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=激活您的新电子邮件
hive_login_mail_title_register=激活您的新账户
hive_login_mail_pre_register=点击以下链接激活您的账户： <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=找回您的账户
hive_login_mail_pre_rec=点击以下链接找回您的账户密码： <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=您已成功激活账户！您现在可以通过本网站的登录页面登录。
hive_login_msg_a_er=尝试激活用户账户时出错。请尝试找回账户密码或注册新账户。
hive_login_msg_a_exp=激活令牌无效。请通过登录页面找回账户以激活账户！
hive_login_msg_a_block=您的账户激活已被禁用，请稍后再试！

# Login - Recover Request
hive_login_msg_rr_recnewunk=提供的电子邮件未注册。
hive_login_msg_rr_recnope=您的账户无权找回密码！
hive_login_msg_rr_recnopede=您的账户已被停用，无法提出新请求！
hive_login_msg_rr_recwait=您需要等待 120 分钟后才能开始新的恢复请求！
hive_login_msg_rr_recnok=请检查您的收件箱以获取密码重置电子邮件。此邮件包含一个链接用于找回密码。
hive_login_msg_recfr_ok=请检查您的电子邮件收件箱以获取密码恢复链接！

# Login - Recover Execute
hive_login_msg_pwtexpire=此密码恢复令牌已过期！请重新尝试找回您的账户。
hive_login_msg_recexecerror=尝试找回密码时出错。请重新尝试找回您的账户。
hive_login_msg_recexecok=您已成功找回密码，现在可以使用新密码登录。
