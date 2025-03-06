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

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=主题：动态主题颜色的默认颜色
hive_var_exp_2=主题：包含有效主题的序列化数组
hive_var_exp_3=主题：默认使用的主题
hive_var_exp_4=语言：包含有效语言的序列化数组
hive_var_exp_5=语言：默认语言数组
hive_var_exp_6=操作：通用注册表单是否激活？（1=开启/0=关闭）
hive_var_exp_7=暂无说明。
hive_var_exp_8=操作：通用找回表单是否激活？（1=开启/0=关闭）
hive_var_exp_9=操作：通用激活表单是否激活？（1=开启/0=关闭）
hive_var_exp_10=通用登录表单是否激活？（1=开启/0=关闭）
hive_var_exp_11=TinyMCE：插件配置字符串
hive_var_exp_12=TinyMCE：菜单栏配置字符串
hive_var_exp_13=TinyMCE：工具栏配置字符串
hive_var_exp_14=用户配置：会话/Cookie的最大有效天数
hive_var_exp_15=用户配置：激活邮件中的令牌有效时间（分钟）
hive_var_exp_16=用户配置：失败登录 X 次后锁定用户（0 表示禁用）
hive_var_exp_17=用户配置：用户在请求之间需要等待的时间（分钟）（防洪）
hive_var_exp_18=用户配置：记录旧会话日志？（登录、找回、激活、邮件更改）（1=开启/0=关闭）
hive_var_exp_19=用户配置：在数据库中记录用户IP地址（1=开启/0=关闭）
hive_var_exp_20=用户配置：1 - 用户成功登录后删除找回密钥 | 0 - 保留密钥
hive_var_exp_21=用户配置：1 - 允许多用户登录 | 0 - 禁用多用户登录
hive_var_exp_22=密码过滤：最少字符数
hive_var_exp_23=密码过滤：最少大写字符数
hive_var_exp_24=密码过滤：最少小写字符数
hive_var_exp_25=密码过滤：最少特殊字符数
hive_var_exp_26=密码过滤：最少数字字符数
hive_var_exp_27=初始创建的用户名
hive_var_exp_28=初始创建的用户密码
hive_var_exp_29=验证码：图片高度
hive_var_exp_30=验证码：图片宽度
hive_var_exp_31=验证码：验证码颜色（可选，可以为0）
hive_var_exp_32=验证码：字体（如果为0，将使用默认字体）
hive_var_exp_33=Redis：是否激活？1/0
hive_var_exp_34=Redis：主机
hive_var_exp_35=Redis：端口
hive_var_exp_36=更新器：本网站更新器的标题
hive_var_exp_37=更新器：更新所需代码？（可以为0以禁用）
hive_var_exp_38=设置：记录CURL类请求日志？（1/0）
hive_var_exp_39=设置：失败 X 次后阻止IP（可以为0以禁用）
hive_var_exp_40=设置：记录引用者？（1/0）
hive_var_exp_41=设置：默认CSRF代码有效时间（秒）
hive_var_exp_42=设置：1 - 仅允许从命令行执行计划任务 | 0 - 允许在浏览器中执行计划任务
hive_var_exp_43=设置：激活JavaScript调试错误日志记录（1/0）
hive_var_exp_44=设置：标签页和其他地方的网站标题
hive_var_exp_45=设置：浏览器标签中的标题分隔符
hive_var_exp_46=设置：在网站上显示PHP错误？（1/0）
hive_var_exp_47=设置：包含所需PHP模块的序列化数组，如果不存在则显示错误（示例：array("mysqli", "mbstring", "gd")）
hive_var_exp_48=设置：页面上是否停止并显示MySQL错误？（始终会记录在x_log_mysql表中）（1/0）
hive_var_exp_49=设置：1 - 使用SEO URL | 0 - 不使用SEO URL
hive_var_exp_50=设置：仅当_HIVE_URL_SEO_ == false时需要 [GET位置变量的名称，在序列化数组中]
hive_var_exp_51=邮件配置：SMTP密码
hive_var_exp_52=邮件配置：SMTP用户名
hive_var_exp_53=邮件配置：SMTP认证（ssl/tls/false）
hive_var_exp_54=邮件配置：SMTP端口
hive_var_exp_55=邮件配置：SMTP主机
hive_var_exp_56=邮件配置：邮件调试模式（0, 1, 2, 3） - 使用0用于生产环境，因为这将在站点上输出调试信息！
hive_var_exp_57=邮件配置：允许不安全的SSL连接？（1/0）
hive_var_exp_58=邮件配置：所有邮件以HTML格式发送？（1/0）
hive_var_exp_59=邮件配置：默认发件人名称
hive_var_exp_60=邮件配置：默认发件人邮件地址
hive_var_exp_61=邮件配置：邮件默认页脚
hive_var_exp_62=邮件配置：邮件默认页眉
