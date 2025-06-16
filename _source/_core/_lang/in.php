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
string_email=ई-मेल
string_password=पासवर्ड
string_login=लॉगिन
string_register=रजिस्टर करें
string_close=बंद करें
string_error=त्रुटि

# Page - Actions
hive_login_changelanguage=आप भाषा बदल सकते हैं
hive_login_changelanguage_here=यहां.
hive_login_lostpass=पासवर्ड भूल गए?
hive_login_notregistered=पंजीकृत नहीं हैं?
hive_login_rememberme=कुकीज़ का उपयोग करें?
hive_login_recoveraccount=खाता पुनर्प्राप्त करें
hive_login_haveaccount=क्या आपके पास पहले से एक खाता है?
hive_login_password_confirm=पासवर्ड की पुष्टि करें
hive_login_mc_change_mail=ई-मेल बदलें
hive_login_mc_backtohome=मुख्य पृष्ठ पर वापस जाएं
hive_login_title_accactivation=खाता सक्रियण
hive_cannotenterwhilenologin=यदि आप लॉगिन नहीं हैं तो आप इस पृष्ठ पर प्रवेश नहीं कर सकते!
hive_cannotenterwhilelogin=यदि आप लॉगिन हैं तो आप इस पृष्ठ पर प्रवेश नहीं कर सकते!
hive_cannotoperatesiteerror=इस साइट मॉड्यूल में एक गंभीर त्रुटि है, इसलिए आप वर्तमान में कोई भी ऑपरेशन नहीं कर सकते!
hive_login_backtologin=लॉगिन पर वापस जाएं
hive_login_change_Lang=भाषा बदलें
hive_login_language_changed=भाषा बदल दी गई है!

# Login Events - General
hive_login_msg_l_wrong=गलत पासवर्ड/ई-मेल संयोजन.
hive_login_msg_csrf=फॉर्म की समय सीमा समाप्त हो गई है, कृपया पुनः प्रयास करें.
hive_login_msg_empty=कृपया आवश्यक डेटा दर्ज करें!
hive_login_msg_ipban=आपका IP वर्तमान में अवरुद्ध है; कृपया बाद में पुनः प्रयास करें.
hive_login_msg_logout=आपको लॉगआउट कर दिया गया है!
hive_login_msg_nomatchpass=पासवर्ड की पुष्टि दर्ज किए गए पासवर्ड से मेल नहीं खाती.
hive_login_doremember=क्या आप अपना पासवर्ड याद रखना चाहते हैं?

# Login Events - Login
hive_login_msg_l_ok=लॉगिन सफल.
hive_login_msg_l_blocked=आप लॉगिन नहीं कर सकते क्योंकि आपका खाता अवरुद्ध है.
hive_login_msg_l_inactive=आपका उपयोगकर्ता खाता अभी तक सक्रिय नहीं है! अपना पासवर्ड पुनर्प्राप्त करके अपना खाता सक्रिय करें या आपको प्राप्त सक्रियण ई-मेल में दिए गए URL पर क्लिक करें!
hive_login_msg_l_blockedpwf=आपने कई बार गलत पासवर्ड दर्ज किया है, और आपका खाता अवरुद्ध कर दिया गया है!
hive_login_msg_l_disabled=आपका उपयोगकर्ता खाता अक्षम कर दिया गया है!
hive_login_mail_serror=ई-मेल भेजने का प्रयास करते समय त्रुटि हुई. यह एक आंतरिक त्रुटि है जिसे जांचने और हमारी वेबसाइट के कर्मचारियों को सूचित करने की आवश्यकता है.
hive_login_msg_register_ok=कृपया अपना नया खाता सक्रिय करने के लिए अपना ई-मेल इनबॉक्स जांचें!
hive_login_msg_passfiltererror=दर्ज किया गया पासवर्ड पासवर्ड नियमों को पूरा नहीं करता है!
hive_login_msg_mailexist=आप एक ई-मेल के साथ खाता पंजीकृत करने का प्रयास कर रहे हैं जो पहले से मौजूद है!
hive_login_password_rules=पासवर्ड नियम
hive_login_password_sign=आवश्यक अक्षर:
hive_login_password_cap=आवश्यक बड़े अक्षर:
hive_login_password_small=आवश्यक छोटे अक्षर:
hive_login_password_special=आवश्यक विशेष अक्षर:
hive_login_password_numeric=आवश्यक संख्यात्मक अक्षर:

