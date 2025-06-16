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
be_404_2=त्रुटि 404
be_404_1=अनुरोधित सामग्री मौजूद नहीं है!
be_401_2=पहुंच अस्वीकृत
be_401_1=आपको इस क्षेत्र तक पहुंच नहीं है!
b_permissions=अनुमतियां

## Popups
be_edit_abort=ऑपरेशन को रद्द करने के लिए यहां क्लिक करें!
be_list_h_exec_flush=इस तालिका के सभी आइटम हटा दिए गए हैं!
be_list_h_btn_flush_rly=क्या आप वाकई इस तालिका को फ्लश करना चाहते हैं? यह संबंधित डेटाबेस तालिका को पुनः आरंभ करेगा और इसमें सभी पुरानी प्रविष्टियों को हटा देगा!
be_list_h_btn_flush=तालिका फ्लश करें
be_cbanner_1=यह वेबसाइट सत्र कुकीज़ का उपयोग कर रही है!
be_cbanner_2=मैं सहमत हूं
be_pp_hide=क्या आप वाकई इस आइटम को सार्वजनिक पुस्तक सूची में छिपाना चाहते हैं?
be_pp_unhide=क्या आप वाकई इस आइटम को सार्वजनिक पुस्तक सूची में दिखाना चाहते हैं?
be_pp_delbook=क्या आप वाकई इस पुस्तक को हटाना चाहते हैं? यह सभी संबंधित जानकारी और इसके लिए लॉग को हटा देगा।
be_pp_errimage=कृपया एक मान्य jpg फ़ाइल चुनें!
be_pp_errimage1=कोई फ़ाइल अपलोड नहीं की गई या अपलोड के दौरान त्रुटि हुई।
be_pp_errimage2=अपलोड की गई फ़ाइल को स्थानांतरित करने में त्रुटि।
be_pp_errimage3=अमान्य फ़ाइल प्रकार। केवल JPG फ़ाइलें अनुमत हैं।
be_pp_sapi=यह वर्तमान पुस्तक जानकारी को openLibrary से प्राप्त जानकारी से अधिलेखित कर देगा। कवर छवि भी बदल दी जाएगी!
be_pp_sapierr=openLibrary API के साथ संचार करने का प्रयास करते समय त्रुटि!
be_pp_sr1=क्या आप वाकई इस पुस्तक आइटम को हटाना चाहते हैं?
be_pp_sr2=क्या यह पुस्तक वापस स्टॉक में है और लौटा दी गई है?
be_pp_sr3=openLibrary API के साथ संचार करने का प्रयास करते समय त्रुटि!

## Permissions
be_tperm_page_deadlines=समय सीमा प्रबंधित करें
be_dperm_page_deadlines=उपयोगकर्ताओं को पुस्तकें किराए पर दे सकते हैं और समय सीमा प्रबंधित कर सकते हैं।
be_tperm_page_books=पुस्तकें प्रबंधित करें
be_dperm_page_books=पुस्तक पृष्ठ और उस पर कार्यों तक पहुंच, पुस्तकें बना सकते हैं, संपादित कर सकते हैं और हटा सकते हैं।
be_tperm_page_tag=टैग प्रबंधित करें
be_dperm_page_tag=पुस्तक टैग पृष्ठ और उस पर कार्यों तक पहुंच, टैग बना सकते हैं, संपादित कर सकते हैं और हटा सकते हैं।
be_tperm_page_user=उपयोगकर्ता प्रबंधित करें
be_dperm_page_user=उपयोगकर्ता पृष्ठ और उस पर कार्यों तक पहुंच, उपयोगकर्ता बना सकते हैं और सभी उपयोगकर्ताओं को देख/प्रबंधित कर सकते हैं।
be_tperm_page_blacklist=ब्लैकलिस्ट प्रबंधित करें
be_dperm_page_blacklist=IP ब्लैकलिस्ट पृष्ठ और उस पर कार्यों तक पहुंच।
be_tperm_page_logging=लॉगिंग प्रबंधित करें
be_dperm_page_logging=लॉगिंग पृष्ठ और उस पर कार्यों तक पहुंच।
be_tperm_page_settings=सेटिंग्स प्रबंधित करें
be_dperm_page_settings=सेटिंग्स पृष्ठ और उस पर कार्यों तक पहुंच।

