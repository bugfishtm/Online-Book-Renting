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
		
		File Description:
			File to easier control core functionalities during development.
		
	*/ if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); } 
	
	if(!_HIVE_MOD_CHANGES_) { hive__error("Access Error", "Script is deactivated in ruleset.php! Enable _HIVE_MOD_CHANGES_ in ruleset.php or in the _administration interface to enable this files execution!", "", true, 401); }
	
	// Cookie Deletion
	if(@$_GET["operation"] == "cdestroy") { 
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
		Header("Location: ./developer.php?proc=ok");
		exit();
	}
	
	// Session Deletion	
	if(@$_GET["operation"] == "sdestroy") { 
		session_destroy();
		Header("Location: ./developer.php?proc=ok");
		exit();
	}
	
	// PHPInfo
	if(@$_GET["operation"] == "phpinfo") { 
		echo '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/image.favicon.ico">';
		echo '<title>PHP Informations - CMS</title>';
		echo "<center><a href='./developer.php'>Click here to go back!</a></center>";
		phpinfo();
		exit();
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Developer Tools - CMS</title>
		<meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="data:image/x-icon;base64,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zP/PyL3/xb2y/9vUyv9oZWD/Dw8N/xkXFP8YFxT/Dw8N/2hlYP/a1Mr/xb2y/8/IvP/d1sz/3dfM/93WzP/d1sz/3NbM/93XzP/FvbL/r6eb/8rEu/+bl4//m5eP/8rEu/+vp5v/xb2z/93XzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/xb2z/6+mm//LxLr/m5aO/5uWjv/KxLr/rqeb/8W9sv/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1s3/3NbM/8/Ivf/Bua7/3dbM/7GonP+wqJz/3dbM/8G5rv/PyL3/3dbM/93WzP/d1sz/3NbM/93XzP/d1sz/3dbM/93WzP/Pyb3/wLmu/93WzP+wqJz/sKic/93WzP/Bua7/z8i9/93WzP/d1sz/3dbM/93WzP/d1s3/3dbM/9zWzf/d1sz/3dbM/93WzP/c1sz/0svB/9PLwP/d18z/3dbM/93WzP/d18z/3dbM/93XzP/d1sz/3dbM/93WzP/d1sz/3NbM/93Wzf/d1sz/3dbM/9LLwP/Sy8D/3dbM/9zWzP/d1sz/3dbM/93XzP/d18z/3dbM/93WzP/d1sz/3dbM/93XzP/d1sz/3dfM/93WzP/d1s3/3dbM/9zWzP/d1sz/3dfM/93WzP/d1sz/3dbN/9zWzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/9zWzP/d1sz/3dbN/93Wzf/d1s3/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/c1sz/3dbM/93XzP/d1sz/3dbM/9zWzP/d1sz/3dbM/93Wzf/c1sz/3dbN/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dfM/93WzP/d1s3/3dbM/93WzP/d1sz/3dfM/93WzP/d18z/3dbM/93WzP/c1sz/3dbN/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/9jRx/+zrqX/s66l/9jRx//d1s3/3dbM/93XzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1s3/3dbM/93WzP/Y0cf/s66l/7Oupf/Y0cf/3dbM/93WzP/d1sz/3dbM/93WzP/d1s3/3dbM/93WzP/d1s3/3dbM/93XzP+BfHf/FhUU/xQSEP8VEhD/FxUU/4F8d//d1s3/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/gXx3/xYVFP8UEhD/FBMQ/xYVFP+BfHb/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93XzP/d1sz/enZw/xQSEP8yLij/My8p/zMvKf8yLij/FBIQ/3p2cP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/c1sz/3dbM/3p3cf8UEhD/Mi4o/zMvKf8yLyn/Mi8o/xUSEP96dnH/3dbM/93WzP/d1sz/3dfM/93XzP/c1sz/3dbM/8/Jv/8SEQ//Mi4o/zIvKf8zLin/My4p/zMvKf8yLij/EhEP/8/Iv//d1sz/3dbN/93WzP/d1sz/3NbN/93WzP/Pyb//EhEP/zIuKP8zLyn/My8p/zMvKf8zLyn/Mi4o/xIRD//Pyb//3dbM/93WzP/d1sz/3dbM/9XOxP+5sab/npmS/xgXFP8zLyn/My8p/1ZSTP9JRT//My8p/zMuKf8YFxT/npmS/6WY0f/Ryc3/3dbM/93WzP/UzsT/urGm/56Zk/8YFhT/My8p/zMuKf9KRT//WVRO/zMvKf8zLyn/GBcV/56Ykv+lltH/0cjN/93Wzf/d1sz/z8i9/6aekf+Yk4z/GxgV/zMvKf8zLyn/XltU/8vGwP+RjIb/OjYw/xoYFf+Yk4z/hnbV/8e+zv/d18z/3dbM/8/Ivf+mnpL/mJOM/xoYFP8zLyn/My8p/7mzrf9iXlj/My4p/zMvKf8aGBX/mJOM/4Z21P/Hvc7/3dfM/93WzP/d1sz/3dbM/8S/tf8PDgz/My8p/zIvKf8zLyn/ODQt/4iEfv+fmpT/Dg4M/8S+tf/d183/3dbM/93XzP/d1sz/3NbM/93WzP/FvrX/Dw4M/zIvKf9uamT/rKih/zMvKf8zLyn/My8p/w4ODP/EvrX/3dbM/9zWzP/d1s3/3NbM/93XzP/GvrT/t6+j/1dUUP8eHRj/My8p/zMvKP8zLyn/My8p/x4cGP9XVFD/t6+j/8a/tP/d1sz/3dbM/93WzP/d1sz/xr+0/7avov9XVFD/HhwY/6Sgmf9GQjz/My8p/zMvKf8eHBj/V1RQ/7evo//Gv7T/3dbM/93XzP/c1sz/3dbM/8rDuP+9tar/1s/F/09MSf8QDg3/Hx0Z/x8dGf8QDw3/T0xJ/9bPxf+9tar/ysO4/93WzP/d1sz/3dbM/9zWzP/Kw7j/vbWq/9bPxv9PTUn/EA8N/x8dGf8eHRn/EA8N/09NSf/Wz8b/vbSq/8rDuP/d1sz/3dbM/93WzP/d1sz/3dbM/9zWzP/Kwrf/t6+j/7awqP+CfXn/gn14/7ewqP+2r6P/y8K3/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/c1sz/ysK3/7euo/+2saj/gn54/4J+eP+2saj/t6+j/8rCt//d1sz/3dbN/9zWzP/d1sz/3dfM/d3WzP/d1sz/3dbM/8rDuP+5sab/3dfM/7atov+2raL/3dbM/7mxpv/Lw7j/3dbM/93WzP/d1sz/3dbN/93WzP/d1sz/3dbM/93XzP/Kw7n/ubGm/93WzP+2raL/tq2i/93WzP+5sKb/ysO4/93WzP/c18z/3dbM/93WzP3d18zS3dfM/93WzP/d1sz/3NbM/93Wzf/d1sz/zMW6/8zFuv/d1sz/3NbM/93WzP/d1sz/3dfM/93Wzf/d18z/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/8zFuv/Mxbr/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dfM0t3XzlPd1sz+3dbN/93WzP/d1sz/3dbN/93WzP/d1s3/3dbM/93WzP/d1sz/3dbM/93Xzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93XzP/d1sz/3dbM/93WzP/d1sz/3NbN/93WzP/d183/3dbM/93WzP7d185TAAAAAN3XzlPd18zS3dbM/d3WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/c1sz/3dbN/93WzP/d1s3/3dbM/93WzP/d1sz/3dbN/93WzP/c1sz/3dbM/9zWzP/d18z/3dbN/93WzP/d1sz/3dbM/93WzP3c1srT3dbOUwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAADAAAABgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADbtrYH4NXLMd3VzZ/e1szn3dbM/t3WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP7e1szn3dXMn+DVyzH/1NQGAAAAAP/U1Abe181l3dXL6N3WzP/d18z/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93Vy+je181l/9TUBuDVyzHd1cvo3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1cvo4NXLMd3VzJ/d1sz/3dbM/93Wzf/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3NXMn97WzOfd1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3tbM593WzP7d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/8/Ivv+Pi4T/aGRg/2hkYf+Pi4T/z8i+/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/8/Ivv+Pi4T/aGRg/2hkYP+Pi4T/z8i+/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/t3Wzf/d1sz/3dbM/93WzP/d18z/3NbM/93WzP/Oyb//e3dx/xEREP8HBgX/CwsJ/wsLCf8HBgX/EBEQ/3p3cf/OyL//3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/OyL//e3dx/xEQEP8HBgX/CwsJ/wsLCf8HBgX/ERAQ/3p3cf/OyL//3NbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/87Iv/9WVFD/EA8N/yAdGf8tKiT/My8p/zMvKf8tKiT/IB0Z/xAPDf9WVFD/z8i//93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/87Iv/9WVFD/EA8N/yAdGf8tKiT/My8p/zMvKf8tKiT/IB0Z/xAPDf9WVFD/zsi//93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/3p3cf8QDw3/Kici/zMvKf8zLyn/My8p/zMv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zP/OyL//endx/xEQEP8HBgX/CgsJ/wsLCf8HBgX/ERAQ/3p3cf/OyL//3dbM/9jRx//Sy8D/29TK/93WzP/d18z/3dbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/9jRx/+3r6P/zcS5/8/Ivv+Pi4T/aGRg/2hkYP+Pi4T/z8i+/8zEuf+3r6P/2NHH/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/9jRx/+3r6P/zMS5/8/Ivv+Pi4T/aGRg/2hkYP+Pi4T/z8i+/8zEuf+3r6P/2NHH/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/9LKwP+OhXf/sqmd/93WzP/c1cv/wrqv/8K6r//c1cv/3dbM/7Kpnf+OhHf/0srA/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/9LKwP+OhXf/sqmd/93WzP/c1cv/wrqv/8K6r//c1cv/3dbM/7Kpnf+OhXf/0srA/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9vUyv/Ryb//19DG/93WzP/WzsT/kYd6/5CHev/WzsT/3dbM/9fQxv/Ryb//29TK/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9vUyv/Ryb//19DG/93WzP/WzsT/kId6/5CHev/Wz8T/3NbM/9fQxv/Ryb//29TK/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/wLit/8C4rf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/wLit/8C4rf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3NbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d18z/3dbM/93W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zP/d1sz/3dbM/9PLwP+WjH//tq2h/9TOxP/Fv7b/vbeu/723rv/Fv7b/1M7E/7atof+WjH//08vB/93WzP/d1sz/3dbM/93Wzf/d1sz/3NbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/9PLwP+WjH//tq2h/9TOxP/Fv7b/vbeu/723rv/Fvrb/1M7E/7atof+WjH//08vB/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP7d1sz/3dbM/93WzP/d1sz/3dbM/9PMwf+XjoH/t7Ck/93WzP/b1Mr/said/7Gonf/b1Mr/3dbM/7ewpP+XjoH/08zB/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d18z/3dbM/9PMwf+Xj4H/t7Ck/93WzP/b1Mr/said/7Gonf/b1Mr/3dbM/7ewpP+Xj4H/08zB/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/t7WzOfd1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Y0cf/3NXL/93WzP/Y0cb/mpGE/5qRhP/Y0cb/3dbM/9zVyv/Y0cf/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Y0cf/3NXL/93Wzf/Y0Mb/mpGE/5qRhP/Y0cb/3dbM/9zVy//Y0cf/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3tbM593VzJ/d18z/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/1M3C/9TNw//d1sz/3dbM/93Wzf/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/1M3C/9TNwv/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dXMn+DVyjHd1Mvo3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3NbM/93WzP/d18z/3dbM/93WzP/d1cvo4NXLMf/U1Qbe181l3NXL6N3WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Vy+je1s1l27a2BwAAAAD/1NQG4NXLMd3VzJ/e18zn3dbM/t3WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP7e1szn3dXMn+DVyzH/1NQGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==">
        <style type="text/css">
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #333; background: #EEEEEE;  padding-top: 0px; padding-bottom: 25px;  }
            h1 { font-size: 32px; margin: 0; }
            article { display: block; text-align: left; max-width: 650px; margin: 0 auto; padding-top: 15px; margin-top: 15px;}
            a { color: #FF5707; text-decoration: none; }
            a:hover { color: #333; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 26px; }
            }
			.card {
				box-sizing: border-box;
				background: #FFFFFF;
				border-radius: 5px;
				padding: 15px;
				font-size: 14px;
				margin-bottom: 15px;
			}
			
			.btn {
				background: #FF5707;
				background: #EEEEEE;
				color: black;
				padding: 15px;
				border-radius: 5px;
				cursor: pointer;
				border: none;
			}
			
			.btn:hover {
				background: black;
				color: white;
			}
			
			.btn-fr {
				float: right;
			}
			
			table {
				width: 100%;
				border: none;
			}
			table td {
				width: 100%;
			}
			
			table tr:last-child td {
				border-bottom: 0px;
			}
			
			input[type="text"], input[type="number"], input[type="password"] {
				box-sizing: border-box;
				width: 100%;
				border-radius: 5px;
				border-color: #CCCCCC;
				border-style: solid;
				border: 1px solid #CCCCCC;
				padding: 5px;
			}
			
			.containererror {
				padding: 5px; 
				background: red; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
			.containererrorg {
				padding: 5px; 
				background: green; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
        </style>
    </head>
    <body>
        <article>
	
	

	<?php
	
		if(@$_GET["proc"] == "ok") {
			?>
			<div class="card" style="background: lime; color: black;">
					The operation has been executed successfully!	
			</div>			
			<?php
		}
	
	?>

	<div class="card">
			<b style='font-size:36px; padding-bottom: 10px;'>Backend Tools</b><br />
			Empower your browsing experience with personalized control through our user-centric settings customization feature. Modify website settings exclusively for your sessions, ensuring that changes remain confined to your individual preferences without any impact on global configurations. These developer tools provide a comprehensive suite for inspecting various backend functionalities, facilitating a more streamlined understanding and navigation during the development process. For optimal usage, consider disabling this functionality by turning off HIVE_MOD_CHANGES in ruleset.php or utilizing an associated admin interface designed for this purpose. Your seamless browsing experience starts with tailored settings and efficient developer tools.<br />	
	</div>
	<div class="card">
		<b>Operational URLs:</b><br />Explore a suite of invaluable backend tools through the following links, designed to enhance your development and optimization processes!<br /><br /><br />
		<a href="./developer.php?operation=sdestroy" class="btn">Session Destroy</a> 
		<a href="./developer.php?operation=cdestroy" class="btn">Cookie Destroy</a> <br /><br /><br />
		<a href="./developer.php?operation=phpinfo" class="btn">PHPInfo</a> 
		<a href="./_core/_action/admin_switch.php" class="btn">Backend/Frontend Switch</a>
		<a href="./_core/_action/token_switch.php" class="btn">Token Switch</a>
		<br /><br />
	</div>
	<div class="card">
        <b>Change website mode:</b><br />Tailor your browsing experience effortlessly with our website's rewriting feature. Easily redefine the landing page based on conditions such as the current browser URL or active user session. Switch seamlessly between different sites (Site Modules) using the administration backend or by configuring ruleset.php through straightforward rewriting and setup. This rewriting capability allows you to personalize your online environment according to your preferences, ensuring a customized and efficient browsing experience!<br /><br />
		<b>Current Site-Module</b>: <?php echo _HIVE_MODE_; ?><br />
		<b>Session Site-Module</b>: <?php echo @$_SESSION[_HIVE_COOKIE_."hive_mode"]; ?><br />
		<b>Default Site-Module</b>: <?php echo _HIVE_MODE_DEFAULT_; ?><br />
		<b>Available Site-Modules</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_MODE_ARRAY_)) { foreach(_HIVE_MODE_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span><br /><br />
		<?php 
			if(@is_string(@$_POST["mod_change"]) AND @in_array(@$_POST["mod_change"], @_HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_POST["mod_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="mod_change" class="btn">
				<option value="<?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"]  ?? ''); ?>">Active: <?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"] ?? '' ); ?></option>
				<?php
					foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value ?? '')."'>".@htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Site</button> 		
		</form>		
		
		<br /><b>Current Site Informations</b>:<br />
		Version: <?php echo @htmlspecialchars(@$object["hive_mode"]["version"] ?? ''); ?><br />
		Build: <?php echo @htmlspecialchars(@$object["hive_mode"]["build"] ?? ''); ?><br />
		Rname: <?php echo @htmlspecialchars(@$object["hive_mode"]["rname"] ?? ''); ?><br />
		Name: <?php echo @htmlspecialchars(@$object["hive_mode"]["name"] ?? ''); ?><br />
		Short Description: <?php echo @htmlspecialchars(@$object["hive_mode"]["short"] ?? ''); ?><br />
	</div>
	<div class="card">
		<b>Change website language:</b><br />Customize your language preferences effortlessly on our website. Explore available languages configured within the current activated site modules configuration files. Take control of your linguistic experience, ensuring seamless navigation in a language that suits your preferences. Switch between languages with ease, making your interaction with the website a personalized and user-friendly journey. This functionality is available, if the current loaded site module has different languages enabled.<br /><br />
		<b>Current Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_ ?? ''); ?><br />
		<b>Session Language</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?><br />
		<b>Default Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_DEFAULT_ ?? ''); ?><br />
		<b>Available Languages</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_LANG_ARRAY_)) { foreach(_HIVE_LANG_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>
		<br />
		<?php 
			if(@is_string(@$_POST["lang_change"]) AND @in_array(@$_POST["lang_change"], @_HIVE_LANG_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$_POST["lang_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="lang_change" class="btn">
				<option value="<?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?>">Active: <?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_LANG_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Language</button>
		</form>		
	</div>
	<div class="card">
		<b>Change website theme:</b><br />Elevate your visual experience by selecting a theme that resonates with your style on our website. Explore the array of available themes configured within the current activated site modules configuration files. Tailor the website's appearance to match your preferences, with the flexibility to seamlessly switch between different themes. Immerse yourself in a personalized and visually appealing online environment, where your chosen theme enhances the overall aesthetic and usability of the site! This functionality is available, if the current loaded site module has different themes enabled.<br /><br />
		<b>Current Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_ ?? ''); ?><br />
		<b>Session Theme</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?><br />
		<b>Default Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_DEFAULT_ ?? ''); ?><br />
		<b>Available Themes</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_THEME_ARRAY_)) { foreach(_HIVE_THEME_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>	
		<br />
		<?php 
			if(@is_string(@$_POST["thm_change"]) AND @in_array(@$_POST["thm_change"], @_HIVE_THEME_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$_POST["thm_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="thm_change" class="btn">
			<option value="<?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?>">Active: <?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_THEME_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Theme</button> 
		</form>
	</div>		
	<div class="card">
		<b>Change website color:</b><br />Immerse yourself in a vibrant online experience by customizing the website's color palette dynamically. Explore a spectrum of colors available within the current activated site modules configuration files, extending beyond predefined options. Your color choices are not restricted, allowing for limitless personalization. Transform the visual aesthetics of the website effortlessly, adapting to your mood and preferences. Embrace the freedom to infuse your online journey with a burst of color that resonates with your unique style and enhances the dynamic themes at your fingertips! This functionality is available, if the current loaded site module has dynamic theme colors enabled.<br /><br />
		<b>Current Color</b>: <?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?><br />
		<b>Session Color</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] ?? ''); ?><br />	
		<b>Default Color</b>: <?php echo htmlspecialchars(_HIVE_THEME_COLOR_DEFAULT_ ?? ''); ?><br />		
		<br />
		<?php 
			if(@is_string(@$_POST["ctsd_change"])) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$_POST["ctsd_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<input type="color" name="ctsd_change" value='<?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?>'>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="btn">Change Theme Color</button> 
		</form>
	</div>
			
				<center><font size="-1"><?php echo _HIVE_CREATOR_; ?></font></center>
			</article>
    </body>
</html>