<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
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
	if(!is_array($object)) { Header("Location: ../"); exit(); }
	#############################################################################################################################################
	// Alert Boxes
	#############################################################################################################################################
	function hive__dashboard_alert_danger($message, $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish background-danger") { ?>
		<div class="<?php echo $classes; ?>">
			<span><?php echo $message; ?></span>
		</div>
	<?php }
	function hive__dashboard_alert_success($message, $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish background-success") { ?>
		<div class="<?php echo $classes; ?>">
			<span><?php echo $message; ?></span>
		</div>
	<?php }
	function hive__dashboard_alert_warning($message, $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish background-warning") { ?>
		<div class="<?php echo $classes; ?>">
			<span><?php echo $message; ?></span>
		</div>
	<?php }
	function hive__dashboard_alert_info($message, $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish background-info") { ?>
		<div class="<?php echo $classes; ?>">
			<span><?php echo $message; ?></span>
		</div>
	<?php }
	function hive__dashboard_alert_primary($message, $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish background-primary") { ?>	  
		<div class="<?php echo $classes; ?>">
			<span><?php echo $message; ?></span>
		</div>
	<?php }
	function hive__dashboard_alert_url($message, $image, $url, $newtab = false, $rel = false, $more = "View more &RightArrow;", $classes = "flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 bg-primary-bugfish rounded-lg shadow-md focus:outline-none focus:shadow-primary-bugfish ") { ?>
		<a
		  class="<?php echo $classes; ?>"
		  href="<?php echo $url; ?>" 
		  <?php if($newtab) { echo "target='_blank'"; } ?> 
		  <?php if($rel) { echo "rel='".$rel."'"; } ?> 
		>
		  <div class="flex items-center">
			<i class="<?php echo $image; ?> xfpe_marginright10px"></i> 
			<span><?php echo $message; ?></span>
		  </div>
		  <span><?php echo $more; ?></span>
		</a>
	<?php }
	#############################################################################################################################################
	// Heading Elements
	#############################################################################################################################################
	function hive__dashboard_h2($text, $classes = "my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200") { ?>
		<h2
		  class="<?php echo $classes; ?>"
		>
		  <?php echo $text; ?>
		</h2>
	<?php }	
	function hive__dashboard_h4($text, $classes = "mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 ") { ?>
		<h4
		  class="<?php echo $classes; ?>"
		>
		  <?php echo $text; ?>
		</h4>
	<?php }	
	#############################################################################################################################################
	// Button Elements
	#############################################################################################################################################
	function hive__dashboard_button($text, $icon = "bx bxs-pear", $color = "#030303", $tcolor = "#ffffff", $type = "button", $url = "", $name = "", $js = "", $classes = "px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus ") { 
	if(!$color) {$color = "#030303";} if(!$tcolor) {$tcolor = "#ffffff";} ?>
			<?php if($type == "submit" OR $type == "button") { ?><button onClick="<?php echo $js; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>"  <?php } else { ?>
				<a href="<?php echo $url; ?>" name="<?php echo $name; ?>" onClick="<?php echo $js; ?>" type="<?php echo $type; ?>" 
			<?php } ?>
		  class="<?php echo $classes; ?>"
		   style="background: <?php echo $color; ?>;color: <?php echo $tcolor; ?>;"  
		>
		  <span><?php echo $text; ?></span>
		<?php if($type == "submit" OR $type == "button") { ?></button><?php } else { ?></a><?php } ?>
	<?php }	
	
	function hive__dashboard_button_icright($text, $icon = "bx bxs-pear", $color = "#030303", $tcolor = "#ffffff", $type = "button", $url = "", $name = "", $js = "", $classes = "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus ") { 
	if(!$color) {$color = "#030303";} if(!$tcolor) {$tcolor = "#ffffff";} ?>
			<?php if($type == "submit" OR $type == "button") { ?><button onClick="<?php echo $js; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>"  <?php } else { ?>
				<a href="<?php echo $url; ?>" name="<?php echo $name; ?>" onClick="<?php echo $js; ?>" type="<?php echo $type; ?>" 
			<?php } ?>
		  class="<?php echo $classes; ?>"
		   style="background: <?php echo $color; ?>;color: <?php echo $tcolor; ?>;"  
		>
		  <span><?php echo $text; ?></span>
		  <i class="<?php echo $icon; ?> xfpe_marginleft10px"></i>
		<?php if($type == "submit" OR $type == "button") { ?></button><?php } else { ?></a><?php } ?>
	<?php }	

	function hive__dashboard_button_icleft($text, $icon = "bx bxs-pear", $color = "#030303", $tcolor = "#ffffff",  $type = "button", $url = "", $name = "", $js = "", $classes = "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus ") { 
	if(!$color) {$color = "#030303";} if(!$tcolor) {$tcolor = "#ffffff";} ?>
			<?php if($type == "submit" OR $type == "button") { ?><button onClick="<?php echo $js; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>"  <?php } else { ?>
				<a href="<?php echo $url; ?>" name="<?php echo $name; ?>" onClick="<?php echo $js; ?>" type="<?php echo $type; ?>" 
			<?php } ?>
			  class="<?php echo $classes; ?>" style="background: <?php echo $color; ?>;color: <?php echo $tcolor; ?>;" 
			>
			<i class="<?php echo $icon; ?> xfpe_marginright10px"></i>
			  <span><?php echo $text; ?></span>
		<?php if($type == "submit" OR $type == "button") { ?></button><?php } else { ?></a><?php } ?>
	<?php }	

	function hive__dashboard_button_small_round($icon = "bx bxs-pear", $color = "#030303", $tcolor = "#ffffff",  $type = "button", $url = "", $name = "", $js = "", $classes = "flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border-transparent rounded-full active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus ") { 
	if(!$color) {$color = "#030303";} if(!$tcolor) {$tcolor = "#ffffff";} ?>
			<?php if($type == "submit" OR $type == "button") { ?><button onClick="<?php echo $js; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>"  <?php } else { ?>
				<a href="<?php echo $url; ?>" name="<?php echo $name; ?>" onClick="<?php echo $js; ?>" type="<?php echo $type; ?>" 
			<?php } ?>
			  class="<?php echo $classes; ?>"  style="background: <?php echo $color; ?>;color: <?php echo $tcolor; ?>;"  
			  aria-label="Edit"
			>
			  <i class="<?php echo $icon; ?> xfpe_paddingleft5px xfpe_paddingright5px xfpe_paddingtop5px xfpe_paddingbottom5px"></i>
		<?php if($type == "submit" OR $type == "button") { ?></button><?php } else { ?></a><?php } ?>
	<?php }	

	function hive__dashboard_button_small($icon = "bx bxs-pear", $color = "#030303", $tcolor = "#ffffff",  $type = "button", $url = "", $name = "", $js = "", $classes = "flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus ") { 
	if(!$color) {$color = "#030303";}  if(!$tcolor) {$tcolor = "#ffffff";} ?>
			<?php if($type == "submit" OR $type == "button") { ?><button onClick="<?php echo $js; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>"  <?php } else { ?>
				<a href="<?php echo $url; ?>" name="<?php echo $name; ?>" onClick="<?php echo $js; ?>" type="<?php echo $type; ?>" 
			<?php } ?>
			  class="<?php echo $classes; ?> xfpe_padding20px_f"
			  aria-label="Like"  style="background: <?php echo $color; ?>;color: <?php echo $tcolor; ?>;"  
			>
                <i class="<?php echo $icon; ?> xfpe_paddingleft5px xfpe_paddingright5px xfpe_paddingtop5px xfpe_paddingbottom5px"></i>
		<?php if($type == "submit" OR $type == "button") { ?></button><?php } else { ?></a><?php } ?>
	<?php }		
	#############################################################################################################################################
	// Box Elements
	#############################################################################################################################################
	function hive__dashboard_box_start($header = false, $classes = "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800", $headerclasses = "mb-4 font-semibold text-gray-600 dark:text-gray-300") { ?>
		  <div
			class="<?php echo $classes; ?>"
		  >
		  <?php if($header) {  ?> <h4 class="<?php echo $headerclasses; ?>">
			  <?php echo $header; ?>
			</h4>
		  <?php } ?>
	<?php }
	function hive__dashboard_box_end() { ?>
		  </div>		
	<?php }	
	function hive__dashboard_box_full($text, $classes = "px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300 ") { ?>
		<div
		  class="<?php echo $classes; ?>"
		>
			<?php echo $text; ?>
		</div>	
	<?php }	
	function hive__dashboard_box($text, $header = false, $classes = "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-300 ", $headerclasses = "mb-4 font-semibold text-gray-600 dark:text-gray-300") { ?>
		  <div
			class="<?php echo $classes; ?>"
		  >
		  <?php if($header) {  ?> <h4 class="<?php echo $headerclasses; ?>"> 
			  <?php echo $header; ?>
			</h4> 
		  <?php } ?>
			  <?php echo $text; ?>
		  </div>		
	<?php }
	function hive__dashboard_box_colored($text, $header = false, $classes = "min-w-0 p-4 text-white bg-primary-bugfish rounded-lg shadow-xs ", $headerclasses = "mb-4 font-semibold") { ?>
		  <div
			class="<?php echo $classes; ?>"
		  >
			<?php if($header) {  ?><h4 class="<?php echo $headerclasses; ?>">
			  <?php echo $header; ?>
			</h4> <?php } ?>
			  <?php echo $text; ?>
		  </div>		
	<?php }	
	function hive__dashboard_box_card($text, $value, $color = "orange", $icon = "bx bxs-pear", $classes = "flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 ") { ?>
		  <div
			class="<?php echo $classes; ?>"
		  >
			<div
			  class="p-3 mr-4 text-<?php echo $color; ?>-500 bg-<?php echo $color; ?>-100 rounded-full dark:text-<?php echo $color; ?>-100 dark:bg-<?php echo $color; ?>-500 xfpe_paddingleft15px xfpe_paddingright15px" style="background-color: <?php echo $color; ?>;"
			>
			  <i class="<?php echo $icon; ?>"></i>
			</div>
			<div>
			  <p
				class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
			  >
				<?php echo $text; ?>
			  </p>
			  <p
				class="text-lg font-semibold text-gray-700 dark:text-gray-200"
			  >
				<?php echo $value; ?>
			  </p>
			</div>
		  </div>	
	<?php }			
	#############################################################################################################################################
	// Modal Elements
	#############################################################################################################################################
	function hive__dashboard_modal($text, $title = false, $icon = "info") { ?>
		<script>
			$( document ).ready(function() {
				Swal.fire({
				 <?php if($title) { ?> title: '<?php echo $title; ?>', <?php } ?>
				  <?php if($icon) { ?>icon: '<?php echo $icon; ?>',<?php } ?>
				  html:
					'<?php echo str_replace("'", "\\'", $text); ?>',
				});
			});
		</script>
	<?php }		
	#############################################################################################################################################
	// Main Elements
	#############################################################################################################################################
	function hive__dashboard_404($object, $text = "This page has not been found! :(", $title = "ERROR 404", $classes = "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-300 xfpe_margintop20px") { 
		hive__dashboard_box($text, $title, $classes);
	 }	
	function hive__dashboard_401($object, $text = "You do not have permission to view this page! :(", $title = "ERROR 401", $classes = "min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-gray-300 xfpe_margintop20px") { 
		hive__dashboard_box($text, $title, $classes);
	 }	
	function hive__dashboard_footer($object, $footer = "", $classes = "bg-white dark:bg-gray-800 text-gray-800", $end_div = true) { ?>
			<?php if($end_div) { ?></div><?php } ?>
			<!-- End of modal backdrop -->
			<?php if($footer != "" AND $footer != false) { ?><footer id="web_footer" class="<?php echo $classes; ?>">
				<?php echo $footer; ?>
			</footer><?php } ?>
		  </body>
		</html>	
	<?php }
	function hive__dashboard_end($object) { ?>
			</div>
	<?php }	
	function hive__dashboard_start($object, $classes = "flex flex-col flex-1 w-full") {  ?>
		 <div class="<?php echo $classes; ?>">
	<?php } 
	function hive__dashboard_content_start($object, $classes_main = "h-full overflow-y-auto", $classes_wrapper = "container px-6 mx-auto grid") { ?>
		<main class="<?php echo $classes_main; ?>"><div class="<?php echo $classes_wrapper; ?>">
	<?php }
	function hive__dashboard_content_end($object) { ?>
		</div></main>
	<?php }
	function hive__dashboard_header($object, $tabtitle = "", $metaextensions = "", $theme_default = "dark", $mainclass = "flex h-screen bg-gray-50 dark:bg-gray-900") { 
		if(!isset($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"])) {
			$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $theme_default; 
			if($object["user"]->user_loggedIn) {
				if(isset($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] )) {
					if($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "dark" OR $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "false") {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"];
					}
				}
			}
		}		
				
		$change_theme = false;
		if(@$_GET["hive__db_cst"] == "dark") { $change_theme = "dark"; }
		if(@$_GET["hive__db_cst"] == "light") { $change_theme = "false"; }    
		if($change_theme) {
			if($object["user"]->user_loggedIn) {
				hive__user_theme_sub_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_theme);
			}	
			$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $change_theme;
			
			// Program to display URL of current page.
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			{$link = "https";}
			else
			{$link = "http";}
				 
			// Here append the common URL characters.
			$link .= "://";
				 
			// Append the host(domain name, ip) to the URL.
			$link .= $_SERVER['HTTP_HOST'];
				
			// Append the requested resource location to the URL
			$link .= $_SERVER['REQUEST_URI']; echo $link;

			$link = strtok($link, "&hive__");

			Header("Location: ".$link);  
		} 
				
		$change_lang = false;
		if(@in_array(@$_GET["hive__change_lang"], _HIVE_LANG_ARRAY_)) { $change_lang = @$_GET["hive__change_lang"];  } 
		if($change_lang) {  
			if($object["user"]->user_loggedIn) {
				hive__user_lang_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_lang); 
			}	
			$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = $change_lang; 
			

			// Program to display URL of current page.
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			{$link = "https";}
			else
			{$link = "http";}
				 
			// Here append the common URL characters.
			$link .= "://";
				 
			// Append the host(domain name, ip) to the URL.
			$link .= $_SERVER['HTTP_HOST'];
				 
			// Append the requested resource location to the URL
			$link .= $_SERVER['REQUEST_URI'];
			$link = strtok($link, "hive__change_lang");

			Header("Location: ".$link);  							
		} 
		if($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] == "dark") {$now_theme = "dark";} else {$now_theme = "false";} ?>
		<!DOCTYPE html>
		<html <?php if($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] == "dark") { ?> class = "dark" <?php } ?> :class="{ 'theme-dark': <?php echo $now_theme; ?> }" lang="en" x-data="data()" >
		  <head>
			<!-- Initial Meta -->
			<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<!-- Include Main CSS -->
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-dashboard/main_stylesheet.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-dashboard/<?php echo _HIVE_THEME_; ?>.css.php">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/stylesheet.php">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/boxicons/boxicons.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/jq.datatables.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js.css">
			<!-- Include Main JS -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/jquery/jq.3.6.min.js"></script>	
			<script src='<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery-ui.min.js' defer></script>	
			<script src='<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-dashboard/init-alpine.js' defer></script>		
			<script src='<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js' defer></script>		
			<script src='<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/alpine/alpine.min.js' defer></script>
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/focustrap/focus-trap.js"></script>			
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/sweetalert2/sweetalert2.all.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/jq.datatables.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/tinymce/tinymce.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/resumable/resumable.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/javascript.php"></script> 
			<!-- Include Extensions from Function -->
			<?php echo $metaextensions; ?>
		  </head>
		  <body>
			<div
			  class="<?php echo $mainclass; ?>"
			  :class="{ 'overflow-hidden': isSideMenuOpen }"
			>
	<?php }
	function hive__dashboard_nav($object, $title = "", $button = false) {  $counter_nav_int = 0;  $counter_active_int = 0; ?>
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            <?php echo $title; ?>
          </a>
          <ul class="mt-6">
			<?php foreach($object["nav"] as $key => $value) { ?>	
				<li class="relative px-6 py-3">
				<?php if(is_array($value["nav_sub"])) { $counter_nav_int = $counter_nav_int + 1 ; ?>
				  <button
					class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
					@click="togglePagesMenu<?php echo $counter_nav_int; ?>"
					aria-haspopup="true"
				  >	
					<span class="inline-flex items-center text-gray-800 dark:text-gray-200">
					  <i class='<?php echo $value["nav_img"]; ?> text-gray-800 dark:text-gray-200 xfpe_marginright5px' ></i> 
					  <span class="ml-4  <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "bugfish-primary-color";} ?>"><?php echo $value["nav_title"]; ?></span>
					</span>
					<svg
					  class="w-4 h-4"
					  aria-hidden="true"
					  fill="currentColor"
					  viewBox="0 0 20 20"
					>
					  <path
						fill-rule="evenodd"
						d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
						clip-rule="evenodd"
					  ></path>
					</svg>
				  </button>	
				
              <?php if(_HIVE_URL_CUR_[0] != $value["nav_act"]) { ?><template x-if="isPagesMenuOpen<?php echo $counter_nav_int; ?>"><?php } else {  ?><template x-if="!isPagesMenuOpen<?php echo $counter_nav_int; ?>"><?php } ?>
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >	

				<?php foreach($value["nav_sub"] as $key => $valuex) { ?>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full text-gray-200 dark:text-gray-800 <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"] AND _HIVE_URL_CUR_[1] == $valuex["nav_act"] AND false != $valuex["nav_act"]) { echo "navi-sub-item-active"; } else { echo "navi-sub-item-inactive";} ?>" href="<?php echo $valuex["nav_loc"]; ?>">
                      <?php echo $valuex["nav_title"]; ?>
                    </a>
                  </li>			
				<?php } ?>
                </ul>
              </template>				
				<?php } else {  ?>
				  <span
					class="absolute inset-y-0 left-0 w-1 bg-primary-bugfish rounded-tr-lg rounded-br-lg"
					aria-hidden="true"
				  ></span>
				  <a
					class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
					href="<?php echo $value["nav_loc"]; ?>"
				  >
					<i class='<?php echo $value["nav_img"]; ?> text-gray-800 dark:text-gray-200 xfpe_marginright5px' ></i> 
					<span class="ml-4  <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "bugfish-primary-color";} ?>"><?php echo $value["nav_title"]; ?></span>
				  </a>
				<?php }  ?>
				</li>		
				
			<?php } ?>
          </ul>
		  <?php if(is_array($button)) { ?>
          <div class="px-6 my-6">
            <a href="<?php echo $button[0]; ?>"
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
            >
             <?php echo $button[1]; ?>
            </a>
          </div>
		  <?php } ?>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center fix-turnout-navigation"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
             <?php echo $title; $counter_nav_int = 0; ?>
          </a>
          <ul class="mt-6">
			<?php foreach($object["nav"] as $key => $value) {   ?>		
            <li class="relative px-6 py-3">
			<?php if(is_array($value["nav_sub"])) { $counter_nav_int = $counter_nav_int + 1 ; ?>
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                @click="togglePagesMenu<?php echo $counter_nav_int; ?>"
                aria-haspopup="true"
              >			
			<?php } ?>
			<?php if(is_array($value["nav_sub"])) {?>
                <span class="inline-flex items-center text-gray-800  text-gray-800 dark:text-gray-200">
                  <i class='<?php echo $value["nav_img"]; ?>  text-gray-800 dark:text-gray-200  xfpe_marginright5px' ></i> 
                  <span class="ml-4  <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "bugfish-primary-color"; $counter_active_int = $counter_nav_int; } ?>"><?php echo $value["nav_title"]; ?></span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>		
              <?php if(_HIVE_URL_CUR_[0] != $value["nav_act"]) { ?><template x-if="isPagesMenuOpen<?php echo $counter_nav_int; ?>"><?php } else {  ?><template x-if="!isPagesMenuOpen<?php echo $counter_nav_int; ?>"><?php } ?>
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
				<?php foreach($value["nav_sub"] as $key => $valuex) { ?>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full text-gray-200 dark:text-gray-800 <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"] AND _HIVE_URL_CUR_[1] == $valuex["nav_act"] AND false != $valuex["nav_act"]) { echo "navi-sub-item-active"; } else { echo "navi-sub-item-inactive";} ?>" href=" <?php echo $valuex["nav_loc"]; ?>">
                      <?php echo $valuex["nav_title"]; ?>
                    </a>
                  </li>				
				<?php } ?>
                </ul>
              </template>			  
			<?php } else { ?>
              <span
                class="absolute inset-y-0 left-0 w-1 bg-primary-bugfish rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100 "
                href="<?php echo $value["nav_loc"]; ?>"
              >
                <i class='<?php echo $value["nav_img"]; ?> text-gray-800 dark:text-gray-200 xfpe_marginright5px' ></i> 
                <span class="ml-4 <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "bugfish-primary-color";} ?>"><?php echo $value["nav_title"]; ?></span>
              </a>
            </li>			  
			<?php } ?>
			<?php } ?>
          </ul>
		  <?php if(is_array($button)) { ?>
          <div class="px-6 my-6">
            <a href="<?php echo $button[0]; ?>"
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish"
            >
              <?php echo $button[1]; ?>
            </a>
          </div>
		  <?php }  ?>
        </div>
      </aside>	
	<?php }
	function hive__dashboard_topbar($object, $profile_menu = false, $theme_menu = false, $search = false, $title = false, $img = "", $lang_ar = false) {  ?>
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-bugfish-primary-600 dark:text-white-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-primary-bugfish"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button> <?php if($title) {  ?><div class='text-gray-800 dark:text-gray-200'><?php echo $title; ?></div><?php } ?>
			
				<!-- Search input -->
				<div class="flex justify-center flex-1 lg:mr-32">
				<?php if($search) {  ?>
				  <div
					class="relative w-full max-w-xl mr-6 focus-within:text-white-500"
				  >
					<div class="absolute inset-y-0 flex items-center pl-2 text-gray-800 dark:text-gray-200">
					  <svg
						class="w-4 h-4"
						aria-hidden="true"
						fill="currentColor"
						viewBox="0 0 20 20"
					  >
						<path
						  fill-rule="evenodd"
						  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						  clip-rule="evenodd"
						></path>
					  </svg>
					</div>
					<form method="get" action="<?php echo $search; ?>"><input
					  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-primary-bugfish form-input"
					  type="text"
					  placeholder="<?php echo $object["lang"]->translate("top_bar_search"); ?>"
					  aria-label="<?php echo $object["lang"]->translate("top_bar_search"); ?>"
					/></form>
				  </div>
				 <?php } ?>
				</div>
			
            <ul class="flex items-center flex-shrink-0 space-x-6">
			<?php if($theme_menu) {  
				if(@$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] == "dark") { $tmp_uri_theme = "&hive__db_cst=light"; }
				if(@$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] == "false") { $tmp_uri_theme = "&hive__db_cst=dark"; }
			?>
				  <!-- Theme toggler -->
				  <li class="flex">
					<a
					  onClick = "window.location.href= '<?php echo hive_get_url_rel(array(_HIVE_URL_CUR_[0], _HIVE_URL_CUR_[1], _HIVE_URL_CUR_[2])); ?><?php echo @$tmp_uri_theme; ?>'"
					  class="rounded-md focus:outline-none focus:shadow-primary-bugfish xfpe_cursorpointer text-gray-800 dark:text-gray-200"
					  @click="toggleTheme"
					  aria-label="Toggle color mode"
					>
					  <template x-if="dark">
						<svg
						  class="w-5 h-5"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						>
						  <path
							d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
						  ></path>
						</svg>
					  </template>
					  <template x-if="!dark">
						<svg
						  class="w-5 h-5"
						  aria-hidden="true"
						  fill="currentColor"
						  viewBox="0 0 20 20"
						>
						  <path
							fill-rule="evenodd"
							d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
							clip-rule="evenodd"
						  ></path>
						</svg>
					  </template>
					</a>
				  </li>
			  <?php } ?>
			  <?php if($lang_ar) {  ?>
				  <!-- Profile menu -->
				  <li class="relative">
					<button
					  class="align-middle rounded-full focus:shadow-primary-bugfish focus:outline-none"
					  @click="toggleLangMenu"
					  @keydown.escape="closeLangMenu"
					  aria-label="Account"
					  aria-haspopup="true"
					>
					  <img
						class="object-cover w-8 h-8 rounded-full"
						src="<?php echo $lang_ar[0]["current_img"]; ?>"
						alt=""
						aria-hidden="true"
					  />
					</button>
					<template x-if="isLangMenuOpen">
					  <ul
						x-transition:leave="transition ease-in duration-150"
						x-transition:leave-start="opacity-100"
						x-transition:leave-end="opacity-0"
						@click.away="closeLangMenu"
						@keydown.escape="closeLangMenu"
						class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
						aria-label="submenu"
					  >
						<?php foreach($lang_ar as $key => $value) { ?>	
							<li class="flex">
							  <a
								class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
								href="<?php echo hive_get_url_rel(array(_HIVE_URL_CUR_[0], _HIVE_URL_CUR_[1], _HIVE_URL_CUR_[2])); ?>&hive__change_lang=<?php echo htmlspecialchars($value["ident"]); ?>"
							  >
								<img src='<?php echo $value["img"]; ?>' class='xfpe_marginright5px'></i> 
								<span><?php echo htmlspecialchars($value["name"]); ?></span>
							  </a>
							</li>
						<?php } ?>
					  </ul>
					</template>
				  </li>
			  <?php } ?>
			  <?php if(is_array($profile_menu)) {  ?>
				  <!-- Profile menu -->
				  <li class="relative">
					<button
					  class="align-middle rounded-full focus:shadow-primary-bugfish focus:outline-none"
					  @click="toggleProfileMenu"
					  @keydown.escape="closeProfileMenu"
					  aria-label="Account"
					  aria-haspopup="true"
					>
					  <img
						class="object-cover w-8 h-8 rounded-full"
						src="<?php echo $img; ?>"
						alt=""
						aria-hidden="true"
					  />
					</button>
					<template x-if="isProfileMenuOpen">
					  <ul
						x-transition:leave="transition ease-in duration-150"
						x-transition:leave-start="opacity-100"
						x-transition:leave-end="opacity-0"
						@click.away="closeProfileMenu"
						@keydown.escape="closeProfileMenu"
						class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
						aria-label="submenu"
					  >
						<?php foreach($profile_menu as $key => $value) { ?>	
							<li class="flex">
							  <a
								class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
								href="<?php echo $value["nav_loc"]; ?>"
							  >
								<i class='<?php echo $value["nav_img"]; ?> text-gray-800 dark:text-gray-200 xfpe_marginright5px' ></i> 
								<span class="text-gray-800 dark:text-gray-200 "><?php echo $value["nav_title"]; ?></span>
							  </a>
							</li>
						<?php } ?>
					  </ul>
					</template>
				  </li>
			  <?php } ?>
            </ul>
          </div>
        </header>	
	<?php }