## Events 
be_list_exec_idel=आइटम हटा दिया गया है!
be_list_exec_iedit=आइटम बदल दिया गया है!
be_usr_ad_herem=आपको आवश्यक डेटा भरना होगा!
be_usr_ad_hmailex=उस मेल के साथ एक अन्य उपयोगकर्ता पहले से मौजूद है! कृपया इस उपयोगकर्ता के लिए कोई अन्य मेल चुनें।
be_usr_ad_hmaok=उपयोगकर्ता बना दिया गया है!
be_str_item_created=आइटम बना दिया गया है


############################################################################################################################################1


## List Headers 
be_list_h_date=दिनांक
be_list_h_id=आईडी
be_list_h_ttype=प्रकार
be_list_h_ref=संदर्भ
be_list_h_detail=विवरण
be_list_h_ar=आगमन
be_list_h_url=यूआरएल
be_list_h_site=साइट
be_list_h_err=त्रुटि
be_list_h_rece=प्राप्तकर्ता
be_list_h_content=सामग्री
be_list_h_time=समय
be_list_h_ip=आईपी
be_list_h_fails=विफलताएँ
be_list_h_delete=हटाएँ
be_user_area_adr=पता
be_user_area_mail=ई-मेल
be_usr_ad_hmail=मेल

## Navigation
be_deadlines=समय सीमाएँ
be_profile=प्रोफ़ाइल
be_logout=लॉगआउट
be_tag=टैग
be_books=पुस्तकें
be_privacy=गोपनीयता
be_impressum=इम्प्रेसम
be_settings=सेटिंग्स
be_blacklist=काली सूची
be_logging=लॉगिंग
be_user=उपयोगकर्ता
be_myprofile=मेरी प्रोफ़ाइल
be_login=लॉगिन

## Tag Area
be_tag_raw=टैग
be_tag_rawn=टैग नाम
be_tag_add=टैग जोड़ें
be_tag_edit=टैग संपादित करें
be_tag_chdele=क्या आप वाकई इस टैग को हटाना चाहते हैं?
be_tag_exp=यहाँ आप टैग प्रबंधित कर सकते हैं, टैग पुस्तकों को असाइन किए जा सकते हैं।

## Blacklist Area
be_exp_blacklist=अवरुद्ध आईपी यहाँ देखी जा सकती हैं। ये आईपी इस वेबसाइट पर लॉगिन नहीं कर पाएंगी या प्रमाणित कार्य नहीं कर पाएंगी।

## Logging Area
be_exp_logging=यहाँ आप इस सिस्टम में गतिविधियों का प्रोटोकॉल देख सकते हैं।

############################################################################################################################################2

## Book Area
be_book_add=पुस्तक जोड़ें
be_booked_isbn=आईएसबीएन
be_booked_title=शीर्षक
be_booked_autor=लेखक
be_booked_descr=विवरण
be_booked_lang=भाषा
be_booked_released=प्रकाशन तिथि
be_booked_type=प्रकार
be_booked_pub=प्रकाशक
be_vb_header_log=लॉग
be_vb_header_rentc=मात्रा
be_vb_header_ima=कवर
be_vb_header_det=विवरण

## Deadline Area
be_deadline_raw=समय सीमाएँ
be_deadline_exp=यहाँ आप खुली समय सीमाएँ और पुस्तक वापसी की देय तिथियाँ देख सकते हैं।
be_table_header_book=पुस्तक
be_table_header_barcode=बारकोड
be_table_header_duedate=देय तिथि

# Profile Area
b_prof_pwinfo=यहाँ आप लॉगिन करने के लिए पासवर्ड बदल सकते हैं।
b_prof_mailinfo=यहाँ आप लॉगिन करने के लिए ई-मेल बदल सकते हैं।

