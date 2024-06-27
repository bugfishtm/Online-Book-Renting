<?php
	/* 	 _           ___ _     _   _____ _____ _____ 
		| |_ _ _ ___|  _|_|___| |_|     |     |   __|
		| . | | | . |  _| |_ -|   |   --| | | |__   |
		|___|___|_  |_| |_|___|_|_|_____|_|_|_|_____|
				|___|                                
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
		
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } 
	if($object["ipbl"]->blocked()) { 
			hive__simple_start($object, "You are temporary blocked!", ''); ?>
			<div class="containerbox" style="text-align: center;">
				
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">

				<defs>
				</defs>
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
					<path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<path d="M 28.902 66.098 c -1.28 0 -2.559 -0.488 -3.536 -1.465 c -1.953 -1.952 -1.953 -5.118 0 -7.07 l 32.196 -32.196 c 1.951 -1.952 5.119 -1.952 7.07 0 c 1.953 1.953 1.953 5.119 0 7.071 L 32.438 64.633 C 31.461 65.609 30.182 66.098 28.902 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<path d="M 61.098 66.098 c -1.279 0 -2.56 -0.488 -3.535 -1.465 L 25.367 32.438 c -1.953 -1.953 -1.953 -5.119 0 -7.071 c 1.953 -1.952 5.118 -1.952 7.071 0 l 32.195 32.196 c 1.953 1.952 1.953 5.118 0 7.07 C 63.657 65.609 62.377 66.098 61.098 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				</g>
				</svg>
					<p>Your IP-Adress is currently blocked!<br />Please try again later or contact our support team.</p>
			</div>
			<?php hive__simple_end($object, false); exit();
	}	
	if(defined("_HIVE_USR_MC_DISABLE_")) { 
		if(_HIVE_USR_MC_DISABLE_) { 
			hive__simple_start($object, "Functionality Disabled", ''); ?>
			<div class="containerbox" style="text-align: center;">
				
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">

				<defs>
				</defs>
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
					<path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<path d="M 28.902 66.098 c -1.28 0 -2.559 -0.488 -3.536 -1.465 c -1.953 -1.952 -1.953 -5.118 0 -7.07 l 32.196 -32.196 c 1.951 -1.952 5.119 -1.952 7.07 0 c 1.953 1.953 1.953 5.119 0 7.071 L 32.438 64.633 C 31.461 65.609 30.182 66.098 28.902 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
					<path d="M 61.098 66.098 c -1.279 0 -2.56 -0.488 -3.535 -1.465 L 25.367 32.438 c -1.953 -1.953 -1.953 -5.119 0 -7.071 c 1.953 -1.952 5.118 -1.952 7.071 0 l 32.195 32.196 c 1.953 1.952 1.953 5.118 0 7.07 C 63.657 65.609 62.377 66.098 61.098 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				</g>
				</svg>
					<p>Functionality disabled by site module!</p>
			</div>
			<?php hive__simple_end($object, false); exit();
		}
	}
	if(defined("_HIVE_USR_MC_REFER_")) {  
		if(_HIVE_USR_MC_REFER_) {
			$refer = trim(_HIVE_USR_MC_REFER_ ?? '');
			if(strpos(_HIVE_USR_MC_REFER_, "?") > 0) { $refer = _HIVE_USR_MC_REFER_."&"; }
				else { $refer = _HIVE_USR_MC_REFER_."?"; }
			Header("Location: ".$refer."mai_token=".@$_GET["mai_token"]."&mai_user=".@$_GET["mai_user"]);
			exit();
		}
	}
	$return = hive__template_mail_activate($object, "mai_token", "mai_user", false, false );
	
	if($object["lang"]->translate("hive_login_msg_m_thead") != "hive_login_msg_m_thead") { $text = $object["lang"]->translate("hive_login_msg_m_thead"); } else { $text = "E-Mail Activation";}
// Simple Theme Header
	hive__simple_start($object, $text, ''); 
	$text = "";
		if($return == 1) { if($object["lang"]->translate("hive_login_msg_m_ok") != "hive_login_msg_m_ok") { $text = $object["lang"]->translate("hive_login_msg_m_ok");  } else { $text = "You have successfully activated your new mail!";} }
		elseif($return == 2) {  $object["ipbl"]->raise(); if($object["lang"]->translate("hive_login_msg_m_er") != "hive_login_msg_m_er") { $text = $object["lang"]->translate("hive_login_msg_m_er"); } else { $text = "Error activating your new Mail!";}}
		elseif($return == 3) { if($object["lang"]->translate("hive_login_msg_m_exp") != "hive_login_msg_m_exp") { $text = $object["lang"]->translate("hive_login_msg_m_exp"); } else { $text = "Mail Activation code expired! Please retry to change your mail in the profile setup!";}}
		elseif($return == 4) { if($object["lang"]->translate("hive_login_msg_m_res") != "hive_login_msg_m_res") { $text = $object["lang"]->translate("hive_login_msg_m_res"); } else { $text = "The mail you tried to activate is now used on another account, so it cannot be related to your account!";}}
		elseif($return == 5) { if($object["lang"]->translate("hive_login_msg_m_block") != "hive_login_msg_m_block") { $text = $object["lang"]->translate("hive_login_msg_m_block"); } else { $text = "Your account is blocked for mail changes!";}}
		elseif($return == 6) { if($object["lang"]->translate("hive_login_msg_m_res") != "hive_login_msg_m_res") { $text = $object["lang"]->translate("hive_login_msg_m_res"); } else { $text = "The mail you tried to activate is now used on another account, so it cannot be related to your account!";}}
		else { if($object["lang"]->translate("hive_login_msg_m_noadr") != "hive_login_msg_m_noadr") { $text = $object["lang"]->translate("hive_login_msg_m_noadr"); } else { $text = "The request has been failed. Please try again later.";}}

	?>

	<div class="containerbox" style="text-align: center;">
		
			<?php if($return != 1) {  ?>
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">

		<defs>
		</defs>
		<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
			<path d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
			<path d="M 28.902 66.098 c -1.28 0 -2.559 -0.488 -3.536 -1.465 c -1.953 -1.952 -1.953 -5.118 0 -7.07 l 32.196 -32.196 c 1.951 -1.952 5.119 -1.952 7.07 0 c 1.953 1.953 1.953 5.119 0 7.071 L 32.438 64.633 C 31.461 65.609 30.182 66.098 28.902 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
			<path d="M 61.098 66.098 c -1.279 0 -2.56 -0.488 -3.535 -1.465 L 25.367 32.438 c -1.953 -1.953 -1.953 -5.119 0 -7.071 c 1.953 -1.952 5.118 -1.952 7.071 0 l 32.195 32.196 c 1.953 1.952 1.953 5.118 0 7.07 C 63.657 65.609 62.377 66.098 61.098 66.098 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
		</g>
		</svg>
			<?php } else {  ?>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">

				<defs>
				</defs>
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
					<circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(93,201,121); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
					<path d="M 69.643 24.047 c -0.566 -0.72 -1.611 -0.862 -2.342 -0.309 c -6.579 4.976 -12.729 10.529 -18.402 16.574 c -3.022 3.229 -5.905 6.603 -8.599 10.161 c -1.431 1.904 -2.808 3.86 -4.109 5.889 h -0.082 l -7.6 -15.206 c -0.073 -0.146 -0.157 -0.293 -0.247 -0.433 c -1.401 -2.168 -4.343 -2.741 -6.462 -1.209 c -1.987 1.437 -2.337 4.279 -1.006 6.339 l 12.304 19.043 l 0.151 0.234 c 0.435 0.676 1.13 1.198 2.019 1.398 c 1.525 0.343 3.04 -0.567 3.671 -1.997 c 1.623 -3.678 3.724 -7.281 6.016 -10.76 c 2.337 -3.525 4.898 -6.936 7.614 -10.228 c 5.102 -6.169 10.74 -11.942 16.842 -17.188 C 70.093 25.768 70.199 24.754 69.643 24.047 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
				</g>
				</svg>
			<?php } ?>
		
		<p>
		<?php echo $text; ?><br /><a href="../"><?php 
		
		if($object["lang"]->translate("hive_login_msg_m_getback") != "hive_login_msg_m_getback") { $text = $object["lang"]->translate("hive_login_msg_m_getback"); } else { $text = "Click here to go back to the website!";}
		echo $text; ?></a></p>
	</div>	

	<?php // Simple Theme Footer
	hive__simple_end($object, false);