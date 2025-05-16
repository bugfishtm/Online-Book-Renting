<?php
	/* 
		 ____  __  __  ___  ____  ____  ___  _   _ 
		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
				 ___ _   _ ___ _____ ___ ___ ___ ___ _  _ 
				/ __| | | |_ _|_   _| __| __|_ _/ __| || |
				\__ \ |_| || |  | | | _|| _| | |\__ \ __ |
				|___/\___/|___| |_| |___|_| |___|___/_||_|
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
	////////////////////////////////////////////////////////////////////////////////////////
	// This is the loader File
	// If your site module is choosing active in the current session
	// This file will be the loader file for your site module!
	// Do what you want here!
	// But comply to the rules of the documentation
	////////////////////////////////////////////////////////////////////////////////////////
	if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); } ?>
		<?php
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
			hive__default_volt_header($object, "Site Example", '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico"><meta name="robots" content="noindex, nofollow">', "dark");
		?>		
		<style>
			/*-----------------------------------------*/
			/* Eventbox Admin Template Stylesheet */
			/*-----------------------------------------*/
			/******************************************************* x_class_eventbox  *********/
			.x_class_eventbox {
				position: fixed;
				top: 0px;
				right: 20px;
				z-index: 1000 !important;
			}

			.x_class_eventbox_inner {
				max-width: 500px;
			}
			.x_class_eventbox_msg {
				max-width: 500px;
				border-radius: 5px;
				padding: 15px;
				margin-top: 20px;
			}
			.x_class_eventbox_msg_ok {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_error {
				background: #F9D2DA;
				color: #87112B;
				border: 1px solid #F6BBC8;
			}
			.x_class_eventbox_msg_warning {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_info {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_close {
				background: #1F2937;
				border-radius: 5px;
				padding: 5px;
				color: white;
				cursor: pointer;
				width: 80px;
				font-weight: bold;
				font-size: 12px;
				position: absolute;
				float: right;
				right: 15px;
				border: 0px solid black;
				text-align: center;
			}
			.x_class_eventbox_msg_close:hover {
				background: #E5E7EB;
				color: black;
				border: 0px solid black;
			}
		</style>	
		<div class="container mb-5 mt-5">
			<div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
						<div class="text-center text-md-center mb-4 mt-md-0">
							<h1 class="mb-0 h3">Site Module Skeleton</h1>
						</div>

						<div class="containerbox mb-2">
							<b style='font-size: 16px; padding-bottom: 10px;'>Introduction</b><br />
							 This skeleton helps developers quickly deploy and structure new modules in the default modules directory. Designed for Suitefish CMS, it includes all CMS-related folders and explanations to streamline module creation and deployment.
						</div>	

						<div class="containerbox">
								<b style='font-size: 16px; padding-bottom: 10px;'>Developer Tools</b><br />
								Access the developer area below via the button to explore the backend interface, integrated with frontend and developer tools. Deny access to ./developer.php in production, as it's intended for development use only, providing quick access to configured elements.
								<br><br>
								<?php echo "<a class='btn btn-primary' href='"._HIVE_URL_REL_."/developer.php' rel='noopener' target='_blank'>Developer Tools</a><br><br>"; ?>
						</div>		
						
						<div class="containerbox">
								<b style='font-size: 16px; padding-bottom: 10px;'>Backend/Frontend</b><br />
								To get full insight to all functionalities and administration pages click on the link below. It will guide you to a page where you can activate the administration backend to be seen with your current session!
								<br><br>
								<?php echo "<a href='"._HIVE_URL_REL_."/_core/_action/admin_switch.php' rel='noopener' class='btn btn-primary'>Switch to Backend</a> "; ?>
								<?php echo "<a href='"._HIVE_URL_REL_."/_core/_action/token_switch.php' rel='noopener' class='btn btn-primary'>Switch with Token</a> "; ?>
								<br><br>
						</div>		
						
						<div class="containerbox">
								<b style='font-size: 16px; padding-bottom: 10px;'>Documentation</b><br />
								You can find documentation and help about this project on my Github Documentation Page.
								<br><br>
								<?php echo "<a href='https://bugfishtm.github.io/suitefish-cms' rel='noopener' target='_blank' class='btn btn-primary'>CMS</a> "; ?>
								<?php echo "<a href='https://bugfishtm.github.io/bugfish-framework' rel='noopener' target='_blank' class='btn btn-primary'>Framework</a><br><br>"; ?>
						</div>	
						
						
						<div class="containerbox">
							<p>I wish you the best!<br />Sincerely, Bugfish</p>
						</div>	
					</div>
				</div>
			</div>
		</div>	
	<?php
		$object["eventbox"]->show("Close");
		hive__default_volt_footer($object, "");