## User Area
be_password_filter_setup=पासवर्ड निम्नलिखित मानदंडों को पूरा करना चाहिए:<br />- कम से कम 10 अक्षर<br />- कम से कम 1 अपरकेस अक्षर<br />- कम से कम 1 लोअरकेस अक्षर<br />- कम से कम एक संख्या



############################################################################################################################################3

be_yes=हाँ
be_no=नहीं
b_in_time=समय पर
b_overdue=समय अतिक्रमित
b_today_return=आज वापस करें
b_view=देखें
be_table_header_returndate=वापसी तिथि
b_active=सक्रिय
b_inactive=निष्क्रिय
b_edit=संपादित करें
b_action=कार्रवाई
b_delete=हटाएँ
be_close=बंद करें
be_cancel=रद्द करें
b_description=विवरण
be_list=सूची
be_none=कोई नहीं
be_help=सहायता
be_explanation=व्याख्या
b_nosslval=SSL सत्यापन नहीं
b_sslval=SSL सत्यापन अनिवार्य
b_low=निम्न
b_medium=मध्यम
b_high=उच्च
b_apirequest=API के साथ सिंक करें
b_barcode=बारकोड
b_add=जोड़ें
b_nolistcurrent=इस सूची में वर्तमान में कोई आइटम नहीं है!
b_backtolist=सूची पर वापस जाएँ
b_hide=छिपाएँ
b_unhide=दिखाएँ
be_profile=प्रोफ़ाइल
b_creation=निर्माण
b_lastmodification=अंतिम संशोधन
b_firstname=पहला नाम
b_lastname=अंतिम नाम
b_street=सड़क
b_postcode=पिन कोड
b_country=देश
b_changeimage=छवि बदलें
b_password=पासवर्ड
b_change_password=पासवर्ड बदलें
b_email=ईमेल
b_change_email=ईमेल बदलें
b_status=स्थिति
b_id=आईडी
b_tags=टैग
b_thisitemcurhiddenlist=यह आइटम वर्तमान में सार्वजनिक सूची में छिपा हुआ है!
b_nobooktitlelist=अज्ञात शीर्षक
b_hidden=छिपा हुआ
b_lend=उधार दें
b_return=वापस करें
b_hardback=हार्डबैक
b_paperback=पेपरबैक
b_softcover=सॉफ्टकवर
b_bookcurrentlyrented=यह पुस्तक वर्तमान में किसी अन्य उपयोगकर्ता द्वारा आरक्षित है और जल्द ही उपलब्ध होगी!
b_available=उपलब्ध
b_reserved=आरक्षित
b_user=उपयोगकर्ता
b_until=तक
b_returndate=वापसी तिथि
b_note=नोट
b_lendtouser=उपयोगकर्ता को उधार दें
b_changefavicon=फेविकॉन बदलें
b_settings_exp_string=इस पृष्ठ पर आप वेबसाइट की कार्यक्षमताओं को नियंत्रित कर सकते हैं।
b_tel=टेलीफोन
be_pp_sr1ssd=क्या पुस्तक वापस कर दी गई है?
be_error_booknoexists=जिस पुस्तक को आप देखने की कोशिश कर रहे थे वह मौजूद नहीं है!
be_error_usernoexists=जिस उपयोगकर्ता को आप देखने की कोशिश कर रहे थे वह मौजूद नहीं है!
be_puser_chdele3=उपयोगकर्ता सक्षम करें
b_prof_pwinfoadd=व्यवस्थापक के रूप में आप सक्रियण के बिना उपयोगकर्ता मेल बदल सकते हैं


############################################################################################################################################4

