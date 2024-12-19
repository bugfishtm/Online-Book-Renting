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
string_email=E-Mail
string_password=Password
string_login=Login
string_register=Register
string_close=Close
string_error=Error

# Page - Actions
hive_login_changelanguage=You can change the language
hive_login_changelanguage_here=here.
hive_login_lostpass=Lost Password?
hive_login_notregistered=Not Registered?
hive_login_rememberme=Use Cookies?
hive_login_recoveraccount=Recover Account
hive_login_haveaccount=Already Have an Account?
hive_login_password_confirm=Confirm Password
hive_login_mc_change_mail=Change E-Mail
hive_login_mc_backtohome=Back to Home
hive_login_title_accactivation=Account Activation
hive_cannotenterwhilenologin=You cannot enter this page if you are not logged in!
hive_cannotenterwhilelogin=You cannot enter this page if you are logged in!
hive_cannotoperatesiteerror=There is an critical error on this site module, so you are currently not able to execute any operation!
hive_login_backtologin=Back to Login
hive_login_change_Lang=Change Language
hive_login_language_changed=The Language has been changed!

# Login Events - General
hive_login_msg_l_wrong=Wrong Password/E-Mail combination.
hive_login_msg_csrf=Form expired, please try again.
hive_login_msg_empty=Please enter the required data!
hive_login_msg_ipban=Your IP is currently blocked; please try again later.
hive_login_msg_logout=You have been logged out!
hive_login_msg_nomatchpass=Password confirmation does not match the entered password.
hive_login_doremember=Do you want to remember your password?

# Login Events - Login
hive_login_msg_l_ok=Login successful.
hive_login_msg_l_blocked=You cannot login because your account is blocked.
hive_login_msg_l_inactive=Your user account is not yet activated! Recover your password to activate your account or click the URL in the activation E-Mail you received!
hive_login_msg_l_blockedpwf=You have entered the wrong password too many times, and your account has been blocked!
hive_login_msg_l_disabled=Your user account has been disabled!
hive_login_mail_serror=Error while trying to send E-Mail. This is an internal error that needs to be investigated and should be reported to our website's staff.
hive_login_msg_register_ok=Please check your E-Mail inbox to activate your new account!
hive_login_msg_passfiltererror=The entered password does not meet the password rules!
hive_login_msg_mailexist=You are trying to register an account with an E-Mail that already exists!
hive_login_password_rules=Password Rules
hive_login_password_sign=Required Characters:
hive_login_password_cap=Required Capital Letters:
hive_login_password_small=Required Small Letters:
hive_login_password_special=Required Special Characters:
hive_login_password_numeric=Required Numeric Characters:

# Login Events - Mail Change
hive_login_msg_m_ok=You have successfully activated your new E-Mail!
hive_login_msg_m_er=Error while trying to activate the new E-Mail address; please try again.
hive_login_msg_m_exp=E-Mail activation code expired! Please retry to change your E-Mail!
hive_login_msg_m_res=The E-Mail you tried to activate is now used on another account, so it cannot be associated with your account!
hive_login_msg_m_block=Your account is blocked from E-Mail changes!
hive_login_msg_m_noadr=The request has failed. Please try again later.
hive_login_mc_cmailtext=Your current E-Mail is:
hive_login_msg_rec_ok=Please check the new E-Mail inbox to activate the new E-Mail address.
hive_login_msg_rec_err=Error while trying to change E-Mail address.
hive_login_msg_rec_wait=You need to wait 120 minutes between E-Mail changes!
hive_login_msg_rec_exist=The E-Mail you are trying to change to is already used by another user account!
hive_login_msg_rec_block=Your account is blocked from E-Mail changes!
hive_login_msg_rec_disable=You cannot change the E-Mail of a disabled account!

# Login Mails
hive_login_mail_pre_change=Activate your new mail here: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Activate Your New E-Mail
hive_login_mail_title_register=Activate Your New Account
hive_login_mail_pre_register=Click the following link to activate your account: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Recover Your Account
hive_login_mail_pre_rec=Click the following link to recover your account password: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=You have successfully activated your account! You can now login on our login pages on this website.
hive_login_msg_a_er=Error while trying to activate the user account. Please try to recover your account password or register a new account.
hive_login_msg_a_exp=The activation token is invalid. Please recover your account at the login page to activate your account!
hive_login_msg_a_block=Activation for your account has been disabled; please try again later!

# Login - Recover Request
hive_login_msg_rr_recnewunk=The provided E-Mail is not registered.
hive_login_msg_rr_recnope=Your account does not have permission to recover the password!
hive_login_msg_rr_recnopede=Your account has been deactivated and cannot make new requests!
hive_login_msg_rr_recwait=You need to wait 120 minutes before you start a new recovery request!
hive_login_msg_rr_recnok=Please check your inbox for a password reset E-Mail. This mail contains a link to recover your password.
hive_login_msg_recfr_ok=Please check your E-Mail inbox to get a password recovery link!

# Login - Recover Execute
hive_login_msg_pwtexpire=This Password Recovery Token has expired! Please retry to recover your account.
hive_login_msg_recexecerror=Error while trying to recover your password. Please try again to recover your account.
hive_login_msg_recexecok=You have successfully recovered your password and can now login with your new password.