# Login Events - Mail Change
hive_login_msg_m_ok=आपने सफलतापूर्वक अपना नया ई-मेल सक्रिय कर लिया है!
hive_login_msg_m_er=नए ई-मेल पते को सक्रिय करने का प्रयास करते समय त्रुटि; कृपया पुनः प्रयास करें.
hive_login_msg_m_exp=ई-मेल सक्रियण कोड की समय सीमा समाप्त हो गई है! कृपया अपना ई-मेल बदलने का पुनः प्रयास करें!
hive_login_msg_m_res=जिस ई-मेल को आप सक्रिय करने का प्रयास कर रहे हैं, वह अब किसी अन्य खाते में उपयोग हो रहा है, इसलिए इसे आपके खाते से संबद्ध नहीं किया जा सकता!
hive_login_msg_m_block=आपके खाते को ई-मेल परिवर्तन से अवरुद्ध कर दिया गया है!
hive_login_msg_m_noadr=अनुरोध असफल रहा. कृपया बाद में पुनः प्रयास करें.
hive_login_mc_cmailtext=आपका वर्तमान ई-मेल है:
hive_login_msg_rec_ok=कृपया नया ई-मेल इनबॉक्स जांचें ताकि आप नए ई-मेल पते को सक्रिय कर सकें.
hive_login_msg_rec_err=ई-मेल पता बदलने का प्रयास करते समय त्रुटि हुई.
hive_login_msg_rec_wait=ई-मेल बदलने के बीच आपको 120 मिनट प्रतीक्षा करनी होगी!
hive_login_msg_rec_exist=जिस ई-मेल को आप बदलने का प्रयास कर रहे हैं, वह पहले से किसी अन्य उपयोगकर्ता खाते में उपयोग हो रहा है!
hive_login_msg_rec_block=आपका खाता ई-मेल परिवर्तन से अवरुद्ध है!
hive_login_msg_rec_disable=आप अक्षम खाते का ई-मेल नहीं बदल सकते!

# Login Mails
hive_login_mail_pre_change=अपना नया ई-मेल यहां सक्रिय करें: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=अपना नया ई-मेल सक्रिय करें
hive_login_mail_title_register=अपना नया खाता सक्रिय करें
hive_login_mail_pre_register=अपना खाता सक्रिय करने के लिए निम्नलिखित लिंक पर क्लिक करें: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=अपना खाता पुनर्प्राप्त करें
hive_login_mail_pre_rec=अपना खाता पासवर्ड पुनर्प्राप्त करने के लिए निम्नलिखित लिंक पर क्लिक करें: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=आपने सफलतापूर्वक अपना खाता सक्रिय कर लिया है! अब आप इस वेबसाइट पर हमारे लॉगिन पेज पर लॉगिन कर सकते हैं.
hive_login_msg_a_er=उपयोगकर्ता खाता सक्रिय करने का प्रयास करते समय त्रुटि हुई. कृपया अपना खाता पासवर्ड पुनर्प्राप्त करें या नया खाता पंजीकृत करें.
hive_login_msg_a_exp=सक्रियण टोकन अमान्य है. कृपया अपना खाता सक्रिय करने के लिए लॉगिन पेज पर अपना खाता पुनर्प्राप्त करें!
hive_login_msg_a_block=आपके खाते का सक्रियण अक्षम कर दिया गया है; कृपया बाद में पुनः प्रयास करें!

# Login - Recover Request
hive_login_msg_rr_recnewunk=दिया गया ई-मेल पंजीकृत नहीं है.
hive_login_msg_rr_recnope=आपके खाते को पासवर्ड पुनर्प्राप्त करने की अनुमति नहीं है!
hive_login_msg_rr_recnopede=आपका खाता निष्क्रिय कर दिया गया है और नए अनुरोध नहीं कर सकता!
hive_login_msg_rr_recwait=नया पुनर्प्राप्ति अनुरोध शुरू करने से पहले आपको 120 मिनट प्रतीक्षा करनी होगी!
hive_login_msg_rr_recnok=कृपया पासवर्ड रीसेट ई-मेल के लिए अपना इनबॉक्स जांचें. इस मेल में आपके पासवर्ड को पुनर्प्राप्त करने के लिए एक लिंक है.
hive_login_msg_recfr_ok=कृपया पासवर्ड पुनर्प्राप्ति लिंक प्राप्त करने के लिए अपना ई-मेल इनबॉक्स जांचें!

