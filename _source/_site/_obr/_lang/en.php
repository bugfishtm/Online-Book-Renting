<?php if(isset($this)) { if(!is_object($this)) { exit(); } } else { exit(); }
#		@@@@@@@   @@@  @@@   @@@@@@@@  @@@@@@@@  @@@   @@@@@@   @@@  @@@  
#		@@@@@@@@  @@@  @@@  @@@@@@@@@  @@@@@@@@  @@@  @@@@@@@   @@@  @@@  
#		@@!  @@@  @@!  @@@  !@@        @@!       @@!  !@@       @@!  @@@  
#		!@   @!@  !@!  @!@  !@!        !@!       !@!  !@!       !@!  @!@  
#		@!@!@!@   @!@  !@!  !@! @!@!@  @!!!:!    !!@  !!@@!!    @!@!@!@!  
#		!!!@!!!!  !@!  !!!  !!! !!@!!  !!!!!:    !!!   !!@!!!   !!!@!!!!  
#		!!:  !!!  !!:  !!!  :!!   !!:  !!:       !!:       !:!  !!:  !!!  
#		:!:  !:!  :!:  !:!  :!:   !::  :!:       :!:      !:!   :!:  !:!  
#		 :: ::::  ::::: ::   ::: ::::   ::        ::  :::: ::   ::   :::  
#		:: : ::    : :  :    :: :: :    :        :    :: : :     :   : :  www.bugfish.eu
# This is a comment!
# New Translation options should be applied to this sites config.php _HIVE_LANG_ARRAY_
# This files are public visible! You can use Database Mode if you want your translations hidden. ?>
##################################################################
## Online Book Renting Translations
##################################################################

## General 
be_yes=Yes
be_no=No
b_active=Active
b_inactive=Inactive
b_edit=Edit
b_action=Action
b_delete=Delete
be_close=Close
be_cancel=Cancel
b_description=Description
be_list=List

## Error
be_404_2=Error 404
be_404_1=The requested content does not exist!
be_401_2=Access Denied
be_401_1=You do not have access to this area!


## Popups
be_edit_abort=Click here to abort the operation!
be_list_h_exec_flush=All items on this table have been deleted!
be_list_h_btn_flush_rly=Do you really want to flush this table? This will reinitialize this related database table and delete all old entries in it!
be_list_h_btn_flush=Flush Table
be_cbanner_1=This website is using session cookies!
be_cbanner_2=I Agree


## Events 
be_list_exec_idel=The item has been deleted!
be_list_exec_iedit=The Item has been changed!
be_usr_ad_herem=You need to fill in needed data!
be_usr_ad_hmailex=Another user with that mail already exists! Please choose another mail for this user.
be_usr_ad_hmaok=The user has been created!



## List Headers 
be_list_h_date=Date
be_list_h_id=ID
be_list_h_ttype=Type
be_list_h_ref=Reference
be_list_h_detail=Details
be_list_h_ar=Arrivals
be_list_h_url=URL
be_list_h_site=Site
be_list_h_err=Error
be_list_h_rece=Receiver
be_list_h_content=Content
be_list_h_time=Time
be_list_h_ip=IP
be_list_h_fails=Failures
be_list_h_delete=Delete
be_user_area_adr=Address
be_user_area_mail=E-Mail
be_usr_ad_hmail=Mail




## Navigation
be_deadlines=Deadlines
be_profile=Profile
be_logout=Logout
be_tag=Tags
be_books=Books
be_privacy=Privacy
be_impressum=Impressum
be_settings=Settings
be_blacklist=Blacklist
be_logging=Logging
be_user=Users
be_myprofile=My Profile
be_login=Login


## Book Area
be_book_add=Add Book
be_booked_isbn=ISBN
be_booked_title=Title
be_booked_autor=Author
be_booked_descr=Description
be_booked_type=Type
be_booked_pub=Publisher
be_vb_header_log=Log
be_vb_header_rentc=Quantity
be_vb_header_ima=Cover
be_vb_header_det=Details

## Tag Area
be_tag_raw=Tags
be_tag_rawn=Tag Name
be_tag_add=Add Tag
be_tag_edit=Edit Tag
be_tag_chdele=Do you really want to delete this tag?
be_tag_exp=Here you can manage tags, tags can be assigned to books.

## Blacklist Area
be_exp_blacklist=Blocked IP's can be seen here. These IP's will not be able to login to this website or perform authenticated operations.


## Deadline Area
be_deadline_raw=Deadlines
be_deadline_exp=Here you can see open deadlines and book return dues.
be_table_header_book=Book
be_table_header_barcode=Barcode
be_table_header_duedate=Due Date

## Logging Area
be_exp_logging=Here you can see a protocol of activities in this system.


## User Area
be_password_filter_setup=Ein Passwort muss folgende Kriterien erfüllen:<br />- Mindestens 10 Zeichen<br />- Mindestens 1 Großbuchstabe<br />- Mindestens 1 Kleinbuchstabe<br />- Mindestens eine Zahl


## Settings Area
be_about_core_info=CMS Version
be_about_fw_info=Framework Version
be_about_site_info=Module Version
be_set_header_general=General Settings
be_set_header_mail=E-Mail Settings
be_set_header_trans=Translation Settings
be_set_header_about=System Information
be_string_key=Key
be_string_language=Language
be_string_translation=Translation
be_trans_current_active=Default Translations
be_trans_current_ovr=Translation Overrides
be_trans_button_create=Create Translation
be_trans_button_edit=Edit Translation
be_trans_dlrly=Do you really want to delete this translation?