be_about_core_info=सीएमएस संस्करण
be_about_fw_info=फ्रेमवर्क संस्करण
be_about_site_info=मॉड्यूल संस्करण
be_set_header_general=सामान्य सेटिंग्स
be_set_header_mail=ई-मेल सेटिंग्स
be_set_header_trans=अनुवाद सेटिंग्स
be_set_header_about=सिस्टम जानकारी
be_string_key=कुंजी
be_string_language=भाषा
be_string_translation=अनुवाद
be_trans_current_active=डिफ़ॉल्ट अनुवाद
be_trans_current_ovr=अनुवाद ओवरराइड
be_trans_button_create=अनुवाद बनाएं
be_trans_button_edit=अनुवाद संपादित करें
be_trans_dlrly=क्या आप वाकई इस अनुवाद को हटाना चाहते हैं?
be_eexps_hivetitle=इस वेबसाइट का शीर्षक।
be_eexps_imp=आपका इम्प्रिंट टेक्स्ट
be_eexps_pry=आपका गोपनीयता टेक्स्ट
be_eexps_expiretoken=ई-मेल टोकन एक विशिष्ट मिनट की संख्या के बाद समाप्त हो जाता है।
be_eexps_expireip=ब्लैकलिस्टिंग से पहले आईपी विफलता सीमा।
be_eexps_expirecsrf=सीएसआरएफ कुंजियां समाप्त होने से पहले कितने सेकंड तक मान्य हैं।
be_eexps_expireact=उपयोगकर्ताओं को पुनर्प्राप्ति/मेल परिवर्तन अनुरोधों के बीच कितने मिनट तक प्रतीक्षा करनी होगी।
be_eexps_upgc=ऑनसाइट अपडेटर को एक्सेस कोड से सुरक्षित करें।
be_eexps_actmc=उपयोगकर्ताओं को अपना ई-मेल बदलने की अनुमति दें।
be_eexps_actrec=उपयोगकर्ताओं को अपना पासवर्ड पुनर्प्राप्त करने की अनुमति दें।
be_eexps_actreg=अतिथियों को इस वेबसाइट पर पंजीकरण करने की अनुमति दें।
be_eexps_actdeflang=अतिथियों के लिए डिफ़ॉल्ट भाषा यदि उन्होंने अपनी खुद की भाषा सेट नहीं की है।
be_eexps_trapage=इस अनुभाग में आप डिफ़ॉल्ट अनुवाद देख सकते हैं और यदि उपयोगी हो तो उन्हें ओवरराइड कर सकते हैं।
be_eexpm_user=ई-मेल सर्वर के लिए उपयोगकर्ता नाम
be_eexpm_pass=ई-मेल सर्वर के लिए पासवर्ड
be_eexpm_host=एसएमटीपी होस्टनाम
be_eexpm_port=एसएमटीपी पोर्ट
be_eexpm_auth=एसएमटीपी प्रमाणीकरण विधि
be_eexpm_sm=आउटगोइंग मेल के लिए प्रेषक मेल
be_eexpm_sn=आउटगोइंग मेल के लिए प्रेषक नाम
be_eexpm_mh=डिफ़ॉल्ट मेल हेडर
be_eexpm_debug=यदि मेल भेजने के दौरान समस्याएं आती हैं, तो आप यहां डीबगिंग सक्रिय कर सकते हैं - इस मामले में प्रत्येक भेजने के ऑपरेशन पर डीबग जानकारी स्क्रीन पर दिखाई जाएगी - भले ही सफल हो।
be_eexpm_ins=असुरक्षित एसएमटीपी कनेक्शन की अनुमति दें
be_eexpm_mf=डिफ़ॉल्ट मेल फुटर
obr_inp_title=शीर्षक
obr_inp_autor=लेखक
obr_inp_publisher=प्रकाशक
obr_inp_isbn=आईएसबीएन
obr_inp_lang=भाषा
obr_inp_tags=टैग
be_obr_li_id=पुस्तक आईडी
be_obr_li_book_title=शीर्षक
be_obr_li_book_autor=लेखक
be_obr_li_book_type=पुस्तक प्रकार
be_obr_li_book_publisher=प्रकाशक
be_obr_li_book_isbn=आईएसबीएन
be_obr_li_book_lang=भाषा
be_obr_li_book_tag_array=लिंक की गई श्रेणियाँ
be_obr_li_book_creation=निर्माण तिथि
be_obr_li_book_modification=संशोधन तिथि
be_obr_update_book=आईएसबीएन द्वारा पुस्तक डेटा प्राप्त करें
be_obr_delete_book=पुस्तक हटाएं
be_obr_add_stock=किराए पर लेने योग्य आइटम
obr_book_item_list=किराए पर लेने योग्य आइटम सूची
be_op_usr_622=उपयोगकर्ता को संपादित किया गया है


