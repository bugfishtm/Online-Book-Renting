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
	
		$object["add_top_title"] = $object["lang"]->translate("be_deadlines"); 
		$object["add_head_title"] = $object["add_top_title"];
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);	
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("be_deadline_raw");
		$trts_general 	= "fk_book, fk_book_item, due_date, rent_descr, is_returned, id, fk_user";
		$item_general 	= $object["lang"]->translate("be_deadline_raw");
		$text_general 	= $object["lang"]->translate("be_deadline_exp");
		$table_general 	= __OBR_TABLE_BOOKR_;
		$table_title   	= array(array("name" => $object["lang"]->translate("in_storage"))); 
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");	

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";		

		// Get Table Values
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general." WHERE is_returned <> 1", true);

		echo hive__volt_h2($title_general);
		
		// Display the Information Box!
		echo hive__volt_alert_secondary($text_general);

		// Display the Table!
		hive__volt_box_start(false, false);
		echo "<table class='obr_datatable_init_class'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_book"))."</th>";
					echo "<th>".hive__hsc($object["lang"]->translate("b_user"))."</th>";
					echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_barcode"))."</th>";
					echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_duedate"))."</th>";
					echo "<th>".hive__hsc($object["lang"]->translate("b_description"))."</th>";
					echo "<th>".hive__hsc($object["lang"]->translate("b_status"))."</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		if(is_array($value_array)) {
			foreach($value_array as $k => $v) {
				$b = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = ".$v["fk_book"]."");
				$bi = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE id = ".$v["fk_book_item"]."");
				echo "<tr>";
					echo "<td><a href='./?hl1=view&id=".$b["id"]."'>".hive__hsc($b["book_title"])."</a></td>";
					echo "<td><a href='./?hl1=profile&id=".$v["fk_user"]."'>UID#".hive__hsc($v["fk_user"])."</a></td>";
					echo "<td>".hive__hsc($bi["book_barcode"])."</td>";
					echo "<td>".hive__hsc(adm_date_format($v["due_date"]))."</td>";
					echo "<td>".hive__hsc($v["rent_descr"])."</td>";
					$status = "";
					$datetime = $v["due_date"];
					$today = new DateTime('today');
					$datetime_object = new DateTime($datetime);
					if($datetime_object >= $today && $datetime_object < $today->modify('+1 day')) { $status = "<span class='badge bg-warning'>".hive__hsc($object["lang"]->translate("b_today_return"))."</span>"; }
					elseif($datetime_object < $today) { $status = "<span class='badge bg-danger'>".hive__hsc($object["lang"]->translate("b_overdue"))."</span>"; }
					else { $status = "<span class='badge bg-success'>".hive__hsc($object["lang"]->translate("b_in_time"))."</span>"; }
					echo "<td>".$status."</td>";
					//echo "<td><a href='./?hl1=view&id=".$b["id"]."' class='btn btn-primary'>".hive__hsc($object["lang"]->translate("b_view"))."</a></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		echo "</tbody>";
		hive__volt_box_end();
	