# Permissions
be_tperm_page_deadlines=Manage Deadlines
be_dperm_page_deadlines=Access to the Page for Book Deadlines and functions on it.
be_tperm_page_tag=Manage Tags
be_dperm_page_tag=Access to the Page for Book Tags and functions on it.
be_tperm_page_user=Manage Users
be_dperm_page_user=Access to the Page for Users and functions on it, can view and manage all users.
be_tperm_page_blacklist=Manage Blacklist
be_dperm_page_blacklist=Access to the Page for IP Blacklist and functions on it.
be_tperm_page_logging=Manage Logging
be_dperm_page_logging=Access to the Page for Logging and functions on it.
be_tperm_page_settings=Manage Settings
be_dperm_page_settings=Access to the Page for Settings and functions on it.



string_add=Add
be_exp_usrlst=Here you can manage and create users.
be_user_area_usrname=Name
be_opok=You are seeing this site because you have requested an activation.<br/>See the event box on the top right corner for details.
be_operr=Error#
be_str_item_created=The item has been created!
be_str_item_createderr=API Token could not be created, this is mostly the case if this token is already existing for the related site module!
be_mail_template_edit=Edit Mail Template
be_mail_exp_recover=Email template for recovering registered users. This template is sent when users request a new password through the 'forgot password' function. An substitution is set to provide the user with a link. With easy Subsitution _ACTION_URL_.
be_mail_exp_mchange=Email template for changes in registered user emails. This template is sent when the user changes their primary email or when it is changed in general. An substitution is set to provide the user with a link to activate and confirm the new mail. With easy Subsitution _ACTION_URL_ for the activation URL.
be_mail_exp_acti=Email template for activating registered users. This template is sent when users or company employees are created. An substitution is set to provide the user with a link. With easy Subsitution _ACTION_URL_ to activate the new account. The user can also recover the password to activate the account.
be_se_key_mch=Mail Activate Key
b_permission=Permissions
be_user_area_name=User Management
be_user_area_create=Add User
be_usr_ad_errgm=The user has been created, but there was an error while trying to send the activation mail!
be_noti_user_crea=Please be advised, that if a user has not confirmed his account and another user trys to sign up with the same mail - the initial unconfirmed user may gets deleted. This can lead to data loss. So be sure you are always working with confirmed users if you do not want the system to delete them. Do never use functionalities to unconfirm users, as this also can lead to data loss.
be_usr_ad_errg=Error while trying to create the user.
be_usr_ad_hpasserem=The choosen password does not fit the recommendations!
be_usr_ad_hpass=Password
be_usr_ad_h=Activation Procedure
be_usr_ad_rec=Request mail activation and user to set own password
be_usr_ad_act=Request only activation per Mail
be_usr_ad_ok=Activate this user without any activation procedures
be_puser_noview=This user does not exist!
be_puser_cpass=Change Password
be_puser_cpass1=Confirm Password
be_puser_cpass2=New Password
be_puser_cper=Change Permissions
be_puser_chmm=Change User Mail
be_puser_chmm1=New Mail
be_puser_chdele=Delete User
be_puser_chdele1=User Operations
be_puser_chdele7=This user is currently not confirmed by mail!
be_puser_chdele8=This user is currently blocked!
be_puser_chdele9=This user is currently disabled!
be_puser_chdele10=This is the initial super-admin account! It always has full access to this admin panel!
be_puser_chdele11=This profile does belong to another user as you! Be careful when changing settings, as changes will have impact on the users experience!
be_puser_chdele12=Awaiting new mail activation for:
be_puser_chdele13=Click here to abort the operation.
be_puser_chdele14=The Mail can't be empty!
be_puser_chdele15=Unknown Error
be_puser_chdele16= The functionality to change the mail is currently disabled for this user!
be_puser_chdele17=It is not allowed to change this users mail.
be_puser_chdele18=There is already an active user with that mail! Duplicate mails on users are not possible.
be_puser_chdele19=You need to wait a specific amount of time between mail change requests: 
be_puser_chdele20=minutes
be_puser_chdele21=Please check your new mails inbox to activate new mail!
be_puser_chdele22=There was an error sending the activation email!
be_puser_chdele23=The Mail Change request has been cancelled!
be_op_usr_1=Password does need one integer, one small and one capital letter! At least you need to have 10 signs.
be_op_usr_2=Passwords cant be empty!
be_op_usr_3=Passwords do not match!
be_op_usr_4=The password has been changed!
be_op_usr_6=The user permissions has been changed!
be_op_usr_11=The user has been confirmed and is now able to login!
be_op_usr_12=The user has been deleted!
be_book_area_create=Create Book
obr_inp_title=Title
obr_inp_autor=Autor
obr_inp_publisher=Publisher
obr_inp_isbn=ISBN
obr_inp_lang=Language
obr_inp_tags=Tags
be_obr_li_id=Book ID
be_obr_li_book_title=Title
be_obr_li_book_autor=Autor
be_obr_li_book_type=Book Type
be_obr_li_book_publisher=Publisher
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Language
be_obr_li_book_tag_array=Linked Categories
be_obr_li_book_creation=Creation Date
be_obr_li_book_modification=Modification Date
be_obr_update_book=Fetch Book Data by ISBN
be_obr_delete_book=Delete Book
be_obr_add_stock=Rentable Items
obr_book_item_list=Rentable Items List