# Login - Recover Execute
hive_login_msg_pwtexpire=यह पासवर्ड पुनर्प्राप्ति टोकन समाप्त हो गया है! कृपया अपना खाता पुनर्प्राप्त करने का पुनः प्रयास करें.
hive_login_msg_recexecerror=आपका पासवर्ड पुनर्प्राप्त करने का प्रयास करते समय त्रुटि हुई. कृपया अपना खाता पुनर्प्राप्त करने का पुनः प्रयास करें.
hive_login_msg_recexecok=आपने सफलतापूर्वक अपना पासवर्ड पुनर्प्राप्त कर लिया है और अब आप अपने नए पासवर्ड के साथ लॉगिन कर सकते हैं.

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=थीम: गतिशील थीम रंगों के लिए डिफ़ॉल्ट रंग
hive_var_exp_2=थीम: वैध थीम्स के साथ एक क्रमबद्ध ऐरे
hive_var_exp_3=थीम: डिफ़ॉल्ट उपयोग की गई थीम
hive_var_exp_4=भाषा: वैध भाषाओं के साथ एक क्रमबद्ध ऐरे
hive_var_exp_5=भाषा: डिफ़ॉल्ट भाषा के साथ ऐरे
hive_var_exp_6=क्रियाएँ: सामान्य पंजीकरण रूप सक्रिय है? (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_7=अभी तक कोई व्याख्या नहीं।
hive_var_exp_8=क्रियाएँ: सामान्य पुनर्प्राप्ति रूप सक्रिय है? (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_9=क्रियाएँ: सामान्य सक्रियण रूप सक्रिय है? (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_10=सामान्य लॉगिन रूप सक्रिय है? (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_11=TinyMCE: प्लगइन विन्यास स्ट्रिंग
hive_var_exp_12=TinyMCE: मेनू बार विन्यास स्ट्रिंग
hive_var_exp_13=TinyMCE: उपकरण पट्टी विन्यास स्ट्रिंग
hive_var_exp_14=उपयोगकर्ता विन्यास: अधिकतम दिन सेशन/कुकीज़ वैध रहते हैं
hive_var_exp_15=उपयोगकर्ता विन्यास: सक्रियण मेल के टोकन की वैधता का समय (मिनटों में)
hive_var_exp_16=उपयोगकर्ता विन्यास: X असफल लॉगिन के बाद उपयोगकर्ता को ब्लॉक करें (0 अगर अक्षम है)
hive_var_exp_17=उपयोगकर्ता विन्यास: अनुरोधों के बीच उपयोगकर्ता को प्रतीक्षा करने का समय (फ्लडिंग से बचने के लिए)
hive_var_exp_18=उपयोगकर्ता विन्यास: पुराने सत्रों को लॉग करें? (लॉगिन, पुनर्प्राप्ति, सक्रियण, मेल परिवर्तनों के लिए) (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_19=उपयोगकर्ता विन्यास: डेटाबेस में उपयोगकर्ता IPs लॉग करें (1=सक्रिय/0=निष्क्रिय)
hive_var_exp_20=उपयोगकर्ता विन्यास: 1 - उपयोगकर्ता सफलतापूर्वक लॉग इन होने पर पुनर्प्राप्ति कुंजी हटाएं | 0 - कुंजी बनाए रखें
hive_var_exp_21=उपयोगकर्ता विन्यास: 1 - मल्टी लॉगिन अनुमति दें | 0 - मल्टी लॉगिन निष्क्रिय करें
hive_var_exp_22=पासवर्ड फ़िल्टर: न्यूनतम संकेत
hive_var_exp_23=पासवर्ड फ़िल्टर: न्यूनतम बड़े संकेत
hive_var_exp_24=पासवर्ड फ़िल्टर: न्यूनतम छोटे संकेत
hive_var_exp_25=पासवर्ड फ़िल्टर: न्यूनतम विशेष संकेत
hive_var_exp_26=पासवर्ड फ़िल्टर: न्यूनतम संख्यात्मक संकेत
hive_var_exp_27=प्रारंभिक बनाए गए उपयोगकर्ता नाम
hive_var_exp_28=प्रारंभिक बनाए गए उपयोगकर्ता पासवर्ड
hive_var_exp_29=कैप्चा: छवि ऊंचाई
hive_var_exp_30=कैप्चा: छवि चौड़ाई
hive_var_exp_31=कैप्चा: कैप्चा के लिए रंग (वैकल्पिक, 0 हो सकता है)
hive_var_exp_32=कैप्चा: फ़ॉन्ट (0 अगर डिफ़ॉल्ट फ़ॉन्ट उपयोग होगा)
hive_var_exp_33=Redis: सक्रिय किया गया? 1/0
hive_var_exp_34=Redis: होस्ट
hive_var_exp_35=Redis: पोर्ट
hive_var_exp_36=अपडेटर: इस साइट के लिए अपडेटर का शीर्षक
hive_var_exp_37=अपडेटर: क्या अपडेट के लिए कोड आवश्यक है? (0 अगर निष्क्रिय है)
hive_var_exp_38=सेटिंग्स: CURL क्लास अनुरोध लॉग करें? (1/0)
hive_var_exp_39=सेटिंग्स: X असफलताओं के बाद IP को ब्लॉक करें (0 अगर निष्क्रिय है)
hive_var_exp_40=सेटिंग्स: संदर्भकर्ता लॉग करें? (1/0)
hive_var_exp_41=सेटिंग्स: डिफ़ॉल्ट CSRF कोड की वैधता समय (सेकंड में)
hive_var_exp_42=सेटिंग्स: 1 - केवल क्रोन जॉब कमांड लाइन से निष्पादित करें | 0 - ब्राउज़र में क्रोन जॉब निष्पादित करने की अनुमति दें
hive_var_exp_43=सेटिंग्स: जावास्क्रिप्ट डिबगिंग त्रुटि लॉगिंग सक्रिय करें (1/0)
hive_var_exp_44=सेटिंग्स: वेबसाइट शीर्षक टैब और अन्य के लिए
hive_var_exp_45=सेटिंग्स: ब्राउज़र में टैब के लिए शीर्षक अंतर
hive_var_exp_46=सेटिंग्स: वेबसाइट पर PHP त्रुटियाँ दिखाएं? (1/0)
hive_var_exp_47=सेटिंग्स: आवश्यक PHP मॉड्यूल के साथ एक क्रमबद्ध ऐरे, यदि मौजूद नहीं है तो त्रुटि दिखाई जाएगी (उदाहरण: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=सेटिंग्स: यदि MySQL त्रुटियाँ होती हैं तो पृष्ठ पर उन्हें रोकें और दिखाएँ? (यह हमेशा x_log_mysql तालिका में लॉग होगा!) (1/0)
hive_var_exp_49=सेटिंग्स: 1 - SEO URLs का उपयोग करें | 0 - SEO URLs का उपयोग न करें
hive_var_exp_50=सेटिंग्स: केवल यदि _HIVE_URL_SEO_ == false [नाम के लिए श्रृंखला ऐरे में स्थान परिवर्तनीय]
hive_var_exp_51=मेल सेटिंग्स: SMTP पासवर्ड
hive_var_exp_52=मेल सेटिंग्स: SMTP उपयोगकर्ता नाम
hive_var_exp_53=मेल सेटिंग्स: SMTP प्रमाणन (ssl/tls/false)
hive_var_exp_54=मेल सेटिंग्स: SMTP पोर्ट
hive_var_exp_55=मेल सेटिंग्स: SMTP होस्ट
hive_var_exp_56=मेल सेटिंग्स: मेल डिबग मोड (0, 1, 2, 3) - उत्पादन के लिए 0 का उपयोग करें क्योंकि इससे साइट पर डिबग आउटपुट दिखेगा!
hive_var_exp_57=मेल सेटिंग्स: असुरक्षित SSL कनेक्शन की अनुमति दें? (1/0)
hive_var_exp_58=मेल सेटिंग्स: क्या सभी मेल HTML के रूप में भेजे जाते हैं? (1/0)
hive_var_exp_59=मेल सेटिंग्स: डिफ़ॉल्ट प्रेषक मेल नाम
hive_var_exp_60=मेल सेटिंग्स: डिफ़ॉल्ट प्रेषक मेल पता
hive_var_exp_61=मेल सेटिंग्स: मेल के लिए डिफ़ॉल्ट फ़ूटर
hive_var_exp_62=मेल सेटिंग्स: मेल के लिए डिफ़ॉल्ट हैडर
