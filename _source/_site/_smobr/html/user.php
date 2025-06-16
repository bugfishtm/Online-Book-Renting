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
	if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); } 
	
		$table_general = _TABLE_USER_;
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
		echo "<div class='xfpe_margintop15px'></div>";
		
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("be_user_area_name"); 
		$trts_general 	= "id as gid, user_mail, user_confirmed, user_disabled, user_blocked, id, user_firstname, user_lastname, user_street, user_postcode, user_country, user_region";
		$item_general 	= $object["lang"]->translate("be_user_area_name");
		$text_general 	= $object["lang"]->translate("be_exp_usrlst");
		$table_general 	= _TABLE_USER_;
		$table_title   	= array(array("name" => $object["lang"]->translate("be_user_area_mail")), 
								array("name" => $object["lang"]->translate("be_user_area_usrname")),
								array("name" => $object["lang"]->translate("be_user_area_adr")));
			
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");
		
		// Table Edit Arrays and Create
		$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."");		
		
		// Get Table Values
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["user_mail"] = "<a class='text-primary text-decoration-underline' href='"."./?"._HIVE_URL_GET_[0]."=profile&id=".$value_array[$key]["id"].""."'>".@htmlspecialchars($value_array[$key]["user_mail"])."</a>";
				$value_array[$key]["gid"] = "<a href='"."./?"._HIVE_URL_GET_[0]."=user&"._HIVE_URL_GET_[1]."=profile&id=".$value_array[$key]["id"].""."'>".@htmlspecialchars($value_array[$key]["id"])."</a>";

				
				$value_array[$key]["user_firstname"] = hive__hsc($value_array[$key]["user_firstname"])." ".hive__hsc($value_array[$key]["user_lastname"]);
				if(@trim($value_array[$key]["user_firstname"] ?? '') == "") { $value_array[$key]["user_firstname"] = "- - -"; }

				$value_array[$key]["user_lastname"] = hive__hsc($value_array[$key]["user_street"])." ";
				if(@trim($value_array[$key]["user_postcode"] ?? '') != "") { $value_array[$key]["user_lastname"] .= "<br />".hive__hsc($value_array[$key]["user_postcode"]); }
				if(@trim($value_array[$key]["user_postcode"] ?? '') == "" AND @trim($value_array[$key]["user_region"] ?? '') != "") { $value_array[$key]["user_lastname"] .= "<br />".hive__hsc($value_array[$key]["user_region"]); }
				if(@trim($value_array[$key]["user_postcode"] ?? '') != "" AND @trim($value_array[$key]["user_region"] ?? '') != "") { $value_array[$key]["user_lastname"] .= " ".hive__hsc($value_array[$key]["user_region"]); }			
				if(@trim($value_array[$key]["user_country"] ?? '') != "") { $value_array[$key]["user_lastname"] .= "<br />".hive__hsc($value_array[$key]["user_country"]); }		
				if(@trim($value_array[$key]["user_lastname"] ?? '') == "") { $value_array[$key]["user_lastname"] = "- - -"; }
				if($value_array[$key]["user_confirmed"] == 1) {
					$value_array[$key]["user_mail"] .= " <span class='badge bg-success'>".$object["lang"]->translate("b_active")."</span>";
				} else {
					$value_array[$key]["user_mail"] .= " <span class='badge bg-danger'>".$object["lang"]->translate("b_inactive")."</span>";
				}
				$value_array[$key]["user_firstname"] = $value_array[$key]["user_firstname"];
				$value_array[$key]["user_lastname"] = $value_array[$key]["user_lastname"];
				//$value_array[$key]["user_mail"] .= "<br /><small>".$object["lang"]->translate("be_usrl_active").":</small> ".$tmp;
				unset($value_array[$key]["user_confirmed"]);
				unset($value_array[$key]["user_blocked"]);
				unset($value_array[$key]["user_disabled"]);
				unset($value_array[$key]["gid"]);
				unset($value_array[$key]["user_region"]);
				unset($value_array[$key]["user_country"]);
				unset($value_array[$key]["user_postcode"]);
				unset($value_array[$key]["user_street"]);
			}
		}
		
		// Div with Top Margin for Elements!
		echo "<h2>".$title_general."</h2>";
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>"; 
		
		// Display the Information Box!
		echo hive__volt_alert_secondary($text_general);

		// Display the Information Box!
		if(@$_GET["add"] == "true") { 
			if(@$_POST["form_add_user"] == "add") {
				if($object["csrf"]->check($_POST["form_csrf"])) {
					if(@trim(@$_POST["form_user_mail"] ?? '') != "") {
						if($object["user"]->passfilter_check(@$_POST["form_user_pass"])) { 
							$result = $object["user"]->addUser(@trim(@$_POST["form_user_mail"]), @trim(@$_POST["form_user_mail"]), @$_POST["form_user_pass"], 1, 1);	
							$tmpinsert = @$object["mysql"]->insert_id();
							$object["log"]->info("[CREATE] [USER] [TABLE] ".$table_general." [ID] ".@$tmpinsert." [UID] ".$object["user"]->user_id."", "user");
							if($result == 1) {
								$object["eventbox"]->ok($object["lang"]->translate("be_usr_ad_hmaok"));
								$object["eventbox"]->skip();
								echo "<script>window.location.href=\"./?hl1=profile&id=".$tmpinsert."\";</script>";
							} else { $object["eventbox"]->error($object["lang"]->translate("be_usr_ad_hmailex")); }
						} else {
							$object["eventbox"]->error($object["lang"]->translate("be_password_filter_setup"));
						}			
					} else { $object["eventbox"]->error($object["lang"]->translate("be_usr_ad_herem")); }
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }
			}

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
	
		// Display the Operations Bar!
		hive__volt_box_start(false, false);
		
		echo "<h4>".$object["lang"]->translate("be_user_area_create")."</h4>";			
		echo hive__volt_alert_secondary($object["lang"]->translate("be_password_filter_setup"));
	?>
	
		<form method="post" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&add=true"; ?>">
			<label class="block text-sm">
				<span class="text-gray-700 dark:text-gray-400"><?php echo $object["lang"]->translate("be_user_area_mail"); ?></span>
				<input class="form-control" name="form_user_mail">
			</label><br />
			<label class="block text-sm">
				<span class="text-gray-700 dark:text-gray-400"><?php echo $object["lang"]->translate("be_usr_ad_hpass"); ?></span>
				<input class="form-control" type="password" name="form_user_pass">
			</label><br />	
			<br />			
			<button class="btn btn-primary" ><?php echo $object["lang"]->translate("string_add"); ?></button><br />
			<br />
			
		<?php 
			echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
			echo "<input type='hidden' name='form_add_user' value='add'>";
			echo "<input type='hidden' name='form_user_act' value='ok'>";
			echo "</form>";

			// Div with Top Margin for Elements!
			echo "<a href='".hive__url(array("user", false, false))."' class='text-danger'>".$object["lang"]->translate("be_edit_abort")."</a>"; 

			// Div with Top Margin for Elements!
			hive__volt_box_end();	
			
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
		} 

		// Display the Table!
		hive__volt_box_start(false, false);
		if(@$_GET["add"] != "true") {
			echo '<button class="btn btn-primary" onclick="window.location.href=window.location.href+\'&add=true\';">'.$object["lang"]->translate("string_add").'</button><br /><br />';
		}
		$tbl->spawn_table($table_title, $value_array, false, false, false, false, "display");
		hive__volt_box_end();