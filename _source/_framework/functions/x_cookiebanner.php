<?php
	/* 
			bb                       fff iii       hh      
			bb      uu   uu  gggggg ff        sss  hh      
			bbbbbb  uu   uu gg   gg ffff iii s     hhhhhh  
			bb   bb uu   uu ggggggg ff   iii  sss  hh   hh 
			bbbbbb   uuuu u      gg ff   iii     s hh   hh 
							 ggggg            sss          

			 ____  ____    __    __  __  ____  _    _  _____  ____  _  _ 
			( ___)(  _ \  /__\  (  \/  )( ___)( \/\/ )(  _  )(  _ \( )/ )
			 )__)  )   / /(__)\  )    (  )__)  )    (  )(_)(  )   / )  ( 
			(__)  (_)\_)(__)(__)(_/\/\_)(____)(__/\__)(_____)(_)\_)(_)\_)
							
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
	*/
	
	function x_cookieBanner_Pre($precookie = "", $redirect = true) { 
		if (session_status() !== PHP_SESSION_ACTIVE) {@session_start();}
		if(@$_SESSION[$precookie ."x_cookieBanner"] == true) { return false; }
		$set = false;
			if(@$_POST["x_cookieBanner"] == "submit") { $_SESSION[$precookie ."x_cookieBanner"] = true; $set = true; }
			if(@$_GET["x_cookieBanner"] == "submit")  { $_SESSION[$precookie ."x_cookieBanner"] = true; $set = true; }
			if($set AND $redirect) { Header("Location: ".@$_SERVER['REQUEST_URI']); exit(); }}
	function x_cookieBanner($precookie = "", $use_post = false, $text = false, $url_cookies = "", $redirect_url = false, $button_text = "I Agree") { 
		if (session_status() !== PHP_SESSION_ACTIVE) {@session_start();}
		if(@$_GET["x_cookieBanner"] == "submit")  { $_SESSION[$precookie ."x_cookieBanner"] = true; }
		if(@$_SESSION[$precookie ."x_cookieBanner"] == true) { return false; }
		
		if($text == false AND $url_cookies != "") { $text =  "This Website is using <a href='".$url_cookies."' target='_blank'>Session Cookies</a> for Site Functionality.";} elseif($text == false) {
			$text =  "This Website is using <b>Session Cookies</b> for Site Functionality.";
		}
				if(!$use_post) { 
		echo '<div class="x_cookieBanner">';
			echo '<div class="x_cookieBanner_inner">';
				echo $text;
					if(!$redirect_url) {  echo '<form method="get"><input type="submit" value="'.$button_text.'" class="x_cookieBanner_close"><input type="hidden" value="submit" name="x_cookieBanner"></form>'; }
					else {  echo '<form method="get" action="'.$redirect_url.'"><input type="submit" value="I Agree" class="x_cookieBanner_close"><input type="hidden" value="submit" name="x_cookieBanner"></form>';  }
			echo '</div>';		
		echo '</div>';
				} else { 
					if(@$_POST["x_cookieBanner"] == "submit") { $_SESSION[$precookie ."x_cookieBanner"] = true;  }
					else {
		echo '<div class="x_cookieBanner">';
			echo '<div class="x_cookieBanner_inner">';
				echo $text;
						if(!$redirect_url) { echo '<form method="post"><input type="submit" value="'.$button_text.'" class="x_cookieBanner_close"><input type="hidden" value="submit" name="x_cookieBanner"></form>'; }
						else { echo '<form method="post" action="'.$redirect_url.'"><input type="submit" value="I Agree" class="x_cookieBanner_close"><input type="hidden" value="submit" name="x_cookieBanner"></form>'; }
			echo '</div>';		
		echo '</div>';
					}
				}
			echo '</div>';		
		echo '</div>';
	}