############################################################################################################################################5

string_add=जोड़ें
be_exp_usrlst=यहां आप उपयोगकर्ताओं को प्रबंधित और बना सकते हैं।
be_user_area_usrname=नाम
be_opok=आप इस साइट को देख रहे हैं क्योंकि आपने सक्रियण का अनुरोध किया है।<br/>विवरण के लिए ऊपरी दाएं कोने में इवेंट बॉक्स देखें।
be_operr=त्रुटि
be_str_item_createderr=API टोकन नहीं बनाया जा सका, यह अधिकतर तब होता है जब यह टोकन संबंधित साइट मॉड्यूल के लिए पहले से मौजूद हो!
be_mail_template_edit=मेल टेम्पलेट संपादित करें
be_mail_exp_recover=पंजीकृत उपयोगकर्ताओं को पुनः प्राप्त करने के लिए ईमेल टेम्पलेट। यह टेम्पलेट तब भेजा जाता है जब उपयोगकर्ता 'पासवर्ड भूल गए' फ़ंक्शन के माध्यम से नया पासवर्ड अनुरोध करते हैं। उपयोगकर्ता को एक लिंक प्रदान करने के लिए एक प्रतिस्थापन सेट किया गया है। आसान प्रतिस्थापन _ACTION_URL_ के साथ।
be_mail_exp_mchange=पंजीकृत उपयोगकर्ता ईमेल में परिवर्तन के लिए ईमेल टेम्पलेट। यह टेम्पलेट तब भेजा जाता है जब उपयोगकर्ता अपना प्राथमिक ईमेल बदलता है या जब इसे सामान्य रूप से बदला जाता है। नए मेल को सक्रिय और पुष्टि करने के लिए उपयोगकर्ता को एक लिंक प्रदान करने के लिए एक प्रतिस्थापन सेट किया गया है। सक्रियण URL के लिए आसान प्रतिस्थापन _ACTION_URL_ के साथ।
be_mail_exp_acti=पंजीकृत उपयोगकर्ताओं को सक्रिय करने के लिए ईमेल टेम्पलेट। यह टेम्पलेट तब भेजा जाता है जब उपयोगकर्ता या कंपनी कर्मचारी बनाए जाते हैं। उपयोगकर्ता को एक लिंक प्रदान करने के लिए एक प्रतिस्थापन सेट किया गया है। नए खाते को सक्रिय करने के लिए आसान प्रतिस्थापन _ACTION_URL_ के साथ। उपयोगकर्ता खाते को सक्रिय करने के लिए पासवर्ड भी पुनः प्राप्त कर सकता है।
be_se_key_mch=मेल सक्रियण कुंजी
b_permission=अनुमतियाँ
be_user_area_name=उपयोगकर्ता प्रबंधन
be_user_area_create=उपयोगकर्ता जोड़ें
be_usr_ad_errgm=उपयोगकर्ता बना दिया गया है, लेकिन सक्रियण मेल भेजने का प्रयास करते समय एक त्रुटि हुई!
be_noti_user_crea=कृपया ध्यान दें, यदि किसी उपयोगकर्ता ने अपने खाते की पुष्टि नहीं की है और कोई अन्य उपयोगकर्ता उसी मेल के साथ साइन अप करने का प्रयास करता है - तो प्रारंभिक अपुष्ट उपयोगकर्ता हटाया जा सकता है। इससे डेटा हानि हो सकती है। इसलिए सुनिश्चित करें कि आप हमेशा पुष्टि किए गए उपयोगकर्ताओं के साथ काम कर रहे हैं यदि आप नहीं चाहते कि सिस्टम उन्हें हटा दे। उपयोगकर्ताओं को अपुष्ट करने के लिए कभी भी कार्यक्षमताओं का उपयोग न करें, क्योंकि इससे भी डेटा हानि हो सकती है।
be_usr_ad_errg=उपयोगकर्ता बनाने का प्रयास करते समय त्रुटि।
be_usr_ad_hpasserem=चुना गया पासवर्ड अनुशंसाओं के अनुरूप नहीं है!
be_usr_ad_hpass=पासवर्ड
be_usr_ad_h=सक्रियण प्रक्रिया
be_usr_ad_rec=मेल सक्रियण का अनुरोध करें और उपयोगकर्ता को अपना पासवर्ड सेट करने दें
be_usr_ad_act=केवल मेल द्वारा सक्रियण का अनुरोध करें
be_usr_ad_ok=इस उपयोगकर्ता को बिना किसी सक्रियण प्रक्रिया के सक्रिय करें
be_puser_noview=यह उपयोगकर्ता मौजूद नहीं है!
be_puser_cpass=पासवर्ड बदलें
be_puser_cpass1=पासवर्ड की पुष्टि करें
be_puser_cpass2=नया पासवर्ड
be_puser_cper=अनुमतियाँ बदलें
be_puser_chmm=उपयोगकर्ता मेल बदलें
be_puser_chmm1=नया मेल
be_puser_chdele=उपयोगकर्ता हटाएं
be_puser_chdele1=उपयोगकर्ता संचालन
be_puser_chdele7=यह उपयोगकर्ता वर्तमान में मेल द्वारा पुष्टि नहीं किया गया है!
be_puser_chdele8=यह उपयोगकर्ता वर्तमान में अवरुद्ध है!
be_puser_chdele9=यह उपयोगकर्ता वर्तमान में अक्षम है!
be_puser_chdele10=यह प्रारंभिक सुपर-एडमिन खाता है! इसकी हमेशा इस एडमिन पैनल तक पूर्ण पहुंच होती है!
be_puser_chdele11=यह प्रोफ़ाइल आपके अलावा किसी अन्य उपयोगकर्ता की है! सेटिंग्स बदलते समय सावधान रहें, क्योंकि परिवर्तनों का उपयोगकर्ता के अनुभव पर प्रभाव पड़ेगा!
be_puser_chdele12=नए मेल सक्रियण की प्रतीक्षा कर रहा है:
be_puser_chdele13=ऑपरेशन रद्द करने के लिए यहां क्लिक करें।
be_puser_chdele14=मेल खाली नहीं हो सकता!
be_puser_chdele15=अज्ञात त्रुटि
be_puser_chdele16=इस उपयोगकर्ता के लिए मेल बदलने की कार्यक्षमता वर्तमान में अक्षम है!
be_puser_chdele17=इस उपयोगकर्ता का मेल बदलने की अनुमति नहीं है।
be_puser_chdele18=उस मेल के साथ पहले से ही एक सक्रिय उपयोगकर्ता मौजूद है! उपयोगकर्ताओं पर डुप्लिकेट मेल संभव नहीं हैं।
be_puser_chdele19=आपको मेल बदलने के अनुरोधों के बीच एक विशिष्ट समय अवधि की प्रतीक्षा करनी होगी:
be_puser_chdele20=मिनट
be_puser_chdele21=कृपया नए मेल को सक्रिय करने के लिए अपने नए मेल इनबॉक्स की जांच करें!
be_puser_chdele22=सक्रियण ईमेल भेजने में एक त्रुटि हुई!
be_puser_chdele23=मेल बदलने का अनुरोध रद्द कर दिया गया है!
be_op_usr_1=पासवर्ड में एक पूर्णांक, एक छोटा और एक बड़ा अक्षर होना चाहिए! कम से कम आपको 10 चिह्न होने चाहिए।
be_op_usr_2=पासवर्ड खाली नहीं हो सकते!
be_op_usr_3=पासवर्ड मेल नहीं खाते!
be_op_usr_4=पासवर्ड बदल दिया गया है!
be_op_usr_6=उपयोगकर्ता अनुमतियाँ बदल दी गई हैं!
be_op_usr_11=उपयोगकर्ता की पुष्टि कर दी गई है और अब वह लॉगिन कर सकता है!
be_op_usr_12=उपयोगकर्ता हटा दिया गया है!
be_book_area_create=पुस्तक बनाएं
