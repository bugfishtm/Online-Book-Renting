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
	*/ if(!is_array(@$object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }
	function hive__simple_start($object, $tabtitle = "", $metaextensions = "", $style_default = true) {  if(!defined("_HIVE_COLOR_")) { define("_HIVE_COLOR_", "yellow");} ?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $tabtitle; ?></title>
	<?php if($style_default) { ?><style>
		body,tabletd{font-size:14px;}.body,body{background-color:#080808;color:white;}.container,.content{display:block;max-width:580px;padding:10px;}body,h1,h2,h3,h4{line-height:1.4;font-family:sans-serif;color:white;}body,h1,h2,h3,h4,ol,p,tabletd,ul{font-family:sans-serif;}.btna,.btntabletd{background-color:#fff;}.btn,.btna,.content,.wrapper{box-sizing:border-box;}.btna,h1{text-transform:capitalize;}.align-center,.btntabletd,.footer,h1{text-align:center;}.clear,.footer{clear:both;}.btna,powered-bya{text-decoration:none;}img{border:none;-ms-interpolation-mode:bicubic;max-width:100%;}body{-webkit-font-smoothing:antialiased;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;}table{border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;}tabletd{vertical-align:top;}.body{width:100%;}.container{margin:0auto;width:580px;}.btn,.footer,.main{width:100%;}.content{margin:0auto;}.main{background:#000;color:white;border-radius:3px;}.wrapper{padding:20px;}.content-block{padding-bottom:10px;padding-top:10px;}.footer{margin-top:10px;}.footera,.footerp,.footerspan,.footertd{color:#999;font-size:12px;text-align:center;}h1,h2,h3,h4{color:#000;font-weight:400;margin:0030px;}.btna,a{color:#242424;}h1{font-size:35px;font-weight:300;}.btna,ol,p,ul{font-size:14px;}ol,p,ul{font-weight:400;margin:0015px;}olli,pli,ulli{list-style-position:inside;margin-left:5px;}a{text-decoration:underline;}.btn>tbody>tr>td{padding-bottom:15px;}.btntable{width:auto;}.btntabletd{border-radius:5px;}.btna{border:1pxsolid#242424;border-radius:5px;cursor:pointer;display:inline-block;font-weight:700;margin:0;padding:12px25px;}.btn-primarya,.btn-primarytabletd{background-color:#242424;}.btn-primarya{border-color:#242424;color:#fff;}.last,.mb0{margin-bottom:0;}.first,.mt0{margin-top:0;}.align-right{text-align:right;}.align-left{text-align:left;}preheader{color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0;}hr{border:0;border-bottom:1pxsolid#f6f6f6;margin:20px0;}@mediaonlyscreenand(max-width:620px){table.bodyh1{font-size:28px;margin-bottom:10px;}table.bodya,table.bodyol,tablebodyp,tablebodyspan,table.bodytd,tablebodyul{font-size:16px;}table.body.article,table.body.wrapper{padding:10px;}table.body.content{padding:0;}table.body.container{padding:0;width:100%;}table.body.main{border-left-width:0;border-radius:0;border-right-width:0;}table.body.btna,table.body.btntable{width:100%;}table.body.img-responsive{height:auto;max-width:100%;width:auto;}}@mediaall{.btn-primarya:hover,.btn-primarytabletd:hover{background-color:<?php echo _HIVE_COLOR_; ?>;}.ExternalClass{width:100%;}.ExternalClass,.ExternalClassdiv,.ExternalClassfont,.ExternalClassp,.ExternalClassspan,.ExternalClasstd{line-height:100%;}.apple-linka{color:inherit;font-family:inherit;font-size:inherit;font-weight:inherit;line-height:inherit;text-decoration:none;}#MessageViewBodya{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit;}.btn-primarya:hover{border-color:<?php echo _HIVE_COLOR_; ?>;color:<?php echo _HIVE_COLOR_; ?>;}}.hovernew:hover{color:black;}a{color:<?php echo _HIVE_COLOR_; ?>;text-decoration:none;}input{width:100%;max-width:97%;padding:5px;background:#242424;border-radius:5px;color:white;border:1pxsolid#242424;padding:5px;}button:hover{color:black;}
		.containerbox { max-width: 600px; margin: auto; background: #1b1b1b; padding: 15px; margin-top: 15px;border-radius: 5px; } .containerbox-btn { white-space: pre;  margin-right: 15px; word-break: keep-all; margin-top: 15px; cursor: pointer; padding: 10px; border: 2px solid #121212; border-radius: 5px; background: #121212; color: <?php echo _HIVE_COLOR_; ?>;} .containerbox-btn:hover { color: black; background: white; } h2{ color: white; } @media (max-width: 800px) { .containerbox { border-radius: 0px; max-width: 100%; width: 100vw !important; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; margin-top: 15px; box-sizing: border-box; padding: 15px;} } input[type=text] { background: #080808; color: white; border: 2px solid #444444;}  input[type=number] { background: #080808; color: white; border: 2px solid #444444;}input[type=password] { background: #080808; color: white; border: 2px solid #444444;} .containererror { padding: 15px; color: white; background: red;padding-bottom: 5px; padding-top: 5px;font-weight: normal; margin-top: 2px; margin-bottom: 2px; border-radius: 5px;}
	</style><?php } ?>
	<?php if($metaextensions) { echo $metaextensions; } ?>
	<?php if(defined("_HIVE_URL_REL_")) { ?><link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/stylesheet.php">
	<script src="<?php echo _HIVE_URL_REL_; ?>/_core/javascript.php"></script> <?php } ?>
  </head>
  <body>
	<?php }
	function hive__simple_end($object, $footer = "") { ?>
			<!-- START FOOTER -->
			<div class="footer">
			  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="content-block">
					<span class="apple-link"><?php echo $footer; ?></span>
				  </td>
				</tr>
				<tr>
				  <td class="content-block powered-by">
						<!-- No Content Currently as Message -->
				  </td>
				</tr>
			  </table>
			</div>
			<!-- END FOOTER -->
		  </body>
		</html>			
	<?php }