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
	*/	if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); } ?>
	
	
/******************************************************* Datatable init  *********/

	$( document ).ready(function() {
		new DataTable("#x_class_table_id_tbl_table", {
			order: [[0, 'desc']],   
			autoWidth: false,
			<?php if(file_exists(_HIVE_PATH_."/_core/_vendor/datatables/lang/"._HIVE_LANG_.".json")) { ?>
			language: {
				 url: '<?php echo _HIVE_URL_REL_."/_core/_vendor/datatables/lang/"._HIVE_LANG_.".json"; ?>', 
			},
			<?php } ?>
		});
	});

	$( document ).ready(function() {
		new DataTable(".obr_datatable_init_class", {
			order: [[0, 'desc']],   
			autoWidth: false,
			<?php if(file_exists(_HIVE_PATH_."/_core/_vendor/datatables/lang/"._HIVE_LANG_.".json")) { ?>
			language: {
				 url: '<?php echo _HIVE_URL_REL_."/_core/_vendor/datatables/lang/"._HIVE_LANG_.".json"; ?>', 
			},
			<?php } ?>
		});
	});