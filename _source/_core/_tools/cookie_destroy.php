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
	*/ require_once("../internal.php");
	
	function hive_error_full_out($title, $subtitle, $description, $exit, $code) { 
		if(is_numeric($code)) { @http_response_code($code); }?>	
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><?php if(defined("_HIVE_URL_REL_")) { ?> <link rel="icon" type="image/x-icon" href="<?php echo _HIVE_URL_REL_; ?>/_core/_image/favicon.ico"> <?php } ?><title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "FP²"; } ?></title><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><style>* { margin: 0; padding: 0; box-sizing: border-box; }body {font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;background-color: #f9f9f9;color: #121212;display: flex;align-items: center;justify-content: center;height: 100vh;flex-direction: column;text-align: center;} .artwork { height: auto; max-height: 50vh; max-width: 80vw; margin-bottom: 4rem; } h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: #242424; } p {line-height: 1.6; font-size: 1.4rem; } @media only screen and (max-width: 500px) { html { font-size: 75%; } } @media (prefers-color-scheme: dark) {  body{ background-color: #121212; color: #cddcdd; }   h1 { color: #f9f9f9;} }a {	color: #ff5707; text-decoration: none;} </style></head><body cz-shortcut-listen="true"><svg class="artwork" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1120 700" width="1120" height="700"><circle cx="292.61" cy="213" r="213" fill="#f2f2f2"></circle><path fill="#242424" d="M0 51.14c0 77.5 48.62 140.21 108.7 140.21"></path><path fill="#ff5707" d="M108.7 191.35c0-78.37 54.26-141.78 121.3-141.78M39.38 58.17c0 73.61 31 133.18 69.32 133.18"></path><path fill="#242424" d="M108.7 191.35c0-100.14 62.71-181.17 140.2-181.17"></path><path fill="#a8a8a8" d="M85.83 192.34s15.42-.48 20.06-3.78 23.72-7.26 24.87-1.96 23.17 26.4 5.76 26.53-40.44-2.7-45.07-5.53-5.62-15.26-5.62-15.26z"></path><path d="M136.83 211.28c-17.4.15-40.44-2.7-45.07-5.53-3.53-2.15-4.94-9.87-5.41-13.43l-.52.02s.98 12.43 5.62 15.26 27.67 5.67 45.07 5.53c5.03-.04 6.76-1.83 6.67-4.47-.7 1.6-2.62 2.6-6.36 2.62z" opacity=".2"></path><ellipse cx="198.61" cy="424.5" fill="#181818" rx="187" ry="25.44"></ellipse><ellipse cx="198.61" cy="424.5" opacity=".1" rx="157" ry="21.36"></ellipse><ellipse cx="836.61" cy="660.5" fill="#181818" rx="283" ry="38.5"></ellipse><ellipse cx="310.61" cy="645.5" fill="#181818" rx="170" ry="23.13"></ellipse><path fill="none" stroke="#242424" stroke-miterlimit="10" stroke-width="2" d="M462.6 626c90 23 263-30 282-90M309.6 259s130-36 138 80-107 149-17 172M184.01 537.28s39.07-10.82 41.48 24.05-32.16 44.78-5.11 51.7"></path><path fill="#242424" d="M778.7 563.24l-7.87 50.3s-38.78 20.6-11.52 21.2 155.74 0 155.74 0 24.84 0-14.55-21.81l-7.87-52.72z"></path><path d="M753.83 634.2c6.2-5.51 17-11.25 17-11.25l7.87-50.3 113.93.1 7.87 49.59c9.19 5.09 14.88 8.99 18.2 11.98 5.07-1.16 10.6-5.45-18.2-21.4l-7.87-52.71-113.93 3.03-7.87 50.3s-32.6 17.31-17 20.66z" opacity=".1"></path><rect width="513.25" height="357.52" x="578.43" y="212.69" fill="#242424" rx="18.05"></rect><path fill="#181818" d="M595.7 231.78h478.71v267.84H595.7z"></path><circle cx="835.06" cy="223.29" r="3.03" fill="#f2f2f2"></circle><path fill="#242424" d="M1091.69 520.82v31.34a18.04 18.04 0 01-18.05 18.05H596.48a18.04 18.04 0 01-18.05-18.05v-31.34zM968.98 667.47v6.06H642.97v-4.85l.45-1.21 8.03-21.82h310.86l6.67 21.82zM1094.44 661.53c-.6 2.54-2.84 5.22-7.9 7.75-18.18 9.1-55.15-2.42-55.15-2.42s-28.48-4.85-28.48-17.57a22.72 22.72 0 012.5-1.49c7.64-4.04 32.98-14.02 77.92.42a18.74 18.74 0 018.54 5.6c1.82 2.13 3.25 4.84 2.57 7.71z"></path><path d="M1094.44 661.53c-22.25 8.53-42.09 9.17-62.44-4.97-10.27-7.13-19.6-8.9-26.6-8.76 7.65-4.04 33-14.02 77.93.42a18.74 18.74 0 018.54 5.6c1.82 2.13 3.25 4.84 2.57 7.71z" opacity=".1"></path><ellipse cx="1066.54" cy="654.13" fill="#f2f2f2" rx="7.88" ry="2.42"></ellipse><circle cx="835.06" cy="545.67" r="11.51" fill="#f2f2f2"></circle><path d="M968.98 667.47v6.06H642.97v-4.85l.45-1.21h325.56z" opacity=".1"></path><path fill="#242424" d="M108.61 159h208v242h-208z"></path><path fill="#181818" d="M87.61 135h250v86h-250zM87.61 237h250v86h-250zM87.61 339h250v86h-250z"></path><path fill="#ff5707" d="M271.61 150h16v16h-16z" opacity=".4"></path><path fill="#ff5707" d="M294.61 150h16v16h-16z" opacity=".8"></path><path fill="#ff5707" d="M317.61 150h16v16h-16z"></path><path fill="#ff5707" d="M271.61 251h16v16h-16z" opacity=".4"></path><path fill="#ff5707" d="M294.61 251h16v16h-16z" opacity=".8"></path><path fill="#ff5707" d="M317.61 251h16v16h-16z"></path><path fill="#ff5707" d="M271.61 352h16v16h-16z" opacity=".4"></path><path fill="#ff5707" d="M294.61 352h16v16h-16z" opacity=".8"></path><path fill="#ff5707" d="M317.61 352h16v16h-16z"></path><circle cx="316.61" cy="538" r="79" fill="#242424"></circle><path fill="#242424" d="M280.61 600h24v43h-24zM328.61 600h24v43h-24z"></path><ellipse cx="300.61" cy="643.5" fill="#242424" rx="20" ry="7.5"></ellipse><ellipse cx="348.61" cy="642.5" fill="#242424" rx="20" ry="7.5"></ellipse><circle cx="318.61" cy="518" r="27" fill="#fff"></circle><circle cx="318.61" cy="518" r="9" fill="#181818"></circle><path fill="#ff5707" d="M239.98 464.53c-6.38-28.57 14-57.43 45.54-64.47s62.27 10.4 68.64 38.98-14.51 39.1-46.05 46.14-61.75 7.92-68.13-20.65z"></path><ellipse cx="417.22" cy="611.34" fill="#242424" rx="39.5" ry="12.4" transform="rotate(-23.17 156.4 637.65)"></ellipse><ellipse cx="269.22" cy="664.34" fill="#242424" rx="39.5" ry="12.4" transform="rotate(-23.17 8.4 690.65)"></ellipse><path fill="#fff" d="M362.6 561c0 7.73-19.9 23-42 23s-43-14.27-43-22 20.92-6 43-6 42-2.73 42 5z"></path></svg><h1 id="title"><?php echo $title; ?></h1><p><?php echo $subtitle; ?></p><p><small><?php echo $description; ?> [<a href="https://bugfishtm.github.io/" rel="noopener" target="_blank">FP²</a>]</small></p></body></html>

	<?php if($exit) { exit(); } }
	if(!_HIVE_ALLOW_TOOLS_) { hive_error_full_out("Access Error", "Script is deactivated in ruleset.php!", "Enable _HIVE_ALLOW_TOOLS_ in ruleset.php or in the _administration interface to enable this files execution!", true, 401); }
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}?>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="../_image/favicon.ico">
  <title>Cookie Deletion - FP²</title>
  <meta charset="UTF-8">
  <style>
    body {
      background-color: #111;
      color: #fff;
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    #countdown-box {
      background-color: #222;
      color: #fff;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
    }
    p {
      font-size: 14px;
      margin: 0;
    }
	a {
		color: yellow;
		text-decoration: none;
	}
  </style>
</head>
<body>
  <div id="countdown-box">
	<img src="../_image/logo_alpha.png" width="100">
    <p>Your Cookies has been destroyed!<br />Click <a href="../../developer.php">here</a> to go back!</p>
  </div>
 </body>
 </html>