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
store_version_name=टेम्पलेट: Docker मॉड्यूल
store_version_description=हमारे एडमिनिस्ट्रेटर मॉड्यूल के लिए Docker सर्वर मैनेजर एक्सटेंशन के लिए एक Docker मॉड्यूल उदाहरण, विशेष रूप से डेवलपर्स के लिए। Docker मॉड्यूल के बारे में अधिक जानकारी Suitefish दस्तावेज़ और रिपॉजिटरी में संबंधित Readme.md फ़ाइलों में पाई जा सकती है।

##########################################################################################
## Substitution Explanation Translations
##########################################################################################
var_password=MySQL डेटाबेस एक्सेस के लिए कंटेनर सेटअप पर बनाए जाने वाले पासवर्ड को परिभाषित करें।
var_user=MySQL डेटाबेस एक्सेस के लिए कंटेनर सेटअप पर बनाए जाने वाले उपयोगकर्ता नाम को परिभाषित करें।
var_port=होस्ट सिस्टम पर MySQL इंस्टेंस के लिए एक पोर्ट परिभाषित करें।
