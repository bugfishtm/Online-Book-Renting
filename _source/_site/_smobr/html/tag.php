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
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("be_tag_raw");
		$trts_general 	= "tag_title, id";
		$item_general 	= $object["lang"]->translate("be_tag_raw");
		$text_general 	= $object["lang"]->translate("be_tag_exp");
		$table_general 	= __OBR_TABLE_TAG_;
		$table_title   	= array(array("name" => $object["lang"]->translate("be_tag"))); 
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");

		// Table Edit Arrays and Create
		$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."");
		$create_ar  = array();
		$create_ar[0]["field_name"] 	= "tag_title";
		$create_ar[0]["field_label"] 	= $object["lang"]->translate("be_tag_rawn");
		$create_ar[0]["field_type"] 	= "string";
		$create_ar[0]["field_ph"] 		= "";
		$create_ar[0]["field_classes"] 	= "form-control";
		$edit_ar    = array();
		$edit_ar[0]["field_name"] 		= "tag_title";
		$edit_ar[0]["field_label"] 		= $object["lang"]->translate("be_tag_rawn");
		$edit_ar[0]["field_type"] 		= "string";
		$edit_ar[0]["field_ph"] 		= "";
		$edit_ar[0]["field_classes"] 	= "form-control";
		$tbl->config_array($create_ar, $edit_ar);			

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";		
		
		// Delete Item Operations
		if(is_numeric(@$_POST["x_class_table_exec_deletetable"])) {
			if(@$_GET["confirm"] != "confirmed") { ?>
						<script>
					Swal.fire({
					  title: "",
					  html: "<?php echo $object["lang"]->translate("be_tag_chdele"); ?><form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&confirm=confirmed"; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='x_class_table_exec_deletetable' value='<?php echo @$_POST["x_class_table_exec_deletetable"]; ?>'><input type='hidden' name='x_class_table_exec_csrftable' value='<?php echo @$tbl->csrfobj->get(); ?>'><input type='hidden' name='x_class_table_exec_del_submittable' value='1'><input type='submit' class=\"btn btn-danger\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
					  showCancelButton: false,
					  showCloseButton: true,
					  showConfirmButton: false
					});
				</script> <?php
			} else {	
				$output1 =  $tbl->exec_delete();
				if($output1 == "deleted") { $object["eventbox"]->warning($object["lang"]->translate("be_list_exec_idel"));
											$object["log"]->info("[DELETION] [TAG] [TABLE] ".$table_general." [ID] ".@$_POST["x_class_table_exec_deletetable"]." [UID] ".$object["user"]->user_id."", "tag");}
				if($output1 == "csrf") { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}
			}
		}
		
		// Delete Operations
		$output1 =  $tbl->exec_create();
		if($output1 == "created") { 
						if(@$object["mysql"]->insert_id() > 0) {
							$object["log"]->info("[CREATE] [TAG] [TABLE] ".$table_general." [ID] ".@$object["mysql"]->insert_id()." [UID] ".$object["user"]->user_id."", "tag");
							$object["eventbox"]->warning($object["lang"]->translate("be_str_item_created"));
						} 
									}
		if($output1 == "csrf") { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}
		
		// Delete Operations
		$output1 =  $tbl->exec_edit();
		if($output1 == "edited") { $object["eventbox"]->warning($object["lang"]->translate("be_list_exec_iedit")); 
			$object["log"]->info("[CHANGE] [TAG] [TABLE] ".$table_general." [ID] ".@$_POST["x_class_table_exec_edittable"]." [UID] ".$object["user"]->user_id."", "tag");}
		if($output1 == "csrf") { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}

		// Get Table Values
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["tag_title"] = @htmlspecialchars($value_array[$key]["tag_title"]);
			}
		}
		
		// Display the Information Box!
		echo hive__volt_h2($title_general);
		
		// Display the Information Box!
		echo hive__volt_alert_warning($text_general);
			

		if(@$_GET["op"] == "create") {
			hive__volt_box_start(false, false);
			echo "<h4>".$object["lang"]->translate("be_tag_add")."</h4>";
			$tbl->spawn_create(hive__hen($object["lang"]->translate("be_tag_add")), "btn btn-primary");
			echo "<br /><a href='".hive__url(array("tag", false, false))."' class='text-danger'>".$object["lang"]->translate("be_edit_abort")."</a>"; 
			hive__volt_box_end();
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";	
		} elseif(@$_POST["x_class_table_exec_edittable"] ) {
			hive__volt_box_start(false, false);
			echo "<h4>".$object["lang"]->translate("be_tag_edit")."</h4>";
			$tbl->spawn_edit(hive__hen($object["lang"]->translate("be_tag_edit")), "btn btn-primary");
			echo "<br /><a href='".hive__url(array("tag", false, false))."' class='text-danger'>".$object["lang"]->translate("be_edit_abort")."</a>"; 
			hive__volt_box_end();
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";	
		}
		
		// Display the Table!
		hive__volt_box_start(false, false);
		if(@$_GET["op"] != "create") {
				echo '<button onclick="window.location.href = \''.hive__url(array("tag", false, false)).'&op=create\';" type="button" class="btn btn-primary"><span>'.$object["lang"]->translate("be_tag_add").'</span></button><br /><br />';
		}
		//$tbl->spawn_table($table_title, $value_array, $object["lang"]->translate("b_edit"), "<span class='btn btn-danger'>".$object["lang"]->translate("b_delete")."</span>", false, $object["lang"]->translate("b_action"), "display");
		$tbl->spawn_table($table_title, $value_array, '<span class="btn btn-icon-only btn-primary d-inline-flex align-items-center" type="button"><i style="font-size: 24px;" class=\'bx bxs-edit-alt\' ></i></span>', '<span class="btn btn-icon-only btn-danger d-inline-flex align-items-center" type="button"><i style="font-size: 24px;" class=\'bx bx-trash\' ></i></span>', false, $object["lang"]->translate("b_action"), "display");
		hive__volt_box_end();
	