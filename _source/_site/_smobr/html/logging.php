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

	
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("be_logging");
		$trts_general 	= "id as yeaid, creation, message, id";
		$item_general 	= $object["lang"]->translate("be_logging");
		$text_general 	= $object["lang"]->translate("be_exp_logging");
		$table_general 	= _TABLE_LOG_;
		$table_title   	= array(array("name" => $object["lang"]->translate("be_list_h_id")),
							    array("name" => $object["lang"]->translate("be_list_h_date")),
							    array("name" => $object["lang"]->translate("be_list_h_content")));
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");
		
		// Table Flush Operation
		if(@$_POST["hive_submit_flush_table"] OR @$_GET["op"] == "flush") {
			if(@$_GET["confirm"] != "confirmed") { 
				?>
				<script>
					Swal.fire({
					  title: "<?php echo $object["lang"]->translate("be_list_h_btn_flush"); ?>",
					  html: "<?php echo $object["lang"]->translate("be_list_h_btn_flush_rly"); ?><form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&confirm=confirmed"; ?>'><input type='hidden' name='hive_submit_flush_table_token' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='hive_submit_flush_table' value='1'><input type='submit' class=\"btn btn-danger\" style=\"background: red;color: white;\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
					  showCancelButton: false,
					  showCloseButton: true,
					  showConfirmButton: false
					});
				</script>
				<?php 
			} else { 
				if($object["csrf"]->check(@$_POST["hive_submit_flush_table_token"])) { 
					$object["mysql"]->query("DELETE FROM ".$table_general."");
					$object["mysql"]->query("ALTER TABLE ".$table_general." AUTO_INCREMENT = 1");
					$object["eventbox"]->warning($object["lang"]->translate("be_list_h_exec_flush"));
					$object["log"]->info("[FLUSH] [TABLE] ".$table_general." [UID] ".$object["user"]->user_id."", "logging_logging");
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }		 
			}
		}			
		
		////////////////////////////////////////////////////////////////
		// Get Table Values
		////////////////////////////////////////////////////////////////
		$limitx = ""; 
		$bind[0]["value"] = _HIVE_MODE_;
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general." WHERE section = ? ORDER BY id DESC ".$limitx."", true, $bind);
		
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["creation"] = @htmlspecialchars($value_array[$key]["creation"] ?? '');
				$value_array[$key]["message"] = @htmlspecialchars($value_array[$key]["message"] ?? '');
			}
		}

		
		//hive__volt_box_start(false);
			echo hive__volt_h2($item_general);
		//hive__volt_box_end();
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		// Display the Information Box!
		echo hive__volt_alert_secondary($text_general);
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Operations Bar!
		hive__volt_box_start(false);
			echo "<form method='post' action='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."'>";
				echo '<button onclick="" name="hive_submit_flush_table" type="submit" class="btn btn-danger"><span>'.$object["lang"]->translate("be_list_h_btn_flush").'</span><i class="bx bx bx-trash xfpe_marginleft10px"></i></button>';
				echo "<input type='hidden' name='hive_submit_flush_table_token' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='hive_submit_flush_table' value='1'>";
			echo "</form>";
		hive__volt_box_end();
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";
		
		// Display the Table!
		hive__volt_box_start(false);
		$tbl->spawn_table($table_title, $value_array, false, false, false, false, "display");
		hive__volt_box_end();